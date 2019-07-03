<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice; 
use App\Project;
use App\Customer;
use App\InvoiceCustomer;
use App\InvoiceProject;
use App\Pdf;

class PrintInvoiceController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);
        $customer = InvoiceCustomer::select('customers.name', 'customers.address', 'customers.phone')
        ->join('customers', function($join){
            $join->on('invoice_customers.customer_id', '=', 'customers.id');
        })
        ->where('invoice_customers.invoice_id', $invoice->id)
        ->first();
        $projects = InvoiceProject::select('*')
        ->join('projects', function($join)
        {
            $join->on('invoice_projects.project_id', '=', 'projects.id');
        })
        ->where('invoice_projects.invoice_id', $invoice->id)
        ->get();
        // $invoice->created_at = $invoice->created_at->toFormattedDateString();
        // echo $projects;
        // echo $customer;
        // echo $invoice;

        return view('print.index', compact('projects', 'customer', 'invoice'));
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
        $customer = InvoiceCustomer::select('customers.name', 'customers.address', 'customers.phone')
        ->join('customers', function($join){
            $join->on('invoice_customers.customer_id', '=', 'customers.id');
        })
        ->where('invoice_customers.invoice_id', $invoice->id)
        ->first();
        $projects = InvoiceProject::select('*')
        ->join('projects', function($join)
        {
            $join->on('invoice_projects.project_id', '=', 'projects.id');
        })
        ->where('invoice_projects.invoice_id', $invoice->id)
        ->get();
        // echo $laporan;
        // echo $invoice;
        // echo $customer;
        // echo $projects;
        $pdf = new Pdf;
        // echo $pdf;
        $output = $pdf->generateInvoice($invoice, $customer, $projects);
        $headers = [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="invoice.pdf"'];
        return response($output)->withHeaders($headers);
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
        //
    }
}
