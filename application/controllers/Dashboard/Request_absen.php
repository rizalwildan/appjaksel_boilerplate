<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: rizal
 * Date: 9/25/2018
 * Time: 1:54 PM
 */

class Request_absen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->lang->load('auth');
        $this->load->helper('language');
        $this->load->model('Request_absen_model', 'Model');
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
        $this->load->css('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        //Data table
        $this->load->css('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->load->css('assets/dist/css/AdminLTE.min.css');
        $this->load->css('assets/dist/css/skins/_all-skins.min.css');

        //Load All Js assets
        $this->load->js('assets/bower_components/jquery/dist/jquery.min.js');
        $this->load->js('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');
        $this->load->js('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
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
            return show_error('You must be an administrator to view this page.');
        } else {
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //list the users
            $this->data['request_absen'] = $this->db->join('users','users.id = request_absen.id_user')->get('request_absen')->result_array();
            // $this->data['fingerprint'] = $this->FingerPrint->find()->get()->result_array();

            $this->load->view('page/request_absen/index', $this->data);
        }
    }
    public function add(){
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth', 'refresh');
        }

        //Validation rule
        $this->form_validation->set_rules('id_user', '', 'required|xss_clean');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'id_user' => $this->input->post('id_user'),
                'tanggal' => date('Y-m-d' , strtotime($this->input->post('tanggal'))),
                'alasan' => $this->input->post('alasan'),
                'status' => 0
            );

            $insert = $this->Model->insert($data);

            $this->session->set_flashdata('message', 'Success');

            if($insert) redirect("Dashboard/Request_absen/add", "refresh");

        } else {
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        }
        $this->data['alasan'] = $this->db->get('jenis_absen')->result_array();
        $this->load->view('page/request_absen/add', $this->data);
    }


    public function approve($id){
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $condition = array('id_request' => $id);

        // $r = $this->Model->find()->where($condition);
        // $deactive = $this->Model->update(array('status' => 1));
        
        $req = $this->db->where($condition)->get('request_absen')->result_array()[0];
        // print_r($req);
        
        $condition2 = array(
            'id_user' => $req['id_user'],
            'tanggal' => $req['tanggal']
            );

        $insert = array(
            'id_user' => $req['id_user'],
            'tanggal' => $req['tanggal'],
            'keterangan' => $req['keterangan']
            );
        $absen = $this->db->where($condition2)->get('absen')->result_array();
        if(count($absen) == 0){
            if($this->db->insert('absen', $insert)){
                $this->session->set_flashdata('message', 'Success');
            }
        }else{
            if($this->db->update('absen', $insert ,$condition2)){
                $this->session->set_flashdata('message', 'Success');
            }
        }
        // print_r($absen);
        // if($deactive) redirect("Dashboard/Request_absen/index", "refresh");
    }
}