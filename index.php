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
$t = $message->text;
$m = $message->message_id;
$text = $message->text;
//====================ᵗᶦᵏᵃᵖᵖ======================//
if($text=="/start"){
bot('sendmessage', [
    'chat_id' => $chat_id,
    'text' =>"Tezlik:123",
]);
}
if($t=="/start" or $t=="/start@$botname" or $t=="/Start@$botname" or $t=="$botname" or $t=="/Start" or $t=="/START"){
bot('sendMessage',[
'chat_id'=>$chat_id,
    'message_id'=>$m,
'text'=>"*👋 Salom men guruhlarda kirdi-chiqdi xabarlarni oʻchiruvchi botman!*
*Istasangiz meni o'z guruhingizga qo'shing ✅*",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
  'inline_keyboard'=>[
    [['text'=>"➕ Guruhga Qo'shish",'url'=>"http://t.me/$botname?startgroup=new"]],
 ]]),   ]);
}
?>
