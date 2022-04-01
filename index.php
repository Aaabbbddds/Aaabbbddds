<?php 
/**
 *Author: Tilon
 *
 *Telegram : @TILON
 */
$API_KEY = '5102454298:AAFtasDA-yaCJxCjO07uz3eetkvWvaNzPz8';
##------------------------------##
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
 
 function sendaction($chat_id, $action){
 bot('sendchataction',[
 'chat_id'=>$chat_id,
 'action'=>$action
 ]);
 }
 //====================ᵗᶦᵏᵃᵖᵖ======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$m = $message->message_id;
$text = $message->text;
//====================ᵗᶦᵏᵃᵖᵖ======================//
if($text=="/start" or $text=="/start@$botname" or $text=="/Start@$botname" or $text=="$botname" or $text=="/Start" or $text=="/START"){
bot('sendMessage',[
'chat_id'=>$chat_id,
    'message_id'=>$m,
'text'=>"*👋 Salom men guruhlarda kirdi-chiqdi xabarlarni oʻchiruvchi botman!*
*Istasangiz meni o'z guruhingizga qo'shing ✅*",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
  'inline_keyboard'=>[
    [['text'=>"➕ Guruhga Qo'shish",'url'=>"http://t.me/$botname?startgroup=new"]]
    ]]);
]);
}
if($update->message->leaveChat or $update->message->new_chat_member or $update->message->new_chat_photo or $update->message->new_chat_title or $update->message->left_chat_member or $update->message->pinned_message){
    bot('deleteMessage',[
        'chat_id'=>$chat_id,
        'message_id'=>$m,
    ]);
}

if(preg_match('/^\/([Ss]tart)/',$text)){
$start_time = round(microtime(true) * 1000);
      $send=  bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' =>"Tezlik:",
            ])->result->message_id;
        
                    $end_time = round(microtime(true) * 1000);
                    $time_taken = $end_time - $start_time;
                    bot('editMessagetext',[
                        "chat_id" => $chat_id,
                        "message_id" => $send,
                        "text" => "Tezlik:" . $time_taken . "ms",
                    ]);
}
/*

*/

?>
