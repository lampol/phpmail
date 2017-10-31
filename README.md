# this is send mail by PHP

### only support SMTP

#### HOW TO USE

```
use lampol\Mail;

$config = [
	'emailName'=>'test@qq.com',
	'emailPass'=>'testtest',
	'host'     =>'smtp.163.com'
];

//debug  0 关闭  2开启 默认关闭
//secure  开启加密  ssl  和 tls 两个 默认 tls
//port   端口  默认 25
//emailName  email 地址    必传
//emailPass  email 密码    必传
//host       email 服务器  必传

$mail = new Mail($config,true); //第二个参数是开启异常默认关闭

//$to 收件人邮箱     必选
//$subject 邮件主题  必选
//$content 邮件内容  必选
//$attachPath 附件路径  /tmp/file.p

$res = $mail->sendMail($to,$subject,$content,$attachPath) //第四个参数是发送附件 可以不带此参数  

发送成功后返回

$res = {"status":"success","info":"发送成功"}


```
