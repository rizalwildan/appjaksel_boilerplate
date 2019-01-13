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
        <?php if ($this->session->flashdata('error')):?>
            <div class="row">
                <div class="col-md-4 pull-right" style="float: none; margin: 0 auto;">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4>
                            <i class="icon fa fa-info"></i>
                            Error
                        </h4>
                        <?= $this->session->flashdata('error')?>
                    </div>
                </div>
            </div>
        <?php endif;?>
        <div class="row">
            <div class="col-md-8" style="float: none; margin: 0 auto;">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">From Tambah Setting Hari</h3>
                    </div>
                    <form action="<?= base_url(uri_string())?>" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <div class="text-danger">
                                    <?php echo form_error('tanggal')?>
                                </div>
                                <input name="tanggal" type="date" class="form-control pull-right" id="datepicker">
                            </div>
                            <div class="form-group">
                                <label for="">Jam Masuk</label>
                                <div class="text-danger">
                                    <?php echo form_error('jam_masuk')?>
                                </div>
                                <input name="jam_masuk" type="time" class="form-control pull-right timepicker">
                            </div>
                            <div class="form-group">
                                <label for="">Jam Pulang</label>
                                <div class="text-danger">
                                    <?php echo form_error('jam_pulang')?>
                                </div>
                                <input name="jam_pulang" type="time" class="form-control pull-right timepicker">
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
        $('#datepicker').datepicker({
          // startDate: new Date(),
          format: 'dd/mm/yy',
          autoclose : true
        });
        $('.timepicker').timepicker({
          timeFormat : 'HH:mm:ss',
          minuteStep : 1,
          defaultTime : false,
          showMeridian : false,
        });
    });
    </script>

