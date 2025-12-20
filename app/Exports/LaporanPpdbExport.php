<?php

namespace App\Exports;

use App\Models\Pendaftar;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    ShouldAutoSize,
    WithEvents,
    WithCustomStartCell
};
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class LaporanPpdbExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    ShouldAutoSize, // Tetap gunakan untuk kolom lain
    WithEvents,
    WithCustomStartCell
{
    protected $request;
    protected $no = 1;

    public function __construct($request = null)
    {
        $this->request = $request;
    }

    public function startCell(): string
    {
        return 'A7';
    }

    public function collection(): Collection
    {
        return Pendaftar::with(['unit', 'orangTua', 'walisantri', 'verifikasi'])
            ->when($this->request?->unit, function ($q) {
                $q->where('unit_id', $this->request->unit);
            })
            ->when($this->request?->status === 'valid', function ($q) {
                $q->whereHas('verifikasi', function ($v) {
                    $v->where('verifikasi_pembayaran', 'valid')
                      ->where('verifikasi_berkas', 'valid');
                });
            })
            ->get();
    }

    public function headings(): array
    {
        return array_map('strtoupper', [
            'NO',
            'KODE REG',
            'NAMA LENGKAP', // Kolom C
            'L/P',
            'TEMPAT LAHIR',
            'TGL LAHIR',
            'UNIT TUJUAN',
            'PROVINSI',
            'KAB/KOTA',
            'KECAMATAN',
            'DESA/KEL',
            'ALAMAT DETAIL',
            'NAMA AYAH',
            'PEKERJAAN AYAH',
            'NO HP AYAH',
            'NAMA IBU',
            'PEKERJAAN IBU',
            'NO HP IBU',
            'NAMA WALI',
            'HUBUNGAN',
            'NO HP WALI',
            'BAYAR',
            'BERKAS',
            'STATUS AKHIR'
        ]);
    }

    public function map($row): array
    {
        $ortu = $row->orangTua;
        $wali = $row->walisantri;
        $v    = $row->verifikasi;

        $isLengkap = (($v->verifikasi_pembayaran ?? '') == 'valid' && ($v->verifikasi_berkas ?? '') == 'valid');

        $data = [
            $this->no++,
            $row->kode_pendaftaran,
            $row->nama_lengkap, 
            substr($row->jenis_kelamin, 0, 1),
            $row->tempat_lahir,
            $row->tanggal_lahir,
            $row->unit->nama_unit ?? '-',
            $row->provinsi,
            $row->kabupaten,
            $row->kecamatan,
            $row->desa,
            $row->alamat_detail,
            $ortu->nama_ayah ?? '-',
            $ortu->pekerjaan_ayah ?? '-',
            $ortu->no_hp_ayah ?? '-',
            $ortu->nama_ibu ?? '-',
            $ortu->pekerjaan_ibu ?? '-',
            $ortu->no_hp_ibu ?? '-',
            $wali->nama_wali ?? '-',
            $wali->hubungan_wali ?? '-',
            $wali->no_hp_wali ?? '-',
            $v->verifikasi_pembayaran ?? 'PENDING',
            $v->verifikasi_berkas ?? 'PENDING',
            $isLengkap ? 'LENGKAP' : 'PROSES'
        ];

        return array_map(function($value) {
            return strtoupper((string)$value);
        }, $data);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            7 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2F5597']
                ],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // 1. SET FONT GLOBAL (Arial)
                $sheet->getStyle('A1:X' . $sheet->getHighestRow())->getFont()->setName('Arial');

                // 2. MELEBARKAN KOLOM NAMA (Kolom C)
                // Kita set manual karena Nama biasanya panjang
                $sheet->getColumnDimension('C')->setAutoSize(false); 
                $sheet->getColumnDimension('C')->setWidth(50); 

                // 3. JUDUL LAPORAN (KIRI)
                $sheet->mergeCells('A1:H1');
                $sheet->setCellValue('A1', 'DATA CALON SANTRI / SISWA BARU');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);

                $sheet->mergeCells('A2:H2');
                $sheet->setCellValue('A2', 'TAHUN AJARAN ' . (date('Y')) . '/' . (date('Y')+1));
                $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(12);

                $sheet->mergeCells('A3:H3');
                $sheet->setCellValue('A3', 'YAYASAN / PONDOK PESANTREN AL-IKHLAS');
                $sheet->getStyle('A3')->getFont()->setBold(true)->setSize(12);

                $sheet->mergeCells('A4:H4');
                $sheet->setCellValue('A4', 'TANGGAL CETAK: ' . strtoupper(date('d F Y H:i')));
                $sheet->getStyle('A4')->getFont()->setItalic(true)->setSize(9);

                // 4. BORDER & ALIGNMENT
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                $range = 'A7:' . $highestColumn . $highestRow;

                $sheet->getStyle($range)->applyFromArray([
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Menambah tinggi baris data agar tidak sesak
                for ($i = 8; $i <= $highestRow; $i++) {
                    $sheet->getRowDimension($i)->setRowHeight(height: 22);
                }
            },
        ];
    }
}