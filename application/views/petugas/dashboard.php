<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<div class="container-fluid py-4 main-petugas-container animate__animated animate__fadeIn">
    
    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success border-0 shadow-lg rounded-4 mb-4 dashboard-alert animate__animated animate__slideInDown">
            <div class="d-flex align-items-center">
                <div class="alert-icon-box bg-success text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                </div>
                <div>
                    <strong class="d-block text-dark small-uppercase-caps">Tugas Diperbarui</strong>
                    <span class="text-muted small-13"><?= $this->session->flashdata('success'); ?></span>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger border-0 shadow-lg rounded-4 mb-4 dashboard-alert animate__animated animate__shakeX">
            <div class="d-flex align-items-center">
                <div class="alert-icon-box bg-danger text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                </div>
                <div>
                    <strong class="d-block text-dark small-uppercase-caps">Sistem Error</strong>
                    <span class="text-muted small-13"><?= $this->session->flashdata('error'); ?></span>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-5 gap-3 dynamic-header-panel">
        <div>
            <div class="badge bg-soft-primary text-primary rounded-pill px-3 py-2 fw-bold small-caps mb-2 shadow-sm">
                <i class="bi bi-shield-shaded me-1"></i> Unit Reaksi Cepat (URC)
            </div>
            <h2 class="fw-800 text-dark mb-1 tracking-tight">Panel Tugas Lapangan</h2>
            <p class="text-muted small mb-0 font-medium">Sistem Eksekusi Infrastruktur CivicFix &bull; Kendali Lapangan Gorontalo</p>
        </div>
        <button onclick="window.location.reload()" class="btn btn-premium-white shadow-sm rounded-circle border p-2-5 transition-all hover-rotate" title="Segarkan Tugas">
            <i class="bi bi-arrow-clockwise fs-5 text-primary"></i>
        </button>
    </div>

    <div class="row g-4 mb-5 card-stats-row">
        <div class="col-xl-4 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
            <div class="card card-stat-premium border-0 shadow-sm rounded-4 overflow-hidden bg-white-card">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted-caps small fw-bold text-uppercase mb-2">Total Beban Tugas</p>
                            <h1 class="fw-800 text-dark mb-0 tracking-tight"><?= number_format($total_laporan); ?></h1>
                        </div>
                        <div class="icon-shape-wrapper bg-gradient-blue text-white rounded-4 p-3 shadow-blue">
                            <i class="bi bi-briefcase-fill fs-3"></i>
                        </div>
                    </div>
                    <div class="card-decor-line bg-primary"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
            <div class="card card-stat-premium border-0 shadow-sm rounded-4 overflow-hidden bg-white-card">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted-caps small fw-bold text-uppercase mb-2">Menunggu Eksekusi</p>
                            <h1 class="fw-800 text-dark mb-0 tracking-tight"><?= number_format($total_pending); ?></h1>
                        </div>
                        <div class="icon-shape-wrapper bg-gradient-orange text-white rounded-4 p-3 shadow-orange">
                            <i class="bi bi-tools fs-3"></i>
                        </div>
                    </div>
                    <div class="card-decor-line bg-warning"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
            <div class="card card-stat-premium border-0 shadow-sm rounded-4 overflow-hidden bg-white-card">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted-caps small fw-bold text-uppercase mb-2">Pekerjaan Selesai</p>
                            <h1 class="fw-800 text-dark mb-0 tracking-tight"><?= number_format($total_selesai); ?></h1>
                        </div>
                        <div class="icon-shape-wrapper bg-gradient-green text-white rounded-4 p-3 shadow-green">
                            <i class="bi bi-patch-check-fill fs-3"></i>
                        </div>
                    </div>
                    <div class="card-decor-line bg-success"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-lg rounded-4 mb-5 bg-white overflow-hidden animate__animated animate__fadeIn">
        <div class="card-header bg-white py-3 px-4 border-0 border-bottom d-flex align-items-center">
            <i class="bi bi-geo-alt-fill text-danger me-2 fs-5"></i> 
            <span class="fw-800 text-dark">Peta Lokasi Perintah Kerja Fisik Satgas URC (Wilayah Gorontalo)</span>
        </div>
        <div class="card-body p-0">
            <div id="mapPetugasURC" style="height: 420px; width: 100%;"></div>
        </div>
    </div>

    <div class="card border-0 shadow-lg rounded-4 bg-white table-container-card animate__animated animate__fadeInUp">
        <div class="card-header bg-white py-4 px-4 border-0">
            <h5 class="fw-800 text-dark mb-0 d-flex align-items-center">
                <i class="bi bi-journal-check text-primary me-2 fs-4"></i> Manifest Perintah Kerja Lapangan
            </h5>
            <p class="text-muted small mb-0">Silakan lakukan perbaikan koordinat lokasi, lalu unggah bukti penyelesaian aduan</p>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0 custom-premium-table">
                    <thead class="bg-light-table text-muted small text-uppercase fw-bold">
                        <tr>
                            <th class="ps-4 py-3 border-0">Pelapor Warga</th>
                            <th class="py-3 border-0">Detail Lokasi & Deskripsi</th>
                            <th class="py-3 border-0 text-center">Tanggal Tugas</th>
                            <th class="py-3 border-0 text-center">Status Kerja</th>
                            <th class="py-3 border-0 text-end pe-4">Aksi Lapangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($tugas_masuk)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 empty-table-state">
                                    <img src="https://illustrations.popsy.co/blue/work-from-home.svg" style="width: 180px;" class="mb-3 opacity-75">
                                    <h6 class="text-dark fw-bold mb-1">Tidak Ada Beban Tugas</h6>
                                    <p class="text-muted small mb-0">Semua aduan masyarakat sudah tuntas dikerjakan.</p>
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php foreach($tugas_masuk as $row): ?>
                        <tr class="item-row transition-all shadow-hover">
                            <td class="ps-4 py-3-5">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-box bg-soft-primary text-primary rounded-3 me-3 shadow-sm">
                                        <?= substr($row->nama_warga ?? '?', 0, 1); ?>
                                    </div>
                                    <div>
                                        <div class="fw-800 text-dark small-13 mb-0"><?= $row->nama_warga ?? 'User Anonim'; ?></div>
                                        <small class="text-muted x-small d-block mt-0-5"><?= $row->email; ?></small>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="py-3-5 data-deskripsi-col">
                                <p class="mb-1 text-dark small-13 text-truncate-2 font-medium"><?= character_limiter($row->deskripsi, 80); ?></p>
                                <span class="badge bg-soft-secondary text-dark rounded-3 x-small fw-bold">
                                    <i class="bi bi-geo-alt-fill text-danger me-1"></i> GPS: <?= !empty($row->koordinat_gps) ? $row->koordinat_gps : (!empty($row->lat) ? $row->lat.','.$row->lng : 'Internal Sektor'); ?>
                                </span>
                            </td>
                            
                            <td class="text-center py-3-5">
                                <div class="text-dark fw-bold small-13 mb-0"><?= date('d M', strtotime($row->tanggal)); ?></div>
                                <small class="text-muted x-small d-block mt-0-5"><?= date('Y', strtotime($row->tanggal)); ?></small>
                            </td>
                            
                            <td class="text-center py-3-5">
                                <?php 
                                    $b_class = 'bg-soft-warning text-warning-deep';
                                    if($row->status == 'Sedang Dikerjakan') $b_class = 'bg-soft-info text-info-deep';
                                    elseif($row->status == 'Selesai') $b_class = 'bg-soft-success text-success-deep';
                                ?>
                                <span class="badge <?= $b_class; ?> rounded-pill px-3 py-2 fw-bold status-badge-premium">
                                    <i class="bi bi-circle-fill small-dot me-1"></i> <?= strtoupper($row->status); ?>
                                </span>
                            </td>

                            <td class="text-end pe-4 py-3-5">
                                <button type="button" class="btn btn-sm btn-action-trigger rounded-pill px-4 py-2 fw-bold shadow-sm transition-all" data-bs-toggle="modal" data-bs-target="#modalUpdate<?= $row->laporan_id; ?>">
                                    <i class="bi bi-pencil-square me-1"></i> Update Progres
                                </button>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalUpdate<?= $row->laporan_id; ?>" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-xl rounded-4">
                                    <div class="modal-header bg-light border-0 py-3 px-4">
                                        <h5 class="modal-title fw-800 text-dark"><i class="bi bi-gear-wide-connected text-primary me-2"></i>Tindakan Lapangan #<?= $row->laporan_id; ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    
                                    <form action="<?= base_url('petugas/update_progres/'.$row->laporan_id); ?>" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body p-4">
                                            <div class="mb-4">
                                                <label class="form-label fw-800 text-dark small-uppercase-caps">Status Penanganan</label>
                                                <select name="status" class="form-select border-0 bg-light rounded-3 py-2-5 px-3 fw-bold text-primary shadow-xsm">
                                                    <option value="Sedang Dikerjakan" <?= ($row->status == 'Sedang Dikerjakan') ? 'selected' : ''; ?>>⚡ Eksekusi Lapangan (Sedang Dikerjakan)</option>
                                                    <option value="Selesai" <?= ($row->status == 'Selesai') ? 'selected' : ''; ?>>✅ Pekerjaan Selesai Tuntas (Selesai)</option>
                                                </select>
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label fw-800 text-dark small-uppercase-caps">Unggah Foto Bukti Fisik Perbaikan</label>
                                                <input type="file" name="foto_bukti" class="form-control border-0 bg-light rounded-3 py-2 px-3 shadow-xsm" required>
                                                <small class="text-muted d-block mt-1 x-small"><i class="bi bi-info-circle"></i> Ekstensi diizinkan: JPG/JPEG/PNG max 2MB.</small>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label fw-800 text-dark small-uppercase-caps">Memo / Tanggapan Lapangan</label>
                                                <textarea name="tanggapan_petugas" class="form-control border-0 bg-light rounded-3 p-3 shadow-xsm" rows="3" placeholder="Tuliskan laporan kondisi terkini material jalan atau infrastruktur pasca penanganan..." required><?= $row->tanggapan_petugas; ?></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="modal-footer border-0 bg-light py-3 px-4 d-flex gap-2">
                                            <button type="button" class="btn btn-white border rounded-pill px-4 fw-bold shadow-sm" data-bs-dismiss="modal">Batalkan</button>
                                            <button type="submit" class="btn btn-premium-save rounded-pill px-4 py-2 text-white fw-bold shadow-blue">
                                                <i class="bi bi-cloud-arrow-up-fill me-1 text-warning"></i> Simpan Progres
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var gorontaloCenterLat = -0.5436;
    var gorontaloCenterLng = 123.0617;
    
    var mapPetugas = L.map('mapPetugasURC').setView([gorontaloCenterLat, gorontaloCenterLng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap | Satgas URC CivicFix Gorontalo'
    }).addTo(mapPetugas);

    var layerGroupURC = new L.featureGroup();

    <?php 
        if(!empty($tugas_masuk)):
            foreach($tugas_masuk as $item):
                $final_lat = 0; $final_lng = 0;
                
                if(!empty($item->koordinat_gps) && strpos($item->koordinat_gps, ',') !== false) {
                    $pieces = explode(',', $item->koordinat_gps);
                    $final_lat = isset($pieces[0]) ? trim($pieces[0]) : 0;
                    $final_lng = isset($pieces[1]) ? trim($pieces[1]) : 0;
                } else {
                    $final_lat = $item->latitude ?? $item->lat ?? 0;
                    $final_lng = $item->longitude ?? $item->lng ?? 0;
                }

                if($final_lat != 0 && $final_lng != 0):
    ?>
                    var markerURC = L.marker([<?= $final_lat ?>, <?= $final_lng ?>]);
                    
                    var bubbleInfo = `
                        <div style="font-family: 'Plus Jakarta Sans', sans-serif; min-width: 160px; padding: 2px;">
                            <span style="font-size: 10px; font-weight: 800; color: #0061ff; display: block; margin-bottom: 2px;">PERINTAH TUGAS #<?= $item->laporan_id ?></span>
                            <p style="font-size: 12px; font-weight: 600; color: #1e293b; margin: 0 0 6px 0;"><?= addslashes(character_limiter($item->deskripsi, 40)) ?></p>
                            <button class="btn btn-xs btn-primary text-white" style="font-size: 10px; padding: 2px 8px; border-radius: 4px; border:none;" onclick="jQuery('#modalUpdate<?= $item->laporan_id ?>').modal('show')">
                                <i class="bi bi-pencil-square"></i> Eksekusi
                            </button>
                        </div>
                    `;
                    markerURC.bindPopup(bubbleInfo);
                    layerGroupURC.addLayer(markerURC);
    <?php 
                endif;
            endforeach;
        endif;
    ?>

    mapPetugas.addLayer(layerGroupURC);

    if (layerGroupURC.getLayers().length > 0) {
        mapPetugas.fitBounds(layerGroupURC.getBounds(), { padding: [50, 50] });
    }
});
</script>

