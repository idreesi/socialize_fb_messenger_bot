<?php
/**
 * Created by IntelliJ IDEA.
 * User: Edris
 * Date: 9/7/2016
 * Time: 6:06 PM
 */
/*$rec =  file_get_contents('php://input');
if(!empty($rec)) {
    $count = file_get_contents('fb.txt');
    if(is_numeric($count)) {
        $count++;
        file_put_contents('fb.txt', $count);
    } else {
        file_put_contents('fb.txt', 0);
    }
}*/
file_put_contents('fb.txt', file_get_contents('php://input'));
$response = file_get_contents('fb.txt');
//$response = '{"object":"page","entry":[{"id":"1090235634364764","time":1473256954637,"messaging":[{"sender":{"id":"1200858053291224"},"recipient":{"id":"1090235634364764"},"timestamp":1473256954532,"message":{"mid":"mid.1473256954511:7e40d6422dc151e234","seq":27,"text":"test"}}]}]}';
//echo $response; exit;
/*$replies = array(
    'hi' => array(
        'Hello',
        'Hi',
        'Hey'
    ),
    'other' => array(
        'Don\'t know what to say',
        'Didn\'t get you'
    )
);*/
$response = json_decode($response);
if(!empty($response)) {
    $page_access_token = 'EAABps72rEZB0BAIe07ac3tnozPQVZCDig5k5te5UZAAZBWY6S0OyYtnqfpx1N4EOepzmEKemsHfoBHvccs1zNFRqejm3aaPf7luNG16tpy5S9sL27JdAtFI1y3y7Cyf6QejZBtIw41QAM0kx3OZAVEniXBycuPhg4gMtO6Oz5z9AZDZD';
    $send_message_url = 'https://graph.facebook.com/v2.6/me/messages?access_token=' . $page_access_token;
    foreach ($response->entry as $entry) {
        foreach ($entry->messaging as $message_detail) {
            $sender_id = $message_detail->sender->id;
            if( isset($message_detail->message->text) && !empty($message_detail->message->text) ) {
                $message_text = $message_detail->message->text;
                if (strtolower($message_text) == 'hi') {
                    $reply_message = 'Hi too';
                } else if (!empty($message_text)) {
                    $reply_message = 'Don\'t know what to say';
                }

                $send_message = array(
                    'recipient' => array(
                        'id' => $sender_id
                    ),
                    'message' => array(
                        'text' => $reply_message
                    )
                );

                do_post($send_message_url, $send_message);
            }
        }
    }
}
function do_post($url,$data) {
    $data_json = json_encode($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response  = curl_exec($ch);
    //file_put_contents('fb.txt',json_encode($response));
    curl_close($ch);
}