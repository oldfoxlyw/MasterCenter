<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grant_pack extends CI_Controller
{
	private $pageName = 'master/grant_pack';
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
			$serverResult[$i]->server_port = $server[0]->lanport;
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
		$packId = $this->input->post('packId');
		$count = $this->input->post('count');

		$nickname = empty($nickname) ? '' : $nickname;
		$count = empty($count) ? 1 : intval($count);
		
		if(!empty($nickname) && !empty($ip) && !empty($packId))
		{
			$this->load->model('maccount');
			$account = $this->maccount->read(array(
				'account_nickname'		=>	$nickname
			));
			if(!empty($account))
			{
				$account = $account[0];
				$parameter = array(
					'player_id'		=>	$account->GUID,
					'item_const_id'	=>	$packId,
					'count'			=>	$count
				);
				$result = $this->connector->post($ip . '/ser_send_items', $parameter, FALSE);
				
				$this->load->model('mlog');
				$this->mlog->writeLog($this->user, 'grant_pack/send');
				
				echo trim($result);
			}
		}
	}
	
	public function get()
	{
		$this->load->model('utils/connector');
		
		$ip = $this->input->post('serverIp', FALSE);
		
		if(!empty($ip))
		{
			header('Content-type: text/json');
			echo $this->connector->post($ip . '/ser_get_items', null, FALSE);
		}
	}
}

?>