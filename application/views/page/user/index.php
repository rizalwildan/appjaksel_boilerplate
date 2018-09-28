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
                        <a href="<?= base_url('Dashboard/User/create_user')?>" class="btn btn-primary btn-sm btn-flat pull-right">Create Users</a>
                    </div>
                    <div class="box-body">
                        <div class="dataTables_wrapper form-inline dt-bootstrap">

                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Full Name</th>
                                            <th>Phone</th>
                                            <th>Group</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($users as $val):
                                        ?>
                                        <tr>
                                            <td><?= $i++?></td>
                                            <td><?= $val->username?></td>
                                            <td><?= $val->email?></td>
                                            <td><?= $val->first_name.' '.$val->last_name?></td>
                                            <td><?= $val->phone?></td>
                                            <td>
                                                <?php foreach($val->groups as $row):?>
                                                <?= $row->name.','?>
                                                <?php endforeach;?>
                                            </td>
                                            <td>
                                                <?php if ($val->active == 1):?>
                                                <span class="label label-success">Active</span>
                                                <?php else:?>
                                                <span class="label label-danger">Deactivate</span>
                                                <?php endif;?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('Dashboard/User/edit/'.$val->user_id)?>" class="btn btn-primary btn-sm btn-flat">Edit</a>

                                                <?php if ($val->active == 1): ?>
                                                    <button type="button" id="deactive" class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-id="<?= $val->user_id?>" data-url="<?= base_url('Dashboard/User/deactive/')?>" data-target="#exampleModal">
                                                        Deactive
                                                    </button>
                                                <?php else: ?>
                                                    <button type="button" id="active" class="btn btn-success btn-sm btn-flat" data-toggle="modal" data-id="<?= $val->user_id?>" data-url="<?= base_url('Dashboard/User/activate/')?>" data-target="#activateModal">
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
                        <h5 class="modal-title" id="exampleModalLabel">Deactive This User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" id="form-deactive">
                    <div class="modal-body">
                        Are you sure for <b>Deactive</b> this user ?
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