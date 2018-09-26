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
        $this->load->model('Fingerprint_model', 'FingerPrint');
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
            $this->data['fingerprint'] = $this->FingerPrint->find()->get()->result_array();

            $this->load->view('page/fingerprint/index', $this->data);
        }
    }
    public function add_fingerprint(){
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }

        //Validation rule
        $this->form_validation->set_rules('nama_fingerprint', 'Nama mesin', 'required|xss_clean');
        $this->form_validation->set_rules('ip_address', 'IP Address', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {

            $data = array(
                'nama_fingerprint' => $this->input->post('nama_fingerprint'),
                'ip_address' => $this->input->post('ip_address'),
                'status' => 1
            );

            $insert = $this->FingerPrint->insert($data);

            $this->session->set_flashdata('message', 'Create mesin success');

            if($insert) redirect("Dashboard/Fingerprint/index", "refresh");

        } else {
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        }

        $this->load->view('page/fingerprint/add_fingerprint', $this->data);
    }

    public function edit_fingerprint($id){
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }

        //Validation rule
        $this->form_validation->set_rules('nama_fingerprint', 'Nama mesin', 'required|xss_clean');
        $this->form_validation->set_rules('ip_address', 'IP Address', 'required|xss_clean');

        $condition = array('id_fingerprint' => $id);

        if ($this->form_validation->run() == TRUE) {

            $data = array(
                'nama_fingerprint' => $this->input->post('nama_fingerprint'),
                'ip_address' => $this->input->post('ip_address')
            );

            $this->FingerPrint->find()->where($condition);
            $update = $this->FingerPrint->update($data);

            $this->session->set_flashdata('message', 'Update mesin success');

            if($update) redirect("Dashboard/Fingerprint/index", "refresh");
        } else {
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        }

        $this->data['fingerprint'] = $this->FingerPrint->find()->where($condition)->get()->row_array();

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

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $condition = array('id_fingerprint' => $id);

        $this->FingerPrint->find()->where($condition);
        $deactive = $this->FingerPrint->update(array('status' => 0));

        if($deactive) redirect("Dashboard/Fingerprint/index", "refresh");
    }

    public function activate($id) {

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $condition = array('id_fingerprint' => $id);

        $this->FingerPrint->find()->where($condition);
        $activate = $this->FingerPrint->update(array('status' => 1));

        if($activate) redirect("Dashboard/Fingerprint/index", "refresh");
    }

}