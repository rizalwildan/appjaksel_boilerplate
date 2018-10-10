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


    //fitur yang berhubungan dengan mesin fingerprint
    public function thishari(){
      print_r($this->hari);
      
    }
    public function tarikDataAll(){
      ini_set('max_execution_time', 600);
      $this->db->empty_table('absen_temp');
      if($this->hari[0]['status'] == 1){
        $mesin = $this->db->get('mesin_fingerprint')->result_array();
        for ($i=0; $i <count($mesin) ; $i++) { 
          $ip_address = $mesin[$i]['ip_address'];
          if($mesin[$i]['status'] == 1){
            $this->tarikDataPerMesin($ip_address);
          }
        }
        $this->db->query('delete from absen_temp where date(DateTime) != date(now())');
        // $this->db->query("delete from absen_temp where date(DateTime) < '2018-09-03'");
        $this->pindahDataToAbsen();
      }
    }
    public function tarikDataPerMesin($ip_address){
      ini_set('max_execution_time', 300);
      $data = $this->lib_fingerprint->getData($ip_address);
      if($data != null){
        $this->db->insert_batch('absen_temp', $data);
      }
    }

    public function pindahDataToAbsen(){
      ini_set('max_execution_time', 600);
      $id_user_arr = $this->db->distinct()->select("id_user")->get('absen_temp')->result_array();
      for ($i=0; $i <count($id_user_arr) ; $i++) {
        $pulang_awal = null;
        $lembur = null;
        $telat = null;
        $id_user = $id_user_arr[$i]['id_user'];
        // $tanggal = explode(" ", $id_user_arr[$i]['DateTime'])[0];
        $tanggal = date("Y-m-d");
        $jam_masuk_kantor = $this->lib_hari->cekByDate($tanggal)[0]['jam_masuk'];
        $jam_pulang_kantor = $this->lib_hari->cekByDate($tanggal)[0]['jam_pulang'];

        $this->db->where("id_user = '$id_user' AND tanggal = '$tanggal'");
        if($this->db->get('absen')->num_rows() == 0){
          $this->db->where("id_user = '$id_user' AND date(DateTime) = '$tanggal'");
          $this->db->select("min(time(DateTime)) as jam_pertama , max(time(DateTime)) as jam_terakhir");
          $jam = $this->db->get('absen_temp')->result_array();
          if($jam[0]['jam_pertama'] < '12:00:00'){
            $jam_masuk = $jam[0]['jam_pertama'];
            if($jam_masuk > $jam_masuk_kantor){
              $telat = strtotime($jam_masuk)  - strtotime($jam_masuk_kantor);
              $telat = date("H:i:s", $telat);
            }
          }else{
            $jam_masuk = null;
            $telat = null;
          }
          if($jam[0]['jam_terakhir'] >= '12:00:00'){
            $jam_pulang = $jam[0]['jam_terakhir'];
            if($jam_pulang < $jam_pulang_kantor){
              $pulang_awal = strtotime($jam_pulang_kantor) - strtotime($jam_pulang);
              $pulang_awal = date("H:i:s", $pulang_awal);
            }else{
              $lembur = strtotime($jam_pulang) - strtotime($jam_pulang_kantor);
              $lembur = date("H:i:s", $lembur);
            }
          }else{
            $jam_pulang = null;
            $lembur = null;
            $pulang_awal = null;
          }
          //ngeset telat, pulang awal dan lembur
          $data_insert = array(
                        'id_user' => $id_user,
                        'tanggal' => $tanggal,
                        'jam_masuk' => $jam_masuk,
                        'jam_pulang' => $jam_pulang,
                        'telat' => $telat,
                        'pulang_awal' =>$pulang_awal,
                        'lembur' =>$lembur
          );
          $this->db->insert('absen', $data_insert);
        }else{
          $this->db->where("id_user = '$id_user' AND date(DateTime) = '$tanggal'");
          $this->db->select("min(time(DateTime)) as jam_pertama , max(time(DateTime)) as jam_terakhir");
          $jam = $this->db->get('absen_temp')->result_array();
          if($jam[0]['jam_pertama'] < '12:00:00'){
            $jam_masuk = $jam[0]['jam_pertama'];
            if($jam_masuk > $jam_masuk_kantor){
              $telat = strtotime($jam_masuk)  - strtotime($jam_masuk_kantor);
              $telat = date("H:i:s", $telat);
            }
          }else{
            $jam_masuk = null;
            $telat = null;
          }
          if($jam[0]['jam_terakhir'] > '12:00:00'){
            $jam_pulang = $jam[0]['jam_terakhir'];
            if($jam_pulang < $jam_pulang_kantor){
              $pulang_awal = strtotime($jam_pulang_kantor) - strtotime($jam_pulang);
              $pulang_awal = date("H:i:s", $pulang_awal);
            }else{
              $lembur = strtotime($jam_pulang) - strtotime($jam_pulang_kantor);
              $lembur = date("H:i:s", $lembur);
            }
          }else{
            $jam_pulang = null;
            $pulang_awal = null;
            $lembur = null;
          }
          $data['id_user'] = $id_user;
          $data['tanggal'] = $tanggal;
          $data_update['jam_masuk'] = $jam_masuk;
          $data_update['jam_pulang'] = $jam_pulang;
          $data_update['telat'] = $telat;
          $data_update['pulang_awal'] = $pulang_awal;
          $data_update['lembur'] = $lembur;
          $this->db->where($data);
          $this->db->update('absen', $data_update);
        }
      }
    }

    public function pindahDataToAbsenWithTanggal(){
      ini_set('max_execution_time', 600);
      $tanggal1 =  $this->db->distinct()->select("date(DateTime) as tanggal")->order_by("date(DateTime)","ASC")->get('absen_temp')->result_array();
      // dd($tanggal);
      for ($t=0; $t < count($tanggal1); $t++) { 
        if($this->lib_hari->cekByDate($tanggal1[$t]['tanggal'])[0]["status"]==1){
          $tanggal = $tanggal1[$t]['tanggal'];
          $id_user_arr = $this->db->distinct()->select("id_user")->get('absen_temp')->result_array();
          for ($i=0; $i <count($id_user_arr) ; $i++) {
            $pulang_awal = null;
            $lembur = null;
            $telat = null;
            $id_user = $id_user_arr[$i]['id_user'];
            // $tanggal = explode(" ", $id_user_arr[$i]['DateTime'])[0];
            // $tanggal = date("Y-m-d");
            $jam_masuk_kantor = $this->lib_hari->cekByDate($tanggal)[0]['jam_masuk'];
            $jam_pulang_kantor = $this->lib_hari->cekByDate($tanggal)[0]['jam_pulang'];

            $this->db->where("id_user = '$id_user' AND tanggal = '$tanggal'");
            if($this->db->get('absen')->num_rows() == 0){
              $this->db->where("id_user = '$id_user' AND date(DateTime) = '$tanggal'");
              $this->db->select("min(time(DateTime)) as jam_pertama , max(time(DateTime)) as jam_terakhir");
              $jam = $this->db->get('absen_temp')->result_array();
              if($jam[0]['jam_pertama'] < '12:00:00'){
                $jam_masuk = $jam[0]['jam_pertama'];
                if($jam_masuk > $jam_masuk_kantor){
                  $telat = strtotime($jam_masuk)  - strtotime($jam_masuk_kantor);
                  $telat = date("H:i:s", $telat);
                }
              }else{
                $jam_masuk = null;
                $telat = null;
              }
              if($jam[0]['jam_terakhir'] >= '12:00:00'){
                $jam_pulang = $jam[0]['jam_terakhir'];
                if($jam_pulang < $jam_pulang_kantor){
                  $pulang_awal = strtotime($jam_pulang_kantor) - strtotime($jam_pulang);
                  $pulang_awal = date("H:i:s", $pulang_awal);
                }else{
                  $lembur = strtotime($jam_pulang) - strtotime($jam_pulang_kantor);
                  $lembur = date("H:i:s", $lembur);
                }
              }else{
                $jam_pulang = null;
                $lembur = null;
                $pulang_awal = null;
              }
              //ngeset telat, pulang awal dan lembur
              $data_insert = array(
                            'id_user' => $id_user,
                            'tanggal' => $tanggal,
                            'jam_masuk' => $jam_masuk,
                            'jam_pulang' => $jam_pulang,
                            'telat' => $telat,
                            'pulang_awal' =>$pulang_awal,
                            'lembur' =>$lembur
              );
              $this->db->insert('absen', $data_insert);
            }else{
              $this->db->where("id_user = '$id_user' AND date(DateTime) = '$tanggal'");
              $this->db->select("min(time(DateTime)) as jam_pertama , max(time(DateTime)) as jam_terakhir");
              $jam = $this->db->get('absen_temp')->result_array();
              if($jam[0]['jam_pertama'] < '12:00:00'){
                $jam_masuk = $jam[0]['jam_pertama'];
                if($jam_masuk > $jam_masuk_kantor){
                  $telat = strtotime($jam_masuk)  - strtotime($jam_masuk_kantor);
                  $telat = date("H:i:s", $telat);
                }
              }else{
                $jam_masuk = null;
                $telat = null;
              }
              if($jam[0]['jam_terakhir'] > '12:00:00'){
                $jam_pulang = $jam[0]['jam_terakhir'];
                if($jam_pulang < $jam_pulang_kantor){
                  $pulang_awal = strtotime($jam_pulang_kantor) - strtotime($jam_pulang);
                  $pulang_awal = date("H:i:s", $pulang_awal);
                }else{
                  $lembur = strtotime($jam_pulang) - strtotime($jam_pulang_kantor);
                  $lembur = date("H:i:s", $lembur);
                }
              }else{
                $jam_pulang = null;
                $pulang_awal = null;
                $lembur = null;
              }
              $data['id_user'] = $id_user;
              $data['tanggal'] = $tanggal;
              $data_update['jam_masuk'] = $jam_masuk;
              $data_update['jam_pulang'] = $jam_pulang;
              $data_update['telat'] = $telat;
              $data_update['pulang_awal'] = $pulang_awal;
              $data_update['lembur'] = $lembur;
              $this->db->where($data);
              $this->db->update('absen', $data_update);
            }
          }
        }
      }
      
    }

}