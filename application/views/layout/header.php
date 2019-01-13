<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<header class="main-header">
    <a href="#" class="logo">
            <span class="logo-lg">
                <b>Admin</b>
                "LTE"
            </span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle Navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?=base_url();?>assets/img/icon.png" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?= $this->session->userdata('username')?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="<?=base_url();?>assets/img/icon.png" class="img-circle" alt="">
                            <p><?= $this->session->userdata('username').' - '.$this->session->userdata('group_name')?></p>
                        </li>
                        <li class="user-footer">
                            <!-- <div class="pull-left">
                                <a href="<?= base_url('Dashboard/User/edit/'.$this->session->userdata('user_id'))?>" class="btn btn-default btn-flat">Profile</a>
                            </div> -->
                            <div class="pull-right">
                                <a href="<?= base_url('Auth/logout')?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>