<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grant_retinue extends CI_Controller
{
	private $pageName = 'master/grant_retinue';
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
		header('Content-type: text/json');
		$this->load->model('utils/connector');
		
		$ip = $this->input->post('serverIp', FALSE);
		$nickname = $this->input->post('nickname');
		$retinueIds = $this->input->post('retinueIds');

		$nickname = empty($nickname) ? '' : $nickname;
		
		if(!empty($nickname) && !empty($ip) && !empty($retinueIds))
		{
			$parameter = array(
				'nkm'			=>	$nickname,
				'retinues_ids'	=>	$retinueIds
			);
			$result = $this->connector->post($ip . '/ser_add_retinue', $parameter, FALSE);
			
			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'grant_retinue/send');
			
			echo trim($result);
		}
	}
	
	public function get()
	{
		header('Content-type: text/json');
		$this->load->model('utils/connector');
		
		$ip = $this->input->post('serverIp', FALSE);
		
		if(!empty($ip))
		{
			echo $this->connector->post($ip . '/ser_all_retinue_keys', null, FALSE);
		}
		else
		{
			$parameter = array(
				'error'	=>	'IP参数不能为空'
			);
		}
	}
}

?>