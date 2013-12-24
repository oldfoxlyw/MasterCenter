<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct ();
	}
	
	public function index()
	{
		$redirectUrl = $this->input->get('redirect', TRUE);

		$this->load->model('utils/check_user', 'check');
		$user = $this->check->validate(false);
		if(!empty($user))
		{
			if(!empty($redirectUrl))
			{
				redirect(urldecode($redirectUrl));
			}
			else
			{
				redirect('index');
			}
		}
		else
		{
			$this->load->view('login');
		}
	}
	
	public function submit()
	{
		$redirectUrl = $this->input->post('redirect', TRUE);
		$accountName = $this->input->post('accountName', TRUE);
		$accountPass = $this->input->post('accountPass', TRUE);
		$cookieRemain = $this->input->post('cookieRemain', TRUE);
		$isAjaxRequest = $this->input->post('isAjaxRequest', TRUE);
		
		if(!empty($accountName) && !empty($accountPass))
		{
			$this->load->model('madmin');
			$this->load->helper('security');
				
			$parameter = array(
					'user_name'			=>	$accountName,
					'user_pass'			=>	encrypt_pass($accountPass)
			);
			$result = $this->madmin->read($parameter);
				
			if($result === FALSE)
			{
				showMessage(MESSAGE_TYPE_ERROR, 'USER_INVALID', '', 'login?redirect=' . $redirectUrl, true, 5);
			}
			else
			{
				$row = $result[0];
				$cookie = array(
						'admin_id'			=>		$row->GUID,
						'admin_name'		=>		$accountName,
						'user_founder'		=>		$row->user_founder
				);
				$cookieStr = json_encode($cookie);
				$cookieStr = _authcode($cookieStr, 'ENCODE');
		
				$this->load->helper('cookie');
				$cookie = array(
						'name'		=> 'admin',
						'value'		=> $cookieStr,
						'expire'		=> $this->config->item('cookie_expire'),
						'domain'	=> $this->config->item('cookie_domain'),
						'path'		=> $this->config->item('cookie_path'),
						'prefix'		=> $this->config->item('cookie_prefix')
				);
				if($cookieRemain=='1') {
					$cookie['expire'] = strval(intval($this->config->item('cookie_expire')) * 30);
				}
				$this->input->set_cookie($cookie);
				 
				$this->madmin->update($row->admin_id, array(
						'admin_lastlogin'	=>	time()
				));
				 
				$redirectUrl = empty($redirectUrl) ? 'index' : $redirectUrl;
				showMessage(MESSAGE_TYPE_SUCCESS, 'USER_LOGIN_SUCCESS', $result, $redirectUrl, true, 5);
			}
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'USER_LOGIN_ERROR_NO_PARAM', '', 'login?redirect=' . $redirectUrl, true, 5);
		}
	}
	
	public function out()
	{
		$this->load->helper('cookie');
	
		$cookie = array(
			'name'		=> 'admin',
			'domain'	=> $this->config->item('cookie_domain'),
			'path'		=> $this->config->item('cookie_path'),
			'prefix'	=> $this->config->item('cookie_prefix')
		);
		delete_cookie($cookie);
		showMessage(MESSAGE_TYPE_SUCCESS, 'USER_LOGOUT', '退出成功', 'login', true, 5);
	}
}

?>