<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\InvoiceCustomer;
use App\InvoiceProject;
use App\Project;
use App\Customer;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::select('invoices.*', 'invoice_customers.customer_id as customer_id', 'customers.name as customer_name')
        ->leftjoin('invoice_customers', function($join)
        {
            $join->on('invoices.id', '=', 'invoice_customers.invoice_id');
        })
        ->leftjoin('customers', function($join)
        {
            $join->on('invoice_customers.customer_id', '=', 'customers.id');
        })
        ->orderBy('nomor','ASC')
        ->get();

        $projects = Invoice::select('invoice_projects.invoice_id','projects.name as project_name', 'projects.info as project_info', 'projects.tarif as project_tarif', 'invoice_projects.quantity')

        ->join('invoice_projects', function($join)
        {
            $join->on('invoices.id', '=', 'invoice_projects.invoice_id');
        })
        ->join('projects', function($join)
        {
            $join->on('invoice_projects.project_id', '=', 'projects.id');
        })
        ->get();
        echo $invoices;
        // echo $projects;
        return view('invoice.index', compact('invoices', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $projects = Project::all();
        return view('invoice.create', compact('customers', 'projects'));
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
            'customer_id'=>'required',
            'jenis_pajak'=>'required|integer',
            'project_id.*'=>'required',
            'quantity.*'=>'required'
        ]);
        $month = date('m');
        if ($month == '01') $noMonth = 'E';
        else if ($month == '02') $noMonth = 'F';
        else if ($month == '03') $noMonth = 'G';
        else if ($month == '04') $noMonth = 'H';
        else if ($month == '05') $noMonth = 'I';
        else if ($month == '06') $noMonth = 'J';
        else if ($month == '07') $noMonth = 'K';
        else if ($month == '08') $noMonth = 'L';
        else if ($month == '09') $noMonth = 'M';
        else if ($month == '10') $noMonth = 'N';
        else if ($month == '11') $noMonth = 'O';
        else if ($month == '12') $noMonth = 'P';
        $nomor;
        $year = date('y');
        $noYear = $year;
        $noMonthYear = $noMonth.$noYear;
        $cekNomor = Invoice::select("nomor")
        ->whereMonth('created_at', $month)
        ->orderBy('id', 'DESC')
        ->first();
        // echo $cekNomor;
        if ($cekNomor == NULL)
        {
            $nomor = $noMonthYear.'-01';
        }
        else if ($noMonthYear == substr($cekNomor->nomor, 0, 3))
        {
            
            $temp = explode('-', $cekNomor)[1];
            $noLastNomor = explode("\"", $temp)[0];
            echo $noLastNomor;
            $noLastNomor++;
            if ($noLastNomor<10)
            {
                $noLastNomor = '0'.$noLastNomor;
            }
            $nomor = $noMonthYear.'-'.$noLastNomor;
        }
        

        $invoice = new Invoice([
            'tanggal' => date("Y-m-d"),
            'nomor' => $nomor,
            'jenis_pajak' => $request->get('jenis_pajak')
        ]);

        $invoice->save();
        $invoiceCustomer = new InvoiceCustomer([
            'customer_id' => $request->get('customer_id'),
            'invoice_id' => $invoice->id
        ]);
        $invoiceCustomer->save();
        $iterateProject = 0;
        $iterateQuantity =0;
        foreach ($request->get('project_id') as $project_id) 
        {
            $iterateQuantity =0;
            foreach ($request->get('quantity') as $quantity) 
           {
                if ($project_id != NULL && $quantity!=NULL)
                {
                    if ($iterateProject == $iterateQuantity)
                    {
                        $invoiceProject = new InvoiceProject([
                            'project_id' => $project_id,
                            'quantity' => $quantity,
                            'invoice_id' => $invoice->id
                        ]);
                        $invoiceProject->save();
                    }
                $iterateQuantity++;
                }
            }
            $iterateProject++;
        }
 
        $updateJumlah = $this->updateJumlah($invoice);
        return redirect('/invoice')->with('success', 'Invoice has been added');
    }

    public function updateJumlah($invoice)
    {
        $projects = $this->getProjects($invoice);
        $jumlah = 0;
        foreach ($projects as $project) {
            $jumlah = $jumlah + ( $project->tarif * $project->quantity);
        }
        // $pajak = $jumlah / 10;
        
        $updateInvoice = Invoice::find($invoice->id);
        $updateInvoice->jumlah = $jumlah;
        $pajak = $updateInvoice->jenis_pajak * $jumlah /100;
        $updateInvoice->pajak = $pajak;
        $jumlah_total = $jumlah + $pajak;
        $updateInvoice->jumlah_total = $jumlah_total;
        $updateInvoice->save();
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
        $invoice = Invoice::select('invoices.*', 'invoice_customers.customer_id as customer_id', 'customers.name as customer_name')
        ->join('invoice_customers', function($join)
        {
            $join->on('invoices.id', '=', 'invoice_customers.invoice_id');
        })
        ->join('customers', function($join)
        {
            $join->on('invoice_customers.customer_id', '=', 'customers.id');
        })
        ->where('invoices.id', $id)
        ->first();

        $projects = Invoice::select('invoice_projects.invoice_id','projects.id as project_id','projects.name as project_name', 'projects.info as project_info', 'projects.tarif as project_tarif', 'invoice_projects.quantity')
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
        ->where('invoices.id', $id)
        ->get();
        
        $customers = Customer::all();
        $allProjects = Project::all();
        // echo $invoice;
        // echo $projects;
        // echo $allProjects;
        // echo $customers;
        return view('invoice.edit', compact('invoice', 'projects', 'allProjects', 'customers'));
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
            'customer_id'=>'required|integer'
        ]);

        $invoice = Invoice::find($id);
        $invoice->nomor = $request->get('nomor');
        
        $invoiceCustomerId =  InvoiceCustomer::select('id')
        ->where('invoice_id', $invoice->id)
        ->first();
        $invoiceCustomerId->customer_id = $request->get('customer_id');
        $invoiceCustomerId->save();

        $invoiceProjects = InvoiceProject::select('id')
        ->where('invoice_id', $id)
        ->get();

        $iterateProject = 0;
        $iterateQuantity =0;
        $iterateId=0;
        foreach ($invoiceProjects as $invoiceProjectId) {
            $iterateProject = 0;
            foreach ($request->get('project_id') as $project_id) 
            {
                $iterateQuantity =0;
                foreach ($request->get('quantity') as $quantity)
                {
                    if ($iterateProject == $iterateQuantity && $iterateProject==$iterateId )
                    {
                        $invoiceProject = InvoiceProject::find($invoiceProjectId->id);
                        $invoiceProject->project_id = $project_id;
                        $invoiceProject->quantity = $quantity;
                        $invoiceProject->save();
                    }
                    $iterateQuantity++;
                }
                $iterateProject++;
            }
            $iterateId++;
        }
        $updateJumlah = $this->updateJumlah($invoice);

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
