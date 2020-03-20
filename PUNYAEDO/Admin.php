<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		is_logged_in();
		}
	
	public function index(){
		$data['title'] = 'Dashboard';
		$data['user']= $this->db->get_where('user',['email'=> $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
		}
	public function role(){
		$data['title'] = 'Role';
		$data['user']= $this->db->get_where('user',['email'=> $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get('user_role')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role', $data);
		$this->load->view('templates/footer');
		
	}
	public function roleAccess($role_id){
		$data['title'] = 'Role Access';
		$data['user']= $this->db->get_where('user',['email'=> $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get_where('user_role',['id'=> $role_id])->row_array();
		$this->db->where('id !=',1);
		$data['menu']= $this->db->get('user_menu')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role-access', $data);
		$this->load->view('templates/footer');
		
	}
	public function changeAccess(){
		$menu_id =$this->input->post('menuId');
		$role_id =$this->input->post('roleId');
		$data=[
			'role_id'=> $role_id,
			'menu_id'=>$menu_id
		];
		$result =$this->db->get_where('user_access_menu',$data);
		if($result->num_rows()<1){
			$this->db->insert('user_access_menu', $data);

		}else{
			$this->db->delete()('user_access_menu', $data);
		}
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  	Access Changed!!</div>');
	}
	
	public function databarang(){

		$data['title'] = 'Data Gitar';
	$data['barang']=$this->model_barang->tampil_data()->result();
	$data['user']= $this->db->get_where('user',['email'=> $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/databarang', $data);
		$this->load->view('templates/footer');
		
	}
	public function databarang1(){

		$data['title'] = 'Data Drum';
	$data['barang1']=$this->model_barang1->tampil_data1()->result();
	$data['user']= $this->db->get_where('user',['email'=> $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/databarang1', $data);
		$this->load->view('templates/footer');
		
	}
	public function databarang2(){

		$data['title'] = 'Data Microphone';
	$data['barang2']=$this->model_barang2->tampil_data2()->result();
	$data['user']= $this->db->get_where('user',['email'=> $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/databarang2', $data);
		$this->load->view('templates/footer');
		
	}
	public function databarang3(){

		$data['title'] = 'Data Headphone';
	$data['barang3']=$this->model_barang3->tampil_data3()->result();
	$data['user']= $this->db->get_where('user',['email'=> $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/databarang3', $data);
		$this->load->view('templates/footer');
		
	}
	public function databarang_lain(){

		$data['title'] = 'Data Alat Lainnya';
	$data['barang4']=$this->model_barang4->tampil_data4()->result();
	$data['user']= $this->db->get_where('user',['email'=> $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/databarang_lain', $data);
		$this->load->view('templates/footer');
		
	}
	public function tambah_aksi(){
		$nama =$this->input->post('nama');
		$keterangan =$this->input->post('keterangan');
		$harga =$this->input->post('harga');
		$stok =$this->input->post('stok');
		$gambar =$this->input->post('gambar');		
		if($gambar=''){}
	else{
		$config['upload_path']='./assets/img';
		$config['allowed_types']='jpg|jpeg|png|gif';
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload('gambar')){
			echo " Gambar Gagal diupload";

		}else{
			$gambar=$this->upload->data('file_name');

		}

	}
	$data = array(
		'nama'=>$nama,
		'keterangan'=>$keterangan,
		'harga'=>$harga,
		'stok'=>$stok,
		'gambar'=>$gambar);
	$this->model_barang->tambah_barang($data,'tb_barang');
	redirect('admin/databarang');

		}
		public function edit($id){
			$data['title'] = 'Edit Data Barang';
			$data['user']= $this->db->get_where('user',['email'=> $this->session->userdata('email')])->row_array();

		$where = array('id'=>$id);
$data['barang']=$this->model_barang->edit_barang($where,'tb_barang')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/edit_barang', $data);
		$this->load->view('templates/footer');

		}
		
		public function update(){
			$id=$this->input->post('id');
			$nama=$this->input->post('nama');
		$keterangan=$this->input->post('keterangan');
			$harga=$this->input->post('harga');
			$stok=$this->input->post('stok');
			$gambar=$this->input->post('gambar');
			$data=array(
				'nama'=>$nama,
				'keterangan'=>$keterangan,
				'harga'=>$harga,
				'stok'=>$stok,
				'gambar'=>$gambar
			);
			$where=array(
				'id'=>$id
			);
		$this->model_barang->update_data($where,$data,'tb_barang');
			redirect('admin/databarang');

		}
		public function hapus($id){
			$where=array('id'=> $id);
		$this->model_barang->hapus_data($where,'tb_barang');
			redirect('admin/databarang');
		}
		public function tambah_aksi1(){
		$nama =$this->input->post('nama');
		$keterangan =$this->input->post('keterangan');
		$harga =$this->input->post('harga');
		$stok =$this->input->post('stok');
		$gambar =$this->input->post('gambar');		
		if($gambar=''){}
	else{
		$config['upload_path']='./assets/img';
		$config['allowed_types']='jpg|jpeg|png|gif';
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload('gambar')){
			echo " Gambar Gagal diupload";

		}else{
			$gambar=$this->upload->data('file_name');

		}

	}
	$data = array(
		'nama'=>$nama,
		'keterangan'=>$keterangan,
		'harga'=>$harga,
		'stok'=>$stok,
		'gambar'=>$gambar);
	$this->model_barang1->tambah_barang($data,'tb_barang1');
	redirect('admin/databarang1');

		}
		public function edit1($id_brg1){
			$data['title'] = 'Edit Data Barang';
			$data['user']= $this->db->get_where('user',['email'=> $this->session->userdata('email')])->row_array();

		$where = array('id_brg1'=>$id_brg1);
$data['barang1']=$this->model_barang1->edit_barang($where,'tb_barang1')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/edit_barang1', $data);
		$this->load->view('templates/footer');

		}
		public function update1(){
			$id_brg1=$this->input->post('id_brg1');
			$nama=$this->input->post('nama');
		$keterangan=$this->input->post('keterangan');
			$harga=$this->input->post('harga');
			$stok=$this->input->post('stok');
			$gambar=$this->input->post('gambar');
			$data=array(
				'nama'=>$nama,
				'keterangan'=>$keterangan,
				'harga'=>$harga,
				'stok'=>$stok,
				'gambar'=>$gambar
			);
			$where=array(
				'id_brg1'=>$id_brg1
			);
		$this->model_barang1->update_data($where,$data,'tb_barang1');
			redirect('admin/databarang1');

		}
		public function hapus1($id_brg1){
			$where=array('id_brg1'=> $id_brg1);
		$this->model_barang1->hapus_data($where,'tb_barang1');
			redirect('admin/databarang1');
		}
		public function tambah_aksi2(){
		$nama =$this->input->post('nama');
		$keterangan =$this->input->post('keterangan');
		$harga =$this->input->post('harga');
		$stok =$this->input->post('stok');
		$gambar =$this->input->post('gambar');		
		if($gambar=''){}
	else{
		$config['upload_path']='./assets/img';
		$config['allowed_types']='jpg|jpeg|png|gif';
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload('gambar')){
			echo " Gambar Gagal diupload";

		}else{
			$gambar=$this->upload->data('file_name');

		}

	}
	$data = array(
		'nama'=>$nama,
		'keterangan'=>$keterangan,
		'harga'=>$harga,
		'stok'=>$stok,
		'gambar'=>$gambar);
	$this->model_barang2->tambah_barang($data,'tb_barang2');
	redirect('admin/databarang2');

		}
		public function edit2($id_brg2){
			$data['title'] = 'Edit Data Barang';
			$data['user']= $this->db->get_where('user',['email'=> $this->session->userdata('email')])->row_array();

		$where = array('id_brg2'=>$id_brg2);
$data['barang2']=$this->model_barang2->edit_barang($where,'tb_barang2')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/edit_barang2', $data);
		$this->load->view('templates/footer');

		}
		public function update2(){
			$id_brg2=$this->input->post('id_brg2');
			$nama=$this->input->post('nama');
		$keterangan=$this->input->post('keterangan');
			$harga=$this->input->post('harga');
			$stok=$this->input->post('stok');
			$gambar=$this->input->post('gambar');
			$data=array(
				'nama'=>$nama,
				'keterangan'=>$keterangan,
				'harga'=>$harga,
				'stok'=>$stok,
				'gambar'=>$gambar
			);
			$where=array(
				'id_brg2'=>$id_brg2
			);
		$this->model_barang2->update_data($where,$data,'tb_barang2');
			redirect('admin/databarang2');

		}
		public function hapus2($id_brg2){
			$where=array('id_brg2'=> $id_brg2);
		$this->model_barang2->hapus_data($where,'tb_barang2');
			redirect('admin/databarang2');
		}
		public function tambah_aksi3(){
		$nama =$this->input->post('nama');
		$keterangan =$this->input->post('keterangan');
		$harga =$this->input->post('harga');
		$stok =$this->input->post('stok');
		$gambar =$this->input->post('gambar');		
		if($gambar=''){}
	else{
		$config['upload_path']='./assets/img';
		$config['allowed_types']='jpg|jpeg|png|gif';
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload('gambar')){
			echo " Gambar Gagal diupload";

		}else{
			$gambar=$this->upload->data('file_name');

		}

	}
	$data = array(
		'nama'=>$nama,
		'keterangan'=>$keterangan,
		'harga'=>$harga,
		'stok'=>$stok,
		'gambar'=>$gambar);
	$this->model_barang3->tambah_barang($data,'tb_barang3');
	redirect('admin/databarang3');

		}
		public function edit3($id_brg3){
			$data['title'] = 'Edit Data Barang';
			$data['user']= $this->db->get_where('user',['email'=> $this->session->userdata('email')])->row_array();

		$where = array('id_brg3'=>$id_brg3);
$data['barang3']=$this->model_barang3->edit_barang($where,'tb_barang3')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/edit_barang3', $data);
		$this->load->view('templates/footer');

		}
		public function update3(){
			$id_brg3=$this->input->post('id_brg3');
			$nama=$this->input->post('nama');
		$keterangan=$this->input->post('keterangan');
			$harga=$this->input->post('harga');
			$stok=$this->input->post('stok');
			$gambar=$this->input->post('gambar');
			$data=array(
				'nama'=>$nama,
				'keterangan'=>$keterangan,
				'harga'=>$harga,
				'stok'=>$stok,
				'gambar'=>$gambar
			);
			$where=array(
				'id_brg3'=>$id_brg3
			);
		$this->model_barang3->update_data($where,$data,'tb_barang3');
			redirect('admin/databarang3');

		}
		public function hapus3($id_brg3){
			$where=array('id_brg3'=> $id_brg3);
		$this->model_barang3->hapus_data($where,'tb_barang3');
			redirect('admin/databarang3');
		}
	public function tambah_aksi4(){
		$nama =$this->input->post('nama');
		$keterangan =$this->input->post('keterangan');
		$harga =$this->input->post('harga');
		$stok =$this->input->post('stok');
		$gambar =$this->input->post('gambar');		
		if($gambar=''){}
	else{
		$config['upload_path']='./assets/img';
		$config['allowed_types']='jpg|jpeg|png|gif';
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload('gambar')){
			echo " Gambar Gagal diupload";

		}else{
			$gambar=$this->upload->data('file_name');

		}

	}
	$data = array(
		'nama'=>$nama,
		'keterangan'=>$keterangan,
		'harga'=>$harga,
		'stok'=>$stok,
		'gambar'=>$gambar);
	$this->model_barang4->tambah_barang($data,'tb_barang_lain');
	redirect('admin/databarang_lain');

		}
		public function edit4($id_brg4){
			$data['title'] = 'Edit Data Barang';
			$data['user']= $this->db->get_where('user',['email'=> $this->session->userdata('email')])->row_array();

		$where = array('id_brg4'=>$id_brg4);
$data['barang4']=$this->model_barang4->edit_barang($where,'tb_barang_lain')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/edit_barang4', $data);
		$this->load->view('templates/footer');

		}
		public function update4(){
			$id_brg4=$this->input->post('i_brg4');
			$nama=$this->input->post('nama');
		$keterangan=$this->input->post('keterangan');
			$harga=$this->input->post('harga');
			$stok=$this->input->post('stok');
			$gambar=$this->input->post('gambar');
			$data=array(
				'nama'=>$nama,
				'keterangan'=>$keterangan,
				'harga'=>$harga,
				'stok'=>$stok,
				'gambar'=>$gambar
			);
			$where=array(
				'id_brg4'=>$id_brg4
			);
		$this->model_barang4->update_data($where,$data,'tb_barang_lain');
			redirect('admin/databarang_lain');

		}
		public function hapus4($id){
			$where=array('id_brg4'=> $id_brg4);
		$this->model_barang4->hapus_data($where,'tb_barang_lain');
			redirect('admin/databarang_lain');
		}
			
}