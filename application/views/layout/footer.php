</div> 
</div> 

<footer class="footer-premium py-3 bg-white border-top">
    <div class="container-fluid px-4">
        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between small">
            <div class="text-muted font-medium text-center text-sm-start mb-2 mb-sm-0">
                &copy; <?= date('Y'); ?> <span class="fw-bold text-primary">CivicFix</span> Gorontalo Smart City. All Rights Reserved.
            </div>
            <div class="footer-links-group d-flex gap-2 justification-mobile">
                <span class="badge bg-soft-primary text-primary rounded-pill px-3 py-2 fw-bold x-small">
                    <i class="bi bi-code-slash me-1"></i> TRPL Vocation UNG
                </span>
                <span class="badge bg-soft-success text-success rounded-pill px-3 py-2 fw-bold x-small">
                    <i class="bi bi-patch-check-fill me-1"></i> SQA Verified
                </span>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function () {
        // 1. Logika Toggle Sidebar dengan Animasi Meluncur Lembut
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active-collapsed');
            $('#content').toggleClass('active-expanded');
        });

        // 2. Auto-Fade Alert System (Notifikasi Hilang Otomatis setelah 4 Detik)
        window.setTimeout(function() {
            $(".dashboard-alert").addClass('animate__fadeOutUp').fadeTo(500, 0, function(){
                $(this).remove(); 
            });
        }, 4000);
    });
</script>

<style>
    /* ==========================================================================
       FOOTER STICKY POSITION HOOK MECHANISM
       ========================================================================== */
    .footer-premium {
        border-color: rgba(226, 232, 240, 0.8) !important;
        background-color: #ffffff !important;
        width: 100%;
        margin-top: auto !important; /* Mendorong paksa footer ke bagian paling bawah */
        z-index: 10;
    }
    .bg-soft-primary { background-color: #eef2ff; }
    .bg-soft-success { background-color: #f0fdf4; }

    /* Media Queries Responsif untuk Interaksi Hambat Samping */
    @media (max-width: 768px) {
        #sidebar { margin-left: -270px; }
        #sidebar.active-collapsed { margin-left: 0; }
        .justification-mobile { justify-content: center; width: 100%; }
    }
    @media (min-width: 769px) {
        #sidebar.active-collapsed { margin-left: -270px; }
        #content.active-expanded { width: 100%; }
    }
</style>

</body>
</html>