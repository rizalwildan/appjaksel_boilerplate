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
                        <h3 class="box-title">Laporan Per User</h3>
                        <div class="pull-right">
                          <?php
                            if($this->session->userdata('group_id') == 5){
                              $kembali = "Dashboard/Laporan/index";
                            }elseif($this->session->userdata('group_id') == 4){
                              $kembali = "Dashboard/Laporan/getLaporanperBagian";
                            }else{
                              $kembali = "Dashboard/Laporan/getLaporanAll";
                            }
                          ?>
                          <a href="<?=base_url().$kembali;?>" class="btn btn-info btn-sm btn-flat">Kembali</a>
                          <a href="#" class="btn btn-primary btn-sm btn-flat pull-right">Excel</a> 
                          <a target="_blank" href="<?= base_url().'Dashboard/Printer/printPerUser'?>" class="btn btn-primary btn-sm btn-flat pull-right">PDF</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-xs-12">
                                	<table class="table table-striped table-bordered" style="width:25%">
                                    	<tr>
                                    		<td>Nama </td>
                                    		<td> : </td>
                                    		<td><?=$users['first_name'];?></td>
                                    	</tr>
                                    	<tr>
                                    		<td>NIP</td>
                                    		<td> : </td>
                                    		<td><?=$users['nip'];?></td>
                                    	</tr>
                                    </table>
                                    <table id="examplem" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jam Masuk</th>
                                            <th>Telat</th>
                                            <th>Jam Pulang</th>
                                            <th>Pulang Awal</th>
                                            <th>Lembur</th>
                                            <th>Keterangan</th>
                                        </tr>
                                        </thead>
                                        <tbody>
										                    <?php foreach ($laporan as $row) { ?>
                                        <tr>
                                            <td><?=date('d M Y', strtotime($row['tanggal']));?></td>
                                            <td><?=$row['jam_masuk'];?></td>
                                            <td><?=$row['telat'];?></td>
                                            <td><?=$row['jam_pulang'];?></td>
                                            <td><?=$row['pulang_awal'];?></td>
                                            <td><?=$row['lembur'];?></td>
                                            <td><?=$row['keterangan'];?></td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    <table class="table table-striped table-bordered" style="width:25%">
                                    	<tr>
                                    		<td>Jumlah Telat</td>
                                    		<td> : </td>
                                    		<td><?=$laporanAll['telat'];?></td>
                                    	</tr>
                                    	<tr>
                                    		<td>Jumlah Ganti</td>
                                    		<td> : </td>
                                    		<td><?=$laporanAll['ganti'];?></td>
                                    	</tr>
                                    	<tr>
                                    		<td>Jumlah Pulang Awal</td>
                                    		<td> : </td>
                                    		<td><?=$laporanAll['pulang_awal'];?></td>
                                    	</tr>
                                    	<tr>
                                    		<td>Jumlah Potong</td>
                                    		<td> : </td>
                                    		<td><?=$laporanAll['potong'];?> % </td>
                                    	</tr>
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