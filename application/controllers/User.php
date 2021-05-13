<?php

class User extends CI_Controller {
	
	public function get_officials() {
		$officials = $this->db->query("SELECT * FROM `officials`")->result_array();
		$pageCount = $this->db->query("SELECT * FROM `officials` GROUP BY `page`")->num_rows();
		echo json_encode(array(
			'page_count' => $pageCount,
			'officials' => $officials
		));
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
	
	public function login_with_google() {
		$email = $this->input->post('email');
		$admins = $this->db->query("SELECT * FROM `users` WHERE `email`='" . $email . "'")->result_array();
		if (sizeof($admins) > 0) {
			echo json_encode(array(
				'response_code' => 1
			));
		} else {
			echo json_encode(array(
				'response_code' => -1
			));
		}
	}
}
