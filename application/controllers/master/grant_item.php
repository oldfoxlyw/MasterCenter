<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grant_item extends CI_Controller
{
	private $pageName = 'master/grant_item';
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
		$itemId = $this->input->post('itemId');
		$count = $this->input->post('count');

		$nickname = empty($nickname) ? '' : $nickname;
		$count = empty($count) ? 1 : intval($count);
		
		if(!empty($nickname) && !empty($ip) && !empty($itemId))
		{
			$parameter = array(
				'nkm'		=>	$nickname,
				'item_id'	=>	$itemId,
				'count'		=>	$count
			);
			$result = $this->connector->post($ip . '/ser_create_items', $parameter, FALSE);
			
			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'grant_item/send');
			
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
			echo $this->connector->post($ip . '/ser_get_items', null, FALSE);
		}
	}
}

?>