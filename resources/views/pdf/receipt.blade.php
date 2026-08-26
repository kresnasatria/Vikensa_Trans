<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>
        Kwitansi {{ $booking->booking_code }} - VikensaTrans
    </title>

    <style>
        @page {
            margin: 22px 30px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;

            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;

            font-size: 10px;
            line-height: 1.45;

            color: #0f172a;
            background: #ffffff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-muted {
            color: #64748b;
        }

        .font-bold {
            font-weight: bold;
        }


        /* =========================================
           HEADER
        ========================================= */

        .header {
            margin-bottom: 14px;
            border-bottom: 2px solid #0ea5e9;
            padding-bottom: 10px;
        }

        .brand-name {
            margin: 0;

            font-size: 22px;
            font-weight: bold;

            color: #0f172a;
        }

        .brand-blue {
            color: #0ea5e9;
        }

        .company-text {
            margin-top: 3px;

            font-size: 8.5px;
            line-height: 1.5;

            color: #64748b;
        }

        .receipt-title {
            margin: 0;

            font-size: 21px;
            font-weight: bold;
            letter-spacing: 1px;

            color: #0f172a;
        }

        .booking-code {
            margin-top: 4px;

            font-size: 9px;
            font-weight: bold;

            color: #475569;
        }

        .paid-badge {
            display: inline-block;

            margin-top: 6px;

            padding: 4px 10px;

            border: 1px solid #86efac;
            border-radius: 4px;

            background: #f0fdf4;

            color: #15803d;

            font-size: 9px;
            font-weight: bold;
            letter-spacing: .6px;
        }


        /* =========================================
           SECTION
        ========================================= */

        .section {
            margin-bottom: 12px;
        }

        .section-title {
            margin-bottom: 6px;

            font-size: 8px;
            font-weight: bold;
            letter-spacing: .8px;

            text-transform: uppercase;

            color: #64748b;
        }


        /* =========================================
           INFORMATION
        ========================================= */

        .info-box {
            border: 1px solid #e2e8f0;
        }

        .info-box td {
            padding: 6px 8px;

            vertical-align: top;

            border-bottom: 1px solid #f1f5f9;
        }

        .info-box tr:last-child td {
            border-bottom: none;
        }

        .info-label {
            width: 15%;

            color: #64748b;

            font-size: 8.5px;
        }

        .info-value {
            width: 35%;

            font-size: 9px;
            font-weight: bold;

            color: #0f172a;
        }


        /* =========================================
           ROUTE
        ========================================= */

        .route-box {
            padding: 9px 10px;

            border: 1px solid #e2e8f0;

            background: #f8fafc;
        }

        .route-city {
            font-size: 11px;
            font-weight: bold;

            color: #0f172a;
        }

        .route-arrow {
            padding: 0 8px;

            font-size: 13px;
            font-weight: bold;

            color: #0ea5e9;
        }

        .route-address {
            margin-top: 5px;

            font-size: 8.5px;
            color: #64748b;
        }


        /* =========================================
           PAYMENT TABLE
        ========================================= */

        .payment-table {
            border: 1px solid #cbd5e1;
        }

        .payment-table th {
            padding: 7px 8px;

            border-bottom: 1px solid #cbd5e1;

            background: #f1f5f9;

            font-size: 8px;
            font-weight: bold;

            text-transform: uppercase;

            color: #475569;
        }

        .payment-table td {
            padding: 8px;

            border-bottom: 1px solid #e2e8f0;

            font-size: 9px;
            vertical-align: top;
        }

        .payment-table .total-row td {
            padding-top: 9px;
            padding-bottom: 9px;

            border-top: 2px solid #0f172a;
            border-bottom: none;

            font-size: 11px;
            font-weight: bold;

            background: #f8fafc;
        }

        .total-price {
            font-size: 13px !important;

            color: #0f172a;
        }


        /* =========================================
           FOOTER
        ========================================= */

        .footer {
            margin-top: 10px;

            padding-top: 8px;

            border-top: 1px solid #e2e8f0;
        }

        .footer-title {
            font-size: 8.5px;
            font-weight: bold;

            color: #334155;
        }

        .footer-text {
            margin-top: 3px;

            font-size: 7.5px;
            line-height: 1.5;

            color: #64748b;
        }

        .signature {
            width: 28%;

            vertical-align: top;
            text-align: center;
        }

        .signature-space {
            height: 28px;
        }

        .signature-name {
            padding-top: 4px;

            border-top: 1px solid #94a3b8;

            font-size: 8.5px;
            font-weight: bold;
        }
    </style>
</head>


<body>

