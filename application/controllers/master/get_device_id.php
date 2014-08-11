<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Get_device_id extends CI_Controller
{
	private $pageName = 'master/get_device_id';
	private $user = null;

	public function __construct()
	{
		parent::__construct ();
		$this->load->model('utils/check_user', 'check');
		$this->user = $this->check->validate();
		$this->check->permission($this->pageName);
	}

	public function index()
	{
		$this->load->model('mserver');
		$serverResult = $this->mserver->read();
		for($i=0; $i<count($serverResult); $i++)
		{
			$server = json_decode($serverResult[$i]->server_ip);
			$serverResult[$i]->server_port = '6089';
			$serverResult[$i]->server_ip = $server[0]->ip;
		}
		
		$data = array(
			'admin'				=>	$this->user,
			'page_name'			=>	$this->pageName,
			'server_result'		=>	$serverResult
		);
		$this->render->render($this->pageName, $data);
	}
	
	public function lists()
	{
		$this->load->model('utils/connector');
		$this->load->model('utils/return_format');
		
		$ip = $this->input->post('serverIp');
		$nickname = $this->input->post('nickname');
		
		if(!empty($ip) && !empty($nickname))
		{
			$parameter = array(
					'nkm'		=>	$nickname
			);
			
			$result = $this->connector->post($ip . '/ser_get_device_id', $parameter, FALSE);
			echo $result;
		}
	}
}

?>