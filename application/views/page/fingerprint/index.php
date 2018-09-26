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
                        <h3 class="box-title">Data Users</h3>
                        <a href="<?= base_url('Dashboard/Fingerprint/add_fingerprint')?>" class="btn btn-primary btn-sm btn-flat pull-right">Tambah Mesin FIngerprint</a>
                    </div>
                    <div class="box-body">
                        <div class="dataTables_wrapper form-inline dt-bootstrap">

                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Mesin</th>
                                            <th>Ip Address</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($fingerprint as $val):
                                        ?>
                                        <tr>
                                            <td><?= $i++?></td>
                                            <td><?= $val['nama_fingerprint'] ?></td>
                                            <td><?= $val['ip_address'] ?></td>
                                            <td>
                                                <?php if ($val['status'] == 1):?>
                                                <span class="label label-success">Active</span>
                                                <?php else:?>
                                                <span class="label label-danger">Deactive</span>
                                                <?php endif;?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('Dashboard/Fingerprint/edit_fingerprint/'.$val['id_fingerprint'])?>" class="btn btn-primary btn-sm btn-flat">Edit</a>
                                                <?php if ($val['status'] == 1): ?>
                                                <button type="button" class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-id="<?= $val['id_fingerprint']?>" data-target="#exampleModal">
                                                    Deactive
                                                </button>
                                                <?php else: ?>
                                                <button type="button" class="btn btn-success btn-sm btn-flat" data-toggle="modal" data-id="<?= $val['id_fingerprint']?>" data-target="#activateModal">
                                                    Activate
                                                </button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Menonaktifkan Mesin Fingeprint</h5>
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
                        <h5 class="modal-title" id="exampleModalLabel">Aktifkan Mesin Fingerprint</h5>
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

    </section>
</div>

<script>
    $(document).ready(function() {
        $('#example').DataTable();

        $('.alert-dismissible').fadeTo(1000, 500).slideUp(500, function () {
            $('.alert-dismissible').alert('close');
        })
    })

    $(document).on('click', '.btn-danger', function () {
        var id = $(this).data('id');
        $('#form-deactive').attr('action', '<?= base_url('Dashboard/Fingerprint/deactive/')?>' + id);
    })

    $(document).on('click', '.btn-success', function () {
        var id = $(this).data('id');
        $('#form-activate').attr('action', '<?= base_url('Dashboard/Fingerprint/activate/')?>' + id);
    })
</script>