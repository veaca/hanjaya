<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Invoice;
use App\Project;
use App\InvoiceProject;
use App\Nota;
use App\NotaDetail;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
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
            'address'=>'required|max:150',
            'phone'=>'required|max:18',
            'npwp'=>'required|max:20',
            'ppn'=>'required|integer|max:10'
        ]);
        $customer = new Customer([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'phone' => $request->get('phone'),
            'npwp' => $request->get('npwp'),
            'ppn' => $request->get('ppn')
        ]);
        $customer->save();
        return redirect('/customer')->with('success', 'Customer has been added');
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
        $customer = Customer::find($id);

        return view('customer.edit', compact('customer'));
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
            'address'=>'required|max:150',
            'phone'=>'required|max:18',
            'npwp'=>'required|max:20',
            'ppn'=>'required|integer|max:10'
        ]);

        $customer = Customer::find($id);
        $customer->name = $request->get('name');
        $customer->address = $request->get('address');
        $customer->phone = $request->get('phone');
        $customer->npwp = $request->get('npwp');
        $customer->ppn = $request->get('ppn');
        $customer->save();

        $invoices = Invoice::select("invoices.id as id")
        ->join('invoice_projects', function($join){
            $join->on('invoice_projects.invoice_id', '=', 'invoices.id');
        })
        ->join('projects', function($join){
            $join->on('projects.id', '=', 'invoice_projects.project_id');
        })
        ->join('customers', function($join){
            $join->on('customers.id', '=', 'projects.customer_id');
        })
        ->where('customers.id', $id)
        ->get();

        foreach ($invoices as $invoice) {
            $update = Invoice::find($invoice->id);

            $project = Project::select()
            ->join('invoice_projects', function($join){
                $join->on('projects.id', '=', 'invoice_projects.project_id');
            })
            ->join('invoices', function($join){
                $join->on('invoices.id', '=', 'invoice_projects.invoice_id');
            })
            ->where('invoice_id', $invoice->id)
            ->first();
            

            $jumlahPpn = ($project->nilai_project * $request->get("ppn"))/100;
            $jumlahInvoice = $project->nilai_project + $jumlahPpn;
            $invoice->jumlah_ppn = $jumlahPpn;
            $invoice->jumlah_invoice = $jumlahInvoice;
            $invoice->save();
        };

        return redirect('/customer')->with('success', 'Customer has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $projects = Project::select('*')
        ->where('customer_id', $id)
        ->get();
        
        foreach ($projects as $project) {
            $invoices = InvoiceProject::select('*')
            ->where('project_id', $project->id)
            ->get();
            $notas = Nota::select('*')
            ->where('project_id', $project->id)
            ->get();
            foreach ($invoices as $invoice) {
                $delInvoice = Invoice::find($invoice->invoice_id);
                $delInvoice->delete();
                $invoice->delete();
            }
            foreach ($notas as $nota) {
                $notaDetails = NotaDetail::select('*')
                ->where('nota_id', $nota->id)
                ->get();
                foreach ($notaDetails as $notaDetail) {
                    $delNotaDetail = NotaDetail::find($notaDetail->id);
                    $delNotaDetail->delete();
                }
                $nota->delete();
            }
            $project->delete();
        }
        $customer->delete();

        return redirect('customer')->with('success', 'Customer has been deleted successfully');
    }
}
