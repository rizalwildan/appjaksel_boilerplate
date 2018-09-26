<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
                        <h3 class="box-title">Edit Mesin Fingerprint</h3>
                    </div>
                    <form action="<?= base_url(uri_string())?>" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">Nama Mesin</label>
                                <div class="text-danger">
                                    <?php echo form_error('nama_fingerprint')?>
                                </div>
                                <input type="text" name="nama_fingerprint" class="form-control" value="<?=$fingerprint['nama_fingerprint']?>">
                            </div>

                            <div class="form-group">
                                <label for="">IP Address</label>
                                <div class="text-danger">
                                    <?php echo form_error('ip_address')?>
                                </div>
                                <input type="text" name="ip_address" class="form-control" value="<?=$fingerprint['ip_address']?>" required pattern="^([0-9]{1,3}\.){3}[0-9]{1,3}$">
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
