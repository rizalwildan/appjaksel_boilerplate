<aside class="main-sidebar">
  <?php if($this->session->userdata('group_id') == 0 ) { ?>
    <section class="sidebar">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">0</li>
            <li>
                <a href="<?= base_url('Dashboard/Home/index')?>"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="treeview <?= ($this->uri->segment(2) !== 'Home') ? 'active' : ''?>">
                <a href="#"><i class="fa fa-microchip"></i> <span>Admin</span></a>
                <ul class="treeview-menu">
                    <li class="<?= ($this->uri->segment(2) == 'Laporan') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Laporan/index')?>"><i class="fa fa-circle-o"></i> Laporan Absensi</a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?= ($this->uri->segment(2) !== 'Home') ? 'active' : ''?>">
                <a href="#"><i class="fa fa-microchip"></i> <span>Master Data</span></a>
                <ul class="treeview-menu">
                    <li class="<?= ($this->uri->segment(2) == 'Laporan') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Laporan/index')?>"><i class="fa fa-circle-o"></i> Laporan Absensi</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Bagian') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Bagian/index')?>"><i class="fa fa-circle-o"></i> Bagian</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'RuleHari') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/RuleHari/index')?>"><i class="fa fa-circle-o"></i> Rule Hari</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Fingerprint') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Fingerprint/index')?>"><i class="fa fa-circle-o"></i> Mesin Finger Print</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'User') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/User/index')?>"><i class="fa fa-circle-o"></i> Users</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Group') ? 'active' : ''?>">
                        <!-- <a href="<?= base_url('Dashboard/Group/index')?>"><i class="fa fa-circle-o"></i> Groups</a> -->
                    </li>
                </ul>
            </li>
        </ul>
    </section>
  <?php }elseif($this->session->userdata('group_id') == 1 ) { ?>
    <section class="sidebar">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">1</li>
            <li>
                <a href="<?= base_url('Dashboard/Home/index')?>"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="treeview <?= ($this->uri->segment(2) !== 'Home') ? 'active' : ''?>">
                <a href="#"><i class="fa fa-microchip"></i> <span>Master Data</span></a>
                <ul class="treeview-menu">
                    <li class="<?= ($this->uri->segment(2) == 'Laporan') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Laporan/index')?>"><i class="fa fa-circle-o"></i> Laporan Absensi</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Bagian') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Bagian/index')?>"><i class="fa fa-circle-o"></i> Bagian</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'RuleHari') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/RuleHari/index')?>"><i class="fa fa-circle-o"></i> Rule Hari</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Fingerprint') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Fingerprint/index')?>"><i class="fa fa-circle-o"></i> Mesin Finger Print</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'User') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/User/index')?>"><i class="fa fa-circle-o"></i> Users</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Group') ? 'active' : ''?>">
                        <!-- <a href="<?= base_url('Dashboard/Group/index')?>"><i class="fa fa-circle-o"></i> Groups</a> -->
                    </li>
                </ul>
            </li>
        </ul>
    </section>
  <?php }elseif($this->session->userdata('group_id') == 2 ) { ?>
    <section class="sidebar">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">1</li>
            <li>
                <a href="<?= base_url('Dashboard/Home/index')?>"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="treeview <?= ($this->uri->segment(2) !== 'Home') ? 'active' : ''?>">
                <a href="#"><i class="fa fa-microchip"></i> <span>Master Data</span></a>
                <ul class="treeview-menu">
                    <li class="<?= ($this->uri->segment(2) == 'Laporan') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Laporan/index')?>"><i class="fa fa-circle-o"></i> Laporan Absensi</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Bagian') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Bagian/index')?>"><i class="fa fa-circle-o"></i> Bagian</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'RuleHari') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/RuleHari/index')?>"><i class="fa fa-circle-o"></i> Rule Hari</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Fingerprint') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Fingerprint/index')?>"><i class="fa fa-circle-o"></i> Mesin Finger Print</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'User') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/User/index')?>"><i class="fa fa-circle-o"></i> Users</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Group') ? 'active' : ''?>">
                        <!-- <a href="<?= base_url('Dashboard/Group/index')?>"><i class="fa fa-circle-o"></i> Groups</a> -->
                    </li>
                </ul>
            </li>
        </ul>
    </section>
  <?php }elseif($this->session->userdata('group_id') == 3 ) { ?>
    <section class="sidebar">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">1</li>
            <li>
                <a href="<?= base_url('Dashboard/Home/index')?>"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="treeview <?= ($this->uri->segment(2) !== 'Home') ? 'active' : ''?>">
                <a href="#"><i class="fa fa-microchip"></i> <span>Master Data</span></a>
                <ul class="treeview-menu">
                    <li class="<?= ($this->uri->segment(2) == 'Laporan') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Laporan/index')?>"><i class="fa fa-circle-o"></i> Laporan Absensi</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Bagian') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Bagian/index')?>"><i class="fa fa-circle-o"></i> Bagian</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'RuleHari') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/RuleHari/index')?>"><i class="fa fa-circle-o"></i> Rule Hari</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Fingerprint') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Fingerprint/index')?>"><i class="fa fa-circle-o"></i> Mesin Finger Print</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'User') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/User/index')?>"><i class="fa fa-circle-o"></i> Users</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Group') ? 'active' : ''?>">
                        <!-- <a href="<?= base_url('Dashboard/Group/index')?>"><i class="fa fa-circle-o"></i> Groups</a> -->
                    </li>
                </ul>
            </li>
        </ul>
    </section>
  <?php }elseif($this->session->userdata('group_id') == 4 ) { ?>
    <section class="sidebar">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">1</li>
            <li>
                <a href="<?= base_url('Dashboard/Home/index')?>"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="treeview <?= ($this->uri->segment(2) !== 'Home') ? 'active' : ''?>">
                <a href="#"><i class="fa fa-microchip"></i> <span>Master Data</span></a>
                <ul class="treeview-menu">
                    <li class="<?= ($this->uri->segment(2) == 'Laporan') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Laporan/index')?>"><i class="fa fa-circle-o"></i> Laporan Absensi</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Bagian') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Bagian/index')?>"><i class="fa fa-circle-o"></i> Bagian</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'RuleHari') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/RuleHari/index')?>"><i class="fa fa-circle-o"></i> Rule Hari</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Fingerprint') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Fingerprint/index')?>"><i class="fa fa-circle-o"></i> Mesin Finger Print</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'User') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/User/index')?>"><i class="fa fa-circle-o"></i> Users</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Group') ? 'active' : ''?>">
                        <!-- <a href="<?= base_url('Dashboard/Group/index')?>"><i class="fa fa-circle-o"></i> Groups</a> -->
                    </li>
                </ul>
            </li>
        </ul>
    </section>
  <?php } ?> 
</aside>