<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice; 
use App\Project;
use App\Customer;
use App\InvoiceCustomer;
use App\InvoiceProject;
use App\Nota;
use App\NotaVendor;
use App\Vendor;
use App\NotaNotaDetail;
use App\NotaDetail;
use App\Laporan;
use PDF;

class ExportController extends Controller
{
    public function exportInvoice($id)
    {
       $invoice = Invoice::find($id);
        $projects = Project::select('projects.*')
        ->join('invoice_projects', function($join){
            $join->on('invoice_projects.project_id', '=', 'projects.id');
        })
        ->where('invoice_projects.invoice_id', $id)
        ->first();
        $customer = Customer::find($projects->customer_id);
        $pdf = PDF::loadview('print.invoiceExport', compact('projects', 'customer', 'invoice'));
        // echo $pdf;
        $name = "invoice_".$invoice->nomor.".pdf";
        return $pdf->download($name);
        // return $pdf->stream();
        // return view('print.invoiceExport', compact('projects', 'customer', 'invoice'));
    }

    public function exportNota($id)
    {
        $nota = Nota::find($id);
        $notaDetails = NotaDetail::select('*')
        ->where('nota_id', $id)
        ->get();
        $vendor = Vendor::find($nota->vendor_id);
        $projects = Project::find($nota->project_id);

        $pdf = PDF::loadview('print.notaExport', compact('nota', 'vendor', 'projects', 'notaDetails'));
        $name = "nota_".$projects->nop.".pdf";
        return $pdf->download($name);
    }

    public function periodeLaporan()
    {
        return view('laporan.periode');
    }

    public function exportLaporan(Request $request)
    {
        $awalBulan = $request->get('awal');
        $akhirBulan = $request->get('akhir');
        $awalTahun = $request->get('tahun_awal');
        $akhirTahun = $request->get('tahun_akhir');

        if ($awalTahun == $akhirTahun)
        {
            $laporans = Laporan::select('*')
            ->where('bulan', '>=', $awalBulan) 
            ->where('bulan', '<=', $akhirBulan)
            ->get();
        }
        else {
            $laporans = Laporan::select('*')
            ->where('bulan', '>=', $awalBulan)
            ->where('tahun', $awalTahun)
            ->orWhere('bulan', '<=', $akhirBulan)
            ->where('tahun', $akhirTahun)
            ->get();
        }
        
        if ($laporans == NULL )
        {
            return view('laporan.periode')->with('failed', 'Belum ada data bulan tersebut');
        }
        return view('laporan.periodeView', compact('laporans', 'awalBulan', 'akhirBulan', 'awalTahun', 'akhirTahun'));
    }

    public function downloadLaporan($awal, $akhir, $awalTahun, $akhirTahun)
    {
        if ($awalTahun == $akhirTahun)
        {
            $laporans = Laporan::select('*')
            ->where('bulan', '>=', $awalBulan) 
            ->where('bulan', '<=', $akhirBulan)
            ->get();
        }
        else {
             $laporans = Laporan::select('*')
            ->where('bulan', '>=', $awalBulan)
            ->where('tahun', $awalTahun)
            ->orWhere('bulan', '<=', $akhirBulan)
            ->where('tahun', $akhirTahun)
            ->get();
        }
        $pdf = PDF::loadview('print.laporanExport', compact('laporans', 'awalBulan', 'akhirBulan', 'tahun'));
        $name = "laporan_bulanan.pdf";
        return $pdf->download($name);
    }

    public function viewInvoice($id)
    {
        $invoice = Invoice::find($id);
        $projects = Project::select('projects.*')
        ->join('invoice_projects', function($join){
            $join->on('invoice_projects.project_id', '=', 'projects.id');
        })
        ->where('invoice_projects.invoice_id', $id)
        ->first();
        $customer = Customer::find($projects->customer_id);

        return view('print.invoice', compact('projects', 'customer', 'invoice'));
    }

    public function viewNota($id)
    {
        $nota = Nota::find($id);
        $notaDetails = NotaDetail::select('*')
        ->where('nota_id', $id)
        ->get();
        $vendor = Vendor::find($nota->vendor_id);
        $projects = Project::find($nota->project_id);

        return view('print.nota', compact('nota', 'vendor', 'projects', 'notaDetails'));
    }
}
