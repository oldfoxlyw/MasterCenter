<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller
{
	private $pageName = 'master/message';
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
	
	public function add()
	{
		$this->pageName = 'master/message_add';
		$this->check->permission($this->pageName);

		$this->load->model('mserver');
		$serverResult = $this->mserver->read();
		for($i=0; $i<count($serverResult); $i++)
		{
			$server = json_decode($serverResult[$i]->server_ip);
			$serverResult[$i]->server_port = $server[0]->port;
			$serverResult[$i]->server_ip = $server[0]->ip;
		}
		
		$data = array(
			'admin'				=>	$this->user,
			'page_name'			=>	$this->pageName,
			'server_result'		=>	$serverResult,
			'current_time'		=>	time()
		);
		$this->render->render($this->pageName, $data);
	}
	
	public function edit($id = 0)
	{
		if(!empty($id))
		{
			$this->pageName = 'master/message_add';
			$this->check->permission($this->pageName);
			

			$this->load->model('mmessage');
			$result = $this->mmessage->read(array(
					'id'	=>	$id
			));
			if($result !== FALSE)
			{
				$result = $result[0];

				$this->load->model('mserver');
				$serverResult = $this->mserver->read();
				for($i=0; $i<count($serverResult); $i++)
				{
					$server = json_decode($serverResult[$i]->server_ip);
					$serverResult[$i]->server_port = $server[0]->port;
					$serverResult[$i]->server_ip = $server[0]->ip;
				}
				
				$data = array(
						'admin'						=>	$this->user,
						'page_name'					=>	$this->pageName,
						'server_result'				=>	$serverResult,
						'current_time'		=>	time(),
						'edit'						=>	'1',
						'id'						=>	$id,
						'value'						=>	$result
				);
					
				$this->render->render($this->pageName, $data);
			}
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'NO_PARAM', '', 'master/message', true, 5);
		}
	}
	
	public function lists()
	{
		$this->load->model('mmessage');
		$this->load->model('utils/return_format');
		
		$server_id = $this->input->post('serverId');
		
		$parameter = array();
		if(!empty($server_id))
		{
			$parameter['server_id'] = $server_id;
		}
		
		$result = $this->mmessage->read($parameter);
		
		if(empty($result))
		{
			$result = array();
		}
		else
		{
			for($i=0; $i<count($result); $i++)
			{
				$result[$i]->starttime = date('Y-m-d H:i:s', $result[$i]->starttime);
				$result[$i]->endtime = date('Y-m-d H:i:s', $result[$i]->endtime);
			}
		}

		echo $this->return_format->format($result);
	}
	
	public function delete($id = 0)
	{
		$this->load->model('utils/return_format');
		
		if(!empty($id))
		{
			$this->load->model('mmessage');
			$this->mmessage->delete($id);
			
			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'message/delete');
			redirect('master/message');
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'NO_PARAM', '', 'master/message', true, 5);
		}
	}


	public function submit()
	{
		$this->load->model('mmessage');
	
		$edit = $this->input->post('edit');
		$id = $this->input->post('id');
		$server_id = $this->input->post('serverId');
		$content = $this->input->post('messageContent');
		$minutes = $this->input->post('minutes');
		$hour = $this->input->post('hour');
		$date = $this->input->post('date');
		$starttime = $this->input->post('startTime');
		$endtime = $this->input->post('endTime');
		
		if(empty($minutes) && $minutes != '0')
		{
			$minutes = '*';
		}
		if(empty($hour) && $hour != '0')
		{
			$hour = '*';
		}
		if(empty($date) && $date != '0')
		{
			$date = '*';
		}
		$starttime = empty($starttime) ? 0 : strtotime($starttime);
		$endtime = empty($endtime) ? PHP_INT_MAX : strtotime("{$endtime} 23:59:59");
		
		if($starttime >= $endtime)
		{
			showMessage(MESSAGE_TYPE_ERROR, 'MESSAGE_ERROR_TIME_INVALID', '', 'master/message', true, 5);
			exit();
		}
		
		if(!empty($edit))
		{
			$result = $this->mmessage->read(array(
					'id'		=>	$id
			));
			if(empty($result))
			{
				showMessage(MESSAGE_TYPE_ERROR, 'MESSAGE_ID_NOT_EXIST', '', 'master/message', true, 5);
			}
			else
			{
				$parameter = array(
						'server_id'		=>	$server_id,
						'content'		=>	$content,
						'minutes'		=>	$minutes,
						'hour'			=>	$hour,
						'date'			=>	$date,
						'starttime'		=>	$starttime,
						'endtime'		=>	$endtime
				);
			}

			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'master/message/submit/edit');
			$this->mmessage->update($id, $parameter);
		}
		else
		{
			$result = $this->mmessage->read(array(
					'id'		=>	$id
			));
			if(!empty($result))
			{
				showMessage(MESSAGE_TYPE_ERROR, 'MESSAGE_ID_EXIST', '', 'master/message', true, 5);
			}
			else
			{
				$parameter = array(
						'server_id'		=>	$server_id,
						'content'		=>	$content,
						'minutes'		=>	$minutes,
						'hour'			=>	$hour,
						'date'			=>	$date,
						'starttime'		=>	$starttime,
						'endtime'		=>	$endtime
				);

				$this->load->model('mlog');
				$this->mlog->writeLog($this->user, 'master/message/submit/add');
				$this->mmessage->create($parameter);
			}
		}
			
		redirect('master/message');
	}
}

?>