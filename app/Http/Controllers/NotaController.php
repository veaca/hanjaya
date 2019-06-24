<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nota;
use App\NotaDetail;
use App\NotaNotaDetail;
use App\NotaVendor;
use App\Vendor;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notas = Nota::select('notas.*', 'nota_details.date as date', 'nota_details.nopol as nopol', 'nota_details.collies as collies', 'nota_details.kg as kg', 'nota_details.ongkos as ongkos', 'vendors.name as vendor_name')
        ->join('nota_nota_details', function($join){
            $join->on('notas.id', '=', 'nota_nota_details.nota_id');
        })
        ->join('nota_details', function($join){
            $join->on('nota_nota_details.nota_detail_id', '=', 'nota_details.id');
        })
        ->join('nota_vendors', function($join){
            $join->on('notas.id', '=', 'nota_vendors.nota_id');
        })
        ->join('vendors', function($join){
            $join->on('nota_vendors.vendor_id', '=', 'vendors.id');
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
        return view('nota.create');
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
            'vendor'=>'required',
            'asal'=>'required',
            'tujuan'=>'required',
            'NOP'=>'required',
            'nopol'=>'required',
            'collies'=>'required|integer',
            'kg'=>'required|integer',
            'ongkos'=>'required|integer'
        ]);
        $notaDetail = new NotaDetail([
            'date' => date('Y-m-d'),
            'nopol' => $request->get('nopol'),
            'collies' => $request->get('collies'),
            'kg' => $request->get('kg'),
            'ongkos' => $request->get('ongkos')
        ]);
        
        $notaDetail->save();
        $notaDetailInfo = NotaDetail::select('*')
        ->where('id', $notaDetail->id)
        ->first();
        // echo $nota_detail_info;
        $jumlahOngkos = $notaDetailInfo->kg * $notaDetailInfo->ongkos;
        $nota = new Nota([
            'tanggal' => date("Y-m-d"),
            'asal' => $request->get('asal'),
            'tujuan' => $request->get('tujuan'),
            'NOP' => $request->get('NOP'),
            'jumlah_ongkos' => $jumlahOngkos
        ]);
        $nota->save();
        $notaVendor = new NotaVendor([
            'vendor_id' => $request->get('vendor'),
            'nota_id' => $nota->id
        ]);
        $notaVendor->save();
        $notaNotaDetail = new NotaNotaDetail([
            'nota_id' => $nota->id,
            'nota_detail_id' => $notaDetail->id
        ]);
        $notaNotaDetail->save();
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
        
        // $notaId = Nota::find($id);

        $nota = Nota::select('notas.*', 'nota_details.date as date', 'nota_details.nopol as nopol', 'nota_details.collies as collies', 'nota_details.kg as kg', 'nota_details.ongkos as ongkos', 'vendors.name as vendor_name', 'vendors.id as vendor_id')
        ->join('nota_nota_details', function($join){
            $join->on('notas.id', '=', 'nota_nota_details.nota_id');
        })
        ->join('nota_details', function($join){
            $join->on('nota_nota_details.nota_detail_id', '=', 'nota_details.id');
        })
        ->join('nota_vendors', function($join){
            $join->on('notas.id', '=', 'nota_vendors.nota_id');
        })
        ->join('vendors', function($join){
            $join->on('nota_vendors.vendor_id', '=', 'vendors.id');
        })
        ->where('notas.id', $id)
        ->first();

        
        // echo $notas;
        // return view('nota.index', compact('notas'));
        return view('nota.edit', compact('nota'));
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
            'asal'=>'required',
            'tujuan'=>'required',
            'NOP'=>'required',
            'nopol'=>'required',
            'collies'=>'required|integer',
            'kg'=>'required|integer',
            'ongkos'=>'required|integer'
        ]);

        $nota = Nota::find($id);
        $nota->asal = $request->get('asal');
        $nota->tujuan = $request->get('tujuan');
        $nota->NOP = $request->get('NOP');

        $notaVendor = NotaVendor::select('id')
        ->where('nota_id', $nota->id)
        ->first();

        $notaVendor->vendor_id = $request->get('vendor_id');
        $notaVendor->save();

        $notaNotaDetail = NotaNotaDetail::select('nota_detail_id')
        ->where('nota_id', $nota->id)
        ->first();

        $notaDetail = NotaDetail::select('*')
        ->where('id', $notaNotaDetail->nota_detail_id)
        ->first();

        // echo $notaDetail;
        $notaDetail->nopol = $request->get('nopol');
        $notaDetail->collies = $request->get('collies');
        $notaDetail->kg = $request->get('kg');
        $notaDetail->ongkos = $request->get('ongkos');
        $notaDetail->save();
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
        $nota = Nota::find($id);
        $nota->delete();

        return redirect('nota')->with('success', 'Nota has been deleted successfully');
    }
}
