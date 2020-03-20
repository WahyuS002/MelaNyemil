<?php

class Donat_model extends CI_Model {
    public function tampil_donat()
    {
        return $this->db->get('tb_donat');
    }
    public function tambah_donat($data,$table){
		$this->db->insert($table, $data);
    }
    public function edit_barang($where,$table){
		return $this->db->get_where($table,$where);
	}
	public function edit_data($where,$table){
		return $this->db->get_where($table,$where);
	 
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
?>