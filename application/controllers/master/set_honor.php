<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Set_level extends CI_Controller
{
	private $pageName = 'master/set_honor';
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
		$count = $this->input->post('count');

		$nickname = empty($nickname) ? '' : $nickname;
		$count = empty($count) ? 1 : intval($count);
		
		if(!empty($nickname) && !empty($ip))
		{
			$parameter = array(
				'nkm'			=>	$nickname,
				'special_gold'	=>	$count
			);
			$result = $this->connector->post($ip . '/ser_add_glory', $parameter, FALSE);
			
			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'set_honor/send');
			
			echo trim($result);
		}
	}
}

?>