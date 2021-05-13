<?php

include "FCM.php";

class Admin extends CI_Controller {
	
	public function get_admins() {
		echo json_encode($this->db->query("SELECT * FROM `admins` ORDER BY `email`")->result_array());
	}
	
	public function get_users() {
		echo json_encode($this->db->query("SELECT * FROM `users` ORDER BY `email`")->result_array());
	}
	
	public function get_pejabat_batalyons() {
		$officials = $this->db->query("SELECT * FROM `officials`")->result_array();
		$pageCount = $this->db->query("SELECT * FROM `officials` GROUP BY `page`")->num_rows();
		echo json_encode(array(
			'page_count' => $pageCount,
			'officials' => $officials
		));
	}
	
	public function add_admin() {
		$email = $this->input->post('email');
		$admins = $this->db->query("SELECT * FROM `admins` WHERE `email`='" . $email . "'")->result_array();
		if (sizeof($admins) > 0) {
			echo json_encode(array(
				'response_code' => -1
			));
		} else {
			$this->db->query("INSERT INTO `admins` (`email`) VALUES ('" . $email . "')");
			echo json_encode(array(
				'response_code' => 1
			));
		}
	}
	
	public function add_user() {
		$email = $this->input->post('email');
		$users = $this->db->query("SELECT * FROM `users` WHERE `email`='" . $email . "'")->result_array();
		if (sizeof($users) > 0) {
			echo json_encode(array(
				'response_code' => -1
			));
		} else {
			$this->db->query("INSERT INTO `users` (`email`) VALUES ('" . $email . "')");
			echo json_encode(array(
				'response_code' => 1
			));
		}
	}
	
	public function add_pejabat_batalyon() {
		$name = $this->input->post('name');
		$category = $this->input->post('category');
		$page = $this->input->post('page');
		$officials = $this->db->query("SELECT * FROM `officials` WHERE `name`='" . $name . "'")->result_array();
		if (sizeof($officials) > 0) {
			echo json_encode(array(
				'response_code' => -1
			));
		} else {
			$this->db->query("INSERT INTO `officials` (`name`, `category`, `page`) VALUES ('" . $name . "', '" . $category . "', " . $page . ")");
			echo json_encode(array(
				'response_code' => 1
			));
		}
	}
	
	public function delete_admin() {
		$id = $this->input->post('id');
		$this->db->query("DELETE FROM `admins` WHERE `id`=" . $id);
	}
	
	public function delete_user() {
		$id = $this->input->post('id');
		$this->db->query("DELETE FROM `users` WHERE `id`=" . $id);
	}
	
	public function delete_pejabat_batalyon() {
		$id = $this->input->post('id');
		$this->db->query("DELETE FROM `officials` WHERE `id`=" . $id);
	}
	
	public function delete_alarm() {
		$id = $this->input->post('id');
		$this->db->query("DELETE FROM `alarms` WHERE `id`=" . $id);
	}
	
	public function delete_document() {
		$id = $this->input->post('id');
		$path = $this->db->query("SELECT * FROM `documents` WHERE `id`=" . $id)->row_array()['path'];
		$this->db->query("DELETE FROM `documents` WHERE `id`=" . $id);
		unlink("userdata/" . $path);
	}
	
	public function save_ig_page() {
		$url = $this->input->post('url');
		$this->db->query("UPDATE `settings` SET `profil_satuan_ig_page`='" . $url . "'");	
	}
	
	public function get_alarms() {
		echo json_encode($this->db->query("SELECT * FROM `alarms`")->result_array());
	}
	
	public function add_alarm() {
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$ringtone = $this->input->post('ringtone');
		$this->db->query("INSERT INTO `alarms` (`title`, `description`, `ringtone`) VALUES ('" . $title . "', '" . $description . "', " . $ringtone . ")");
	}
	
	public function update_alarm() {
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$ringtone = $this->input->post('ringtone');
		$this->db->query("UPDATE `alarms` SET `title`='" . $title . "', `description`='" . $description . "', `ringtone`=" . $ringtone . " WHERE `id`=" . $id);
	}
	
	public function get_documents() {
		echo json_encode($this->db->query("SELECT * FROM `documents`")->result_array());
	}
	
	public function add_document() {
		$title = $this->input->post('title');
		$config = array(
			'upload_path' => './userdata/',
			'allowed_types' => "*",
			'overwrite' => TRUE
		);
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('document')) {
			$this->db->insert('documents', array(
				'title' => $title,
				'path' => $this->upload->data()['file_name']
			));
		} else {
			echo json_encode($this->upload->display_errors());
		}
	}
	
	public function login_with_google() {
		$email = $this->input->post('email');
		$admins = $this->db->query("SELECT * FROM `admins` WHERE `email`='" . $email . "'")->result_array();
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
	
	public function turn_on_alarm() {
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$ringtone = intval($this->input->post('ringtone'));
		FCM::send_notification_to_topic("", "", "alarm", array(
			'type' => 'alarm_on',
			'title' => $title,
			'description' => $description,
			'ringtone' => "" . $ringtone
		));
	}
	
	public function turn_off_alarm() {
		FCM::send_notification_to_topic("", "", "alarm", array(
			'type' => 'alarm_off'
		));
	}
	
	public function update_pejabat_batalyon() {
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$category = $this->input->post('category');
		$profilePictureChanged = intval($this->input->post('profile_picture_changed'));
		if ($profilePictureChanged == 1) {
			$config = array(
				'upload_path' => './userdata/',
				'allowed_types' => "*",
				'overwrite' => TRUE
			);
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('file')) {
				$this->db->where('id', $id);
				$this->db->update('officials', array(
					'name' => $name,
					'category' => $category,
					'profile_picture' => $this->upload->data()['file_name']
				));
			} else {
				echo json_encode($this->upload->display_errors());
			}
		} else {
			$this->db->where('id', $id);
			$this->db->update('officials', array(
				'name' => $name,
				'category' => $category
			));
		}
	}
}
