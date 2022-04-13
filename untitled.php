<?php

define('API_KEY',"5102454298:AAFtasDA-yaCJxCjO07uz3eetkvWvaNzPz8"); 

$admin = "644753244";
//$host_folder = "https://umidcoder.hosbig.ru/oddiy";
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


$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$type = $message->chat->type;
$name = $message->from->first_name;


$user = $message->from->username;
$botname = bot('getme',['bot'])->result->username;
$cid = $message->from->id;
$text = $message->text;
$mid = $update->message->message_id;
$chat_id = $update->message->chat->id;

if(isset($update->callback_query)){
$callback = $update->callback_query;
$data = $callback->data;
$cid = $update->callback_query->from->id;
$callid = $callback->id;
$chat_id = $update->callback_query->message->chat->id;
$mid = $update->callback_query->message->message_id;
}
date_default_timezone_set("asia/Tashkent");
$sana = date('d.m.Y');
$soat = date('H:i:s');

mkdir("baza");
function replyKeyboard($keyboard) {
return json_encode([
'resize_keyboard'=>true,
'keyboard'=> $keyboard
]);
}
$menu = replyKeyboard([
[['text'=>"Microsoft Word"],['text'=>"Microsoft Excel"]],
[['text'=>"Microsoft Access"],['text'=>"Microsoft PowerPoint"]],
[['text'=>"Sistema o'rnatish"]],
]);
$menua = replyKeyboard([
[['text'=>"Microsoft Word"],['text'=>"Microsoft Excel"]],
[['text'=>"Microsoft Access"],['text'=>"Microsoft PowerPoint"]],
[['text'=>"Sistema o'rnatish"]],
[['text'=>"⚙️ Xabar"],['text'=>"📊 Statistika"]],
]);
$menup = replyKeyboard([
[['text'=>"Xabar yuborish📬"],['text'=>"Forward yuborish🚀"]],
[['text'=>"Blok⛔️"],['text'=>"UnBlok✅"]],
[['text'=>"◀️ Orqaga"]],
]);

$get = file_get_contents('baza/baza.txt');

if($type=="private"){
  if ($text == "/start"){
  if($cid != $admin){
    if(mb_stripos($get,$cid)==false){
      bot('sendMessage',[
        'chat_id' => $cid,
        'text'=>"*✌️ Salom *[$name](tg://user?id=$cid)!
        
 * ✋ Botga xush kelibsiz!*",   
   'parse_mode'=>'markdown',
            "reply_to_message_id"=>$mid,
    'reply_markup'=>$menu,
    ]);file_put_contents("baza/baza.txt","$get\n$cid");
    
}else{
  bot('sendMessage',[
      'chat_id'=>$update->message->chat->id,
      'text'=>"<b>🖥 Bosh Menyu</b>",
      'parse_mode'=>'html',
      'reply_markup'=>$menu,
      ]);
  
}
    
  }
      }
  
}

if($text=="Microsoft Word"){
  bot('sendmessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'reply_markup'=>"html",
    ]);
}
if($text=="Microsoft Excel"){
  bot('sendmessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'reply_markup'=>"html",
    ]);
}
if($text=="Microsoft Access"){
  bot('sendmessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'reply_markup'=>"html",
    ]);
}
if($text=="Microsoft PowerPoint"){
  bot('sendmessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'reply_markup'=>"html",
    ]);
}
if($text=="Sistema o'rnatish"){
  bot('sendmessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'reply_markup'=>"html",
    ]);
}

if($text=="⚙️ Xabar"){
  bot('sendmessage',[
    'chat_id'=>$cid,
    'text'=>"<b>Tugmalardan birini tanlang!</b>",
    'reply_markup'=>"html",
    'reply_markup'=>$menup,
    ]);
}

if($text=="◀️ Orqaga"){
  if($cid == $admin2 or $cid == $admin){
  file_put_contents("baza/admin$cid","");
file_put_contents("baza/button$cid", "");
file_put_contents("baza/post$cid", "");
  bot('sendmessage',[
    'chat_id'=>$cid,
      'text'=>"<b>🖥 Bosh Menyu</b>",
      'parse_mode'=>'html',
      'reply_markup'=>$menua,
    ]);
}
}


