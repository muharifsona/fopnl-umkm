<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Label Gizi - {{ $product->name }}</title>

<style>
    /* --- Reset & layout --- */
    body { font-family: DejaVu Sans, Arial, sans-serif; color: #111; margin: 0; padding: 18px; }
    .page { width: 210mm; max-width: 700px; margin: 0 auto; }
    .header {
        display: table;
        width: 100%;
        table-layout: fixed;
        margin-bottom: 14px;
    }

    .header-left,
    .header-right {
        display: table-cell;
        vertical-align: top;
    }

    .header-left {
        width: 70%;
    }

    .header-right {
        width: 30%;
        text-align: right;
    }

    .logo {
        width: 100px;
        height: 100px;
        object-fit: contain;
        vertical-align: middle;
        margin-right: 8px;
    }

    .info {
        display: inline-block;
        vertical-align: middle;
        width: calc(100% - 115px);
    }

    h1 {
        font-size: 18px;
        margin: 0;
    }

    .desc {
        margin: 4px 0 8px;
        color: #444;
        font-size: 12px;
    }

    /* .logo { width:100px; height:100px; object-fit:contain; } */
    h1 { font-size:18px; margin:0; }
    p.desc { margin:4px 0 10px; color:#444; font-size:12px; }

    /* QR Code container */
    .qr-code {
        /* border: 1px solid #ccc;
        border-radius: 8px; */
        padding: 0px;
        text-align: center;
        width: 100%;
        margin-top: -15px;
        /* margin-left: -25px; */
    }

    /* FOPNL container */
    .fopnl {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 0px;
        text-align: center;
        width: 100%;
        margin-top: -15px;
        margin-left: 5px;
        margin-right: 5px;
    }

    /* Judul kecil */
    .fopnl .title {
        font-weight: bold;
        font-size: 13px;
        margin-bottom: 13px;
    }

    /* Container lingkaran */
    .traffic-circles {
        text-align: center;
        white-space: nowrap;
    }

    .circle {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin: 0 0px;
        vertical-align: middle;
        text-align: center;

        /* Center teks dengan transform */
        font-size: 10px;
        font-weight: bold;
        color: #fff;
        /* text-transform: uppercase; */
    }

    .circle span {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    /* Warna */
    .circle.green { background-color: #2ecc71; }
    .circle.yellow { background-color: #f1c40f; color: #111; }
    .circle.red { background-color: #e74c3c; }
    .circle.blue { background-color: #0000ff; color: #ffffff; }


    /* Nilai energi di bawah */
    .energy {
        font-size: 12px;
        color: #222;
        font-weight: 600;
        margin-top: 6px;
    }

    /* --- Nutrition table --- */
    .nutrition { border-top:1px solid #ddd; margin-top:8px; padding-top:8px; }
    .nutrition table { width:100%; border-collapse: collapse; font-size:13px; }
    .nutrition th, .nutrition td { padding:6px 8px; border-bottom:1px dashed #eaeaea; text-align:left; }
    .nutrition th { font-size:12px; color:#333; background:transparent; font-weight:600; }

    .meta { font-size:11px; color:#555; margin-top:10px; }

    /* small print */
    .footnote { font-size:10px; color:#666; margin-top:14px; }

    /* print helpers */
    @media print {
        body { margin:0; padding:0; margin-top: 15px }
    }
</style>
</head>
<body>
<div class="page">

    @php
        $isPdf = request()->routeIs('products.label.pdf');
        $logoPath = $isPdf
            ? public_path('images/logo.png')
            : asset('images/logo.png');
    @endphp

    <div class="header">
        <div class="header-left">
            {{-- <img src="{{ $logoPath }}" class="logo" alt="logo"/> --}}
            {{-- QR Code --}}
            @if(isset($qrCode))
            <img src="data:image/svg+xml;base64,{{ $qrCode }}" class="logo" alt="QR Code">
            @endif
            <div class="info">
                <h1>{{ $product->name }}</h1>
                <p class="desc">{{ $product->description }}</p>
                <div class="meta">
                    Net weight: {{ $product->net_weight }} g · Serving: {{ $product->serving_size }}
                </div>
            </div>
        </div>

        <div class="header-right">

            {{-- FOPNL traffic light --}}
            @php
                // summary exists?
                $s = $summary ?? null;
                function level($value, $low, $med) {
                    if ($med == $low) return 'blue';
                    if ($value <= $low) return 'green';
                    if ($value <= $med) return 'yellow';
                    return 'red';
                }
                // defaults
                $energy = $s->per_serving_energy_kcal ?? 0;
                $fat = $s->per_serving_fat_g ?? 0;
                $saturated_fat = $s->per_serving_saturated_fat_g ?? 0;
                $sugar = $s->per_serving_sugar_g ?? 0;
                $sodium = $s->per_serving_sodium_mg ?? 0;

                // thresholds (example, tweak to align regulation)
                $energyLevel        = level($energy, 99999, 99999); // per serving
                $fatLevel           = level($fat, 3, 17);
                $saturatedFatLevel  = level($saturated_fat, 3, 5);
                $sugarLevel         = level($sugar, 5, 15);
                $sodiumLevel        = level($sodium, 120, 400);
            @endphp

            {{-- FOPNL traffic light --}}
            <div class="fopnl">
                <div class="title">FOPNL - Traffic Light</div>

                <div class="traffic-circles">
                    <div class="circle {{ $energyLevel }}"><span>{{ $energy }}<br>kkal</span></div>
                    <div class="circle {{ $sugarLevel }}"><span>{{ $fat }}<br>g</span></div><br>
                    <div class="circle {{ $fatLevel }}"><span>{{ $saturated_fat }}<br>g</span></div>
                    <div class="circle {{ $saturatedFatLevel }}"><span>{{ $sugar }}<br>g</span></div>
                    <div class="circle {{ $sodiumLevel }}"><span>{{ $sodium }}<br>mg</span></div>
                </div>

                <div class="energy">
                    {{-- Energy: <strong>{{ number_format($energy, 0) }} kkal</strong> --}}
                    <div style="text-align: center; margin-bottom: 10px;">
                        <div style="display: inline-block; background-color: {{ $nutriColor }}; color: white; padding: 2px 5px; border-radius: 8px; font-weight: bold; font-size: 10px;">
                            Nutri-Score: {{ $nutriScore }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Nutrition summary table --}}
    <div class="nutrition">
        <table>
            <thead>
                <tr>
                    <td><b>Per serving</b></td>
                    <td style="width:130px; text-align:right;"><b>Amount</b></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Energy</td>
                    <td style="text-align:right;">{{ number_format($s->per_serving_energy_kcal ?? 0, 0) }} kkal</td>
                </tr>
                <tr>
                    <td>Protein</td>
                    <td style="text-align:right;">{{ number_format($s->per_serving_protein_g ?? 0, 1) }} g</td>
                </tr>
                <tr>
                    <td>Fat</td>
                    <td style="text-align:right;">{{ number_format($s->per_serving_fat_g ?? 0, 1) }} g</td>
                </tr>
                <tr>
                    <td>Saturated Fat</td>
                    <td style="text-align:right;">{{ number_format($s->per_serving_saturated_fat_g ?? 0, 1) }} g</td>
                </tr>
                <tr>
                    <td>Carbohydrate</td>
                    <td style="text-align:right;">{{ number_format($s->per_serving_carbs_g ?? 0, 1) }} g</td>
                </tr>
                <tr>
                    <td>Sugar</td>
                    <td style="text-align:right;">{{ number_format($s->per_serving_sugar_g ?? 0, 1) }} g</td>
                </tr>
                <tr>
                    <td>Sodium</td>
                    <td style="text-align:right;">{{ number_format($s->per_serving_sodium_mg ?? 0, 0) }} mg</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- ingredient list small --}}
    <div style="margin-top:10px; font-size:12px;">
        <strong>Ingredients:</strong>
        @if($product->productIngredients && $product->productIngredients->count())
            @php
                $ingredientsList = $product->productIngredients->map(function($pi) {
                    $name = $pi->ingredient->name ?? '-';
                    $qty = $pi->quantity_g ? number_format($pi->quantity_g, 0) . 'g' : null;
                    return $qty ? "{$name} ({$qty})" : $name;
                })->join(', ');
            @endphp

            {{ $ingredientsList }}
        @else
            -
        @endif
    </div>

    {{-- Footnote --}}
    <div class="footnote">
        Dibuat: {{ \Carbon\Carbon::now()->format('d M Y H:i') }} · Label ini adalah ringkasan gizi per sajian yang dihitung otomatis.
    </div>
</div>
</body>
</html>
