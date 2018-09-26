<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: rizal
 * Date: 9/25/2018
 * Time: 1:54 PM
 */

class Fingerprint extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->lang->load('auth');
        $this->load->helper('language');
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
    }

    public function index() {
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) {
            return show_error('You must be an administrator to view this page.');
        } else {
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //list the users
            $this->data['fingerprint'] = $this->db->get('mesin_fingerprint')->result();
            $this->load->view('page/fingerprint/index', $this->data);
        }
    }
    public function add_fingerprint(){
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        if(isset($_POST) && !empty($_POST)){
            $insert = $this->db->insert("mesin_fingerprint", $this->input->post());
            if($insert) redirect("Dashboard/Fingerprint/index", "refresh");
        }

        $this->data['fingerprint'] = $this->db->get('mesin_fingerprint')->result();
        $this->load->view('page/fingerprint/add_fingerprint', $this->data);
    }

    public function edit_fingerprint($id){
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        if(isset($_POST) && !empty($_POST)){
            $update = $this->db->update("mesin_fingerprint", $this->input->post(), "id_fingerprint = '$id'");
            if($update) redirect("Dashboard/Fingerprint/index", "refresh");
        }
        $this->data['fingerprint'] = $this->db->where("id_fingerprint", $id)->get('mesin_fingerprint')->result()[0];
        $this->load->view('page/fingerprint/edit_fingerprint', $this->data);

    }

    public function delete_fingerprint($id){
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $delete = $this->db->delete("mesin_fingerprint", "id_fingerprint = '$id'");
        if($delete) redirect("Dashboard/Fingerprint/index", "refresh");
    }

    public function deactive($id) {
        $deacitve = $this->db->update("mesin_fingerprint","status = '0'","id_fingerprint='$id'");
        if($deacitve) redirect("Dashboard/Fingerprint/index", "refresh");
    }

    public function activate($id) {
        $activate = $this->db->query("update mesin_fingerprint set status = '1' where id_fingerprint = '$id'");
        if($activate) redirect("Dashboard/Fingerprint/index", "refresh");
    }

}