<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BiayaLain;

class BiayaLainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $biayas = BiayaLain::all();

        return view('biaya.index', compact('biayas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('biaya.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'bulan'=>'required',
            'tahun'=>'required',
            'gaji'=>'required|integer|max:1000000000000',
            'bpjs'=>'required|integer|max:1000000000000',
            'bank'=>'required|integer|max:1000000000000',
            'listrik'=>'required|integer|max:1000000000000',
            'pdam'=>'required|integer|max:1000000000000',
            'atk'=>'required|integer|max:1000000000000',
            'biaya_lain'=>'required|integer|max:1000000000000'
        ]);
        $biaya = new BiayaLain([
            'bulan'=>$request->get('bulan'),
            'tahun'=>$request->get('tahun'),
            'gaji'=>$request->get('gaji'),
            'bpjs'=>$request->get('bpjs'),
            'bank'=>$request->get('bank'),
            'listrik'=>$request->get('listrik'),
            'pdam'=>$request->get('pdam'),
            'atk'=>$request->get('atk'),
            'biaya_lain'=>$request->get('biaya_lain')
        ]);
        $biaya->save();
        return redirect('/biaya')->with('success', 'Biaya has been added');
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
        $biaya = BiayaLain::find($id);

        return view('biaya.edit', compact('biaya'));
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
        $request -> validate([
            'bulan'=>'required',
            'tahun'=>'required',
            'gaji'=>'required|integer|max:1000000000000',
            'bpjs'=>'required|integer|max:1000000000000',
            'bank'=>'required|integer|max:1000000000000',
            'listrik'=>'required|integer|max:1000000000000',
            'pdam'=>'required|integer|max:1000000000000',
            'atk'=>'required|integer|max:1000000000000',
            'biaya_lain'=>'required|integer|max:1000000000000'
        ]);

        $biaya = BiayaLain::find($id);
        $biaya->bulan = $request->get('bulan');
        $biaya->tahun = $request->get('tahun');
        $biaya->gaji=$request->get('gaji');
        $biaya->bpjs=$request->get('bpjs');
        $biaya->bank=$request->get('bank');
        $biaya->listrik=$request->get('listrik');
        $biaya->pdam=$request->get('pdam');
        $biaya->atk=$request->get('atk');
        $biaya->biaya_lain=$request->get('biaya_lain');
        $biaya->save();

        return redirect('/biaya')->with('success', 'Biaya has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $biaya = BiayaLain::find($id);
        $biaya->delete();

        return redirect('/biaya')->with('success', 'Biaya has been successfully deleted');
    }
}