if($text == "Xabar yuborish📬"){
if($cid == $admin2 or $cid == $admin){
  bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"Xabarni yuboring📨",
    'reply_markup'=>json_encode([
      'resize_keyboard'=>true,
      'keyboard'=>[
        [['text'=>"Bekor qilish❎"]],
        ]
      ])
    ]);
  file_put_contents("baza/admin$cid","post");
}
}
$adminsb = file_get_contents("baza/button$cid");
$adminf = file_get_contents("baza/admin$cid");
if($adminf == "post" and $text !="Xabar yuborish📬" and $text != "⚖ Statistika" and $text != "/start" and $text != "FORWORD"  and $text != "Bekor qilish❎"){
   bot('copyMessage',[ 
      'chat_id'=>$cid, 
      'from_chat_id'=>$cid, 
      'message_id'=> $message->message_id
      ]);
    file_put_contents("baza/post$cid",$message->message_id);
bot("sendMessage",[
  'chat_id'=>$cid,
  'text'=>"Nima qilamiz?",
  'reply_markup'=>json_encode([
    'resize_keyboard'=>true,
    'keyboard'=>[
      [['text'=>"Yuborish✅"],['text'=>"URL"]],[['text'=>"Bekor qilish❎"]],
      ]
    ])
  ]);
file_put_contents("baza/admin$cid","message");
}

if($text == "Yuborish✅" and $adminf == "message"){
$adminsb = file_get_contents("baza/button$cid");
if($adminsb == ""){
file_put_contents("baza/admin$cid","");
bot("sendMessage",[
  'chat_id'=>$cid,
  'text'=>"Yuborayapman⏫",
  'reply_markup'=>$menup,
  ]);
 $azaler=file_get_contents("baza/baza.txt"); 
      $cidszs=explode("\n",$azaler); 
      foreach($cidszs as $cidlat){
   $send =  bot('copyMessage',[ 
      'chat_id'=>$cidlat, 
      'from_chat_id'=>$cid, 
      'message_id'=> file_get_contents("baza/post$cid")]);
$res = $send->ok;
if($res == 'true'){
    $i++;
}
}

 send($cid, "Post $i odamlarga yuborildi✔️");
 file_put_contents("baza/button$cid", "");
}elseif($adminsb != ""){
file_put_contents("baza/admin$cid","");
bot("sendMessage",[
  'chat_id'=>$cid,
  'text'=>"Yuborayapman⏫",
  'reply_markup'=>$menup,
  ]);
 $cidss=file_get_contents("baza/baza.txt"); 
      $cidszs=explode("\n",$cidss); 
      foreach($cidszs as $cidlat){
   $sendd =  bot('copyMessage',[ 
      'chat_id'=>$cidlat, 
      'from_chat_id'=>$cid, 
      'message_id'=>file_get_contents("baza/post$cid"),
      'reply_markup'=>$adminsb,
      ]);
$ress = $sendd->ok;
if($ress == 'true'){
    $ii++;
}
}
send($cid, "Post $ii odamlarga yuborildi✔️");
file_put_contents("baza/button$cid", "");
}
}
if($text == "URL" and $adminf == "message"){
  bot("sendMessage",[
    'chat_id'=>$cid,
    'text'=>"URL BUTTON yuboringA\nNamuna:\nTest = URL",
    'reply_markup'=>json_encode([
      'resize_keyboard'=>true,
      'keyboard'=>[
        [['text'=>"◀️ Orqaga"]]
        ]
      ])
      
    ]);
file_put_contents("baza/admin$cid","URL");
}
if(isset($text) and $text !="◀️ Orqaga" and $adminf == "URL"){
$text = explode(" = ", $text);
  file_put_contents("baza/button$cid", json_encode([
  'inline_keyboard'=>[
    [['text'=>$text[0],'url'=>$text[1]]],
    ]
  ]));
file_put_contents("baza/admin$cid","message");
bot("sendMessage",[
  'chat_id'=>$cid,
  'text'=>"Nima qilamiz?",
  'reply_markup'=>json_encode([
    'resize_keyboard'=>true,
    'keyboard'=>[
      [['text'=>"Yuborish✅"],['text'=>"URL"]],[['text'=>"Bekor qilish❎"]]
      ]
    ])
  ]);
}

