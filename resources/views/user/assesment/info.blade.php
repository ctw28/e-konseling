@extends('admin.template')

@section('content')
<div class="card card-default">
    <div class="card-body">

        <p dir="ltr" style="line-height:1.3800000000000001;text-align: justify;margin-top:12pt;margin-bottom:0pt;"><span
                style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Pengantar</span>
        </p>
        <p dir="ltr" style="line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;"><span
                style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Alat
                Ukur Mandiri (AUM) ini wajib dilakukan oleh mahasiswa IAIN Kendari sebelum menjalani proses konseling
                pada
                konselor. Anda diminta untuk membaca informasi berikut dengan cermat. Jika terdapat hal yang belum
                jelas, Anda
                dapat bertanya secara langsung melalui layanan informasi untuk menjelaskan hal-hal yang belum
                dipahami.</span>
        </p>
        <p><b style="font-weight:normal;" id="docs-internal-guid-ab467cd6-7fff-41f6-f7a8-c8deb7c9fa72"><br></b></p>
        <p dir="ltr" style="line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;"><span
                style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Mengapa
                AUM ini dilakukan?</span></p>
        <p dir="ltr" style="line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;"><span
                style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">AUM
                ini dilakukan untuk mengetahui bagaimana dinamika psikologis Mahasiswa IAIN Kendari sebagai individu
                yang
                memiliki perbedaan karakteristik dengan individu yang lainnya.</span></p>
        <p><b style="font-weight:normal;"><br></b></p>
        <p dir="ltr" style="line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;"><span
                style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Apa
                yang Anda lakukan dalam AUM ini?</span></p>
        <p dir="ltr" style="line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;"><span
                style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Konselor
                akan meminta Anda untuk mengisi sejumlah pernyataan tentang kondisi Anda yang dalam berbagai aspek
                kehidupan
                termasuk sikap Anda dalam menjalani aktivitas. Beberapa pernyataan juga akan menanyakan keadaan keluarga
                Anda
                secara umum dan meminta Anda untuk menjawab seluruh rangkaian pernyataan yang telah diisi dalam batas
                waktu yang
                telah ditentukan.</span></p>
        <p dir="ltr" style="line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;"><span
                style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">&nbsp;</span>
        </p>
        <p dir="ltr" style="line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;"><span
                style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Bagaimana
                kerahasiaan Mahasiswa dilindungi?</span></p>
        <p dir="ltr" style="line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;"><span
                style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Privasi
                Anda adalah sangat penting untuk konselor. Seluruh data informasi yang Anda berikan tidak akan
                diperlihatkan
                kepada pihak lain yang tidak berkepentingan dalam proses konseling ini. Semua catatan akan disimpan
                dengan
                cermat oleh konselor. Nama asli Anda dan identitas lainnya tidak akan ditulis dalam laporan ataupun
                artikel-artikel yang bersangkutan dengan web konseling.</span></p>
        <p><b style="font-weight:normal;"><br></b></p>
        <p dir="ltr" style="line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;"><span
                style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Bagaimana
                jika saya tidak menyelesaikan AUM?</span></p>
        <p dir="ltr" style="line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;"><span
                style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Anda
                sepenuhnya bebas menentukan untuk berpartisipasi atau tidak. Keputusan Anda akan berpengaruh terhadap
                keberlanjutan proses konseling. Jika di tengah pengisian Anda terhenti mengisi karena alasan teknis
                maupun non
                teknis, Anda boleh melanjutkan dilain waktu tanpa harus mengulang pengisian dari awal. Anda dapat
                berhenti dan
                mengundurkan diri kapanpun Anda mau, bahkan jika pengisian AUM sudah dilakukan.</span></p>
        <p><b style="font-weight:normal;"><br></b></p>
        <p dir="ltr" style="line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;"><span
                style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Dimana
                saya bisa mendapatkan informasi lebih lanjut?</span></p>
        <p dir="ltr" style="line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;"><span
                style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Bila
                Anda memiliki pertanyaan tentang AUM ini atau keikutsertaan, Anda dapat menghubungi layanan Web
                Konseling
                (Admin) pada kolom Q n A.</span></p>
        <p><b style="font-weight:normal;"><br></b></p>
        <p dir="ltr" style="line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;"><span
                style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Bagaimana
                cara saya menyatakan persetujuan untuk berpartisipasi?</span></p>
        <p></p>
        <p dir="ltr" style="line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;"><span
                style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Anda
                dapat menyatakan persetujuan pada lembar persetujuan Konseling Online dengan mencentang persetujuan
                konseling.</span></p>
        <div><span
                style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;"><br></span>
        </div>
    </div>
</div>
@endsection