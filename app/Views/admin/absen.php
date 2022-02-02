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
                            <h6 class="ms-4 mt-2" style="font-weight:bold;">
                                <p class="d-inline" style="font-weight:bold; font-size: 15pt;">ABSENSI COACHING
                                </p><br>
                                FAKULTAS PARIWISATA DAN PERHOTELAN <br>
                                UNIVERSITAS NEGERI PADANG <br>

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
                <div class="container mt-2">
                    <table class="table table-striped table-bordered border-dark">
                        <thead class="text-center" style="background-color: palevioletred; color: white;">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Tanda Tangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($info as $absen) : ?>
                                <tr>
                                    <th class="text-center"><?= $i; ?></th>
                                    <td><?= $absen['NIM']; ?></td>
                                    <td><?= $absen['Nama_Mhs']; ?></td>
                                    <td><?= $absen['Jurusan']; ?></td>
                                    <td></td>
                                </tr>
                                <?php $i++ ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
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