if($text == "Bekor qilish❎"){
if($cid == $admin2 or $cid == $admin){
  file_put_contents("baza/post$cid","");
file_put_contents("baza/admin$cid","");
file_put_contents("baza/button$cid", "");
bot("sendMessage",[
  'chat_id'=>$cid,
  'text'=>"Admin",
  'reply_markup'=>$menup,
  ]);
}}

if($text == "Forward yuborish🚀"){
if($cid == $admin2 or $cid == $admin){
  bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"Xabarni yuboring📨",
    'reply_markup'=>json_encode([
      'resize_keyboard'=>true,
      'keyboard'=>[
        [['text'=>"Bekor qilish❎"]]
        ]
      ])
    ]);
  file_put_contents("baza/admin$cid","forword");
}
}
if($adminf == "forword" and $text !="Xabar yuborish📬" and $text != "◀️ Orqaga" and $text != "/start" and $text != "FORWORD"  and $text != "Bekor qilish❎"){ 
  bot('forwardMessage',[ 
      'chat_id'=>$cid, 
      'from_chat_id'=>$cid, 
      'message_id'=> $message->message_id
      ]);
    file_put_contents("baza/post$cid",$message->message_id);
bot("sendMessage",[
  'chat_id'=>$cid,
  'text'=>"Nima qilamiz?",
  'reply_markup'=>json_encode([
    'resize_keyboard'=>true,
    'keyboard'=>[
      [['text'=>"Yuborish✅"]],[['text'=>"Bekor qilish❎"]]
      ]
    ])
  ]);
file_put_contents("baza/admin$cid","fmessage");
}
if($text == "Yuborish✅" and $adminf == "fmessage"){
file_put_contents("baza/admin$cid","");
bot("sendMessage",[
  'chat_id'=>$cid,
  'text'=>"Yuborayapman⏫",
  'reply_markup'=>$menup,
  ]);
   $cidss=file_get_contents("baza/baza.txt"); 
      $cidszs=explode("\n",$cidss); 
      foreach($cidszs as $cidlat){
   $send =  bot('forwardMessage',[ 
      'chat_id'=>$cidlat, 
      'from_chat_id'=>$cid, 
      'message_id'=> file_get_contents("baza/post$cid"),
      
      ]);
$res = $send->ok;
if($res == 'true'){
    $i++;
}
}
send($cid, "Post $i odamlarga yuborildi✔️");
}
$reply = $message->reply_to_message->text;
$rpl = json_encode([
            'resize_keyboard'=>false,
            'force_reply'=>true,
            'selective'=>true
        ]);
        
$blocks = file_get_contents("baza/Blokid.txt");
if($type=="private"){
if($text=="Blok⛔️" and $cid==$admin){
  if($cid == $admin2 or $cid == $admin){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"Blok Qilinadigan 🆔️ni Yuboring!",
'reply_markup'=>$rpl,
]);
}
}}

if($reply=="Blok Qilinadigan 🆔️ni Yuboring!"){
if ($text != '' and $text != '644753244' and $text != "/start" and $text != "◀️ Orqaga"){
  if(mb_stripos($get,$cid)==false){
  file_put_contents("baza/Blokid.txt","$blocks\n$text");
  $user = bot("getchat",[
'chat_id'=>$text,
]);
$username1 = $user->result->username;
$nik = $user->result->first_name;
bot('SendMessage',[
   'chat_id'=>$admin,
        'text'=>"✅[ $nik ](tg://user?id=$text) *Bloklandi!*", 
        'parse_mode'=>'markdown', 
'reply_markup'=>$menup,
        ]);
        bot('SendMessage',[
   'chat_id'=>$text,
        'text'=>"<b>Siz botdan bloklandingiz!</b>", 
        'parse_mode'=>'html', 
        'reply_markup'=>json_encode([
'remove_keyboard'=>true,
]),
]);
}else{
  bot('SendMessage',[
   'chat_id'=>$admin,
        'text'=>"*Afsuski bot aʼzolari roʻyxati orasida* $text *yoʻq* ", 
        'parse_mode'=>'markdown', 
'reply_markup'=>$menup,
        ]);
}}}

