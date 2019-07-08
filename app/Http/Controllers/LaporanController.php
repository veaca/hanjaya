<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laporan;
use App\BiayaLain;
use App\InvoiceNota;
use App\Invoice;
use App\Nota;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laporans = Laporan::all();

        return view('laporan.index', compact('laporans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laporan.create');
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
            'bulan'=>'required',
            'tahun'=>'required',
        ]);


        $biayaLain = BiayaLain::select('*')
        ->where('bulan', $request->get('bulan'))
        ->where('tahun', $request->get('tahun'))
        ->first();
        if ($biayaLain == NULL) $totalBiayaLain=0;
        else
        {
            $totalBiayaLain = $biayaLain->gaji + $biayaLain->bpjs + $biayaLain->bank + $biayaLain->listrik + $biayaLain->pdam + $biayaLain->biaya_lain;
        // echo $totalBiayaLain;
        }
        $invoices = Invoice::select('invoices.jumlah_total')
        ->whereMonth('invoices.created_at', $request->get('bulan'))
        ->whereYear('invoices.created_at', $request->get('tahun'))
        ->get();
        $totalInvoice =0;
        if ($invoices==NULL) {
            $totalInvoice =0;
        }
        else {
            foreach ($invoices as $invoice) {
                $totalInvoice = $totalInvoice + $invoice->jumlah_total;
            }
        }
        
        // echo $invoice;

        $notas = Nota::select('notas.jumlah_dibayar as jumlah_dibayar')
        ->whereMonth('notas.created_at', $request->get('bulan'))
        ->whereYear('notas.created_at', $request->get('tahun'))
        ->get();

        $totalNota = 0;
        if ($notas != NULL)
        {
            foreach ($notas as $nota) {
                $totalNota = $totalNota + $nota->jumlah_dibayar;
            }
            $laporanTotal = $totalInvoice - $totalNota - $totalBiayaLain;
        }
        else 
        {
            $laporanTotal=0;
        }
        


        // echo $invoice;
        
        $laporan = new Laporan([
            'bulan' => $request->get('bulan'),
            'tahun' => $request->get('tahun'),
            'laporan_biaya_bulanan' => $totalBiayaLain,
            'laporan_invoice' => $totalInvoice,
            'laporan_nota' => $totalNota,
            'laporan_total' => $laporanTotal
        ]);
        $laporan->save();
        return redirect('laporan')->with('success', 'Laporan has been added');

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
        $laporan = Laporan::find($id);
        $biayaLain = BiayaLain::select('*')
        ->where('bulan', $laporan->bulan)
        ->where('tahun', $laporan->tahun)
        ->first();
        if ($biayaLain==NULL) $totalBiayaLain=0;
        else{
        $totalBiayaLain = $biayaLain->gaji + $biayaLain->bpjs + $biayaLain->bank + $biayaLain->listrik + $biayaLain->pdam + $biayaLain->biaya_lain;
        // echo $totalBiayaLain;
        }
        $invoices = Invoice::select('invoices.jumlah_total')
        ->whereMonth('invoices.created_at', $laporan->bulan)
        ->whereYear('invoices.created_at', $laporan->tahun)
        ->get();
        $totalInvoice =0;
        if ($invoices==NULL) $totalInvoice =0;
        else {
            foreach ($invoices as $invoice) {
                $totalInvoice = $totalInvoice + $invoice->jumlah_total;
            }
        }
        
        // echo $invoice;

        $notas = Nota::select('notas.jumlah_dibayar as jumlah_dibayar')
        ->whereMonth('notas.created_at', $laporan->bulan)
        ->whereYear('notas.created_at', $laporan->tahun)
        ->get();

        $totalNota = 0;
        if ($notas != NULL)
        {
            foreach ($notas as $nota) {
                $totalNota = $totalNota + $nota->jumlah_dibayar;
            }
        }
        
        $laporanTotal = $totalInvoice - $totalNota - $totalBiayaLain;
        $laporan->laporan_biaya_bulanan = $totalBiayaLain;
        $laporan->laporan_invoice = $totalInvoice;
        $laporan->laporan_nota = $totalNota;
        $laporan->laporan_total = $laporanTotal;
        $laporan->save();

        return redirect('laporan')->with('success', 'Laporan has been updated');
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
        $laporan = Laporan::find($id);
        $biayaLain = BiayaLain::select('*')
        ->where('bulan', $laporan->bulan)
        ->where('tahun', $laporan->tahun)
        ->first();
        $totalBiayaLain = $biayaLain->gaji + $biayaLain->bpjs + $biayaLain->bank + $biayaLain->listrik + $biayaLain->pdam;
        // echo $totalBiayaLain;

        $invoices = Invoice::select('invoices.jumlah_total')
        ->whereMonth('invoices.created_at', $laporan->bulan)
        ->whereYear('invoices.created_at', $laporan->tahun)
        ->get();
        
        $totalInvoice =0;
        foreach ($invoices as $invoice) {
            $totalInvoice = $totalInvoice + $invoice->jumlah_total;
        }
        // echo $invoice;

        $notas = Nota::select('notas.jumlah_ongkos as jumlah_ongkos')
        ->whereMonth('notas.created_at', $laporan->bulan)
        ->whereYear('notas.created_at', $laporan->tahun)
        ->get();

        $totalNota = 0;
        foreach ($notas as $nota) {
            $totalNota = $totalNota + $nota->jumlah_ongkos;
        }
        $laporanTotal = $totalInvoice - $totalNota - $totalBiayaLain;
        
        echo $laporan;
        $laporan->save();
        return redirect('laporan')->with('success', 'Laporan has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $laporan = Laporan::find($id);
        $laporan->delete();

        return redirect('laporan')->with('success', 'Laporan has been updated');
    }

    public function print()
    {
        return view('laporan.print');
    }
}