<style>
    /* STYLING RULES */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
    
    body { 
        background-color: #f6f9fc !important; 
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }

    .fw-800 { font-weight: 800; }
    .font-medium { font-weight: 500; }
    .tracking-tight { letter-spacing: -0.5px; }
    .small-caps { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; }
    .small-uppercase-caps { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; }
    .small-13 { font-size: 0.85rem; }
    .x-small { font-size: 0.75rem; }
    .mt-0-5 { margin-top: 2px; }
    .py-3-5 { padding-top: 1.1rem; padding-bottom: 1.1rem; }
    .p-2-5 { padding: 0.65rem; }

    .btn-premium-white { background-color: #ffffff; border: 1px solid #e2e8f0; }
    .card-stat-premium { background: #ffffff !important; border: 1px solid rgba(226, 232, 240, 0.8) !important; transition: transform 0.3s ease; }
    .card-stat-premium:hover { transform: translateY(-5px); }
    .card-decor-line { position: absolute; bottom: 0; left: 0; width: 100%; height: 4px; }

    .bg-gradient-blue   { background: linear-gradient(135deg, #0061ff 0%, #60efff 100%); }
    .bg-gradient-orange { background: linear-gradient(135deg, #f6ad55 0%, #ed8936 100%); }
    .bg-gradient-green  { background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); }
    .shadow-blue   { box-shadow: 0 8px 20px rgba(0, 97, 255, 0.2); }
    .shadow-orange { box-shadow: 0 8px 20px rgba(246, 173, 85, 0.2); }
    .shadow-green  { box-shadow: 0 8px 20px rgba(72, 187, 120, 0.2); }

    .bg-soft-primary { background-color: #eef2ff; }
    .bg-soft-warning { background-color: #fffbeb; }
    .bg-soft-info    { background-color: #f0f9ff; }
    .bg-soft-success { background-color: #f0fdf4; }
    .bg-soft-secondary { background-color: #f8fafc; }
    .bg-light-table { background-color: #f8fafc; }

    .text-warning-deep { color: #d97706; }
    .text-info-deep    { color: #0284c7; }
    .text-success-deep { color: #16a34a; }

    .table-container-card { border: 1px solid rgba(226, 232, 240, 0.8); }
    .custom-premium-table tbody tr { border-bottom: 1px solid #f1f5f9; }
    .item-row:hover { background-color: #f8fafc !important; }

    .avatar-box {
        width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: 1.1rem; border-radius: 12px;
    }
    .status-badge-premium { font-size: 0.7rem; padding: 6px 14px !important; }
    .small-dot { font-size: 0.45rem; vertical-align: middle; margin-right: 4px; }

    .btn-action-trigger {
        background-color: #ffffff; border: 1px solid #e2e8f0; color: #475569; font-size: 0.8rem;
    }
    .btn-action-trigger:hover {
        background-color: #0061ff; color: #ffffff; border-color: #0061ff;
    }

    .btn-premium-save { background: linear-gradient(135deg, #1e293b 0%, #334155 100%); border: none; }
    .btn-premium-save:hover { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); }
    .hover-rotate:hover i { transform: rotate(180deg); transition: transform 0.4s ease; }
    .shadow-xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15) !important; }
</style>