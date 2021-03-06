<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Send_mail extends CI_Controller
{
	private $pageName = 'master/send_mail';
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
			if(intval($serverResult[$i]->account_server_id) >= 103 || intval($serverResult[$i]->account_server_id) <= 100)
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
		$itemId = $this->input->post('itemId');
		$title = $this->input->post('title');
		$content = $this->input->post('content');
		
		$nickname = empty($nickname) ? '' : $nickname;
		$itemId = empty($itemId) ? '' : $itemId;
		
		if(!empty($ip) && !empty($title) && !empty($content))
		{
			$parameter = array(
					'item_const_id'		=>	$itemId,
					'title'				=>	$title,
					'content'			=>	$content
			);
			
			$nickNameArray = explode(',', $nickname);
			if(count($nickNameArray) > 1)
			{
				$parameter['nkms'] = implode(',', $nickNameArray);
			}
			else
			{
				$parameter['nkm'] = $nickname;
			}
// 			if($allServer == '1')
// 			{
// 				$parameter['all'] = "true";
// 			}
			$result = $this->connector->post($ip . '/ser_send_mails', $parameter, FALSE);
			
			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'send_mail/send');
			
			echo trim($result);
		}
	}
}

?>