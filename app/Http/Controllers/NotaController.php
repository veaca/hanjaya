<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nota;
use App\NotaDetail;
use App\NotaNotaDetail;
use App\NotaVendor;
use App\Vendor;
use App\Project;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notas = Nota::select('notas.*','vendors.name as vendor_name', 'projects.nop',  'projects.asal', 'projects.tujuan', 'projects.tarif_vendor')
        ->join('vendors', function($join){
            $join->on('notas.vendor_id', '=', 'vendors.id');
        })
        ->join('projects', function($join){
            $join->on('notas.project_id', '=', 'projects.id');
        })
        ->get();
        
        // echo $notas;
        return view('nota.index', compact('notas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendor::all();
        $projects = Project::all();

        return view('nota.create', compact('vendors', 'projects'));
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
            'vendor_id'=>'required',
            'project_id'=>'required',
            'jenis_tambahan'=>'required|max:50',
            'jumlah_tambahan'=>'required|numeric|max:1000000000',
            'nopol'=>'required|max:10',
            'kg'=>'required|numeric|max:10000'
        ]);
        $project = Project::find($request->project_id);
        $pph = Vendor::select('pph')
        ->where('id', $request->vendor_id)
        ->first();
        $ongkosNota = $project->tarif_vendor * $request->get('kg');
        // echo $ongkosNota;
        if ($request->get('jenis_tambahan') == 'Penambahan')
            {
                $ongkosNota = $ongkosNota + $request->get('jumlah_tambahan');
            }
        else 
            {
                $ongkosNota = $ongkosNota - $request->get('jumlah_tambahan');
            }
            
        $jumlahPph = ($ongkosNota * $pph->pph)/100;
        $jumlahOngkosNota = $ongkosNota + $jumlahPph;
        
    // //    echo $tarifVendor->tarif_vendor;
        $nota = new Nota([
            'tanggal' => date("Y-m-d"),
            'vendor_id' => $request->get('vendor_id'),
            'project_id' => $request->get('project_id'),
            'jenis_tambahan' => $request->get('jenis_tambahan'),
            'jumlah_tambahan' => $request->get('jumlah_tambahan'),
            'nopol' => $request->get('nopol'),
            'kg' => $request->get('kg'),
            'jumlah_pph' => $jumlahPph,
            'ongkos_nota' => $jumlahOngkosNota
        ]);
        $nota->save();
        
        return redirect('/nota')->with('success', 'Nota has been added');
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
        $nota = Nota::find($id);
        $vendors = Vendor::all();
        $projects = Project::all();
        return view('nota.edit', compact('nota', 'projects', 'vendors' ));
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
        //     'vendor'=>'required',
        //     'asal'=>'required|max:50',
        //     'tujuan'=>'required|max:50',
        //     'NOP'=>'required|max:50',
        //     'jenis_tambahan'=>'required|max:50',
        //     'jumlah_tambahan'=>'required|numeric|max:1000000000',
        //     'nopol.*'=>'required|max:10',
        //     'collies.*'=>'required|numeric|max:10000',
        //     'kg.*'=>'required|numeric|max:10000',
        //     'ongkos.*'=>'required|numeric|max:10000000000'
        // ]);

            $nota = Nota::find($id);
            $nota->project_id = $request->get('project_id');
            $nota->vendor_id = $request->get('vendor_id');
            $nota->jenis_tambahan = $request->get('jenis_tambahan');
            $nota->jumlah_tambahan = $request->get('jumlah_tambahan');
            $nota->nopol = $request->get('nopol');
            $nota->kg = $request->get('kg');

            $vendor = Vendor::find($request->get('vendor_id'));
            $project = Project::find($request->get('project_id'));
            
            $ongkos = ($project->tarif_vendor*$request->get('kg')) ;
            if ($request->get('jenis_tambahan') == 'Penambahan')
            {
                $ongkos = $ongkos + $request->get('jumlah_tambahan');
            }
            else 
            {
                $ongkos = $ongkos - $request->get('jumlah_tambahan');
            }
            $jumlahPph = ($ongkos * $vendor->pph) /100;
            $ongkosNota =  $ongkos + $jumlahPph;
            $nota->jumlah_pph = $jumlahPph;
            $nota->ongkos_nota = $ongkosNota;
            $nota->save();
        return redirect('nota')->with('success', 'Nota has been updated');
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
        $nota = Nota::find($id);
        $nota->delete();

        return redirect('nota')->with('success', 'Nota has been deleted successfully');
    }
}
