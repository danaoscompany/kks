<?php

class FCM {

	public static function send_notification_to_topic_all_types($title, $body, $link, $imgURL, $topic, $data) {
		$url = 'https://fcm.googleapis.com/fcm/send';
	    $fields = array(
            'to' => '/topics/' . $topic,
            'notification' => array(
            	'title' => $title,
            	'body' => $body,
            	'click_action' => 'openlink',
            	'image' => $imgURL
            )
    	);
    	$data['link'] = $link;
    	if (sizeof($data) > 0) {
    		$fields['data'] = $data;
    	}
    	$fields = json_encode($fields);
    	$headers = array (
            'Authorization: key=' . "AAAAIQ4-2r0:APA91bHrs196pyE2xV3cwBhWUzE4Fe6EqC0NMFvLws3Wss3xgA_MV4NloxBAZyfOOcWne4sq6WUG871cggVykWHHR0KKcViWm32CipvzL4vhDbgCIUVgEQJiK3Py7Yh4ESlMCs4uaKRp",
            'Content-Type: application/json'
    	);
    	$ch = curl_init ();
    	curl_setopt ( $ch, CURLOPT_URL, $url );
    	curl_setopt ( $ch, CURLOPT_POST, true );
    	curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
	    $result = curl_exec ( $ch );
	    curl_close ( $ch );
	}

	public static function send_notification_to_topic($title, $body, $topic, $data) {
		$url = 'https://fcm.googleapis.com/fcm/send';
	    $fields = array(
            'to' => '/topics/' . $topic
    	);
    	if (sizeof($data) > 0) {
    		$fields['data'] = $data;
    	}
    	$fields = json_encode($fields);
    	$headers = array (
            'Authorization: key=' . "AAAAIQ4-2r0:APA91bHrs196pyE2xV3cwBhWUzE4Fe6EqC0NMFvLws3Wss3xgA_MV4NloxBAZyfOOcWne4sq6WUG871cggVykWHHR0KKcViWm32CipvzL4vhDbgCIUVgEQJiK3Py7Yh4ESlMCs4uaKRp",
            'Content-Type: application/json'
    	);
    	$ch = curl_init ();
    	curl_setopt ( $ch, CURLOPT_URL, $url );
    	curl_setopt ( $ch, CURLOPT_POST, true );
    	curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
	    $result = curl_exec ( $ch );
	    curl_close ( $ch );
	}

	public static function send_link_notification_to_topic($title, $body, $link, $topic, $data) {
		$url = 'https://fcm.googleapis.com/fcm/send';
	    $fields = array(
            'to' => '/topics/' . $topic,
            'notification' => array(
            	'title' => $title,
            	'body' => $body,
            	'click_action' => 'openlink'
            )
    	);
    	$data['link'] = $link;
    	if (sizeof($data) > 0) {
    		$fields['data'] = $data;
    	}
    	$fields = json_encode($fields);
    	$headers = array (
            'Authorization: key=' . "AAAAIQ4-2r0:APA91bHrs196pyE2xV3cwBhWUzE4Fe6EqC0NMFvLws3Wss3xgA_MV4NloxBAZyfOOcWne4sq6WUG871cggVykWHHR0KKcViWm32CipvzL4vhDbgCIUVgEQJiK3Py7Yh4ESlMCs4uaKRp",
            'Content-Type: application/json'
    	);
    	$ch = curl_init ();
    	curl_setopt ( $ch, CURLOPT_URL, $url );
    	curl_setopt ( $ch, CURLOPT_POST, true );
    	curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
	    $result = curl_exec ( $ch );
	    curl_close ( $ch );
	}

	public static function send_image_notification_to_topic($title, $body, $image, $topic, $data) {
		$url = 'https://fcm.googleapis.com/fcm/send';
	    $fields = array(
            'to' => '/topics/' . $topic,
            'notification' => array(
            	'title' => $title,
            	'body' => $body,
            	'image' => $image
            )
    	);
    	if (sizeof($data) > 0) {
    		$fields['data'] = $data;
    	}
    	$fields = json_encode($fields);
    	$headers = array (
            'Authorization: key=' . "AAAAIQ4-2r0:APA91bHrs196pyE2xV3cwBhWUzE4Fe6EqC0NMFvLws3Wss3xgA_MV4NloxBAZyfOOcWne4sq6WUG871cggVykWHHR0KKcViWm32CipvzL4vhDbgCIUVgEQJiK3Py7Yh4ESlMCs4uaKRp",
            'Content-Type: application/json'
    	);
    	$ch = curl_init ();
    	curl_setopt ( $ch, CURLOPT_URL, $url );
    	curl_setopt ( $ch, CURLOPT_POST, true );
    	curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
	    $result = curl_exec ( $ch );
	    curl_close ( $ch );
	}
}
