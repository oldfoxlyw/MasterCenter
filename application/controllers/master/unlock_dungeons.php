<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Unlock_dungeons extends CI_Controller
{
	private $pageName = 'master/unlock_dungeons';
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

		$nickname = empty($nickname) ? '' : $nickname;
		
		if(!empty($nickname) && !empty($ip))
		{
			$parameter = array(
				'nkm'		=>	$nickname
			);
			$result = $this->connector->post($ip . '/ser_unlock_dungeons', $parameter, FALSE);
			
			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'unlock_dungeons/send');
			
			echo trim($result);
		}
	}
}

?>