<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: rizal
 * Date: 9/26/2018
 * Time: 3:39 PM
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
                        <h3 class="box-title">Data Groups</h3>
                        <button class="btn btn-primary btn-sm btn-flat pull-right" data-toggle="modal" data-target="#addModal">Add Group</button>
                    </div>
                    <div class="box-body">
                        <div class="datatTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="group" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($groups as $group):?>
                                        <tr>
                                            <td><?= $i++?></td>
                                            <td><?= $group->name?></td>
                                            <td><?= $group->description ?></td>
                                            <td>
                                                <button id="btnEdit" type="button" class="btn btn-primary btn-sm btn-flat" data-toggle="modal"
                                                        data-name="<?= $group->name?>" data-description="<?= $group->description?>"
                                                        data-id="<?= $group->id?>" data-target="#editModal">
                                                    Edit
                                                </button>
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

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit this group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form-activate">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Group Name</label>
                        <input type="text" class="form-control" id="groupName" name="group_name">
                    </div>
                    <div class="form-group">
                        <label for="">Group Description</label>
                        <input type="text" class="form-control" id="groupDesc" name="group_description">
                    </div>
                    <?php echo  form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash());  ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Dashboard/Group/add')?>" method="post" id="form-activate">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Group Name</label>
                        <input type="text" class="form-control" id="groupName" name="group_name" required>
                    </div>
                    <div class="form-group">
                        <label for="">Group Description</label>
                        <input type="text" class="form-control" id="groupDesc" name="description" required>
                    </div>
                    <?php echo  form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash());  ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#example').DataTable();

        $('.alert-dismissible').fadeTo(1000, 500).slideUp(500, function () {
            $('.alert-dismissible').alert('close');
        })
    });

    $(document).on('click', '#btnEdit', function () {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var description = $(this).data('description');

        $('#form-activate').attr('action', '<?= base_url('Dashboard/Group/edit/')?>' + id);
        $('#groupName').val(name);
        $('#groupDesc').val(description);
    })

</script>
