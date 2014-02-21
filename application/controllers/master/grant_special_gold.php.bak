<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grant_special_gold extends CI_Controller
{
	private $pageName = 'master/grant_special_gold';
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
			$serverResult[$i]->server_port = LAN_PORT;
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
// 		$allServer = $this->input->post('allServer');
		$nickname = $this->input->post('nickname');
		$goldCount = $this->input->post('goldCount');
		
		$nickname = empty($nickname) ? '' : $nickname;
		
		if(!empty($ip) && !empty($goldCount))
		{
			$parameter = array(
				'nkm'				=>	$nickname,
				'special_gold'		=>	$goldCount
			);
// 			if($allServer == '1')
// 			{
// 				$parameter['all'] = "true";
// 			}
			$result = $this->connector->post($ip . '/ser_add_special_gold', $parameter, FALSE);

			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'grant_special_gold/send');

			echo trim($result);
		}
	}
}

?>