<!DOCTYPE html>
<html>
<head>
    <title>Bukti Pembayaran SPP</title>
    <style>
        @media print {
            button { display:none; }
            .no-print { display:none !important; }
            body { margin: 0; padding: 20px; }
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
            background: #f5f5f5;
        }
        
        .receipt-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #800020 0%, #a52a2a 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }
        
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            position: relative;
            z-index: 1;
        }
        
        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .info-section {
            margin-bottom: 30px;
        }
        
        .info-title {
            font-size: 16px;
            font-weight: 600;
            color: #800020;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #800020;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        
        .info-label {
            font-weight: 600;
            color: #555;
            min-width: 80px;
            font-size: 14px;
        }
        
        .info-value {
            color: #333;
            font-size: 14px;
            flex: 1;
        }
        
        .amount-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #800020;
        }
        
        .amount-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .amount-value {
            font-size: 24px;
            font-weight: 700;
            color: #800020;
        }
        
        .footer {
            margin-top: 40px;
            text-align: right;
            padding: 20px 30px;
            border-top: 1px solid #eee;
        }
        
        .signature-box {
            display: inline-block;
            text-align: center;
        }
        
        .signature-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 30px;
        }
        
        .signature-line {
            border-top: 2px solid #333;
            width: 200px;
            margin: 0;
        }
        
        .signature-name {
            font-weight: 600;
            color: #333;
            margin-top: 5px;
            font-size: 14px;
        }
        
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(128, 0, 32, 0.05);
            font-weight: 700;
            z-index: 0;
            pointer-events: none;
        }
        
        .print-btn {
            background: linear-gradient(135deg, #800020 0%, #a52a2a 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.2s, box-shadow 0.2s;
            margin: 20px auto;
        }
        
        .print-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(128, 0, 32, 0.3);
        }
        
        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .receipt-container {
                margin: 10px;
                border-radius: 0;
            }
            
            body {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

<div class="receipt-container">
    <!-- Watermark -->
    <div class="watermark">LUNAS</div>
    
    <!-- Header -->
    <div class="header">
        <h1>BUKTI PEMBAYARAN SPP</h1>
        <p>Sistem Pembayaran Sekolah</p>
        <p style="font-size: 12px; opacity: 0.7;">No. Transaksi: {{ sprintf('TRX-%08d', $pembayaran->id) }}</p>
    </div>
    
    <!-- Content -->
    <div class="content">
        <!-- Student Information -->
        <div class="info-section">
            <div class="info-title">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg>
                Data Siswa
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Nama</span>
                    <span class="info-value">{{ $pembayaran->siswa->nama }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Kelas</span>
                    <span class="info-value">{{ $pembayaran->siswa->kelas->nama_kelas }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">NISN</span>
                    <span class="info-value">{{ $pembayaran->siswa->nisn }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Kompetensi</span>
                    <span class="info-value">{{ $pembayaran->siswa->kelas->kompetensi_keahlian }}</span>
                </div>
            </div>
        </div>
        
        <!-- Payment Information -->
        <div class="info-section">
            <div class="info-title">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
                    <path d="M3 4.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                </svg>
                Informasi Pembayaran
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Bulan</span>
                    <span class="info-value">{{ $pembayaran->bulan_dibayar }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Tahun</span>
                    <span class="info-value">{{ $pembayaran->tahun_dibayar }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Tanggal</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->format('d/m/Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Kategori</span>
                    <span class="info-value" style="text-transform: capitalize;">{{ $pembayaran->spp->kategori }}</span>
                </div>
            </div>
        </div>
        
        <!-- Amount Section -->
        <div class="amount-section">
            <div class="amount-label">Jumlah Pembayaran</div>
            <div class="amount-value">Rp {{ number_format($pembayaran->spp->nominal, 0, ',', '.') }}</div>
        </div>
        
        <!-- Footer Signature -->
        <div class="footer">
            <div class="signature-box">
                <div class="signature-label">Petugas,</div>
                <div class="signature-line"></div>
                <div class="signature-name">{{ $pembayaran->petugas->nama }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Print Button -->
<div class="no-print" style="text-align: center;">
    <button onclick="window.print()" class="print-btn">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zM6 5v1H4a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-2V5H6zm2 0h4v1H8V5z"/>
            <path d="M0 15a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1H0v1z"/>
        </svg>
        Cetak Bukti Pembayaran
    </button>
</div>

</body>
</html>
