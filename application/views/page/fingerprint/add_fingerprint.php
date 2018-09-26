<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-8" style="float: none; margin: 0 auto;">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah Mesin Fingerprint</h3>
                    </div>
                    <form action="<?= base_url(uri_string())?>" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">Nama Mesin</label>
                                <div class="text-danger">
                                    <?php echo form_error('nama_fingerprint')?>
                                </div>
                                <input type="text" name="nama_fingerprint" placeholder="Nama Fingeprint" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">IP Address</label>
                                <div class="text-danger">
                                    <?php echo form_error('ip_address')?>
                                </div>
                                <input type="text" name="ip_address" id="ip" placeholder="xxx.xxx.xxx.xxx" class="form-control" required pattern="^([0-9]{1,3}\.){3}[0-9]{1,3}$">
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

