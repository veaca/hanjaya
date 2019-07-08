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
        $notas = Nota::select('notas.*','vendors.name as vendor_name')
        ->join('nota_vendors', function($join){
            $join->on('notas.id', '=', 'nota_vendors.nota_id');
        })
        ->join('vendors', function($join){
            $join->on('nota_vendors.vendor_id', '=', 'vendors.id');
        })
        ->get();
        $notaDetails = Nota::select('notas.*', 'nota_details.date as date', 'nota_details.nopol as nopol', 'nota_details.collies as collies', 'nota_details.kg as kg', 'nota_details.ongkos as ongkos')
        ->join('nota_nota_details', function($join){
            $join->on('notas.id', '=', 'nota_nota_details.nota_id');
        })
        ->join('nota_details', function($join){
            $join->on('nota_nota_details.nota_detail_id', '=', 'nota_details.id');
        })
        ->get();
        // echo $notas;
        return view('nota.index', compact('notas', 'notaDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendor::all();

        return view('nota.create', compact('vendors'));
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
            'jenis_tambahan'=>'required',
            'jumlah_tambahan'=>'required',
            'nopol.*'=>'required|string',
            'collies.*'=>'required|integer',
            'kg.*'=>'required|integer',
            'ongkos.*'=>'required|integer'
        ]);
        $iterateNotaId = 0;
        $notaIds = [];
        $iterateNopol=0;
        $iterateCollies=0;
        $iterateKg=0;
        $iterateOngkos=0;
        $jumlahOngkos =0;
        foreach ($request->get('nopol') as $nopol) 
        {
            $iterateCollies = 0;
            foreach ($request->get('collies') as $collies) 
            {
                $iterateKg = 0;
                foreach ($request->get('kg') as $kg) 
                {
                    $iterateOngkos = 0;
                    foreach ($request->get('ongkos') as $ongkos) 
                    {
                        if ($iterateNopol == $iterateCollies && $iterateCollies == $iterateKg && $iterateKg == $iterateOngkos)
                        {
                            $jumlahOngkos =0;
                            if ($collies == NULL || $collies == 0) $jumlahOngkos = $ongkos*$kg;
                            else if ($kg == NULL || $kg == 0) $jumlahOngkos = $ongkos*$collies;
                            else {
                                $jumlahOngkos = ($ongkos*$kg)+($ongkos*$collies);
                            }
                            $notaDetail = new NotaDetail([
                            'date' => date('Y-m-d'),
                            'nopol' => $nopol,
                            'collies' => $collies,
                            'kg' => $kg,
                            'ongkos' => $ongkos,
                            'jumlah_ongkos' => $jumlahOngkos
                            ]);
                            $notaDetail->save();
                            $notaIds[$iterateNotaId] = $notaDetail->id;
                            $iterateNotaId++;
                        }
                        $iterateOngkos++;
                    }
                    $iterateKg++;
                }
                $iterateCollies++;
            }
            $iterateNopol++;     
        }
        $jumlahOngkos=0;
        for ($i=0 ; $i<$iterateNotaId ; $i++)
        {
            $notaDetailInfo = NotaDetail::select('*')
            ->where('id', $notaIds[$i])
            ->first();
            $jumlahOngkos = $jumlahOngkos + $notaDetailInfo->jumlah_ongkos;
        }
        $total=0;
        if ($request->get('jenis_tambahan') == "Penambahan"){
            $total = $jumlahOngkos + $request->get('jumlah_tambahan');
        }
        else 
        {
            $total = $jumlahOngkos - $request->get('jumlah_tambahan');
        }
        $potonganPPh = ($total * 2)/100;
        $jumlahDibayar = $total + $potonganPPh;
        $nota = new Nota([
            'tanggal' => date("Y-m-d"),
            'asal' => $request->get('asal'),
            'tujuan' => $request->get('tujuan'),
            'NOP' => $request->get('NOP'),
            'jumlah_ongkos' => $jumlahOngkos,
            'jenis_tambahan' => $request->get('jenis_tambahan'),
            'jumlah_tambahan' => $request->get('jumlah_tambahan'),
            'potongan_pph' => $potonganPPh,
            'jumlah_dibayar' => $jumlahDibayar
        ]);
        $nota->save();
        $notaVendor = new NotaVendor([
            'vendor_id' => $request->get('vendor'),
            'nota_id' => $nota->id
        ]);
        $notaVendor->save();
        
        for ($i=0 ; $i<$iterateNotaId ; $i++)
        {
            $notaNotaDetail = new NotaNotaDetail([
            'nota_id' => $nota->id,
            'nota_detail_id' => $notaIds[$i]
            ]);
            $notaNotaDetail->save();
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
        $nota = Nota::select('notas.*','vendors.name as vendor_name', 'vendors.id as vendor_id')
        ->join('nota_vendors', function($join){
            $join->on('notas.id', '=', 'nota_vendors.nota_id');
        })
        ->join('vendors', function($join){
            $join->on('nota_vendors.vendor_id', '=', 'vendors.id');
        })
        ->where('notas.id', $id)
        ->first();

        $vendors = Vendor::all();
        $notaDetails = Nota::select('nota_details.id as id','nota_details.date as date', 'nota_details.nopol as nopol', 'nota_details.collies as collies', 'nota_details.kg as kg', 'nota_details.ongkos as ongkos')
        ->join('nota_nota_details', function($join){
            $join->on('notas.id', '=', 'nota_nota_details.nota_id');
        })
        ->join('nota_details', function($join){
            $join->on('nota_nota_details.nota_detail_id', '=', 'nota_details.id');
        })
        ->where('notas.id', $id)
        ->get();
        // echo $nota;
        // echo $notaDetails;
        // echo $notas;
        // return view('nota.index', compact('notas'));
        return view('nota.edit', compact('nota', 'notaDetails', 'vendors' ));
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
        ]);
        $jumlahOngkos =0;
        $nota = Nota::find($id);
        $nota->asal = $request->get('asal');
        $nota->tujuan = $request->get('tujuan');
        $nota->NOP = $request->get('NOP');
        $nota->jenis_tambahan = $request->get('jenis_tambahan');
        $nota->jumlah_tambahan = $request->get('jumlah_tambahan');

        $notaVendor = NotaVendor::select('id')
        ->where('nota_id', $nota->id)
        ->first();

        $notaVendor->vendor_id = $request->get('vendor_id');
        $notaVendor->save();

        $notaNotaDetails = NotaNotaDetail::select('nota_detail_id')
        ->where('nota_id', $nota->id)
        ->get()->count();

        $jumlahOngkosNota =0;
        for ($i = 0 ; $i<$notaNotaDetails ; $i++)
        {
            $notaDetail = NotaDetail::select('*')
            ->where('id', $request->id[$i])
            ->first();
            $notaDetail->nopol = $request->nopol[$i];
            $notaDetail->collies = $request->collies[$i];
            $notaDetail->kg = $request->kg[$i];
            $notaDetail->ongkos = $request->ongkos[$i];
            $jumlahOngkos = 0;
            if ($notaDetail->collies == NULL || $notaDetail->collies == 0) $jumlahOngkos = $notaDetail->kg * $notaDetail->ongkos;
            else if ($notaDetail->kg == NULL || $notaDetail->kg == 0) $jumlahOngkos = $notaDetail->collies * $notaDetail->ongkos;
            else 
            {
                $jumlahOngkos = ($notaDetail->collies * $notaDetail->ongkos) + ($notaDetail->kg * $notaDetail->ongkos); 
            }
            $notaDetail->jumlah_ongkos = $jumlahOngkos;
            $jumlahOngkosNota = $jumlahOngkosNota + $notaDetail->jumlah_ongkos;
            $notaDetail->save();
            // echo $notaDetail;
        }
        $nota->jumlah_ongkos = $jumlahOngkosNota;
        $total=0;
        if ($request->get('jenis_tambahan') == "Penambahan"){
            $total = $jumlahOngkosNota + $request->get('jumlah_tambahan');
        }
        else {
            $total = $jumlahOngkosNota - $request->get('jumlah_tambahan');
        }
        $potonganPPh = ($total * 2)/100;
        $jumlahDibayar = $total + $potonganPPh;
        $nota->jumlah_dibayar = $jumlahDibayar;
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
