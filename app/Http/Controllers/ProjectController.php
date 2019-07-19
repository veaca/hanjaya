<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Customer;
use App\Invoice;
use App\InvoiceProject;
use App\Nota;
use App\Vendor;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::select('projects.*', 'customers.name as name')
        ->join('customers', function($join){
            $join->on('customers.id', '=', 'projects.customer_id');
        })
        ->get();

        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        return view('project.create', compact('customers'));
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
            'nop'=>'required',
            'customer_id'=>'required',
            'spk' => 'required',
            'asal' => 'required',
            'tujuan' => 'required',
            'tarif'=>'required|integer|max:100000000000000',
            'qty' => 'required',
            'tarif_vendor' => 'required'
        ]);
        //CUSTOMER ID MASUKIN DI TABEL GABUNGAN
        $project = new Project([
            'nop' => $request->get('nop'),
            'customer_id' => $request->get('customer_id'),
            'spk' => $request->get('spk'),
            'asal' => $request->get('asal'),
            'tujuan' => $request->get('tujuan'),
            'tarif' => $request->get('tarif'),
            'qty' => $request->get('qty'),
            'tarif_vendor' => $request->get('tarif_vendor'),
            'nilai_project' => $request->get('tarif') * $request->get('qty')
        ]);
        $project->save();
        return redirect('/project')->with('success', 'Project has been added');
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
        $project = Project::find($id);
        $customers = Customer::all();
        return view('project.edit', compact('project', 'customers'));
    }

    public function getProjects($invoiceId){
        $projects = InvoiceProject::select('projects.name', 'projects.info', 'projects.tarif as tarif', 'invoice_projects.quantity')
        ->join('projects', function($join){
            $join->on('invoice_projects.project_id', '=', 'projects.id');
        })
        ->where('invoice_id', $invoiceId)
        ->get();
        
        return $projects;
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
        //     'nop'=>'required',
        //     'customer_id'=>'required',
        //     'spk' => 'required',
        //     'asal' => 'required',
        //     'tujuan' => 'required',
        //     'tarif'=>'required|integer|max:100000000000000',
        //     'qty' => 'required',
        //     'tarif_vendor' => 'required'
        // ]);
        $project = Project::find($id);
        $project->nop = $request->get('nop');
        $project->spk = $request->get('spk');
        $project->asal = $request->get('asal');
        $project->tujuan = $request->get('tujuan');
        $project->tarif = $request->get('tarif');
        $project->qty = $request->get('qty');
        $project->tarif_vendor = $request->get('tarif_vendor');
        $project->nilai_project = $request->get('tarif') * $request->get('qty');
        
        $project->save();

        $invoiceIds = Invoice::select('invoices.id as id', 'invoice_projects.project_id', 'customers.ppn')
        ->join('invoice_projects', function($join){
            $join->on('invoices.id', '=', 'invoice_projects.invoice_id');
        })
        ->join('projects', function($join){
            $join->on('projects.id', '=', 'invoice_projects.project_id');
        })
        ->join('customers', function($join){
            $join->on('customers.id', '=', 'projects.customer_id');
        })
        ->where('invoice_projects.project_id', $id)
        ->get();
        
        foreach ($invoiceIds as $invoiceId) {
            $invoice = Invoice::find($invoiceId->id);
            $project = Project::find($invoiceId->project_id);
            $jumlahPpn = ($project->nilai_project * $invoiceId->ppn) / 100;
            $jumlahInvoice = $project->nilai_project + $jumlahPpn;
            $invoice->jumlah_ppn = $jumlahPpn;
            $invoice->jumlah_invoice = $jumlahInvoice;
            $invoice->save();
        }

        $notaIds = Nota::select('id', 'vendor_id')
        ->where('project_id', $id)
        ->get();

        foreach ($notaIds as $notaId) {
            $nota = Nota::find($notaId->id);
            $vendor = Vendor::find($notaId->vendor_id);
            $project = Project::find($id);

            $ongkos = $request->get('tarif_vendor') * $nota->kg;
            // echo $ongkos;
            $jumlahPph = ($ongkos * $vendor->pph) /100;
            // echo $jumlahPph;
            $ongkosNota = $ongkos+$jumlahPph;
            // echo $ongkosNota;
            $nota->jumlah_pph = $jumlahPph;
            $nota->ongkos_nota = $ongkosNota;
            $nota->save();
        }
        return redirect('/project')->with('success', 'Project has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();

        return redirect('project')->with('success', 'Project has been removed successfully');
    }
}
