<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper" style="min-height: 714px">
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
                        <h3 class="box-title">Data Request Absen</h3>
                    </div>
                    <div class="box-body">
                        <div class="dataTables_wrapper form-inline dt-bootstrap">

                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Alasan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($request_absen as $absen):
                                        ?>
                                        <tr>
                                            <td><?= $i++?></td>
                                            <td><?= $absen['first_name'].$absen['last_name'] ;?></td>
                                            <td><?= $absen['tanggal'] ;?></td>
                                            <td><?= $absen['keterangan'] ;?></td>
                                            <td>
                                                <?php if ($absen['status'] == 1):?>
                                                <span class="label label-success">Disetujui</span>
                                                <?php else:?>
                                                <span class="label label-danger">Belum Disetujui</span>
                                                <?php endif;?>
                                            </td>
                                            <td>
                                                <!-- <a href="<?= base_url('Dashboard/User/edit/'.$val->user_id)?>" class="btn btn-primary btn-sm btn-flat">Edit</a> -->

                                                <?php if ($absen['status'] == 0): ?>
                                                    <!-- <button type="button" id="deactive" class="btn btn-info btn-sm btn-flat" data-toggle="modal" data-id="<?= $absen['id_request']?>" data-url="<?= base_url('Dashboard/Request_absen/approve/')?>" data-target="#exampleModal">
                                                        Approve
                                                    </button> -->
                                                    <a class="btn btn-info btn-sm btn-flat" onclick="return confirm('Anda yakin akan menyutujui ini ? ');" href="<?= base_url('Dashboard/Request_absen/approve/'.$absen['id_request'])?>">Setuju</a>
                                                <?php else: ?>
                                                    <!-- <span class="label label-danger">Not Approved</span> -->
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Approve</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" id="form-deactive">
                    <div class="modal-body">
                        Are you sure for <b>Approve</b> this ?
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
                        <h5 class="modal-title" id="exampleModalLabel">Activate This User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" id="form-activate">
                        <div class="modal-body">
                            Are you sure for <b>Activate</b> this user ?
                            <?php echo  form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash());  ?>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
</div>