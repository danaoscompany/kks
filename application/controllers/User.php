<?php

class User extends CI_Controller {
	
	public function get_officials() {
		echo json_encode($this->db->query("SELECT * FROM `officials`")->result_array());
	}
	
	public function get_profil_satuan_website() {
		echo $this->db->query("SELECT * FROM `settings` LIMIT 1")->row_array()['profil_satuan_ig_page'];
	}
	
	public function get_alarms() {
		echo json_encode($this->db->query("SELECT * FROM `alarms`")->result_array());
	}
	
	public function get_documents() {
		echo json_encode($this->db->query("SELECT * FROM `documents`")->result_array());
	}
}
