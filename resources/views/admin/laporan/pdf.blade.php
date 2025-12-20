<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        td.text-left {
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="title">DAFTAR SISWA DITERIMA PPDB</div>
    <div class="subtitle">
        TAHUN AJARAN {{ date('Y') }}/{{ date('Y') + 1 }}
    </div>

    <table>
        <thead>
            <tr>
                <th width="15%">NO REG</th>
                <th width="30%">NAMA</th>
                <th width="6%">L/P</th>
                <th width="25%">UNIT </th>
                <th width="10%">VALIDASI</th>
            </tr>
        </thead>
        <tbody>

        @foreach($data as $i => $row)
            @php
                $v = $row->verifikasi;

                if (!$v) {
                    $status = '-';
                } elseif (
                    $v->verifikasi_pembayaran === 'valid' &&
                    $v->verifikasi_berkas === 'valid'
                ) {
                    $status = 'V';
                } elseif (
                    $v->verifikasi_pembayaran === 'invalid' ||
                    $v->verifikasi_berkas === 'invalid'
                ) {
                    $status = 'I';
                } else {
                    $status = 'P';
                }
            @endphp

            <tr>
                <td>{{ strtoupper($row->kode_pendaftaran) }}</td>
                <td class="text-left">{{ strtoupper($row->nama_lengkap) }}</td>
                <td>{{ $row->jenis_kelamin }}</td>
                <td>{{ strtoupper($row->unit->nama_unit ?? '-') }}</td>
                <td><b>{{ $status }}</b></td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <br>
    <small>
        Keterangan:
        V = Valid (Pembayaran & Berkas),
        P = Pending,
        I = Invalid
    </small>

</body>
</html>
