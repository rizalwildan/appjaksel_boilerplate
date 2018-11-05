<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content-wrapper">
    <section class="content">
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
        <div class="row">
            <div class="col-md-8" style="float: none; margin: 0 auto;">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">From Pengajuan Izin Absen</h3>
                    </div>
                    <form action="<?= base_url(uri_string())?>" method="post">
                        <div class="box-body">
                        <input name="id_user" value="<?=$this->session->userdata('user_id');?>" hidden>
                            <div class="form-group">
                                <label for="">Tanggal Pengajuan</label>
                                <div class="text-danger">
                                    <?php echo form_error('nama_fingerprint')?>
                                </div>
                                <input name="tanggal" type="text" class="form-control pull-right" id="datepicker">
                            </div>
                            <div class="form-group">
                                <label for="">Alasan</label>
                                <div class="text-danger">
                                    <?php echo form_error('alasan')?>
                                </div>
                                <select name="alasan" class="form-control">
                                  <?php foreach ($alasan as $row) {?>
                                  <option value="<?=$row['nama_absen'];?>"><?=$row['nama_absen'];?></option>
                                  <?php } ?>
                                </select>
                            </div>
                        </div>
                        <?php echo  form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash());  ?>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-flat">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
    <script>
    $(document).ready(function() {
        console.log('hahahahahahahahahhahahsssuuuu');
        $('#datepicker').datepicker({
          startDate: new Date()
        });
    });
    </script>

