<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: rizal
 * Date: 9/25/2018
 * Time: 1:54 PM
 */

class Request_jam extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->lang->load('auth');
        $this->load->helper('language');
        $this->load->model('Request_jam_model', 'Model');
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
        $this->load->css('assets/plugins/timepicker/bootstrap-timepicker.css');
        
        //Data table
        $this->load->css('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->load->css('assets/dist/css/AdminLTE.min.css');
        $this->load->css('assets/dist/css/skins/_all-skins.min.css');

        //Load All Js assets
        $this->load->js('assets/bower_components/jquery/dist/jquery.min.js');
        $this->load->js('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');
        $this->load->js('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $this->load->js('assets/plugins/timepicker/bootstrap-timepicker.js');
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
            $datajoin = array(
            				'absen.id_absen = request_jam_kerja.id_absen',
			            	'users.id_user = absen.id_user'
			            	);
            $this->data['request_jam'] = $this->db->from('request_jam_kerja,absen,users')->where('absen.id_absen = request_jam_kerja.id_absen')->where('users.id = absen.id_user')->get()->result_array();
            
            // $this->data['fingerprint'] = $this->FingerPrint->find()->get()->result_array();
            // print_r($this->data);
            $this->load->view('page/request_jam/index', $this->data);
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
        // ($this->input->post('jam_pulang'))
        if ($this->form_validation->run() == TRUE) {
            $dataWhere = array(
                        // 'id_user' => '73',
                        'id_user' => $this->input->post('id_user'),
                        'tanggal' => date('Y-m-d' , strtotime($this->input->post('tanggal')))
                );
            $id_absen = $this->db->where($dataWhere)->get('absen')->result_array();
            if(count($id_absen) == 1){
                $data = array(
                    'id_absen' => $id_absen[0]['id_absen'],
                    'request_masuk' => $this->input->post('jam_masuk'),
                    'request_pulang' => $this->input->post('jam_pulang'),
                    'alasan' => $this->input->post('alasan'),
                    'status' => 0
                );
                $insert = $this->Model->insert($data);

                $this->session->set_flashdata('message', 'Success');

                if($insert) redirect("Dashboard/Request_jam/add", "refresh");
            }else{
                $this->session->set_flashdata('error', 'Anda belum scan pada tanggal tersebut');
                redirect("Dashboard/Request_jam/add", "refresh");
            }
        } else {
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        }
        // $this->data['alasan'] = $this->db->get('jenis_absen')->result_array();
        $this->load->view('page/request_jam/add','refresh');
    }

    public function approve($id, $id_absen){
        if (!$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $condition = array('id_request' => $id);
        $req = $this->db->where($condition)->get('request_jam_kerja')->result_array()[0];
        if($req['request_masuk'] != '' && $req['request_pulang'] != ''  ){
            $condition2 = array(
                'jam_masuk' => $req['request_masuk'],
                'jam_pulang' => $req['request_pulang']
                );
        }else if($req['request_masuk'] != '' && $req['request_pulang'] == ''){
            $condition2 = array(
                'jam_masuk' => $req['request_masuk']
                );
        }else if($req['request_masuk'] == '' && $req['request_pulang'] != ''){
            $condition2 = array(
                'jam_pulang' => $req['request_pulang']
                );
        }
        if($this->db->where("id_absen = $id_absen")->update('absen', $condition2)){
            $status = array('status' => '1');
            if($this->db->where($condition)->update('request_jam_kerja', $status)){
                redirect("Dashboard/Request_jam/index", "refresh");
            }
        }
    }
}