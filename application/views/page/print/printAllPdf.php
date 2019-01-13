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
          <table id="example" class="table table-bordered">
            <thead>
            <tr>
                <th>ID User</th>
                <th>Nama</th>
                <th>Telat</th>
                <th>Pulang Awal</th>
                <th>Lembur</th>
                <th>Ganti</th>
                <th>Potong</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($pdf as $row):
              $id_user = $row['user']['id'];
              ?>
            <tr>
                <td><?=$row['user']['id'];?></td>
                <td><?php print_r($row['user']['first_name']);?></td>
                <td><?php print_r($row['absen']['telat']);?></td>
                <td><?php print_r($row['absen']['pulang_awal']);?></td>
                <td><?php print_r($row['absen']['lembur']);?></td>
                <td><?php print_r($row['absen']['ganti']);?></td>
                <td><?php print_r($row['absen']['potong']);?></td>
            </tr>
            <?php endforeach;?>
            </tbody>
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