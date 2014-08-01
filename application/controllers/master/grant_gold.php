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
			$serverResult[$i]->server_port = '8089';
			$serverResult[$i]->server_ip = $server[0]->lan;
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
		$goldCount = $this->input->post('goldCount');
		
		if(!empty($nickname) && !empty($ip) && !empty($goldCount))
		{
			$this->load->model('maccount');
			$account = $this->maccount->read(array(
				'account_nickname'		=>	$nickname
			));
			if(!empty($account))
			{
				$account = $account[0];
				$parameter = array(
					'player_id'	=>	$account->GUID,
					'gold'		=>	$goldCount
				);
				$result = $this->connector->post($ip . '/ser_add_gold', $parameter, FALSE);
				
				$this->load->model('mlog');
				$this->mlog->writeLog($this->user, 'grant_gold/send');
				
				echo trim($result);
			}
		}
	}
}

?>