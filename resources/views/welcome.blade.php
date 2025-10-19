<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'FOPNL-UMKM') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
    :root{--bg:#f7f9fb;--card:#fff;--muted:#6b7280;--accent:#0f172a}
    headerz h1{margin:.2rem 0 0;font-size:28px}
    headerz p{margin:6px 0 20px;color:var(--muted)}
    .card{background:var(--card);border-radius:12px;padding:20px;margin-bottom:16px;box-shadow:0 6px 18px rgba(16,24,40,.06)}
    h2{margin:0 0 8px}
    ul{margin:8px 0 0;padding-left:20px}
    pre{background:#0f172a;color:#fff;padding:12px;border-radius:8px;overflow:auto}

    /* Example badges */
    .examples{display:flex;gap:12px;flex-wrap:wrap;margin-top:12px}
    .badge{min-width:120px;padding:12px;border-radius:8px;border:1px solid #e6eef8;background:#fff;text-align:center}
    .traffic{display:flex;flex-direction:column;gap:6px}
    .light{width:28px;height:28px;border-radius:50%;margin:0 auto}
    .g{background:#2ecc71}
    .a{background:#f6c23e}
    .r{background:#ef4444}
    .nutri{font-weight:700;padding:8px;border-radius:6px}
    .nutri.A{background:#1e293b;color:#fff}
    .nutri.B{background:#10b981;color:#fff}
    .nutri.C{background:#f59e0b;color:#fff}
    .nutri.D{background:#f97316;color:#fff}
    .nutri.E{background:#ef4444;color:#fff}
    .stars{font-size:18px}


    /* Responsive */
    @media (max-width:640px){body{padding:16px}.examples{flex-direction:column}}
    </style>

</head>
<body class="bg-gray-100 text-gray-900">
    <div class="flex min-h-screen">

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col">
            {{-- Navbar --}}
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-22 h-8">
                <div class="flex items-center gap-2">
                    <a href="{{ route('home') }}" class="hover:bg-gray-100 text-whitexx px-3 py-1.5 rounded-md text-sm font-medium">
                        Home
                    </a>
                    <a href="{{ route('public.products.index') }}" class="hover:bg-gray-100 text-whitexx px-3 py-1.5 rounded-md text-sm font-medium">
                        Daftar Produk
                    </a>
                    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-md text-sm font-medium">
                        Log in
                    </a>
                    <a href="{{ route('register') }}" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-md text-sm font-medium">
                        Register
                    </a>
                </div>
            </header>

            {{-- Content --}}
            <main class="flex-1 p-6">
                <headerz>
                <h1>FOPNL untuk UMKM — Digitalisasi</h1>
                <p>
                    {{-- Dokumen ini mengonversi konsep pengembangan Front-of-Pack Nutrition Labels (FOPNL) berbasis digital untuk produk UMKM menjadi halaman HTML ringkas dan siap pakai. --}}
                </p>
                </headerz>

                <section class="card" id="introduction">
                <h2>1. Pendahuluan</h2>
                <p>Front-of-Pack Nutrition Labels (FOPNLs) adalah informasi nutrisi sederhana yang diletakkan di bagian depan kemasan makanan, dirancang untuk membantu konsumen memahami kualitas nutrisi produk secara cepat. Industri besar sudah mulai menerapkannya, namun UMKM sering menghadapi kendala seperti sumber daya terbatas, kurangnya pengetahuan, dan minimnya alat digital yang terjangkau.</p>
                <p>Digitalisasi membuka peluang bagi UMKM untuk membuat FOPNL yang standar dengan biaya lebih rendah dan jangkauan lebih luas melalui aplikasi mobile, QR code, dan basis data awan.</p>
                </section>


                <section class="card" id="objectives">
                <h2>2. Tujuan</h2>
                <ul>
                <li>Mengembangkan sistem berbasis digital untuk pembuatan dan manajemen FOPNL produk UMKM.</li>
                <li>Meningkatkan kesadaran dan kepercayaan konsumen terhadap produk UMKM melalui informasi nutrisi yang transparan.</li>
                <li>Mendukung kepatuhan terhadap regulasi pemerintah dan standar internasional terkait pelabelan nutrisi.</li>
                </ul>
                </section>


                <section class="card" id="methodology">
                <h2>3. Konsep Metodologi</h2>
                <h3>Pengumpulan Data</h3>
                <ul>
                <li>Analisis kandungan nutrisi produk UMKM (uji laboratorium atau basis data standar).</li>
                <li>Mengumpulkan referensi regulasi (WHO, Codex Alimentarius, BPOM, dsb.).</li>
                </ul>


                <h3>Proses Digitalisasi</h3>
                <ul>
                <li>Pengembangan aplikasi web atau mobile untuk generasi label otomatis.</li>
                <li>Integrasi QR code yang menautkan ke informasi produk lengkap.</li>
                <li>Penyimpanan data nutrisi produk di cloud.</li>
                </ul>


                <h3>Model Desain FOPNL</h3>
                <p>Beberapa model yang dapat diimplementasikan atau disesuaikan menurut regulasi lokal dan literasi konsumen:</p>
                <ul>
                <li>Sistem traffic light (indikator hijau–kuning–merah).</li>
                <li>Nutri-Score (grade A–E).</li>
                <li>Health star rating.</li>
                <li>Adaptasi kustom sesuai regulasi dan literasi lokal.</li>
                </ul>


                <div class="examples">
                <div class="badge traffic">
                <strong>Traffic Light</strong>
                <div class="light g" title="Rendah gula/lemak/gula"></div>
                <div class="light a" title="Sedang"></div>
                <div class="light r" title="Tinggi"></div>
                </div>


                <div class="badge">
                <strong>Nutri-Score</strong>
                <div class="nutri A">A</div>
                </div>


                <div class="badge">
                <strong>Health Stars</strong>
                <div class="stars">★★★★☆</div>
                </div>
                </div>
                </section>


                <section class="card" id="expected-outcomes">
                <h2>4. Hasil yang Diharapkan</h2>
                <ul>
                <li>Alat digital yang memungkinkan UMKM membuat FOPNL standar secara otomatis.</li>
                <li>Peningkatan literasi konsumen terhadap pilihan makanan lebih sehat.</li>
                <li>Peningkatan daya saing produk UMKM di pasar nasional dan internasional.</li>
                <li>Kontribusi terhadap Tujuan Pembangunan Berkelanjutan (SDG 3 &amp; SDG 9).</li>
                </ul>
                </section>


                <section class="card" id="challenges">
                <h2>5. Tantangan</h2>
                <ul>
                <li>Terbatasnya fasilitas pengujian nutrisi untuk UMKM.</li>
                <li>Kebutuhan pelatihan dan peningkatan kapasitas literasi digital.</li>
                <li>Penyesuaian regulasi dan proses sertifikasi.</li>
                </ul>
                </section>


                <section class="card" id="implementation-suggestions">
                <h2>6. Saran Implementasi Singkat</h2>
                <ol>
                <li>Mulai pilot untuk beberapa produk UMKM bersama laboratorium terakreditasi.</li>
                <li>Kembangkan aplikasi sederhana (progressive web app) untuk input data nutrisi dan menghasilkan gambar FOPNL + QR code.</li>
                <li>Sosialisasi dan pelatihan untuk UMKM terkait cara interpretasi label dan input data.</li>
                <li>Bekerja sama dengan regulator untuk validasi dan standarisasi.</li>
                </ol>
                </section>
            </main>
        </div>
    </div>

    <footer class="bg-white shadow-inner py-3 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} FOPNL Nutrition Label System
    </footer>
</body>
</html>
