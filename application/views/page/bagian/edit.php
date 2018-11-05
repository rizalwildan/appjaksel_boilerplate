<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: rizal
 * Date: 9/27/2018
 * Time: 3:51 PM
 */
?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-8" style="float: none; margin: 0 auto;">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Data Bagian</h3>
                    </div>

                    <form action="<?= base_url(uri_string())?>" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">Nama Bagian</label>
                                <div class="text-danger">
                                    <?php echo form_error('bagian')?>
                                </div>
                                <input type="text" name="bagian" class="form-control" value="<?=$bagian['bagian']?>">
                            </div>

                            <div class="form-group">
                                <label for="">Kepala Bagian</label>
                                <div class="text-danger">
                                    <?php echo form_error('kepala_bagian')?>
                                </div>
                                <select name="kepala_bagian" class="form-control" id="selectKepala">
                                    <?php
                                    foreach ($user as $row):
                                    $uId = $row['id'];
                                    $selected = null;
                                    if ($uid == $bagian['id_kepala_bagian']) {
                                        $selected = "selected";
                                        break;
                                    }
                                    ?>
                                        <option value="<?= $row['id']?>" <?= $selected?>><?= $row['first_name'].' '.$row['last_name'] ?></option>
                                    <?php endforeach;?>
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
