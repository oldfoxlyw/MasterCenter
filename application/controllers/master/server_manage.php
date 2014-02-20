<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Server_manage extends CI_Controller
{
	private $pageName = 'master/server_manage';
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
		$this->load->model('mserver');
		$this->load->model('utils/return_format');
		
		$result = $this->mserver->read();
		
		if(empty($result))
		{
			$result = array();
		}

		echo $this->return_format->format($result);
	}
	
	public function debug_on()
	{
		$this->load->model('utils/return_format');
		
		$id = $this->input->post('id');
		
		if(!empty($id))
		{
			$this->load->model('mserver');
			
			$parameter = array(
					'server_debug'	=>	1
			);
			$this->mserver->update($id, $parameter);
			$result = array(
					'result'	=>	1,
					'id'		=>	$id
			);

			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'server_manage/debug_on');
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
	
	public function debug_off()
	{
		$this->load->model('utils/return_format');
		
		$id = $this->input->post('id');
		
		if(!empty($id))
		{
			$this->load->model('mserver');
			
			$parameter = array(
					'server_debug'	=>	0
			);
			$this->mserver->update($id, $parameter);
			$result = array(
					'result'	=>	1,
					'id'		=>	$id
			);

			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'server_manage/debug_off');
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
	
	public function recommend_on()
	{
		$this->load->model('utils/return_format');
		
		$id = $this->input->post('id');
		
		if(!empty($id))
		{
			$this->load->model('mserver');
			
			$parameter = array(
					'server_recommend'	=>	1
			);
			$this->mserver->update($id, $parameter);
			$result = array(
					'result'	=>	1,
					'id'		=>	$id
			);

			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'server_manage/recommend_on');
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
	
	public function recommend_off()
	{
		$this->load->model('utils/return_format');
		
		$id = $this->input->post('id');
		
		if(!empty($id))
		{
			$this->load->model('mserver');
			
			$parameter = array(
					'server_recommend'	=>	0
			);
			$this->mserver->update($id, $parameter);
			$result = array(
					'result'	=>	1,
					'id'		=>	$id
			);

			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'server_manage/recommend_off');
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
	
	public function activate_on()
	{
		$this->load->model('utils/return_format');
		
		$id = $this->input->post('id');
		
		if(!empty($id))
		{
			$this->load->model('mserver');
			
			$parameter = array(
					'need_activate'	=>	1
			);
			$this->mserver->update($id, $parameter);
			$result = array(
					'result'	=>	1,
					'id'		=>	$id
			);

			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'server_manage/activate_on');
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
	
	public function activate_off()
	{
		$this->load->model('utils/return_format');
		
		$id = $this->input->post('id');
		
		if(!empty($id))
		{
			$this->load->model('mserver');
			
			$parameter = array(
					'need_activate'	=>	0
			);
			$this->mserver->update($id, $parameter);
			$result = array(
					'result'	=>	1,
					'id'		=>	$id
			);

			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'server_manage/activate_off');
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
	
	public function switch_status()
	{
		$this->load->model('utils/return_format');
		
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		
		if(!empty($id) && is_numeric($status))
		{
			$this->load->model('mserver');
			
			$parameter = array(
					'server_status'	=>	$status
			);
			$this->mserver->update($id, $parameter);
			$result = array(
					'result'	=>	1,
					'id'		=>	$id,
					'status'	=>	$status
			);

			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'server_manage/switch_status');
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
}

?>