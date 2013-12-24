<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Connector extends CI_Model {
	private $platformPath = null;
	private $enableSSL = false;
	private $originPath = null;
	
	public function __construct() {
		parent::__construct();
		$this->platformPath = $this->config->item('platform_path');
		$lastChar = substr($this->platformPath, -1, 1);
		if($lastChar!='/' && $lastChar!="\\") {
			$this->platformPath .= '/';
		}
		$this->enableSSL = $this->config->item('enable_ssl');
		$this->originPath = $this->enableSSL ? 'https://' : 'http://';
		$this->originPath .= $this->platformPath;
	}

	public function get($controller, $parameter, $parsePath = true) {
		if(!empty($controller)) {
			if($parsePath)
			{
				$postPath = $this->originPath . $controller;
			}
			else
			{
				$postPath = $controller;
			}
			
			if(!empty($parameter))
			{
				$parameter['code'] = $this->hash($parameter);
			}
				
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $postPath . '?' . $this->getQueryString($parameter));
			$ip = $this->input->ip_address();
			$header = array(
				'CLIENT-IP:' . $ip,
				'X-FORWARDED-FOR:' . $ip,
			);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
				
			if($this->enableSSL) {
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			}
				
			$monfd = curl_exec($ch);
				
			curl_close($ch);
				
			return $monfd;
		} else {
			return false;
		}
	}
	
	public function post($controller, $parameter, $parsePath = true) {
		if(!empty($controller)) {
			if($parsePath)
			{
				$postPath = $this->originPath . $controller;
			}
			else
			{
				$postPath = $controller;
			}
			
			$parameter['code'] = $this->hash($parameter);
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $postPath);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $parameter);
			$ip = $this->input->ip_address();
			$header = array(
				'CLIENT-IP:' . $ip,
				'X-FORWARDED-FOR:' . $ip,
			);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
			
			if($this->enableSSL) {
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			}
			
			$monfd = curl_exec($ch);
			
			curl_close($ch);
			
			return $monfd;
		} else {
			return false;
		}
	}
	
	public function hash($parameter)
	{
		if(!empty($parameter)) {
			$authKey = $this->config->item('auth_key');
			$this->load->helper('security');
			$code = do_hash(implode('|||', $parameter) . '|||' . $authKey);
			return $code;
		} else {
			return NULL;
		}
	}
	
	public function getQueryString($parameter)
	{
		if(!empty($parameter) && is_array($parameter))
		{
			$temp = array();
			foreach($parameter as $key => $value)
			{
				array_push($temp, "{$key}={$value}");
			}
			return implode('&', $temp);
		}
	}
}
?>