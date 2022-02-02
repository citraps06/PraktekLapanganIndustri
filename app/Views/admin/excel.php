<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data PLI Mahasiswa ".$info2.".xls");
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <table>
       <thead>
         <tr>
           <th style="font-size: 14pt; text-align: center; font-family: Times New Roman;" colspan="11">Data Pengalaman Lapangan Industri (PLI) Periode <?php echo $info2; ?></th>
         </tr>
         <tr>
           <th style="font-size: 14pt; text-align: center; font-family: Times New Roman;" colspan="11">Fakultas Pariwisata dan Perhotelan, Universitas Negeri Padang</th>
         </tr>
         <tr>
           <th colspan="11"></th>
         </tr>
      </table>
    </thead>
    <table border="1">
      <thead>
         <tr style="font-size: 12pt; text-align: center; font-family: Times New Roman; padding-left: 5px; padding-right: 5px; background-color: #BFBFBF;">
           <th>No</th>
           <th>NIM</th>
           <th>Nama</th>
           <th>Jurusan</th>
           <th>Prodi</th>
           <th>Dosen Pembimbing</th>
           <th>Nama Perusahaan</th>
           <th>Department</th>
           <th>Tanggal Mulai</th>
           <th>Tanggal Selesai</th>
           <th>Nilai</th>
         </tr>
       </thead>
       <tbody>
         <?php $i = 1; ?>
         <?php foreach($laporan as $isi): ?>
         <tr style="font-size: 12pt; font-family: Times New Roman; padding-left: 5px; padding-right: 5px;">
           <td style="text-align: center;"><?php echo $i; ?></td>
           <td><?php echo $isi['NIM']; ?></td>
           <td><?php echo $isi['Nama_Mhs']; ?></td>
           <td><?php echo $isi['Jurusan']; ?></td>
           <td><?php echo $isi['Prodi']; ?></td>
           <td><?php echo $isi['Nama_Dsn']; ?></td>
           <td><?php echo $isi['Nama_Perusahaan']; ?></td>
           <td><?php echo $isi['Bidang']; ?></td>
           <td style="text-align: left;"><?php echo $isi['Tanggal_Masuk']; ?></td>
           <td style="text-align: left;"><?php echo $isi['Tanggal_Keluar']; ?></td>
           <td style="text-align: center;"><?php echo $isi['Akred']; ?></td>
         </tr>
         <?php $i++; ?>
       <?php endforeach; ?>
       </tbody>
     </table>
   </body>
 </html>
