<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-8" style="float: none; margin: 0 auto;">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create User</h3>
                    </div>
                    <form action="<?= base_url(uri_string())?>" method="post">
                        <div class="box-body">
                            <div class="text-danger">
                                <?php echo form_error('username')?>
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" placeholder="username" class="form-control">
                            </div>
                            <!-- <div class="text-danger">
                                <?php echo form_error('email')?>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" placeholder="email" class="form-control">
                            </div> -->
                            <div class="text-danger">
                                <?php echo form_error('first_name')?>
                            </div>
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" placeholder="First Name" name="first_name" class="form-control">
                            </div>
                            <div class="text-danger">
                                <?php echo form_error('last_name')?>
                            </div>
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" placeholder="Last Name" name="last_name" class="form-control">
                            </div>
                            <div class="text-danger">
                                <?php echo form_error('nip')?>
                            </div>
                            <div class="form-group">
                                <label for="">NIP</label>
                                <input type="text" placeholder="NIP" name="nip" class="form-control">
                            </div>
                            <div class="text-danger">
                                <?php echo form_error('jabatan')?>
                            </div>
                            <div class="form-group">
                                <label for="">Jabatan</label>
                                <select name="id_jabatan" class="form-control">
                                <?php foreach ($jabatan as $row) { ?>
                                  <option value="<?=$row['id_jabatan'];?>"><?=$row['jabatan'];?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="text-danger">
                                <?php echo form_error('bagian')?>
                            </div>
                            <div class="form-group">
                                <label for="">Bagian</label>
                                <select name="id_bagian" class="form-control">
                                <?php foreach ($bagian as $row) { ?>
                                  <option value="<?=$row['id_bagian'];?>"><?=$row['bagian'];?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="text-danger">
                                <?php echo form_error('password')?>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" placeholder="Password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Password Confirm</label>
                                <input type="password" placeholder="Confirm Password" name="password_confirm" class="form-control">
                            </div>

                            <div class="text-danger">
                                <?php echo form_error('groups')?>
                            </div>
                            <?php if ($this->ion_auth->is_admin()):?>
                                <h4 class="title">User Group</h4>
                                <select name="groups">
                                  <?php foreach ($groups as $group): ?>
                                    <option value="<?=$group['id'];?>"><?= $group['name'];?></option>
                                  <?php endforeach;?>
                                </select>
                            <?php endif;?>
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
