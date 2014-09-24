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
		
		$id = $this->input->post('serverId', TRUE);
		$ip = $this->input->post('serverIp', FALSE);
		$nickname = $this->input->post('nickname');
		$itemId = $this->input->post('itemId');
		$title = $this->input->post('title');
		$content = $this->input->post('content');
		
		$nickname = empty($nickname) ? '' : $nickname;
		$itemId = empty($itemId) ? '' : $itemId;
		var_dump($_POST);
		exit();
		if(!empty($ip) && !empty($id) && !empty($title) && !empty($content))
		{
			$parameter = array(
					'item_const_id'		=>	$itemId,
					'title'				=>	$title,
					'content'			=>	$content
			);
			
			$this->load->model('maccount');
			$nickNameArray = explode(',', $nickname);
			$result = $this->maccount->read(array(
				'server_id'				=>	$id
			), array(
				'where_in'	=>	array(
					'account_nickname',
					$nickNameArray
			)));
			if(!empty($result))
			{
				$guidList = array();
				foreach ($result as $account)
				{
					array_push($guidList, $account->GUID);
				}
				if(count($guidList) > 1)
				{
					$parameter['player_ids'] = implode(',', $guidList);
				}
				else
				{
					$parameter['player_id'] = $guidList[0];
				}
				$result = $this->connector->post($ip . '/ser_send_mails', $parameter, FALSE);
				
				$this->load->model('mlog');
				$this->mlog->writeLog($this->user, 'send_mail/send');
				
				echo trim($result);
			}
		}
	}
}

?>