<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\InvoiceCustomer;
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
        $invoices = Invoice::select('invoices.*', 'invoice_customers.customer_id as customer_id', 'projects.name as project_name', 'projects.info as project_info', 'projects.tarif as project_tarif', 'invoice_projects.quantity')
        ->join('invoice_customers', function($join)
        {
            $join->on('invoices.id', '=', 'invoice_customers.invoice_id');
        })
        ->join('invoice_projects', function($join)
        {
            $join->on('invoices.id', '=', 'invoice_projects.invoice_id');
        })
        ->join('projects', function($join)
        {
            $join->on('invoice_projects.project_id', '=', 'projects.id');
        })
        ->get();

        // $invoices = Invoice::select('invoices.*', 'invoice_projects.project_id')
        // ->join('invoice_projects', function($join)
        // {
        //     $join->on('invoices.id', '=', 'invoice_projects.invoice_id');
        // })
        // ->get(); 
        // $invoices = Invoice::all();
        return view('invoice.index', compact('invoices'));
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
            'project_id'=>'required|integer',
            'quantity'=>'required|integer'
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
        return redirect('/invoice')->with('success', 'Invoice has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::find($id);

        return view('invoice.edit', compact('invoice'));
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
        $request->validate([
            'nomor'=>'required',
            'customer_id'=>'required|integer',

            //projects are > 1
            'project_id'=>'required|integer',
            'quantity'=>'required|integer'
        ]);

        $invoice = Invoice::find($id);
        $invoice->nomor = $request->get('nomor');
        
        $invoiceCustomerId =  InvoiceCustomer::select('id')
        ->where('invoice_id', $invoice->id)
        ->first();
        $invoiceCustomerId->customer_id = $request->get('customer_id');
        $invoiceCustomerId->save();
        // $invoiceCustomer = InvoiceCustomer::update('invoice_customers set customer_id = ? where invoice_id = ?', [$request->customer_id, $id]);
        // $invoiceCustomer = InvoiceCustomer::find($invoiceCustomerId);
        
        // $invoiceCustomer->customer_id = $request->get('customer_id');
        // // echo $invoiceCustomer;
        // $invoiceCustomer->save();
        
        // $invoice->customer_id = $request->get('customer_id');
        
        $invoiceProjectId = InvoiceProject::select('id')
        ->where('invoice_id', $invoice->id)
        ->get();
        $invoiceProject = InvoiceProject::find($invoiceProjectId);
        $invoiceProject->quantity = $request->get('quantity');
        // ;
        // $invoice->save();
        // $invoiceCustomer->save();
        // $invoiceProject->save();
        return redirect('invoice')->with('success', 'Invoice has been updated');
        
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

        return redirect('invoice')->with('success', 'Invoice has been successfully deleted');
    }
}
