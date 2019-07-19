<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\Nota;
use App\Project;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::all();

        return view('vendor.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.create');
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
            'npwp' => 'required',
            'pph' => 'required'
        ]);
        $vendor = new Vendor([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'phone' => $request->get('phone'),
            'npwp' => $request->get('npwp'),
            'pph' => $request->get('pph')
        ]);
        $vendor->save();
        return redirect('/vendor')->with('success', 'Vendor has been added');
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
        $vendor = Vendor::find($id);

        return view('vendor.edit', compact('vendor'));
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
            'npwp' => 'required',
            'pph' => 'required'
        ]);

        $vendor = Vendor::find($id);
        $vendor->name = $request->get('name');
        $vendor->address = $request->get('address');
        $vendor->phone = $request->get('phone');
        $vendor->npwp = $request->get('npwp');
        $vendor->pph = $request->get('pph');
        $vendor->save();

        $notaIds = Nota::select('notas.id as id')
        ->where('vendor_id', $id)
        ->get();

        foreach ($notaIds as $notaId) {
            $nota = Nota::find($notaId->id);

            $project = Project::find($nota->project_id);

            $ongkos = $project->tarif_vendor * $nota->kg;
            $jumlahPph = ($ongkos * $request->get('pph'))/100;
            $ongkosNota = $ongkos + $jumlahPph;
            $nota->jumlah_pph = $jumlahPph;
            $nota->ongkos_nota = $ongkosNota;
            $nota->save();
        }

        return redirect('/vendor')->with('success', 'Vendor has been updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = Vendor::find($id);
        $vendor->delete();

        return redirect('vendor')->with('success', 'Vendor has been deleted successfully');

    }
}
