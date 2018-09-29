<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: rizal
 * Date: 9/29/2018
 * Time: 2:35 PM
 */
?>

<div class="content-wrapper">
    <section class="content">
        <?php if ($this->session->flashdata('message')):?>
            <div class="row">
                <div class="col-md-4" style="float: none; margin: 0 auto;">
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
                        <h3 class="box-title">Edit Rule Hari</h3>
                    </div>
                    <form action="<?= base_url(uri_string())?>" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">Nama Hari</label>
                                <input type="text" name="nama_hari" disabled class="form-control" value="<?=$hari['nama_hari']?>">
                            </div>
                            <div class="form-group">
                                <label for="">Jam Masuk</label>
                                <div class="text-danger">
                                    <?php echo form_error('jam_masuk')?>
                                </div>
                                <input type="time" name="jam_masuk" class="form-control" value="<?=$hari['jam_masuk']?>">
                            </div>
                            <div class="form-group">
                                <label for="">Jam Pulang</label>
                                <div class="text-danger">
                                    <?php echo form_error('jam_pulang')?>
                                </div>
                                <input type="time" name="jam_pulang" class="form-control" value="<?=$hari['jam_pulang']?>">
                            </div>
                            <?php echo  form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash());  ?>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-flat">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
