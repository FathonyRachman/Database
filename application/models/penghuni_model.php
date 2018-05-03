<?php

class penghuni_model extends CI_Model{
	var $table = 'penghuni';
	
	public function penghuni_add($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function get_all_penghuni(){
		$this->db->from('penghuni');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_by_id($id){
		$this->db->from($this->table);
		$this->db->where('Id_penghuni', $id);
		$query = $this->db->get();

		return $query->row();
	}
	
	public function penghuni_update($where, $data){
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id){
		$this->db->where('Id_penghuni', $id);
		$this->db->delete($this->table);
	}
}