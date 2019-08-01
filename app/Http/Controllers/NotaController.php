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
        ->leftjoin('vendors', function($join){
            $join->on('notas.vendor_id', '=', 'vendors.id');
        })
        ->leftjoin('projects', function($join){
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
        $selectedProjects = Nota::select('project_id')
        ->distinct('project_id')
        ->get();
        $arr = [];
        $x =0 ;
        foreach ($selectedProjects as $selectedProject) {
            $arr[$x] = $selectedProject->project_id;
            $x++;
        }
        $vendors = Vendor::all();
        $projects = Project::select('*')
        ->whereNotIn('id', $arr)
        ->get();
        if ($projects->isEmpty())
        {
            return redirect('nota')->with('error', 'Belum Ada Project Yang Dapat Di Assign');
        }
        if ($vendors->isEmpty())
        {
            return redirect('nota')->with('error', 'Belum Ada Vendor Yang Dapat Di Assign');
        }
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
            'nopol.*'=>'required|max:10',
            'kg.*'=>'required|numeric|max:10000'
        ]);
        $ongkosNota =0 ;
        $project = Project::find($request->project_id);
        $pph = Vendor::select('pph')
        ->where('id', $request->vendor_id)
        ->first();
        foreach ($request->get('kg') as $kg) {
            $ongkosNota = $ongkosNota + $project->tarif_vendor * $kg;
        }
        // $ongkosNota = $project->tarif_vendor * $request->get('kg');
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
            'jumlah_pph' => $jumlahPph,
            'ongkos_nota' => $jumlahOngkosNota
        ]);
        $nota->save();
        $idxNopol = 0;
        $idxKg =0;
        foreach ($request->get('nopol') as $nopol) 
        {
            $idxKg=0;
            foreach ($request->get('kg') as $kg) {
                if($idxNopol == $idxKg)
                {
                    $notaDetail = new NotaDetail([
                        'nota_id' => $nota->id,
                        'nopol' => $nopol,
                        'kg' => $kg,
                        'ongkos' => $project->tarif_vendor * $kg
                    ]);
                    $notaDetail->save();
                    
                }
                $idxKg++;
            }
            $idxNopol++;
        }
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
        $nota = Nota::select('notas.*', 'projects.asal as asal', 'projects.tujuan as tujuan', 'projects.tarif_vendor as tarif_vendor', 'vendors.pph as pph')
        ->join('vendors', function($join){
            $join->on('notas.vendor_id', '=', 'vendors.id');
        })
        ->join('projects', function($join){
            $join->on('notas.project_id', '=', 'projects.id');
        })
        ->where('notas.id', $id)
        ->first();
        $notaDetails = NotaDetail::select('*')
        ->where('nota_id', $id)
        ->get();
        $vendors = Vendor::all();
        $projects = Project::all();
        // echo $notaDetails;
        return view('nota.edit', compact('nota', 'projects', 'vendors', 'notaDetails' ));
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
            'vendor_id'=>'required',
            'project_id'=>'required',
            'jenis_tambahan'=>'required|max:50',
            'jumlah_tambahan'=>'required|numeric|max:1000000000',
            'nopol.*'=>'required|max:10',
            'kg.*'=>'required|numeric|max:10000'
        ]);
            $idxNopol = 0;
            $idxKg =0;
            
            $nota = Nota::find($id);
            $nota->project_id = $request->get('project_id');
            $nota->vendor_id = $request->get('vendor_id');
            $nota->jenis_tambahan = $request->get('jenis_tambahan');
            $nota->jumlah_tambahan = $request->get('jumlah_tambahan');
            $vendor = Vendor::find($request->get('vendor_id'));
            $project = Project::find($request->get('project_id'));
            $notaDetails = NotaDetail::select('*')
            ->where('nota_id', $id)
            ->get();
            $notaDetailsCount = NotaDetail::select('*')
            ->where('nota_id', $id)
            ->get()
            ->count();
            // echo $notaDetailsCount;
            $idx =0;
            $ongkos=0;
            $size = sizeOf($request->get('kg'));
           echo $size;
           $batas;
            if ($size <= $notaDetailsCount) 
            {
                $batas = $size;
            }
            else 
            {
                $batas = $notaDetailsCount;
            }
            // echo $notaDetails[0];
            if ($size <= $notaDetailsCount){
                for ($idx ; $idx<$batas ; $idx++)
                {
                    $notaDetails[$idx]->nopol = $request->get('nopol')[$idx];
                    $notaDetails[$idx]->kg = $request->get('kg')[$idx];
                    $notaDetails[$idx]->ongkos = $project->tarif_vendor * $request->get('kg')[$idx];
                    $ongkos = $ongkos + $notaDetails[$idx]->ongkos;
                    $notaDetails[$idx]->save();
                }
            }
            
            if ($size < $notaDetailsCount)
            {
                echo 'masuk sini';
                for ($idx ; $idx < $notaDetailsCount ; $idx++)
                {
                    $notaDetails[$idx]->delete();
                }
            }
            echo $idx;
            if ($size > $notaDetailsCount)
            {
                echo 'aaa';
                for ($idx ; $idx<$notaDetailsCount ; $idx++)
                {
                    $notaDetails[$idx]->nopol = $request->get('nopol')[$idx];
                    $notaDetails[$idx]->kg = $request->get('kg')[$idx];
                    $notaDetails[$idx]->ongkos = $project->tarif_vendor * $request->get('kg')[$idx];
                    $ongkos = $ongkos + $notaDetails[$idx]->ongkos;
                    $notaDetails[$idx]->save();
                }
                for ($i=$idx ; $i<$size ; $i++)
                {
                    // echo 'sini';
                    $notaDetail = new NotaDetail([
                        'nota_id' => $id,
                        'nopol' => $request->get('nopol')[$i],
                        'kg' => $request->get('kg')[$i],
                        'ongkos' => $project->tarif_vendor * $request->get('kg')[$i]
                    ]);
                    $notaDetail->save();
                    $ongkos = $ongkos +$project->tarif_vendor * $request->get('kg')[$i];
                }
            }
            // $ongkos = ($project->tarif_vendor*$request->get('kg')) ;
            
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
