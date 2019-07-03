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
        $customer = InvoiceCustomer::select('customers.name', 'customers.address', 'customers.phone')
        ->join('customers', function($join){
            $join->on('invoice_customers.customer_id', '=', 'customers.id');
        })
        ->where('invoice_customers.invoice_id', $invoice->id)
        ->first();
        $projects = InvoiceProject::select('*')
        ->join('projects', function($join)
        {
            $join->on('invoice_projects.project_id', '=', 'projects.id');
        })
        ->where('invoice_projects.invoice_id', $invoice->id)
        ->get();
        // echo $invoice;
        // echo $customer;
        // echo $projects;
        $pdf = PDF::loadview('print.invoice', compact('projects', 'customer', 'invoice'));
        // echo $pdf;
        return $pdf->download('invoice');
        // return $pdf->stream();
        // return view('print.index2', compact('projects', 'customer', 'invoice'));
    }

    public function exportNota($id)
    {
        $nota = Nota::find($id);
        
        $vendor = NotaVendor::select()
        ->join('vendors', function($join){
            $join->on('nota_vendors.vendor_id', '=', 'vendors.id');
        })
        ->where('nota_id', $nota->id)
        ->first();

        $notaDetails = NotaNotaDetail::select()
        ->join('nota_details', function($join){
            $join->on('nota_nota_details.nota_detail_id', '=', 'nota_details.id');
        })
        ->where('nota_nota_details.nota_id', $nota->id)
        ->get();

        $pdf = PDF::loadview('print.nota', compact('nota', 'vendor', 'notaDetails'));
        // echo $nota;
        // echo $notaDetails;

        // echo $pdf;
        return $pdf->download('nota');
        // return $pdf->stream();
        // return view('print.nota', compact('nota', 'vendor', 'notaDetails'));
    }

    public function periodeLaporan()
    {
        return view('laporan.periode');
    }

    public function exportLaporan(Request $request)
    {
        // echo $request->get('awal');
        // echo $request->get('akhir');
        // echo $request->get('tahun');
        $tanggalAwal = "01";
        $tanggalAkhir = "31";
        $awalPeriode = $request->get('tahun')."-".$request->get('awal')."-".$tanggalAwal;
        $akhirPeriode = $request->get('tahun')."-".$request->get('akhir')."-".$tanggalAkhir;
        echo $awalPeriode;
        echo $akhirPeriode;
        $awalBulan = $request->get('awal');
        $akhirBulan = $request->get('akhir');
        $tahun = $request->get('tahun');
        $laporans = Laporan::select('*')
        ->whereBetween('created_at', [$awalPeriode , $akhirPeriode])
        ->get();
        echo $laporans;
        return view('print.laporan', compact('laporans', 'awalBulan', 'akhirBulan', 'tahun'));
    }
}
