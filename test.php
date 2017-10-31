<?php
use lampol\Mail;

require 'vendor/autoload.php';

//现在只支持SMTP


//debug  0 关闭  2开启 默认关闭
//secure  开启加密  ssl  和 tls 两个 默认 tls
//port   端口  默认 25
//emailName  email 地址    必传
//emailPass  email 密码    必传
//host       email 服务器  必传

$config = ['emailName'=>'你的邮箱地址','emailPass'=>'密码','host'=>'smtp.163.com'];

//$to 收件人邮箱     必选
//$subject 邮件主题  必选
//$content 邮件内容  必选
//$attachPath 附件路径  /tmp/file.php 可选
//sendMail($to,$subject,$content)
//
//成功返回数据
//{"status":"success","info":"发送成功"}

$mail = new Mail($config,true);
$res = $mail->sendMail('收邮件的地址','邮件主题','邮件内容','附件地址');
echo $res;


