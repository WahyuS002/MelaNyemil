<?php

class User extends CI_Controller {
    public function index_user()
    {
        $data['judul'] = 'Selamat Datang Sanak';
        $this->load->view('templates/header', $data);
        $this->load->view('user/index_user');
        $this->load->view('templates/footer');
    }
}