<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function login()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run()) {
            $data = $this->db->get_where('user', ['username' => $_POST['username']])->row_array();
            if ($data) {
                $verify = password_verify($_POST['password'], $data['password']);
                if ($verify) {
                    $this->session->set_userdata('user', $data);
                    redirect(base_url());
                } else {
                    $this->session->set_flashdata('notify', '<div class="badge badge-danger">Password salah!</div>');
                    $this->load->view('templates/login');
                }
            } else {
                $this->session->set_flashdata('notify', '<div class="badge badge-danger">Username tidak ditemukan!</div>');
                $this->load->view('templates/login');
            }
        } else {
            $this->load->view('templates/login');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('user');
        redirect('user/login');
    }
}
