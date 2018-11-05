<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: rizal
 * Date: 9/27/2018
 * Time: 2:16 PM
 */
?>

  <div class="content-wrapper">
    <?php if ($this->session->flashdata('message')):?>
        <div class="row">
            <div class="col-md-4 pull-right" style="float: none; margin: 0 auto;">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h4>
                        <i class="icon fa fa-info"></i>
                        Success!
                    </h4>
                    <?= $this->session->flashdata('message')?>
                </div>
            </div>
        </div>
    <?php endif;?>
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Range Laporan Absensi Karyawan</h3>
      </div>
      <form class="form-horizontal" method="post" action="<?=base_url();?>Dashboard/Laporan/<?=$url?>">
        <div class="box-body">
          <div class="col col-md-6">
            <table class="table">
              <tr>
                <td>Bagian</td>
                <td>:</td>
                <td class="form-group">
	                <select name="id_bagian" class="form-control">
	                	<?php foreach ($bagian as $row): ?>
	                		<option value="<?=$row['id_bagian']?>"><?=$row['bagian'];?></option>
	                	<?php endforeach ?>
	               	</select>
                </td>
              </tr>
              <tr>
                <td>Range Tanggal</td>
                <td>:</td>
                <td><input name="tanggal" type="text" class="form-control pull-right" id="reservation"></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td><input type="submit" class="btn btn-info" value="Select"></td>
              </tr>
            </table>
          </div>
        </div>
        <?php echo  form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash());  ?>
      </form>
    </div>
  </div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script>
  $(document).ready(function() {
        console.log("reservation");
        $('#reservation').daterangepicker({format:'dd/mm/yyyy'});
      });
  </script>