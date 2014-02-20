<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Account_manage extends CI_Controller
{
	private $pageName = 'master/account_manage';
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
		
		$data = array(
			'admin'				=>	$this->user,
			'page_name'			=>	$this->pageName,
			'server_result'		=>	$serverResult
		);
		$this->render->render($this->pageName, $data);
	}
	
	public function lists()
	{
		$this->load->model('maccount');
		$this->load->model('utils/return_format');
		
		$serverId = $this->input->post('serverId');
		$guid = $this->input->post('guid');
		$accountName = $this->input->post('accountName');
		$nickname = $this->input->post('nickname');
		
		$parameter = array();
		if(!empty($serverId))
		{
			$parameter['server_id'] = $serverId;
		}
		if(!empty($guid))
		{
			$parameter['GUID'] = $guid;
		}
		if(!empty($accountName))
		{
			$parameter['account_name'] = $accountName;
		}
		if(!empty($nickname))
		{
			$parameter['account_nickname'] = $nickname;
		}
		
		$result = $this->maccount->read($parameter);
		
		if(empty($result))
		{
			$result = array();
		}

		echo $this->return_format->format($result);
	}
	
	public function reset_password()
	{
		$guid = $this->input->post('guid');
		$password = $this->input->post('newPassword');
		
		$this->load->model('utils/return_format');
		
		if(!empty($guid) && !empty($password))
		{
			$this->load->model('maccount');
			$this->load->helper('security');
			
			$parameter = array(
					'account_pass'	=>	strtoupper(do_hash(do_hash($password, 'md5') . do_hash($password), 'md5'))
			);
			$this->maccount->update($guid, $parameter);

			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'account_manage/reset_password');

			$result = array(
					'result'	=>	1,
					'guid'		=>	$guid
			);
		}
		else
		{
			$result = array(
					'result'	=>	-1
			);
		}
		header('Content-type: text/json');
		echo $this->return_format->format($result);
	}
	
	public function freeze()
	{
		$this->load->model('utils/return_format');
		
		$guid = $this->input->post('guid');
		$endtime = $this->input->post('endtime');
		
		if(!empty($guid))
		{
			$this->load->model('maccount');
			
			if($endtime == '3')
			{
				$endtime = time() + 3 * 86400;
			}
			elseif ($endtime == '7')
			{
				$endtime = time() + 7 * 86400;
			}
			elseif ($endtime == '30')
			{
				$endtime = time() + 30 * 86400;
			}
			else
			{
				$endtime = PHP_INT_MAX;
			}
			
			$parameter = array(
					'account_status'	=>	-1,
					'closure_endtime'	=>	$endtime
			);
			$this->maccount->update($guid, $parameter);
			$result = array(
					'result'	=>	1,
					'guid'		=>	$guid
			);

			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'account_manage/freeze');
// 			redirect('master/account_manage');
		}
		else
		{
			$result = array(
					'result'	=>	-1
			);
// 			showMessage(MESSAGE_TYPE_ERROR, 'NO_PARAM', '', 'master/account_manage', true, 5);
		}
		header('Content-type: text/json');
		echo $this->return_format->format($result);
	}
	
	public function unfreeze($guid = 0)
	{
		$this->load->model('utils/return_format');
		
		$guid = $this->input->post('guid');
		
		if(!empty($guid))
		{
			$this->load->model('maccount');
			
			$parameter = array(
					'account_status'	=>	1
			);
			$this->maccount->update($guid, $parameter);
			$result = array(
					'result'	=>	1,
					'guid'		=>	$guid
			);
			
			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'account_manage/unfreeze');
// 			redirect('master/account_manage');
		}
		else
		{
			$result = array(
					'result'	=>	-1
			);
// 			showMessage(MESSAGE_TYPE_ERROR, 'NO_PARAM', '', 'master/account_manage', true, 5);
		}
		header('Content-type: text/json');
		echo $this->return_format->format($result);
	}
	
	public function delete($guid = 0)
	{
		$this->load->model('utils/return_format');
		
		if(!empty($guid))
		{
			$this->load->model('maccount');
			$this->maccount->delete($guid);
			
			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'account_manage/delete');
			redirect('master/account_manage');
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'NO_PARAM', '', 'master/account_manage', true, 5);
		}
	}
}

?>