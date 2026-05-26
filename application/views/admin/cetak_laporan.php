<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak_Laporan_CivicFix_<?= date('d_m_Y') ?></title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        /* Standar Dokumen Cetak Kedinasan */
        body { 
            font-family: "Times New Roman", Times, serif; 
            padding: 10px; 
            line-height: 1.4;
            color: #000;
            background-color: #fff;
        }
        
        /* Kop Surat Instansi Dinas PUPR Kota Gorontalo */
        .kop-surat { 
            text-align: center; 
            border-bottom: 4px double #000; 
            padding-bottom: 12px; 
            margin-bottom: 25px;
            position: relative;
        }
        .kop-surat h2 { margin: 0; text-transform: uppercase; font-size: 16pt; font-weight: bold; letter-spacing: 0.5px; }
        .kop-surat h3 { margin: 4px 0; text-transform: uppercase; font-size: 13pt; font-weight: bold; }
        .kop-surat p { margin: 0; font-size: 10pt; font-style: italic; color: #333; }

        /* Tabel Rekapitulasi Data Laporan */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 15px; 
            font-size: 10.5pt;
        }
        th, td { 
            border: 1px solid #000; 
            padding: 8px 10px;
            vertical-align: middle;
        }
        th { 
            background-color: #e2e8f0 !important; 
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
        }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }

        /* Sektor Tanda Tangan Pejabat Pengesah */
        .ttd-container {
            margin-top: 45px;
            float: right;
            width: 260px;
            text-align: center;
            font-size: 11pt;
            page-break-inside: avoid;
        }
        .ttd-space { height: 75px; }

        /* Alat Kontrol Navigasi Tombol Cetak */
        .btn-print-box {
            background-color: #f8fafc;
            padding: 15px 20px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .btn-print {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            color: white;
            padding: 10px 22px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: 0.2s;
        }
        .btn-print:hover {
            background: #0f172a;
        }

        /* HARDENING SQA PRINT MEDIA ENVIRONMENT CONTROL */
        @media print { 
            .no-print { display: none !important; }
            body { padding: 0; background-color: #fff; }
            th { background-color: #f2f2f2 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            @page { 
                size: A4 portrait; /* Mengunci kertas otomatis ke ukuran standar A4 nasional */
                margin: 2cm 1.5cm 2cm 1.5cm; 
            }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print btn-print-box">
        <button onclick="window.print()" class="btn-print">
            <i class="bi bi-printer-fill me-1"></i> Cetak Dokumen / Simpan PDF
        </button>
        <a href="<?= base_url('admin/dashboard') ?>" style="color: #475569; font-weight: 600; font-size: 0.9rem; text-decoration: none; margin-left: 10px;">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard Admin
        </a>
    </div>

    <div class="kop-surat">
        <h2>PEMERINTAH KOTA GORONTALO</h2>
        <h3>DINAS PEKERJAAN UMUM DAN PENATAAN RUANG</h3>
        <p>Jl. Jenderal Sudirman No. 123, Kota Gorontalo. Telp: (0435) 123456 | Kode Pos: 96115</p>
    </div>

    <div style="text-align: center; margin-bottom: 25px;">
        <h4 style="text-decoration: underline; margin-bottom: 4px; font-size: 13pt; font-weight: bold; text-transform: uppercase;">REKAPITULASI LAPORAN ADUAN MASYARAKAT (CIVICFIX)</h4>
        <span style="font-size: 11pt; font-style: italic;">Periode Rekap Berjalan: <?= date('F Y') ?></span>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">ID Laporan</th>
                <th width="20%">Nama Pelapor Warga</th>
                <th width="35%">Deskripsi Kerusakan Infrastruktur</th>
                <th width="15%">Tanggal Aduan</th>
                <th width="10%">Status Alur</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1; 
                if(!empty($semua_laporan)):
                    foreach($semua_laporan as $row): 
            ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td class="text-center fw-bold" style="letter-spacing: 0.5px;">#LPR-00<?= $row->laporan_id ?></td>
                <td><?= !empty($row->nama_warga) ? $row->nama_warga : 'Warga Anonim' ?></td>
                <td><?= $row->deskripsi ?></td>
                <td class="text-center"><?= date('d M Y &bull; H:i', strtotime($row->tanggal)) ?></td>
                <td class="text-center">
                    <span class="fw-bold"><?= strtoupper($row->status) ?></span>
                </td>
            </tr>
            <?php 
                    endforeach;
                else:
            ?>
            <tr>
                <td colspan="6" class="text-center" style="font-style: italic; color: #666; padding: 20px;">
                    Belum ada rekaman berkas aduan masuk pada periode bulan ini.
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="ttd-container">
        <p>Gorontalo, <?= date('d F Y') ?></p>
        <p>Admin Utama Sistem CivicFix,</p>
        <div class="ttd-space"></div>
        <p><strong>( Oyan M. La'ana )</strong></p>
        <p style="border-top: 1px solid #000; padding-top: 2px; margin-top: 2px;">NIP. 19980423 202605 1 001</p>
    </div>

</body>
</html>