@php

    /*
    |--------------------------------------------------------------------------
    | DATA PERJALANAN
    |--------------------------------------------------------------------------
    */

    $departure = $booking->custom_departure_time
        ? \Carbon\Carbon::parse($booking->custom_departure_time)
        : null;

    $arrival = $booking->custom_arrival_time
        ? \Carbon\Carbon::parse($booking->custom_arrival_time)
        : null;


    /*
    |--------------------------------------------------------------------------
    | DURASI
    |--------------------------------------------------------------------------
    |
    | Digunakan untuk informasi visual di kwitansi.
    | Minimal dihitung 1 hari.
    |
    */

    if ($departure && $arrival) {

        $seconds =
            $departure->diffInSeconds($arrival);

        $days =
            max(
                1,
                (int) ceil($seconds / 86400)
            );

    } else {

        $days = 1;

    }


    /*
    |--------------------------------------------------------------------------
    | ARMADA
    |--------------------------------------------------------------------------
    */

    $shuttle =
        $booking->schedule?->shuttle;

    $shuttleName =
        $shuttle?->name
        ?? 'Armada VikensaTrans';

    $licensePlate =
        $shuttle?->license_plate
        ?? '-';


    /*
    |--------------------------------------------------------------------------
    | TARIF
    |--------------------------------------------------------------------------
    */

    $dailyPrice =
        $booking->schedule?->price
        ?? 0;


    /*
    |--------------------------------------------------------------------------
    | CUSTOMER
    |--------------------------------------------------------------------------
    */

    $customerName =
        $booking->booker_name
        ?? $booking->user?->name
        ?? '-';

    $customerPhone =
        $booking->phone_number
        ?? '-';


    /*
    |--------------------------------------------------------------------------
    | ROUTE
    |--------------------------------------------------------------------------
    */

    $origin =
        $booking->custom_origin
        ?? '-';

    $destination =
        $booking->custom_destination
        ?? '-';

    $pickupAddress =
        $booking->pickup_address
        ?? '-';

@endphp



{{-- ========================================================= --}}
{{-- HEADER --}}
{{-- ========================================================= --}}

<table class="header">

    <tr>

        <td
            style="
                width: 60%;
                vertical-align: middle;
            "
        >

            <h1 class="brand-name">
                Vikensa<span class="brand-blue">Trans</span>
            </h1>


            <div class="company-text">

                PT. Vikensa Akbar Sejahtera<br>

                BTN Bumi Taman Cibodas Blok B4 No. 21,
                Sirnagalih, Cilaku<br>

                Cianjur 43285

            </div>

        </td>


        <td
            class="text-right"

            style="
                width: 40%;
                vertical-align: middle;
            "
        >

            <h2 class="receipt-title">
                KWITANSI
            </h2>


            <div class="booking-code">
                No. {{ $booking->booking_code }}
            </div>


            <div class="paid-badge">
                LUNAS
            </div>

        </td>

    </tr>

</table>



{{-- ========================================================= --}}
{{-- INFORMASI TRANSAKSI --}}
{{-- ========================================================= --}}

<div class="section">

    <div class="section-title">
        Informasi Transaksi
    </div>


    <table class="info-box">

        <tr>

            <td class="info-label">
                Nama Pemesan
            </td>

            <td class="info-value">
                {{ $customerName }}
            </td>


            <td class="info-label">
                Kode Booking
            </td>

            <td class="info-value">
                {{ $booking->booking_code }}
            </td>

        </tr>


        <tr>

            <td class="info-label">
                Nomor Telepon
            </td>

            <td class="info-value">
                {{ $customerPhone }}
            </td>


            <td class="info-label">
                Tanggal Pesan
            </td>

            <td class="info-value">

                {{
                    $booking->created_at
                        ->timezone('Asia/Jakarta')
                        ->format('d/m/Y H:i')
                }}
                WIB

            </td>

        </tr>


        <tr>

            <td class="info-label">
                Armada
            </td>

            <td class="info-value">
                {{ $shuttleName }}
            </td>


            <td class="info-label">
                Nomor Polisi
            </td>

            <td class="info-value">
                {{ $licensePlate }}
            </td>

        </tr>

    </table>

</div>



{{-- ========================================================= --}}
{{-- DETAIL PERJALANAN --}}
{{-- ========================================================= --}}

