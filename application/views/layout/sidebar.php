<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">Main Navigation</li>
            <li>
                <a href="<?= base_url('Dashboard/Home/index')?>"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="treeview <?= ($this->uri->segment(2) !== 'Home') ? 'active' : ''?>">
                <a href="#"><i class="fa fa-microchip"></i> <span>Master Data</span></a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Absensi</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Bagian') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Bagian/index')?>"><i class="fa fa-circle-o"></i> Bagian</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Fingerprint') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Fingerprint/index')?>"><i class="fa fa-circle-o"></i> Mesin Finger Print</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'User') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/User/index')?>"><i class="fa fa-circle-o"></i> Users</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == 'Group') ? 'active' : ''?>">
                        <a href="<?= base_url('Dashboard/Group/index')?>"><i class="fa fa-circle-o"></i> Groups</a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>