<?php
ob_start();
error_reporting(0);
define("bb",'5102454298:AAFtasDA-yaCJxCjO07uz3eetkvWvaNzPz8');
$admin = "644753244";
$botname = bot('getme',['bot'])->result->username;
$botid= bot('getme',['bot'])->result->id;



function bot($method, $datas=[]){
	$url = "https://api.telegram.org/bot".bb."/$method";
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


$update = json_decode(file_get_contents("php://input"));
$message = $update->message;
$mid = $message->message_id;
$cid = $message->chat->id;
$text = $message->text;
$type = $message->chat->type;
$title = $message->chat->title;
$uid = $message->from->id;
$uid2 = $update->callback_query->from->id;
$name = $message->chat->first_name;
$new = $message->new_chat_member;
$left = $message->left_chat_member;
$leftid = $message->left_chat_member->id;
$newid = $message->new_chat_member->id;
$newname = $message->new_chat_member->first_name;

$g = json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Guruhga Qoʻshish",'url'=>"http://t.me/$botname?startgroup=new"]],
]
]);


if($text == "/start" and $type == "private"){
	bot('sendmessage',[
	'chat_id'=>$cid,
'text'=>"*👋 Salom men guruhlarda kirdi-chiqdi xabarlarni oʻchiruvchi botman!*
*Istasangiz meni o'z guruhingizga qo'shing ✅*",
'parse_mode'=>'markdown',
	'reply_markup'=>$g,
]);
}

if($newid == $botid){
   bot('sendmessage',[
   'chat_id'=>$cid,
'text'=>"*👋 Salom men guruhlarda kirdi-chiqdi xabarlarni oʻchiruvchi botman!*
*Istasangiz meni o'z guruhingizga qo'shing ✅*",
'parse_mode'=>'markdown',
   'reply_markup'=>$g,
]);
}

//New Chat Member

if($new){
	if($newid == $uid){
    bot('DeleteMessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid,
]);

}
}

if($left){
  bot('DeleteMessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid,
]);
}

?>
