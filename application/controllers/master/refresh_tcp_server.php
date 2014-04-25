<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Refresh_tcp_server extends CI_Controller
{
	private $pageName = 'master/refresh_tcp_server';
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
			if(intval($serverResult[$i]->account_server_id) >= 103)
			{
				$serverResult[$i]->server_port = '8089';
				$serverResult[$i]->server_ip = $server[0]->ip;
			}
			else
			{
				$serverResult[$i]->server_port = $server[0]->port;
				$serverResult[$i]->server_ip = $server[0]->ip;
				// $serverResult[$i]->server_port = LAN_PORT;
				// $serverResult[$i]->server_ip = $server[0]->lan;
			}
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
		
		if(!empty($ip))
		{
			$result = $this->connector->post($ip . '/refresh_tcp_server_ip', null, FALSE);
			echo $result;
		}
		else
		{
			echo 'No param';
		}
	}
}

?>