if($type=="private"){
if($text == "UnBlok✅" ){
  if($cid == $admin2 or $cid == $admin){
bot('sendmessage', [
      'chat_id' =>$cid,
       'text' => "Blockdan Olinadigan 🆔️ni Yozing!" ,
       'parse_mode'=>'markdown',  
       'reply_markup' => $rpl,
       ]);
       }}}

       if($reply == "Blockdan Olinadigan 🆔️ni Yozing!"){  
         if ($text != '' and $text != '644753244' and $text != "/start" and $text != "ADMIN PANEL" and $text != "◀️ Orqaga"){
if(mb_stripos($get,$cid)==false){
$fayl = file_get_contents("baza/Blokid.txt");
$fayl2 = "$text";
$fayl3 = str_replace($fayl2,"",$fayl);
file_put_contents("baza/Blokid.txt","$fayl3");
$fayl = file_get_contents("baza/Blokid.txt");
$user = bot("getchat",[
'chat_id'=>$text,
]);
$username1 = $user->result->username;
$nik = $user->result->first_name;
bot('sendmessage', [
      'chat_id' =>$cid,
       'text' => "[ $nik ](tg://user?id=$text) Blokdan olindi" ,
       'parse_mode'=>'markdown', 
       'reply_markup'=>$menup,
      ]); 
      bot('sendmessage', [
      'chat_id' =>$text,
       'text' => "*Salom  [$nik](tg://user?id=$text) siz Blokdan olindingiz!*" ,
       'parse_mode'=>'markdown', 
       'reply_markup'=>$menu,
       ]);
}else{
  bot('SendMessage',[
   'chat_id'=>$admin,
        'text'=>"*Afsuski bot aʼzolari roʻyxati orasida* $text *yoʻq* ", 
        'parse_mode'=>'markdown', 
'reply_markup'=>$menup,
        ]);
}}}


if($text == "📊 Statistika" ){

    $us = file_get_contents("baza/baza.txt");
    $uscount = substr_count($us, "\n");
    $bl = file_get_contents("baza/Blokid.txt");
    $blcount = substr_count($bl, "\n");
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"📊 Statistika\n\nBot a'zolari soni: *$uscount* ta \n Bloklanganlar: *$blcount* ta \n\n $sana $soat",
    
    'reply_markup'=>json_encode(['inline_keyboard'=>[
    [['text'=>"Yangilash 🆙",'callback_data'=>"statup"]],
    ]
  ])
    ]);
}
if($data=="statup"){
  $us = file_get_contents("baza/baza.txt");
    $uscount = substr_count($us, "\n");
    $bl = file_get_contents("baza/Blokid.txt");
    $blcount = substr_count($bl, "\n");
      bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid,
]);
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"📊 Statistika\n\nBot a'zolari soni: *$uscount* ta \n Bloklanganlar: *$blcount* ta \n\n $sana $soat",
    
    'reply_markup'=>json_encode(['inline_keyboard'=>[
    [['text'=>"Yangilash 🆙",'callback_data'=>"statup"]],
    ]
  ])
    ]);
}
$getss = file_get_contents("baza/Blokid.txt");
if(mb_stripos($getss, $cid) !== false){
bot('sendMessage',[
'chat_id' => $cid,
'text' => "Kechirasiz <b>$name</b> siz bloklangansiz!",
'parse_mode'=>'html',
        'reply_markup'=>json_encode([
'remove_keyboard'=>true,
]),
]); 
return false;
}