<div class="section">

    <div class="section-title">
        Detail Perjalanan
    </div>


    <div class="route-box">

        <table>

            <tr>

                <td
                    style="
                        width: 44%;
                        vertical-align: middle;
                    "
                >

                    <div class="route-city">
                        {{ $origin }}
                    </div>

                    <div class="text-muted">
                        Titik keberangkatan
                    </div>

                </td>


                <td
                    class="route-arrow text-center"

                    style="width: 12%;"
                >
                    &rarr;
                </td>


                <td
                    class="text-right"

                    style="
                        width: 44%;
                        vertical-align: middle;
                    "
                >

                    <div class="route-city">
                        {{ $destination }}
                    </div>

                    <div class="text-muted">
                        Tujuan perjalanan
                    </div>

                </td>

            </tr>

        </table>


        <div class="route-address">

            <strong>Alamat Penjemputan:</strong>
            {{ $pickupAddress }}

        </div>

    </div>

</div>



{{-- ========================================================= --}}
{{-- WAKTU PERJALANAN --}}
{{-- ========================================================= --}}

<div class="section">

    <table class="info-box">

        <tr>

            <td class="info-label">
                Keberangkatan
            </td>

            <td class="info-value">

                @if($departure)

                    {{
                        $departure
                            ->locale('id')
                            ->translatedFormat('d F Y')
                    }}

                    -
                    {{ $departure->format('H:i') }}
                    WIB

                @else

                    -

                @endif

            </td>


            <td class="info-label">
                Selesai
            </td>

            <td class="info-value">

                @if($arrival)

                    {{
                        $arrival
                            ->locale('id')
                            ->translatedFormat('d F Y')
                    }}

                    -
                    {{ $arrival->format('H:i') }}
                    WIB

                @else

                    -

                @endif

            </td>

        </tr>

    </table>

</div>



{{-- ========================================================= --}}
{{-- RINCIAN PEMBAYARAN --}}
{{-- ========================================================= --}}

<div class="section">

    <div class="section-title">
        Rincian Pembayaran
    </div>


    <table class="payment-table">

        <thead>

            <tr>

                <th
                    style="
                        width: 42%;
                        text-align: left;
                    "
                >
                    Deskripsi
                </th>


                <th
                    style="
                        width: 14%;
                        text-align: center;
                    "
                >
                    Durasi
                </th>


                <th
                    style="
                        width: 20%;
                        text-align: right;
                    "
                >
                    Tarif / Hari
                </th>


                <th
                    style="
                        width: 24%;
                        text-align: right;
                    "
                >
                    Jumlah
                </th>

            </tr>

        </thead>


        <tbody>

            <tr>

                <td>

                    <span class="font-bold">
                        Sewa {{ $shuttleName }}
                    </span>

                    <br>

                    <span class="text-muted">
                        Charter kendaraan VikensaTrans
                    </span>

                </td>


                <td class="text-center font-bold">
                    {{ $days }} Hari
                </td>


                <td class="text-right">

                    Rp
                    {{
                        number_format(
                            $dailyPrice,
                            0,
                            ',',
                            '.'
                        )
                    }}

                </td>


                <td class="text-right font-bold">

                    Rp
                    {{
                        number_format(
                            $booking->total_price,
                            0,
                            ',',
                            '.'
                        )
                    }}

                </td>

            </tr>

        </tbody>


        <tfoot>

            <tr class="total-row">

                <td
                    colspan="3"
                    class="text-right"
                >
                    TOTAL PEMBAYARAN
                </td>


                <td
                    class="
                        text-right
                        total-price
                    "
                >

                    Rp
                    {{
                        number_format(
                            $booking->total_price,
                            0,
                            ',',
                            '.'
                        )
                    }}

                </td>

            </tr>

        </tfoot>

    </table>

</div>



{{-- ========================================================= --}}
{{-- FOOTER --}}
{{-- ========================================================= --}}

<table class="footer">

    <tr>

        <td
            style="
                width: 72%;
                vertical-align: top;
                padding-right: 30px;
            "
        >

            <div class="footer-title">
                Catatan
            </div>


            <div class="footer-text">

                Kwitansi ini merupakan bukti pembayaran
                yang sah dari VikensaTrans.

                <br>

                Tarif perjalanan belum termasuk biaya tambahan
                seperti tol, parkir, tiket objek wisata,
                dan kebutuhan pribadi selama perjalanan,
                apabila tidak tercantum dalam kesepakatan.

                <br><br>

                Terima kasih telah mempercayakan perjalanan Anda
                bersama VikensaTrans.

            </div>

        </td>


        <td class="signature">

            <div class="footer-text">
                Cianjur,
                {{
                    now()
                        ->timezone('Asia/Jakarta')
                        ->format('d/m/Y')
                }}
            </div>


            <div class="signature-space"></div>


            <div class="signature-name">
                VikensaTrans
            </div>


            <div class="footer-text">
                PT. Vikensa Akbar Sejahtera
            </div>

        </td>

    </tr>

</table>


</body>
</html>