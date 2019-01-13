<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="<?=base_url().'assets/bower_components/bootstrap/dist/css/bootstrap.css'?>">
</head>
<body>
  <center>
    <h3>Absensi Karyawan</h3>
    <p>Tanggal : <?=$this->session->userdata('tanggal');?></p>
  </center>
  <br>
  <br>
  <br>
  <div class="content-wrapper">
    
    <section class="content">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          	<table class="table table-striped table-bordered" style="width:25%">
        	<tr>
        		<td>Nama </td>
        		<td> : </td>
        		<td><?=$users['first_name'];?></td>
        	</tr>
        	<tr>
        		<td>NIP</td>
        		<td> : </td>
        		<td><?=$users['nip'];?></td>
        	</tr>
        </table>
        <table id="examplem" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Telat</th>
                <th>Jam Pulang</th>
                <th>Pulang Awal</th>
                <th>Lembur</th>
                <th>Keterangan</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($laporan as $row) { ?>
            <tr>
                <td><?=date('d M Y', strtotime($row['tanggal']));?></td>
                <td><?=$row['jam_masuk'];?></td>
                <td><?=$row['telat'];?></td>
                <td><?=$row['jam_pulang'];?></td>
                <td><?=$row['pulang_awal'];?></td>
                <td><?=$row['lembur'];?></td>
                <td><?=$row['keterangan'];?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
        <table class="table table-striped table-bordered" style="width:25%">
        	<tr>
        		<td>Jumlah Telat</td>
        		<td> : </td>
        		<td><?=$laporanAll['telat'];?></td>
        	</tr>
        	<tr>
        		<td>Jumlah Ganti</td>
        		<td> : </td>
        		<td><?=$laporanAll['ganti'];?></td>
        	</tr>
        	<tr>
        		<td>Jumlah Pulang Awal</td>
        		<td> : </td>
        		<td><?=$laporanAll['pulang_awal'];?></td>
        	</tr>
        	<tr>
        		<td>Jumlah Potong</td>
        		<td> : </td>
        		<td><?=$laporanAll['potong'];?> % </td>
        	</tr>
        </table>
        </div>
        <div class="col-md-1"></div>
      </div>
    </section>
  </div>
  <script type="text/javascript">
    window.onload = function() {
      window.print();
    };
  </script>
</body>
</html>