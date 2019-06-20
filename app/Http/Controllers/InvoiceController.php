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

    public function getProjects($invoice){
        $projects = InvoiceProject::select('projects.name', 'projects.info', 'projects.tarif as tarif', 'invoice_projects.quantity')
        ->join('projects', function($join){
            $join->on('invoice_projects.project_id', '=', 'projects.id');
        })
        ->where('invoice_id', $invoice->id)
        ->get();

        return $projects;
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
       
        // projects are >1
        $invoiceProject = new InvoiceProject([
            'project_id' => $request->get('project_id'),
            'quantity' => $request->get('quantity'),
            'invoice_id' => $invoice->id
        ]);
        $invoiceProject->save();

        $projects = $this->getProjects($invoice);
        // echo $projects->tarif;
        $jumlah = 0;
        foreach ($projects as $project) {
            $jumlah = $project->tarif * $project->quantity;
        }
        $pajak = $jumlah / 10;
        $jumlah_total = $jumlah + $pajak;


        $updateInvoice = Invoice::find($invoice->id);
        $updateInvoice->jumlah = $jumlah;
        $updateInvoice->pajak = $pajak;
        $updateInvoice->jumlah_total = $jumlah_total;
        $updateInvoice->save();
        // $invoiceProject = Invoice::find(1);
        // $invoiceProject->jumlah = $jumlah;
        // $invoiceProject->save();

        
        // echo $projects['']->tarif;
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
