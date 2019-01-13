<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RuleHariTambahan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->lang->load('auth');
        $this->load->helper('language');
        $this->load->model('RuleHariTambahan_model', 'RuleHariTambahanModel');
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
    }

    public function index() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) {
            return show_error('You must be an administrator to view this page.');
        } else {
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['hari'] = $this->RuleHariTambahanModel->find()->get()->result_array();

            $this->load->view('page/haritambahan/index', $this->data);
        }
    }

    public function add() {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth/login', 'refresh');
        }

        //Validation rule

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|xss_clean');
        $this->form_validation->set_rules('jam_masuk', 'Jam Masuk', 'required|xss_clean');
        $this->form_validation->set_rules('jam_pulang', 'Jam Pulang', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
            	'tanggal'		=> $this->input->post('tanggal'),
                'jam_masuk' 	=> date('H:i:s', strtotime($this->input->post('jam_masuk'))),
                'jam_pulang' 	=> date('H:i:s', strtotime($this->input->post('jam_pulang')))
            );

            $insert = $this->RuleHariTambahanModel->insert($data);

            $this->session->set_flashdata('message', 'Update rule hari success');

            if($insert) redirect("Dashboard/RuleHariTambahan/index", "refresh");
        } else {
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        }

        $this->load->view('page/haritambahan/add', $this->data);
    }

    public function edit($id) {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth/login', 'refresh');
        }

        //Validation rule
        $this->form_validation->set_rules('jam_masuk', 'Jam Masuk', 'required|xss_clean');
        $this->form_validation->set_rules('jam_pulang', 'Jam Pulang', 'required|xss_clean');

        $condition = array('id_hari' => $id);

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'jam_masuk' => date('H:i:s', strtotime($this->input->post('jam_masuk'))),
                'jam_pulang' => date('H:i:s', strtotime($this->input->post('jam_pulang')))
            );

            $this->RuleHariModel->find()->where($condition);
            $update = $this->RuleHariModel->update($data);

            $this->session->set_flashdata('message', 'Update rule hari success');

            if($update) redirect("Dashboard/RuleHari/index", "refresh");
        } else {
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        }

        $this->data['hari'] = $this->RuleHariModel->find()->where($condition)->get()->row_array();

        $this->load->view('page/haritambahan/edit', $this->data);
    }
}