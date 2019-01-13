<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: rizal
 * Date: 9/27/2018
 * Time: 2:11 PM
 */

class Printer extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('language');
        $this->lang->load('auth');
        $this->load->library('ion_auth');
        $this->_init();
    }

    private function _init() {
        
        //Load All css assets
        $this->load->css('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');
        $this->load->css('assets/bower_components/font-awesome/css/font-awesome.min.css');
        $this->load->css('assets/bower_components/Ionicons/css/ionicons.min.css');
        $this->load->css('assets/bower_components/select2/dist/css/select2.min.css');
        //Data table
        $this->load->css('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->load->css('assets/dist/css/AdminLTE.min.css');
        $this->load->css('assets/dist/css/skins/_all-skins.min.css');

        //Load All Js assets
        $this->load->js('assets/bower_components/jquery/dist/jquery.min.js');
        $this->load->js('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');
        //Data table
        $this->load->js('assets/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->load->js('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->js('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');
        $this->load->js('assets/bower_components/fastclick/lib/fastclick.js');
        $this->load->js('assets/dist/js/adminlte.min.js');
        $this->load->js('assets/bower_components/select2/dist/js/select2.min.js');
        $this->load->js('assets/plugins.js');
        $this->load->js('assets/select2_init.js');
    }

    public function index(){
    	if($this->ion_auth->is_admin()){
    		echo "string";
    	}
    }

    public function printAllPdfFail(){
    	echo "<a href='".base_url()."Dashboard/Laporan/getLaporanAll'>Klik</a><br>";
    	$all = ($this->input->post('pdf'));
    	echo gettype($all);
    	echo count($all);
    	print_r($all);
    	// dd($all);
    	die();
    	for($i = 0; $i < count($all); $i++){
    			print_r($all[$i]);
    		for ($j=0; $j <count($all[$i]) ; $j++) { 
	    		echo "<br>";
	    		echo "<br>";
    		}
    	}
    }

    public function printAllPdf(){
    	$pdf = $this->session->userdata('laporanAll');

    	$data['pdf'] = $pdf;

    	$this->load->view('page/print/printAllPdf', $data);
    }

    public function printBagian(){
    	$pdf = $this->session->userdata('laporanBagian');

    	$data['pdf'] = $pdf;

    	$this->load->view('page/print/printBagianPdf', $data);
    }

    public function printPerUser(){
    	$pdf = $this->session->userdata('laporanPerUser');
    	
    	$this->load->view('page/print/printPerUserPdf', $pdf);
    }

}