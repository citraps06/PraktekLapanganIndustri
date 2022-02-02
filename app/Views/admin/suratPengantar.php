<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="card" style="border: none;">
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col col-2">
                        <img src="/gambar/logo_pendidikan.png" alt="" width="110" height="110" class="ms-2 ">
                    </div>
                    <div class="col col-8">
                        <div class="text-center" style="font-family: 'Times New Roman', Times, serif;">
                            <h6 class="ms-4" style="font-weight:bold;">
                                KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN <br>
                                UNIVERSITAS NEGERI PADANG <br>
                                FAKULTAS PARIWISATA DAN PERHOTELAN <br>
                                <p class="d-inline" style="font-weight:bold; font-size: 15pt;">UNIT HUBUNGAN INDUSTRI
                                </p>
                                <p style="font-size: 10pt; font-weight: normal;">Jl. Prof Dr. Hamka Kampus UNP Air Tawar
                                    Padang 25171 <br>
                                    E-mail : uhifpp@gmail.com</p>
                            </h6>
                        </div>
                    </div>
                    <div class="col col-2">
                        <img src="/gambar/logo_unp.png" alt="" width="110" height="110" class="ms-auto ">
                    </div>
                </div>
                <div class="row ms-2">
                    <hr style=" height: 8px; background-color:black;">
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col col-12">
                        <table class="ms-2">
                            <tbody>
                                <tr style="margin-bottom: none;">
                                    <td>Nomor</td>
                                    <td width="400px">: 49a.UN35.1.7.8/PP/2021</td>
                                    <td>Padang, <?= $tgl_surat; ?></td>
                                </tr>
                                <tr>
                                    <td>Lamp.</td>
                                    <td>: -</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Hal</td>
                                    <td>: Pengalaman Lapangan Industri Mahasiswa FPP UNP</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mt-3">
                    <div class="col col-12 ms-2">
                        <p class="d-inline">
                            Kepada Yth : Pimpinan <?= $perusahaan; ?>
                        </p>
                        <p class="ms-5">di Tempat</p>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col col-12 ms-2">
                        <p class="">Dengan hormat,</p>
                        <p class="mt-1" style="text-align:justify;"> &ensp;&ensp;&ensp;&ensp;&ensp;
                            Kami mengucapkan terima kasih banyak atas persetujuan Pimpinan <?= $perusahaan; ?>
                            untuk menerima mahasiswa kami melaksanakan program PLI mulai tanggal <?= $masuk; ?>
                            s/d <?= $keluar; ?>.
                        </p>
                        <p class="mt-1" style="text-align:justify;"> &ensp;&ensp;&ensp;&ensp;&ensp;
                            Selanjutnya, kami konfirmasikan mahasiswa yang akan datang melaksanakan kegiatan
                            dimaksud yaitu :
                        </p>
                        <table class="table-bordered text-center" style="border-color:black; color:black;">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 50px;">No</th>
                                    <th scope="col" style="width: 200px;">Nama</th>
                                    <th scope="col" style="width: 100px;">NIM</th>
                                    <th scope="col" style="width: 150px;">Program Studi</th>
                                    <th scope="col" style="width: 200px;">Dosen Pembimbing</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($info as $surat) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $surat['Nama_Mhs']; ?></td>
                                        <td><?= $surat['NIM']; ?></td>
                                        <td><?= $surat['Prodi']; ?></td>
                                        <td><?= $surat['Nama_Dsn']; ?></td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <p class="mt-2" style="text-align:justify;" class="d-inline">&ensp;&ensp;&ensp;&ensp;&ensp;
                            Selanjutnya kami mohon agar supervisor mahasiswa tersebut dapat memberikan
                            penilaian setelah kegiatan PLI mahasiswa berakhir dengan menggunakan format penilaian
                            terlampir
                        </p>
                        <p style="text-align:justify;" class="d-inline">&ensp;&ensp;&ensp;&ensp;&ensp;
                            Demikianlah surat ini dibuat, atas perhatian, bantuan, dan kerjasama Saudara kami
                            ucapkan terima kasih.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-6">

                    </div>
                    <div class="col col-6">
                        <p>
                            a.n. Dekan, <br>
                            Kepala/Koordinator Unit Hubungan Industri FPP-UNP
                        </p>
                        <br>
                        <u style="font-weight:bold; font-size: 12pt;">
                            Weni Nelmira, S.Pd, M.Pd.T
                        </u>
                        <p style="font-weight:bold;">NIP. 19790727 200312 2002</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
</body>
<script>
    window.print()
</script>

</html>