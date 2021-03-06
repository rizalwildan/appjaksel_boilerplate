<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: rizal
 * Date: 9/25/2018
 * Time: 1:54 PM
 */

class User extends CI_Controller
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
            $this->data['users'] = $this->ion_auth->users()->result();
            foreach ($this->data['users'] as $k => $user)
            {
                $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
                $this->data['users'][$k]->jabatan = $this->db->select('jabatan')->from('jabatan')->join('users', 'users.id_jabatan = jabatan.id_jabatan')->where("users.id = '$user->id'")->get()->result()[0];
                $this->data['users'][$k]->bagian = $this->db->select('bagian')->from('bagian')->join('users', 'users.id_bagian = bagian.id_bagian')->where("users.id = '$user->id'")->get()->result()[0];
            }
            $this->load->view('page/user/index', $this->data);
        }
    }
    public function create_user() {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        if($this->session->userdata('group_id') == 1){
          $groups = $this->db->where('id != 1')->get('groups')->result_array();
        }else if($this->session->userdata('group_id') == 2){
          $groups = $this->db->where('id != 1')->where('id != 2')->get('groups')->result_array();
        }
        $tables = $this->config->item('tables','ion_auth');
        // $groups=$this->ion_auth->groups()->result_array();
        $jabatan = $this->db->get('jabatan')->result_array();
        $bagian = $this->db->get('bagian')->result_array();
        //Validation Rules
        $this->form_validation->set_rules('username', $this->lang->line('create_user_validation_username_label'), 'required|xss_clean');
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('nip', $this->lang->line('create_user_validation_nip_label'), 'required|xss_clean');
        // $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique['.$tables['users'].'.email]');
        $this->form_validation->set_rules('id_jabatan', $this->lang->line('create_user_validation_jabatan_label'), 'required|xss_clean');
        $this->form_validation->set_rules('id_bagian', $this->lang->line('create_user_validation_bagian_label'), 'required|xss_clean');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');
        $this->form_validation->set_rules('groups[]', $this->lang->line('create_user_validation_groups_label'), 'required|xss_clean');
        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() == true)
            {
                $username = strtolower($this->input->post('username'));
                // $email    = strtolower($this->input->post('email'));
                $password = $this->input->post('password');
                $groups = $this->input->post('groups');
                $additional_data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name'  => $this->input->post('last_name'),
                    'nip'        => $this->input->post('nip')
                );
            }else{
              echo "error<br>";
            }
            if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data, $groups))
            {
                echo "register true";
                //check to see if we are creating the user
                //redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("Dashboard/User/index", 'refresh');
            }
            else {
                echo "register error";
                //display the create user form
                //set the flash data error message if there is one
                $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            }
        }
        $this->data['groups'] = $groups;
        $this->data['jabatan'] = $jabatan;
        $this->data['bagian'] = $bagian;
        $this->load->view('auth/create_user', $this->data);
    }
    public function edit($id) {
        // if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        // $user = $this->ion_auth->user($id)->row();
        $user = $this->db->where('id', $id)->get('users')->result_array()[0];
        // print_r($user);
        $jabatan = $this->db->get('jabatan')->result_array();
        $currentJabatan = $this->db->select('id_jabatan')->where('id', $id)->get('users')->result_array()[0];
        $bagian = $this->db->get('bagian')->result_array();
        $currentBagian = $this->db->select('id_bagian')->where('id', $id)->get('users')->result_array()[0];
        $groups=$this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result_array();
        //validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('id_jabatan', $this->lang->line('create_user_validation_jabatan_label'), 'required|xss_clean');
        $this->form_validation->set_rules('id_bagian', $this->lang->line('create_user_validation_bagian_label'), 'required|xss_clean');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('groups', $this->lang->line('edit_user_validation_groups_label'), 'xss_clean');
        $this->form_validation->set_rules('nip', $this->lang->line('edit_user_validation_nip_label'), 'xss_clean');
        if (isset($_POST) && !empty($_POST))
        {
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'nip'        => $this->input->post('nip'),
                'id_bagian'  => $this->input->post('id_bagian'),
                'id_jabatan' => $this->input->post('id_jabatan')
            );
            // Only allow updating groups if user is admin
            if ($this->ion_auth->is_admin())
            {
                //Update the groups user belongs to
                $groupData = $this->input->post('groups');
                if (isset($groupData) && !empty($groupData)) {
                    $this->ion_auth->remove_from_group('', $id);
                    $this->ion_auth->add_to_group($groupData, $id);
                }
            }
            //update the password if it was posted
            if ($this->input->post('password'))
            {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
                $data['password'] = $this->input->post('password');
            }
            if ($this->form_validation->run() === TRUE)
            {
                $this->ion_auth->update($user['id'], $data);
                //check to see if we are creating the user
                //redirect them back to the admin page
                $this->session->set_flashdata('message', "User Saved");
                if ($this->ion_auth->is_admin())
                {
                    redirect('dashboard/user/edit/'.$id, 'refresh');
                    print_r($data);
                }
                else
                {
                    redirect('/', 'refresh');
                }
            }
        }
        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        //pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;
        $this->data['jabatan'] = $jabatan;
        $this->data['currentJabatan'] = $currentJabatan['id_jabatan'];
        $this->data['bagian'] = $bagian;
        $this->data['currentBagian'] = $currentBagian['id_bagian'];
        $this->load->view('auth/edit_user', $this->data);
    }
    public function deactive($id) {
        if ($id == 1) {
            $this->session->set_flashdata('message', 'Cannot deactivate this user!');
        } else if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
            $this->ion_auth->deactivate($id);
        }
        return redirect('Dashboard/User', 'refresh');
    }
    public function activate($id) {
        if ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }
        if ($activation) {
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("Dashboard/User", 'refresh');
        }
    }


}