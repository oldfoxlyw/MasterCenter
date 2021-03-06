<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grant_gold extends CI_Controller
{
	private $pageName = 'master/grant_gold';
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
				$serverResult[$i]->server_port = LAN_PORT;
				$serverResult[$i]->server_ip = $server[0]->lan;
			}
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
// 		$allServer = $this->input->post('allServer');
		$nickname = $this->input->post('nickname');
		$goldCount = $this->input->post('goldCount');
		
		$nickname = empty($nickname) ? '' : $nickname;
		
		if(!empty($ip) && !empty($goldCount))
		{
			$parameter = array(
				'nkm'		=>	$nickname,
				'gold'		=>	$goldCount
			);
// 			if($allServer == '1')
// 			{
// 				$parameter['all'] = "true";
// 			}
			$result = $this->connector->post($ip . '/ser_add_gold', $parameter, FALSE);
			
			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'grant_gold/send');
			
			echo trim($result);
		}
	}
}

?>