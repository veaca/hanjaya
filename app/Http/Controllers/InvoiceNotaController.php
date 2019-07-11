<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InvoiceNota;
use App\Invoice;
use App\Nota;

class InvoiceNotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoiceNotas = InvoiceNota::select("invoice_notas.*", "invoices.id as invoice_id", "invoices.nomor as invoice_nomor", "notas.id as nota_id", "notas.NOP as nota_nop")
        ->join('invoices', function($join){
            $join->on('invoice_notas.invoice_id', '=', 'invoices.id');
        })
        ->join('notas', function($join){
            $join->on('invoice_notas.nota_id', '=', 'notas.id');
        })
        ->get();
        // echo $invoiceNotas;
        return view('invoicenota.index', compact('invoiceNotas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoices = Invoice::all();
        $notas = Nota::all();
        return view('invoicenota.create', compact('invoices', 'notas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'invoice_id'=>'required|integer',
            'nota_id'=>'required|integer'
        ]);
        
        $InvoiceNota = new InvoiceNota([
            'invoice_id' => $request->get('invoice_id'),
            'nota_id' => $request->get('nota_id')
        ]);

        $InvoiceNota->save();
        return redirect('invoicenota');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoiceNota = InvoiceNota::find($id);
        $invoices = Invoice::all();
        $notas = Nota::all();

        return view('invoicenota.edit', compact('invoiceNota', 'invoices', 'notas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $invoiceNota = InvoiceNota::find($id);
        $invoiceNota->invoice_id = $request->get('invoice_id');
        $invoiceNota->nota_id = $request->get('nota_id');
        $invoiceNota->save();

        return redirect('invoicenota')->with('success', 'Invoice dan Nota has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoiceNota = InvoiceNota::find($id);
        $invoiceNota->delete();

        return redirect('invoicenota')->with('success', 'Invoice Nota has been deleted');
    }
}
