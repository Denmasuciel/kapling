<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Master_model extends CI_Model {

	var $tbl_user = 'users';
	var $tbl_bidang = 'tbl_bidang';
	var $tbl_rr = 'tbl_rr';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_by_id_user($id)
	{
		$this->db->from($this->tbl_user);
		$this->db->where('id_user',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function get_by_id_bidang($id)
	{
		$this->db->from($this->tbl_bidang);
		$this->db->where('id_bidang',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_by_id_rr($id)
	{
		$this->db->from($this->tbl_rr);
		$this->db->where('id_rr',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	

	public function save_user($data)
	{
		$this->db->insert($this->tbl_user, $data);
		return $this->db->insert_id();
	}
	
	public function save_bidang($data)
	{
		$this->db->insert($this->tbl_bidang, $data);
		return $this->db->insert_id();
	}

	public function save_rr($data)
	{
		$this->db->insert($this->tbl_rr, $data);
		return $this->db->insert_id();
	}


	public function update_user($where, $data)
	{
		$this->db->update($this->tbl_user, $data, $where);
		return $this->db->affected_rows();
	}

	public function update_bidang($where, $data)
	{
		$this->db->update($this->tbl_bidang, $data, $where);
		return $this->db->affected_rows();
	}

	public function update_rr($where, $data)
	{
		$this->db->update($this->tbl_rr, $data, $where);
		return $this->db->affected_rows();
	}


	public function delete_by_id_user($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete($this->tbl_user);
	}
	public function delete_by_id_bidang($id)
	{
		$this->db->where('id_bidang', $id);
		$this->db->delete($this->tbl_bidang);
	}

	public function delete_by_id_rr($id)
	{
		$this->db->where('id_rr', $id);
		$this->db->delete($this->tbl_rr);
	}

	

		
}
