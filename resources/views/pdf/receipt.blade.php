<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kwitansi - {{ $booking->booking_code }}</title>
    <style>
        /* Kunci Margin PDF agar tidak tumpah ke halaman 2 */
        @page { margin: 25px 35px; } 
        
        body { 
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
            color: #0f172a; 
            font-size: 13px; 
            margin: 0; 
            padding: 0; 
        }
        .text-blue { color: #3b82f6; }
        .text-green { color: #10b981; }
        .text-gray { color: #64748b; }
        .font-bold { font-weight: bold; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        
        /* HEADER */
        .header-table { width: 100%; border-bottom: 2px solid #3b82f6; padding-bottom: 8px; margin-bottom: 12px; }
        .logo-title { font-size: 26px; font-weight: bold; margin: 0; letter-spacing: -0.5px; }
        .company-address { font-size: 11px; margin-top: 4px; line-height: 1.3; }
        
        /* DATA PELANGGAN */
        .section-title { font-weight: bold; font-size: 12px; margin-bottom: 6px; text-decoration: underline; }
        .info-table { width: 100%; margin-bottom: 12px; font-size: 12px; }
        .info-table td { padding-bottom: 4px; vertical-align: top; }
        .col-label { width: 15%; font-weight: bold; }
        .col-colon { width: 2%; }
        .col-val-left { width: 43%; }
        .col-val-right { width: 23%; }
        
        /* ITEM TABLE */
        .item-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; font-size: 12px; }
        .item-table th { padding: 8px; background-color: #f8fafc; border-top: 2px solid #0f172a; border-bottom: 2px solid #0f172a; }
        .item-table td { padding: 10px 8px; border-bottom: 1px solid #e2e8f0; }
        .total-row td { border-top: 2px solid #0f172a; border-bottom: 2px solid #0f172a; padding: 8px; font-size: 13px; font-weight: bold; }
        
        /* FOOTER */
        .footer-table { width: 100%; font-size: 11px; color: #334155; }
        .terms-list { margin: 4px 0 8px 0; padding-left: 15px; }
        
        /* TTD Box - Ganti tag <br> dengan height agar ukuran stabil */
        .signature-box { height: 60px; vertical-align: bottom; text-align: center; }
    </style>
</head>
<body>

    @php
        // Kalkulasi Hari dan Tarif
        $departure = \Carbon\Carbon::parse($booking->custom_departure_time);
        $arrival = \Carbon\Carbon::parse($booking->custom_arrival_time);
        $days = $departure->diffInDays($arrival);
        $days = $days == 0 ? 1 : $days;
        
        $tarif_per_hari = $booking->schedule->price;

        // Mencegah error karakter "?" pada PDF akibat simbol panah (➔)
        $rute_bersih = str_replace(['➔', '->'], '-', $booking->custom_destination);
    @endphp

    <!-- HEADER KWITANSI -->
    <table class="header-table">
        <tr>
            <td style="vertical-align: middle;">
                <h1 class="logo-title">Vikensa<span class="text-blue">Trans</span></h1>
                <p class="company-address text-gray">
                    BTN Bumi Taman Cibodas Blok B4 No 21, Sirnagalih, Cilaku<br>
                    Cianjur 43285
                </p>
            </td>
            <td class="text-right" style="vertical-align: middle;">
                <h2 style="margin: 0; font-size: 26px; letter-spacing: 2px; color: #0f172a;">KWITANSI</h2>
                <p style="margin: 6px 0; font-weight: bold; font-size: 12px;">NO. {{ $booking->booking_code }}</p>
                <div class="text-green font-bold" style="font-size: 15px; letter-spacing: 1px;">LUNAS</div>
            </td>
        </tr>
    </table>

    <!-- DATA PELANGGAN -->
    <div class="section-title">DATA PELANGGAN :</div>
    <table class="info-table">
        <tr>
            <td class="col-label">Nama</td>
            <td class="col-colon">:</td>
            <td class="col-val-left font-bold">{{ strtoupper($booking->booker_name) }}</td>
            <td class="col-label">Tanggal</td>
            <td class="col-colon">:</td>
            <td class="col-val-right">{{ $departure->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="col-label">Penjemputan</td>
            <td class="col-colon">:</td>
            <td class="col-val-left">{{ $booking->custom_origin }}</td>
            <td class="col-label">Standby</td>
            <td class="col-colon">:</td>
            <td class="col-val-right">{{ $departure->format('H:i') }} WIB</td>
        </tr>
        <tr>
            <td class="col-label">Tujuan</td>
            <td class="col-colon">:</td>
            <td colspan="4">{{ $rute_bersih }}</td>
        </tr>
    </table>

    <!-- RINCIAN SEWA -->
    <table class="item-table">
        <thead>
            <tr>
                <th class="text-center" style="width: 15%;">DURASI</th>
                <th style="text-align: left; width: 40%;">DESKRIPSI</th>
                <th class="text-right" style="width: 20%;">TARIF/DAY</th>
                <th class="text-right" style="width: 25%;">JUMLAH</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center font-bold">{{ $days }} Hari</td>
                <td>Sewa {{ $booking->schedule->shuttle->name }}</td>
                <td class="text-right">Rp {{ number_format($tarif_per_hari, 0, ',', '.') }}</td>
                <td class="text-right font-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3" class="text-right">TOTAL:</td>
                <td class="text-right">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <!-- SYARAT & KETENTUAN (FOOTER) -->
    <table class="footer-table">
        <tr>
            <td style="width: 70%; vertical-align: top;">
                <div class="font-bold" style="font-size: 12px; color: #0f172a;">VIKENSA AKBAR SEJAHTERA</div>
                <ul class="terms-list">
                    <li>Pelunasan saat h-1 keberangkatan</li>
                    <li>Tarif diatas tidak termasuk parkir, tol, tips driver</li>
                </ul>
                <div style="font-style: italic; color: #475569;">
                    Terimakasih telah menggunakan Vikensa Trans untuk menemani perjalanan anda.
                </div>
            </td>
            <td class="signature-box" style="width: 30%;">
                <div class="font-bold" style="color: #0f172a; font-size: 13px;">( VikensaTrans )</div>
            </td>
        </tr>
    </table>

</body>
</html>