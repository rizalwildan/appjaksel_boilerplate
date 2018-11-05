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
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Laporan Absensi</h3>
                        <a href="<?= base_url()?>" class="btn btn-primary btn-sm btn-flat pull-right">Excel</a> 
                        <a href="<?= base_url()?>" class="btn btn-primary btn-sm btn-flat pull-right">PDF</a>
                    </div>
                    <div class="box-body">
                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>No</th>
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
                                        $i = 1;
                                        foreach ($laporan as $row):
                                          $id_user = $row['user']['id'];
                                          ?>
                                        <tr>
                                            <td><?=$i++?></td>
                                            <td><a href="<?= base_url().'Dashboard/Laporan/getLaporanUser/'.$id_user?>"> <?php print_r($row['user']['first_name']);?></a></td>
                                            <td><?php print_r($row['absen']['telat']);?></td>
                                            <td><?php print_r($row['absen']['pulang_awal']);?></td>
                                            <td><?php //print_r($row['absen']['lembur']);?></td>
                                            <td><?php print_r($row['absen']['ganti']);?></td>
                                            <td><?php print_r($row['absen']['potong']);?></td>
                                        </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Menonaktifkan Bagian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form-deactive">
                <div class="modal-body">
                    Are you sure for <b>Deactive</b> this ?
                    <?php echo  form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash());  ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="activateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aktifkan Bagian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form-activate">
                <div class="modal-body">
                    Are you sure for <b>Activate</b> this ?
                    <?php echo  form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash());  ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
