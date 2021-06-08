<?php
function sendNotification(){
        $json_data = [
                        "to" => 'cMHNIHpNSyygyO7Y4rKrcy:APA91bFioKfmurR93E-fSLpwzqOLx8RZvyxYUg8ib3YSEgqhAFhscqV78ElsK7vh9dJtcIBcV-cqEkNNKZSTqlmB6p5tq3XmMsFJp5wwSE9YeelmfbWCZbNdJ_3pNAGg0y_cPI5_py-X',
                        "notification" => [
                            "body" => "SOMETHING",
                            "title" => "SOMETHING",
                            "icon" => "ic_launcher"
                        ],
                    ];
       
        $data = json_encode($json_data);
        //FCM API end-point
        $url = 'https://fcm.googleapis.com/fcm/send';
        //api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
       // $server_key = 'AAAAfw86b34:APA91bE8LLO-l4CmJ5EMs0nYQrGf0iZr318xVzQItZXCpRsPqaNBddTdnPgbZEIUI-IiGJcHoOyQe1_fBNVnf6BF5oRIo-hxFGwGW440Smrj7Wcvyqrmr6rdrUr3MFgMB_X5h6htOLjB';
	   $server_key = "AAAABHxxyLk:APA91bFlPxe8uXXyd-Q4qrUhWXDWpxBRxJ9AjK_6UUy4YaPi-7IRr8DJTAKEr6ZjyWa6ubPuGV0EtxiiGVccZRjtvpBV_HmhDKw31foGNQj13EzOfXkYuP9caKrvJ4jlXf-TpcPhdAYk";
        //header with content_type api key
        $headers = array(
            'Content-Type: application/json',
            'Authorization: key='.$server_key
        );
        //CURL request to route notification to FCM connection server (provided by Google)
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
		print_r($result);
		exit();
        if ($result === FALSE) {
            die('Oops! FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
         
         //pr($ch).die;
    }
	sendNotification();
?>