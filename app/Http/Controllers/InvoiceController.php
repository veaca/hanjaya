<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\InvoiceCustomer;
use App\InvoiceVendor;
use App\InvoiceProject;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoice.create');
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
            'nomor'=>'required',
            'customer_id'=>'required|integer',
            'vendor_id'=>'required|integer',

            //projects are > 1
            'project_id'=>'required|integer'
        ]);
        $invoice = new Invoice([
            'tanggal' => date("Y-m-d"),
            'nomor' => $request->get('nomor')
        ]);
        $invoice->save();

        $invoiceCustomer = new InvoiceCustomer([
            'customer_id' => $request->get('customer_id'),
            'invoice_id' => $invoice->id
        ]);
        $invoiceCustomer->save();

        $invoiceVendor = new InvoiceVendor([
            'vendor_id' => $request->get('vendor_id'),
            'invoice_id' => $invoice->id
        ]);
        $invoiceVendor->save();
       
        //projects are >1
        $invoiceProject = new InvoiceProject([
            'project_id' => $request->get('project_id'),
            'invoice_id' => $invoice->id
        ]);
        $invoiceProject->save();

        $projects = InvoiceProject::select('projects.name', 'projects.info', 'projects.tarif', 'projects.jumlah')
        ->join('projects', function($join){
            $join->on('invoice_projects.project_id', '=', 'projects.id');
        })
        ->where('invoice_id', $invoice->id)
        ->get();
        // echo $projects;
        return redirect('/invoice/create')->with('success', 'Invoice has been added');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();
    }
}
