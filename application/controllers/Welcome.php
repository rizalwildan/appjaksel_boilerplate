<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
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
        $this->load->css('assets/dist/css/AdminLTE.min.css');
        $this->load->css('assets/dist/css/skins/_all-skins.min.css');

        //Load All Js assets
        $this->load->js('assets/bower_components/jquery/dist/jquery.min.js');
        $this->load->js('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');
        $this->load->js('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');
        $this->load->js('assets/bower_components/fastclick/lib/fastclick.js');
        $this->load->js('assets/dist/js/adminlte.min.js');
    }

    public function index()
	{
	    if (!$this->ion_auth->logged_in()) {
	        redirect('auth/login');
        } else {
	        //Contoh select database dengan ORM
            //	    $this->load->model('Absen_model');
            //	    $record = new Absen_model();
            //	    $record = $record->find()->order_by('jam_masuk', 'DESC')->get()->result_array();

            $this->load->view('page/home');
        }
	}
}
