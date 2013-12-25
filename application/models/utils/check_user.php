<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Check_user extends CI_Model {
	
	private $user = null;
	public function __construct() {
		parent::__construct();
	}
	
	public function validate($redirect = true)
	{
		$this->load->helper('security');
		$this->load->helper('cookie');
		$redirectUrl = 'login?redirect=' . urlencode($this->input->server('REQUEST_URI'));
		$cookieName = $this->config->item('cookie_prefix') . 'admin';
		if(!$this->input->cookie($cookieName, TRUE))
		{

			if($redirect)
				showMessage(MESSAGE_TYPE_ERROR, 'USER_CHECK_EXPIRED', '', $redirectUrl, true, 5);
			
		}
		else
		{
			$cookie = $this->input->cookie($cookieName, TRUE);
			$cookie = _authcode($cookie);
			$json = json_decode($cookie);
			$id = $json->admin_id;
			$parameter = array(
				'guid'	=>	$id
			);

			$this->load->model('madmin');
			$result = $this->madmin->read($parameter);
			if($result != FALSE)
			{
				$this->user = $result[0];

				$parameter = array(
						'permission_level'	=>	$this->user->permission_level
				);
				$this->load->model('mpermission');
				$this->load->helper('object');
				$permissionResult = $this->mpermission->read($parameter);
				if(!empty($permissionResult))
				{
					$this->user = merge_object($permissionResult[0], $this->user);
				}
				return $this->user;
			}
			else
			{
				$this->resetCookie();
				if($redirect)
				{
					showMessage(MESSAGE_TYPE_ERROR, 'USER_CHECK_INVALID', '', $redirectUrl, true, 5);
				}
			}
		}
	}
	
	public function permission($permissionName)
	{
		if(!empty($this->user))
		{
			$permissionArray = explode(',', $this->user->permission_list);
			if(!in_array($permissionName, $permissionArray) && !in_array('All', $permissionArray))
			{
				showMessage(MESSAGE_TYPE_ERROR, 'USER_NO_PERMISSION', '', '', false);
			}
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'ERROR_NO_USER', '', '', false);
		}
	}
	
	private function resetCookie()
	{
		$this->load->helper('cookie');
		$cookie = array(
			'name'		=> 'admin',
			'domain'	=> $this->config->item('cookie_domain'),
			'path'		=> $this->config->item('cookie_path'),
			'prefix'	=> $this->config->item('cookie_prefix')
		);
		delete_cookie($cookie);
	}
}
?>