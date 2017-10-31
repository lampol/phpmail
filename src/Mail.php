<?php
//=======================================================
//                Hello World
//
//
//
//======================================================

namespace lampol;
use lampol\Exception;


class Mail extends PHPMailer{
	
	protected $errMsg='';


	//初始化发送的配置
	public function __construct($options,$exception=false){
		if(!array_key_exists('emailName',$options)||!array_key_exists('emailPass',$options)||!array_key_exists('host',$options)){
			$res = ['status'=>'fail','info'=>'必须传入参数emailName,emailPass,host'];
			$this->errMsg =  json_encode($res,JSON_UNESCAPED_UNICODE);
		}
		parent::__construct($exception);
		isset($options['debug'])?$this->SMTPDebug=$options['debug']:0;                    
		$this->isSMTP();                         
		$this->Host = $options['host'];;            
		$this->SMTPAuth = true;                  
		$this->Username = $options['emailName']; 
		$this->Password = $options['emailPass'];            
		isset($options['secure'])?$this->SMTPSecure=$options['secure']:'tls';              
		isset($options['port'])?$this->Port=$options['port']:25;                        
		$this->setFrom($options['emailName']);      

	}

	//发送邮件
	public function sendMail($to,$subject,$content,$attachPath=''){
		if($this->errMsg!=''){
			return $this->errMsg;
		}
		if($to==''||$subject==''||$content==''){
			$res = ['status'=>'fail','info'=>'发送人,发送主题,发送内容不能为空'];
			return json_encode($res,JSON_UNESCAPED_UNICODE);
		}
		$this->addAddress($to);
		if($attachPath!=''){
			if(file_exists($attachPath)){
				$this->addAttachment($attachPath);
			}else{
				$res = ['status'=>'fail','info'=>'附件不存在'];
				return json_encode($res,JSON_UNESCAPED_UNICODE);
			}
		}
		$this->isHTML(true);                         
		$this->Subject = $subject;              
		$this->Body    = $content;
		try{
			$this->send();		
			$res = ['status'=>'success','info'=>'发送成功'];
		}catch (Exception $e) {
			$res = ['status'=>'fail','info'=>$this->ErrorInfo];
		}
		return json_encode($res,JSON_UNESCAPED_UNICODE);
	
	}


} 
