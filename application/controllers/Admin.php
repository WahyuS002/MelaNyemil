<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Donat_model');
    }

    public function index()
    {

        $data['donat'] = $this->Donat_model->tampil_donat()->result();
        $data['judul'] = 'Daftar Donat';
        $this->load->view('templates/header', $data);
        $this->load->view('donat/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_barang()
    {
        $kode       = $this->input->post('kode');
        $harga_donat = $this->input->post('harga_donat');
        $varian_top = $this->input->post('toping');
        $toping     = $this->input->post('toping');
        $harga_top  = $this->input->post('harga_top');
        $stok       = $this->input->post('stok');

        $data = array(
            'kd_donat'         => $kode,
            'hrg_donat'  => $harga_donat,
            'varian_top' => $varian_top,
            'varian_top'       => $toping,
            'hrg_vartop'    => $harga_top,
            'stok'         => $stok,
        );

        $this->Donat_model->tambah_donat($data, 'tb_donat');
        redirect('admin/index');
    }
    public function edit_data($id){
        $where = array('id' =>$id);

        
        $kode       = $this->input->post('kode');
        $harga_donat = $this->input->post('harga_donat');
        $varian_top = $this->input->post('toping');
        $toping     = $this->input->post('toping');
        $harga_top  = $this->input->post('harga_top');
        $stok       = $this->input->post('stok');

        $data = array(
            'kd_donat'         => $kode,
            'hrg_donat'  => $harga_donat,
            'varian_top' => $varian_top,
            'varian_top'       => $toping,
            'hrg_vartop'    => $harga_top,
            'stok'         => $stok,
        );

        $this->load->view('templates/header', $data);
        $this->load->view('donat/index', $data);
        $this->load->view('templates/footer');
   
    }
    
    public function hapus_data ($id){
        $where = array ('id' => $id);
        $this->Donat_model->hapus_data($where, 'tb_donat');
        redirect('admin/index');
    }


}
