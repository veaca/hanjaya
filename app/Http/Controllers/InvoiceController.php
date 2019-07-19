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
        $invoices = Invoice::select('invoices.id as id', 'invoices.jumlah_ppn', 'invoices.jumlah_invoice','invoices.tanggal as tanggal', 'invoices.nomor as nomor','invoices.info as info', 'customers.name as name' ,'customers.address as address' , 'projects.nop as nop', 'projects.tarif as tarif', 'projects.qty as qty')
        ->join('invoice_projects', function($join){
            $join->on('invoice_projects.invoice_id', '=', 'invoices.id');
        })
        ->join('projects', function($join){
            $join->on('projects.id', '=', 'invoice_projects.project_id');
        })
        ->join('customers', function($join){
            $join->on('customers.id', '=', 'projects.customer_id');
        })
        ->get();
        // echo $invoices;
        // echo $projects;
        return view('invoice.index', compact('invoices'));
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
        return view('invoice.create', compact( 'projects'));
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
            'project_id' => 'required',
            'info' => 'required'
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

        $ppn = Project::select('projects.*', 'customers.ppn as ppn')
        ->join('customers', function($join){
            $join->on('customers.id', '=', 'projects.customer_id');
        })
        ->first();
        $jumlahPpn = ($ppn->nilai_project * $ppn->ppn) / 100;
        $jumlahInvoice = $ppn->nilai_project + $jumlahPpn;

        $invoice = new Invoice([
            'tanggal' => date("Y-m-d"),
            'nomor' => $nomor,
            'info' => $request->get('info'),
            'jumlah_ppn' => $jumlahPpn,
            'jumlah_invoice' => $jumlahInvoice
        ]);
        $invoice->save();
        $invoiceProject = new InvoiceProject([
            'invoice_id' => $invoice->id,
            'project_id' => $request->get('project_id')
        ]);
        
        $invoiceProject->save();
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
        $invoice = Invoice::find($id);
        $projects = Project::all();
        return view('invoice.edit', compact('invoice', "projects"));
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
        // $request->validate([
        //     'customer_id'=>'required',
        //     'jenis_pajak'=>'required|integer|max:100',
        //     'project_id.*'=>'required',
        //     'quantity.*'=>'required|integer|max:10000000000'
        // ]);

        $invoice = Invoice::find($id);
        $invoiceProject = InvoiceProject::select('*')
        ->where('invoice_id', $id)
        ->first();
        $invoiceProject->project_id = $request->get('project_id');
        $project = Project::find($request->get('project_id'));
        $customer = Customer::find($project->customer_id);
        $jumlahPpn = ($project->nilai_project * $customer->ppn) /100;
        $jumlahInvoice = $project->nilai_project + $jumlahPpn;
        
        $invoice->info = $request->get('info');
        $invoice->jumlah_ppn = $jumlahPpn;
        $invoice->jumlah_invoice = $jumlahInvoice;
        $invoiceProject->save();
        $invoice->save();
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
        // echo $id;
        $invoice = Invoice::find($id);
        $invoice->delete();

        return redirect('invoice')->with('success', 'Invoice has been successfully deleted');
    }
}
