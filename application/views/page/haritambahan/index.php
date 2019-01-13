<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: rizal
 * Date: 9/29/2018
 * Time: 2:15 PM
 */
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
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Setting Hari Tambahan</h3>
                        <a href="<?= base_url('Dashboard/RuleHariTambahan/add')?>" class="btn btn-primary btn-sm btn-flat pull-right">Tambah Setting Hari</a>
                    </div>
                    <div class="box-body">
                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Pulang</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($hari as $row):
                                        ?>
                                        <tr>
                                            <td><?= $i++?></td>
                                            <td><?= $row['tanggal']?></td>
                                            <td><?= $row['jam_masuk']?></td>
                                            <td><?= $row['jam_pulang']?></td>
                                            <td><?= $row['keterangan']?></td>
                                            <td><?= $row['status']?></td>
                                            <td>
                                                <a href="<?= base_url('Dashboard/RuleHariTambahan/edit/'.$row['id_hari_tambahan'])?>" class="btn btn-sm btn-primary btn-flat">Edit</a>
                                            </td>
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
