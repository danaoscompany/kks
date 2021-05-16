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
	
	public function get_news_website() {
		echo $this->db->query("SELECT * FROM `settings` LIMIT 1")->row_array()['news_page'];
	}
	
	public function get_news_websites() {
		echo json_encode($this->db->query("SELECT * FROM `news_sites`")->result_array());
	}
	
	public function get_alarms() {
		echo json_encode($this->db->query("SELECT * FROM `alarms`")->result_array());
	}
	
	public function get_documents() {
		echo json_encode($this->db->query("SELECT * FROM `documents`")->result_array());
	}
	
	public function login_with_google() {
		$email = $this->input->post('email');
		$users = $this->db->query("SELECT * FROM `users` WHERE `email`='" . $email . "'")->result_array();
		if (sizeof($users) > 0) {
			echo json_encode(array(
				'response_code' => 1,
				'user_id' => intval($users[0]['id'])
			));
		} else {
			echo json_encode(array(
				'response_code' => -1
			));
		}
	}
	
	public function add_track_record() {
		$uuid = $this->input->post('uuid');
		$userID = intval($this->input->post('user_id'));
		$time = intval($this->input->post('time'));
		$date = $this->input->post('date');
		$this->db->insert('track_records', array(
			'uuid' => $uuid,
			'user_id' => $userID,
			'time' => $time,
			'date' => $date
		));
	}
	
	public function get_track_records() {
		$userID = $this->input->post('user_id');
		echo json_encode($this->db->query("SELECT * FROM `track_records` WHERE `user_id`=" . $userID . " ORDER BY `date` DESC")
			->result_array());
	}
}
