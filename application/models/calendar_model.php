<?php
class Calendar_model extends CI_Model{
	public function getYear(){
		$this->db->select('DATE_FORMAT(CURRENT_TIMESTAMP(), "%Y") AS cur_date', FALSE);
		return $this->db->get()->row()->cur_date;
	}

	public function getNextMonth(){
		return $this->db->query('SELECT DATE_FORMAT(DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 1 MONTH), "%M")')->row();
	}

	public function getNextYear(){
		$this->db->select('DATE_ADD(DATE_FORMAT(CURRENT_TIMESTAMP(), "%Y"), INTERVAL 1 YEAR)', FALSE);
		return $this->db->get()->row();
	}
}

?>