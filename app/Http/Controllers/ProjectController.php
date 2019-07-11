<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Invoice;
use App\InvoiceProject;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create');
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
            'name'=>'required|max:100',
            'info'=>'required|max:150',
            'tarif'=>'required|integer|max:100000000000000'
        ]);
        $project = new Project([
            'name' => $request->get('name'),
            'info' => $request->get('info'),
            'tarif' => $request->get('tarif')
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

        return view('project.edit', compact('project'));
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
        $request->validate([
            'name'=>'required|max:100',
            'info'=>'required|max:150',
            'tarif'=>'required|integer|max:100000000000000'
        ]);
        $project = Project::find($id);
        $project->name = $request->get('name');
        $project->info = $request->get('info');
        $project->tarif = $request->get('tarif');
        $project->save();

        $invoiceIds = Project::select('invoice_projects.invoice_id as invoice_id')
        ->join('invoice_projects', function($join){
            $join->on('invoice_projects.project_id', '=', 'projects.id');
        })
        ->get();
        
        foreach ($invoiceIds as $invoiceId) {
            // echo $invoiceId;
            $invoice = Invoice::select('*')
            ->where('id', $invoiceId->invoice_id)
            ->first();
            $projects = $this->getProjects($invoice->id);
            $jumlah = 0;
            foreach ($projects as $project) {
                $jumlah = $jumlah + ( $project->tarif * $project->quantity);
            }
            $pajak = $jumlah / 10;
            $jumlah_total = $jumlah + $pajak;

            $updateInvoice = Invoice::select('*')
            ->where('id', $invoiceId->invoice_id)
            ->first();
            $updateInvoice->jumlah = $jumlah;
            $updateInvoice->pajak = $pajak;
            $updateInvoice->jumlah_total = $jumlah_total;
            $updateInvoice->save();
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
