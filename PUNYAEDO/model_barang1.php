<?php
class model_barang1 extends CI_Model{
	public function tampil_data1(){
		return $this->db->get('tb_barang1');

	}
	public function tambah_barang($data,$table){
		$this->db->insert($table, $data);
	}
public function edit_barang($where,$table){
		return $this->db->get_where($table,$where);
	}
	public function update_data($where,$data,$table){
		$this->db->where($where);
	 $this->db->update($table,$data);
	}
	public function hapus_data($where,$table){

		$this->db->where($where);
	 $this->db->delete($table);
	}
public function find($id_brg1){
$result=$this->db->where('id_brg1',$id_brg1)->limit(1)->get('tb_barang1');
	if($result->num_rows()>0){
		return $result->row();

	}	else{
		return array();
	}					  
	}
}  