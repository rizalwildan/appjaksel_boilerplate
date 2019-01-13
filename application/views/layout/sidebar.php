<aside class="main-sidebar">
  <?php if($this->session->userdata('group_id') == 1 ) { ?>
    <section class="sidebar">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">Super Admin</li>
            <li>
                <a href="<?= base_url('Dashboard/Home/index')?>"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="treeview <?= ($this->uri->segment(2) == 'Laporan') ? 'active' : ''?>">
                <a href="#"><i class="fa fa-microchip"></i> <span>Laporan</span></a>
                <ul class="treeview-menu">
                    <li class="<?= ($this->uri->segment(3) == 'index' && $this->uri->segment(2) == 'Laporan') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Laporan/index')?>"><i class="fa fa-circle-o"></i> Laporan Semua Karyawan</a>
                    </li>
                    <li class="<?= ($this->uri->segment(3) == 'perBagian') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Laporan/perBagian')?>"><i class="fa fa-circle-o"></i> Laporan Per Bagian</a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?= ($this->uri->segment(2) == 'Request_absen') ? 'active' : ''?>">
                <a href="#"><i class="fa fa-microchip"></i> <span>Request Absen</span></a>
                <ul class="treeview-menu">
                    <li class="<?= ($this->uri->segment(2) == 'Request_absen' && $this->uri->segment(3) == 'index') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Request_absen/index')?>"><i class="fa fa-circle-o"></i> List</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Request_absen' && $this->uri->segment(3) == 'add') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Request_absen/add')?>"><i class="fa fa-circle-o"></i> Add</a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?= ($this->uri->segment(2) == 'Request_jam') ? 'active' : ''?>">
                <a href="#"><i class="fa fa-microchip"></i> <span>Request Jam</span></a>
                <ul class="treeview-menu">
                    <li class="<?= ($this->uri->segment(2) == 'Request_jam' && $this->uri->segment(3) == 'index') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Request_jam/index')?>"><i class="fa fa-circle-o"></i> List</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Request_jam' && $this->uri->segment(3) == 'add') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Request_jam/add')?>"><i class="fa fa-circle-o"></i> Add</a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?= (false) ? 'active' : ''?>">
                <a href="#"><i class="fa fa-microchip"></i> <span>Master Data</span></a>
                <ul class="treeview-menu">
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
            <li class="header">Admin</li>
            <li>
                <a href="<?= base_url('Dashboard/Home/index')?>"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="treeview <?= ($this->uri->segment(2) == 'Laporan') ? 'active' : ''?>">
                <a href="#"><i class="fa fa-microchip"></i> <span>Laporan</span></a>
                <ul class="treeview-menu">
                    <li class="<?= ($this->uri->segment(3) == 'index' && $this->uri->segment(2) == 'Laporan') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Laporan/index')?>"><i class="fa fa-circle-o"></i> Laporan Semua Karyawan</a>
                    </li>
                    <li class="<?= ($this->uri->segment(3) == 'perBagian') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Laporan/perBagian')?>"><i class="fa fa-circle-o"></i> Laporan Per Bagian</a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?= ($this->uri->segment(2) == 'Request_absen') ? 'active' : ''?>">
                <a href="#"><i class="fa fa-microchip"></i> <span>Request Absen</span></a>
                <ul class="treeview-menu">
                    <li class="<?= ($this->uri->segment(2) == 'Request_absen' && $this->uri->segment(3) == 'index') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Request_absen/index')?>"><i class="fa fa-circle-o"></i> List</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Request_absen' && $this->uri->segment(3) == 'add') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Request_absen/add')?>"><i class="fa fa-circle-o"></i> Add</a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?= ($this->uri->segment(2) == 'Request_jam') ? 'active' : ''?>">
                <a href="#"><i class="fa fa-microchip"></i> <span>Request Jam</span></a>
                <ul class="treeview-menu">
                    <li class="<?= ($this->uri->segment(2) == 'Request_jam' && $this->uri->segment(3) == 'index') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Request_jam/index')?>"><i class="fa fa-circle-o"></i> List</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Request_jam' && $this->uri->segment(3) == 'add') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Request_jam/add')?>"><i class="fa fa-circle-o"></i> Add</a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?= (false) ? 'active' : ''?>">
                <a href="#"><i class="fa fa-microchip"></i> <span>Master Data</span></a>
                <ul class="treeview-menu">
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
  <?php }elseif($this->session->userdata('group_id') == 3) { ?>
    <section class="sidebar">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">Kepala Kantor</li>
            <li>
                <a href="<?= base_url('Dashboard/Home/index')?>"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="<?= ($this->uri->segment(2) == 'Laporan') ? 'active' : ''?>">
              <a href="<?= base_url('Dashboard/Laporan/index')?>"><i class="fa fa-circle-o"></i> Laporan Semua Karyawan</a>
            </li>
        </ul>
    </section>
  <?php }elseif($this->session->userdata('group_id') == 4 ) { ?>
    <section class="sidebar">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">Kepala Bagian</li>
            <li>
                <a href="<?= base_url('Dashboard/Home/index')?>"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="<?= ($this->uri->segment(2) == 'Laporan') ? 'active' : ''?>">
              <a href="<?= base_url('Dashboard/Laporan/index')?>"><i class="fa fa-circle-o"></i> Laporan Bagian</a>
            </li>
            
        </ul>
    </section>
  <?php }elseif($this->session->userdata('group_id') == 5 ) { ?>
    <section class="sidebar">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">Pegawai</li>
            <li>
                <a href="<?= base_url('Dashboard/Home/index')?>"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="<?= ($this->uri->segment(3) == 'index' && $this->uri->segment(2) == 'Laporan') ? 'active' : ''?>">
                <a href="<?= base_url('Dashboard/Laporan/index')?>"><i class="fa fa-circle-o"></i>Laporan</a>
            </li>
            <!-- <li class="treeview <?= ($this->uri->segment(2) == 'Laporan') ? 'active' : ''?>">
                <a href="#"><i class="fa fa-microchip"></i> <span>Laporan</span></a>
                <ul class="treeview-menu">
                    <li class="<?= ($this->uri->segment(3) == 'index' && $this->uri->segment(2) == 'Laporan') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Laporan/index')?>"><i class="fa fa-circle-o"></i> Laporan Semua Karyawan</a>
                    </li>
                    <li class="<?= ($this->uri->segment(3) == 'perBagian') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Laporan/perBagian')?>"><i class="fa fa-circle-o"></i> Laporan Per Bagian</a>
                    </li>
                </ul>
            </li> -->
            <li>
                <a href="<?= base_url('Dashboard/Request_absen/add')?>"><i class="fa fa-dashboard"></i>Add Request Absen</a>
            </li>
            <li>
                <a href="<?= base_url('Dashboard/Request_jam/add')?>"><i class="fa fa-dashboard"></i>Add Request Jam Kerja</a>
            </li>
        </ul>
    </section>
  <?php } ?> 
</aside>