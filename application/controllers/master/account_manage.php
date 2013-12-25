<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Account_manage extends CI_Controller
{
	private $pageName = 'master/account_manage';
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
			$serverResult[$i]->server_port = $server[0]->port;
			$serverResult[$i]->server_ip = $server[0]->ip;
		}
		
		$data = array(
			'admin'				=>	$this->user,
			'page_name'			=>	$this->pageName,
			'server_result'		=>	$serverResult
		);
		$this->render->render($this->pageName, $data);
	}
	
	public function send()
	{
		$this->load->model('utils/connector');
		
		$ip = $this->input->post('serverIp', FALSE);
		$nickname = $this->input->post('nickname');
		$packId = $this->input->post('packId');
		$count = $this->input->post('count');
		
		$count = empty($count) ? 1 : intval($count);
		
		if(!empty($ip) && !empty($nickname) && !empty($packId))
		{
			$parameter = array(
				'nkm'			=>	$nickname,
				'item_const_id'	=>	$packId,
				'count'			=>	$count
			);
			echo $this->connector->post($ip . '/ser_send_items', $parameter, FALSE);
		}
	}
}

?>