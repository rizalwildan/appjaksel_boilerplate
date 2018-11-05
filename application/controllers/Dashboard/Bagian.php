<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: rizal
 * Date: 9/27/2018
 * Time: 2:11 PM
 */

class Bagian extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->lang->load('auth');
        $this->load->helper('language');
        $this->load->model('Bagian_model', 'BagianModel');
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

    public function index() {
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) {
            return show_error('You must be an administrator to view this page.');
        } else {
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['bagian'] = $this->BagianModel->find()->select('bagian.*, u.id, u.first_name, u.last_name')
                                    ->join('users u', 'u.id = bagian.id_kepala_bagian')->get()->result_array();

            $this->load->view('page/bagian/index', $this->data);
        }
    }

    public function insert() {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth/login', 'refresh');
        }

        //Validation rule
        $this->form_validation->set_rules('nama_bagian', 'Nama Bagian', 'required|xss_clean');
        $this->form_validation->set_rules('kepala_bagian', 'Nama Kepala Bagian', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'nama_bagian' => $this->input->post('nama_bagian'),
                'id_kepala_bagian' => $this->input->post('kepala_bagian'),
                'status' => 1
            );

            $insert = $this->BagianModel->insert($data);

            $this->session->set_flashdata('message', 'Create bagian success');

            if ($insert) redirect('Dashboard/Bagian', 'refresh');
        } else {
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        }

        $this->data['user'] = $this->ion_auth->users()->result_array();

        $this->load->view('page/bagian/add', $this->data);
    }

    public function edit($id) {

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth/login', 'refresh');
        }

        //Validation rule
        $this->form_validation->set_rules('bagian', 'Nama Bagian', 'required|xss_clean');
        $this->form_validation->set_rules('kepala_bagian', 'Nama Kepala Bagian', 'required|xss_clean');

        $condition = array('id_bagian' => $id);

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'bagian' => $this->input->post('bagian'),
                'id_kepala_bagian' => $this->input->post('kepala_bagian')
            );

            $this->BagianModel->find()->where($condition);
            $update = $this->BagianModel->update($data);

            $this->session->set_flashdata('message', 'Update bagian success');

            if($update) redirect("Dashboard/Bagian/index", "refresh");
        } else {
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        }

        $this->data['bagian'] = $this->BagianModel->find()->where($condition)->get()->row_array();
        $this->data['user'] = $this->ion_auth->users()->result_array();

        $this->load->view('page/bagian/edit', $this->data);
    }

    public function deactive($id) {

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth/login', 'refresh');
        }

        $condition = array('id_bagian' => $id);

        $this->BagianModel->find()->where($condition);
        $deactive = $this->BagianModel->update(array('status' => 0));

        if ($deactive) redirect('Dashboard/Bagian/index', 'refresh');
    }

    public function activate($id) {

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth/login', 'refresh');
        }

        $condition = array('id_bagian' => $id);

        $this->BagianModel->find()->where($condition);
        $active = $this->BagianModel->update(array('status' => 1));

        if ($active) redirect('Dashboard/Bagian/index', 'refresh');
    }

}