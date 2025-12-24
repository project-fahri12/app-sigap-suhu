<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use UuidTrait;

    protected $table = 'pendaftar';

    protected $fillable = [
        'users_id',
        'kode_pendaftaran',
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'status_santri',

        // ===== ALAMAT BERANTAI =====
        'provinsi',
        'kabupaten',
        'kecamatan',
        'desa',
        'rt',
        'rw',
        'alamat_detail',

        'asal_sekolah',
        'gelombang_id',
        'tahun_ajaran_id',
        'sekolah_pilihan_id',
        'unit_id',
    ];

    /* ========== RELASI ========== */

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function gelombang()
    {
        return $this->belongsTo(Gelombang::class);
    }

    public function sekolahPilihan()
    {
        return $this->belongsTo(SekolahPilihan::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function orangTua()
    {
        return $this->hasOne(OrangTua::class);
    }

    public function waliSantri()
    {
        return $this->hasOne(WaliSantri::class);
    }

    public function berkas()
    {
        return $this->hasOne(Berkas::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function verifikasi()
    {
        return $this->hasOne(Verifikasi::class);
    }

    public function getRegistrationProgressAttribute()
    {
        $pembayaran = $this->pembayaran()->latest()->first();
        $verifikasi = $this->verifikasi;

        // Step 1: Profil
        $step1Done = !empty($this->nama_lengkap);

        // Step 2: Pembayaran
        $vPembayaran = $verifikasi->verifikasi_pembayaran ?? 'belum';
        $pStatus = $pembayaran->status ?? 'none';

        $step2Status = 'active';
        $step2Text = 'Belum Bayar';
        if ($vPembayaran === 'valid') {
            $step2Status = 'success';
            $step2Text = 'Pembayaran Lunas';
        } elseif ($vPembayaran === 'invalid') {
            $step2Status = 'danger';
            $step2Text = 'Pembayaran Ditolak';
        } elseif ($pStatus === 'pending') {
            $step2Status = 'warning';
            $step2Text = 'Menunggu Pembayaran';
        }

        // Step 3: Berkas
        $vBerkas = $verifikasi->verifikasi_berkas ?? 'belum';

        if ($vPembayaran !== 'valid') {
            $step3Status = 'locked';
            $step3Text = 'Terkunci';
        } else {
            $step3Status = match ($vBerkas) {
                'valid' => 'success',
                'invalid' => 'danger',
                'pending' => 'warning',
                default => 'active'
            };
            $step3Text = match ($vBerkas) {
                'valid' => 'Berkas Diterima',
                'invalid' => 'Berkas Ditolak',
                'pending' => 'Menunggu Verifikasi',
                default => 'Silahkan Unggah Berkas'
            };
        }

        return (object) [
            'step1' => (object) ['class' => $step1Done ? 'step-success' : 'step-active', 'done' => $step1Done],
            'step2' => (object) ['class' => 'step-' . $step2Status, 'text' => $step2Text, 'is_valid' => $vPembayaran === 'valid', 'is_invalid' => $vPembayaran === 'invalid', 'is_pending' => $pStatus === 'pending'],
            'step3' => (object) ['class' => 'step-' . $step3Status, 'text' => $step3Text, 'status' => $vBerkas]
        ];
    }

    
    
}
