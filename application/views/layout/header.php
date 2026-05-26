<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Pusat Kendali'; ?> - CivicFix</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <style>
        /* ==========================================================================
           CIVICFIX CORE DESIGN SYSTEM (PREMIUM LIGHT PRESETS)
           ========================================================================== */
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #f6f9fc;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            overflow-x: hidden;
        }

        /* Layout Main Arsitektur Wrappers */
        .wrapper { 
            display: flex; 
            width: 100%; 
            align-items: stretch; 
            min-height: 100vh;
        }

        /* Sektor Konten Utama Terpadu */
        #content { 
            width: 100%; 
            padding: 0; /* Dikosongkan agar navbar atas menempel sempurna */
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
            background-color: #f6f9fc; 
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Utilities Global */
        .fw-800 { font-weight: 800; }
        .font-medium { font-weight: 500; }
        .rounded-4 { border-radius: 1rem !important; }
        .small-caps {
            letter-spacing: 1.5px;
            font-size: 0.7rem;
            text-transform: uppercase;
        }
        .small-13 { font-size: 0.85rem; }
        .x-small { font-size: 0.72rem; }
    </style>
</head>
<body>
    <div class="wrapper">