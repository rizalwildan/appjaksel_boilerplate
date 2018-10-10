<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: rizal
 * Date: 9/25/2018
 * Time: 1:54 PM
 */

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->lang->load('auth');
        $this->load->helper('language');
        $this->load->model('Laporan_model', 'Laporan');
        $this->hari = $this->lib_hari->cek();
        $this->_init();
    }

    private function _init() {
        $this->output->set_template('default');
        $this->load->section('header', 'layout/header');
        $this->load->section('sidebar', 'layout/sidebar');

        //Load All css assets
        $this->load->css('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');
        $this->load->css('assets/bower_components/font-awesome/css/font-awesome.min.css');
        $this->load->css('assets/bower_components/Ionicons/css/ionicons.min.css');
        $this->load->css('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css');
        //Data table
        $this->load->css('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->load->css('assets/dist/css/AdminLTE.min.css');
        $this->load->css('assets/dist/css/skins/_all-skins.min.css');

        //Load All Js assets
        $this->load->js('assets/bower_components/moment/moment.js');
        $this->load->js('assets/bower_components/jquery/dist/jquery.min.js');
        $this->load->js('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js');
        $this->load->js('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');
        //Data table
        $this->load->js('assets/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->load->js('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->js('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');
        $this->load->js('assets/bower_components/fastclick/lib/fastclick.js');
        $this->load->js('assets/dist/js/adminlte.min.js');
        $this->load->js('assets/plugins.js');
    }

    public function index() {
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) {
            // return show_error('You must be an administrator to view this page.');
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['url'] = "getLaporanAll";
            $this->load->view('page/laporan/index', $this->data);
        } else {
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['url'] = "getLaporanAll";
            $this->load->view('page/laporan/index', $this->data);
        }
    }

    public function getLaporanAll(){
    	if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
    	$tanggal = explode(" - ", $this->input->post('tanggal'));
	    $tanggal_awal = date("Y-m-d", strtotime($tanggal[0]));
	    $tanggal_akhir = date("Y-m-d", strtotime($tanggal[1]));
        //list the users
        $users = $this->db->get("users")->result_array();
        for ($i=0; $i <count($users) ; $i++) { 
        	$laporanArray[$i]['user'] = $users[$i];
        	$laporanArray[$i]['absen'] = array(
        		"telat" => 0,
        		"ganti" => 0,
        		"pulang_awal" => 0,
        		"potong" => 0
        		);
        	$id_user = $users[$i]['id'];
        	$absensi = $this->Laporan->find()->where("tanggal >= '$tanggal_awal' and tanggal <= '$tanggal_akhir' and id_user = '$id_user'")->get()->result_array();

        	foreach ($absensi as $absen) {
        		if($absen['telat'] != null){
        			$laporanArray[$i]['absen']['telat']++;
        			if($absen['telat'] > "00:00:00" && $absen['telat'] <= "00:30:00"){

        				/* versi sebelumnya */
        				if($absen['lembur'] >= $absen['telat'] && $laporanArray[$i]['absen']['ganti'] < 8){
        					$laporanArray[$i]['absen']['ganti']++;
        				}else{
        					$laporanArray[$i]['absen']['potong'] = $laporanArray[$i]['absen']['potong'] + 0.5;
        				}

        				
        				/* versi baru */
        				// if($absen['lembur'] >= $absen['telat']){
        				// 	if($laporanArray[$i]['absen']['ganti'] < 8){
        				// 		$laporanArray[$i]['absen']['ganti']++;
        				// 	}else{
        				// 		$laporanArray[$i]['absen']['potong'] = $laporanArray[$i]['absen']['potong'] + 0.5;
        				// 	}
        				// }else{
        				// 	$laporanArray[$i]['absen']['potong'] = $laporanArray[$i]['absen']['potong'] + 0.5;
        				// }

        			}elseif($absen['telat'] > "00:30:00" && $absen['telat'] <= "01:00:00"){
        				$laporanArray[$i]['absen']['potong'] = $laporanArray[$i]['absen']['potong'] + 1;
        			}elseif ($absen['telat'] > "01:00:00" && $absen['telat'] <= "01:30:00") {
        				$laporanArray[$i]['absen']['potong'] = $laporanArray[$i]['absen']['potong'] + 1.25;
        			}elseif ($absen['telat'] > "01:30:00") {
        				$laporanArray[$i]['absen']['potong'] = $laporanArray[$i]['absen']['potong'] + 1.5;
        			}else{
        				echo $absen['telat'];
        			}
        		}

        		if($absen['pulang_awal'] != null){
        			$laporanArray[$i]['absen']['pulang_awal']++;
        			if($absen['pulang_awal'] > "00:00:00" && $absen['pulang_awal'] < "00:30:00"){
        				$laporanArray[$i]['absen']['potong'] = $laporanArray[$i]['absen']['potong'] + 0.5;
        			}elseif($absen['pulang_awal'] > "00:30:00" && $absen['pulang_awal'] < "01:00:00"){
        				$laporanArray[$i]['absen']['potong'] = $laporanArray[$i]['absen']['potong'] + 1;
        			}elseif ($absen['pulang_awal'] > "01:00:00" && $absen['pulang_awal'] < "01:30:00") {
        				$laporanArray[$i]['absen']['potong'] = $laporanArray[$i]['absen']['potong'] + 1.25;
        			}elseif ($absen['pulang_awal'] > "01:30:00") {
        				$laporanArray[$i]['absen']['potong'] = $laporanArray[$i]['absen']['potong'] + 1.5;
        			}else{
        				echo $absen['pulang_awal'];
        			}	
        		}
        	}
        }
        $this->data['laporan'] = $laporanArray;
        $this->load->view('page/laporan/tampil_laporan',$this->data);
    }



    public function get(){
    	$users = $this->db->get("user")->result_array();

        for ($i=0; $i <count($users) ; $i++) { 
        	$laporanArray[$i]['user'] = $users[$i];
        	$laporanArray[$i] = array(
        		"telat" => 0,
        		"ganti" => 0,
        		"pulang_awal" => 0,
        		"potong" => 0
        		);
        	$id_user = $users[$i]['pin_mesin'];
        	$absensi = $this->Laporan->find()->where("id_user" ,'$id_user')->get()->result_array();
        	foreach ($absensi as $absen) {
        		if($absen['telat'] != null){
        			$laporanArray[$i]['telat']++;
        			if($absen['telat'] > "00:00:00" && $absen['telat'] <= "00:30:00"){
        				if($absen['lembur'] > $absen['telat'] && $laporanArray[$i]['ganti'] < 8){
        					$laporanArray[$i]['ganti']++;
        				}else{
        					$laporanArray[$i]['potong'] = $laporanArray[$i]['potong'] + 0.5;
        				}
        			}elseif($absen['telat'] > "00:30:00" && $absen['telat'] <= "01:00:00"){
        				$laporanArray[$i]['potong'] = $laporanArray[$i]['potong'] + 1;
        			}elseif ($absen['telat'] > "01:00:00" && $absen['telat'] <= "01:30:00") {
        				$laporanArray[$i]['potong'] = $laporanArray[$i]['potong'] + 1.25;
        			}elseif ($absen['telat'] > "01:30:00") {
        				$laporanArray[$i]['potong'] = $laporanArray[$i]['potong'] +1.5;
        			}else{
        				echo $absen['telat'];
        			}
        		}
        	}
        	print_r($laporanArray[$i]);
        	echo "<br>";
        }
    }
    
}