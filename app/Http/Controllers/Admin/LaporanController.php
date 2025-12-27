<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LaporanPpdbExport;
use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use App\Models\Pendaftar;
use App\Models\Unit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Pendaftar::with(['unit', 'verifikasi']);

        if ($this->request->unit) {
            $query->where('unit_id', $this->request->unit);
        }

        if ($this->request->gelombang) {
            $query->where('gelombang_id', $this->request->gelombang);
        }

        return $query->get()->map(function ($p) {
            return [
                'Kode' => $p->kode_pendaftaran,
                'Nama' => $p->nama_lengkap,
                'Unit' => $p->unit->nama_unit ?? '-',
                'Asal Sekolah' => $p->asal_sekolah ?? '-',
                'Bayar' => $p->verifikasi->verifikasi_pembayaran ?? '-',
                'Berkas' => $p->verifikasi->verifikasi_berkas ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'KODE',
            'NAMA',
            'UNIT',
            'ASAL SEKOLAH',
            'STATUS BAYAR',
            'STATUS BERKAS',
        ];
    }

    public function index(Request $request)
    {
        $query = Pendaftar::with(['unit', 'verifikasi']);

        // FILTER
        if ($request->unit) {
            $query->where('unit_id', $request->unit);
        }

        if ($request->gelombang) {
            $query->where('gelombang_id', $request->gelombang);
        }

        if ($request->status) {
            $query->whereHas('verifikasi', function ($q) use ($request) {
                match ($request->status) {
                    'valid' => $q->where('verifikasi_pembayaran', 'valid')
                        ->where('verifikasi_berkas', 'valid'),
                    'pending' => $q->where('verifikasi_pembayaran', 'pending')
                        ->orWhere('verifikasi_berkas', 'pending'),
                    default => $q->where('verifikasi_pembayaran', 'invalid')
                        ->orWhere('verifikasi_berkas', 'invalid'),
                };
            });
        }

        $pendaftar = $query->latest()->paginate(10)->withQueryString();

        // STATISTIK
        $total = Pendaftar::count();
        $valid = Pendaftar::whereHas('verifikasi', fn ($q) => $q->where('verifikasi_pembayaran', 'valid')
            ->where('verifikasi_berkas', 'valid')
        )->count();

        $pending = Pendaftar::whereHas('verifikasi', fn ($q) => $q->where('verifikasi_pembayaran', 'pending')
            ->orWhere('verifikasi_berkas', 'pending')
        )->count();

        $ditolak = Pendaftar::whereHas('verifikasi', fn ($q) => $q->where('verifikasi_pembayaran', 'invalid')
            ->orWhere('verifikasi_berkas', 'invalid')
        )->count();

        $units = Unit::orderBy('nama_unit')->get();
        $gelombangs = Gelombang::orderBy('nama_gelombang')->get();

        return view('admin.laporan.laporan', compact(
            'pendaftar', 'units', 'gelombangs',
            'total', 'valid', 'pending', 'ditolak'
        ));
    }

    // ================= EXPORT =================

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new LaporanPpdbExport($request),
            'LAPORAN_PPDB.xlsx'
        );
    }

    public function exportPdf(Request $request)
    {
        $data = (new LaporanPpdbExport($request))->collection();

        return Pdf::loadView('admin.laporan.pdf', compact('data'))
            ->setPaper('A4', 'portait')
            ->stream('LAPORAN_PPDB.pdf');
    }

    public function exportCsv(Request $request)
    {
        return Excel::download(
            new LaporanPpdbExport($request),
            'LAPORAN_PPDB.csv',
            \Maatwebsite\Excel\Excel::CSV
        );
    }
}
