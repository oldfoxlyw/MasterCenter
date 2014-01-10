<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends CI_Controller
{
	private $pageName = 'master/articles';
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
		$data = array(
			'admin'				=>	$this->user,
			'page_name'			=>	$this->pageName
		);
		$this->render->render($this->pageName, $data);
	}
	
	public function add()
	{
		$this->pageName = 'master/articles_add';
		$this->check->permission($this->pageName);
		
		$data = array(
			'admin'				=>	$this->user,
			'page_name'			=>	$this->pageName
		);
		$this->render->render($this->pageName, $data);
	}
	
	public function edit($id = 0)
	{
		if(!empty($id))
		{
			$this->pageName = 'master/articles_add';
			$this->check->permission($this->pageName);
			

			$this->load->model('mannouncement');
			$result = $this->mannouncement->read(array(
					'id'	=>	$id
			));
			if($result !== FALSE)
			{
				$result = $result[0];
				$data = array(
						'admin'						=>	$this->user,
						'page_name'					=>	$this->pageName,
						'edit'						=>	'1',
						'id'						=>	$id,
						'value'						=>	$result
				);
					
				$this->render->render($this->pageName, $data);
			}
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'NO_PARAM', '', 'master/articles', true, 5);
		}
	}
	
	public function lists()
	{
		$this->load->model('mannouncement');
		$this->load->model('utils/return_format');
		
		$partner = $this->input->post('partner');
		
		$parameter = array();
		if(!empty($partner))
		{
			$parameter['partner_key'] = $partner;
		}
		
		$result = $this->mannouncement->read($parameter);
		
		if(empty($result))
		{
			$result = array();
		}

		echo $this->return_format->format($result);
	}
	
	public function delete($id = 0)
	{
		$this->load->model('utils/return_format');
		
		if(!empty($guid))
		{
			$this->load->model('mannouncement');
			$this->mannouncement->delete($id);
			
			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'articles/delete');
			redirect('master/articles');
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'NO_PARAM', '', 'master/articles', true, 5);
		}
	}


	public function submit()
	{
		$this->load->model('mannouncement');
	
		$edit = $this->input->post('edit');
		$id = $this->input->post('id');
		$summary = $this->input->post('summary');
		$content = $this->input->post('content');
		$partner = $this->input->post('partner');
		
		if(!empty($edit))
		{
			$result = $this->mannouncement->read(array(
					'id'		=>	$id
			));
			if(empty($result))
			{
				showMessage(MESSAGE_TYPE_ERROR, 'ANNOUNCEMENT_ID_NOT_EXIST', '', 'master/articles', true, 5);
			}
			else
			{
				$parameter = array(
						'summary'		=>	$summary,
						'content'		=>	$content,
						'partner_key'	=>	$partner
				);
			}

			$this->load->model('mlog');
			$this->mlog->writeLog($this->user, 'master/articles/submit/edit');
			$this->mannouncement->update($id, $parameter);
		}
		else
		{
			$result = $this->mannouncement->read(array(
					'id'		=>	$id
			));
			if(!empty($result))
			{
				showMessage(MESSAGE_TYPE_ERROR, 'ANNOUNCEMENT_ID_EXIST', '', 'master/articles', true, 5);
			}
			else
			{
				$parameter = array(
						'summary'			=>	$summary,
						'content'			=>	$content,
						'post_time'			=>	time(),
						'partner_key'		=>	$partner
				);

				$this->load->model('mlog');
				$this->mlog->writeLog($this->user, 'master/articles/submit/add');
				$this->mannouncement->create($parameter);
			}
		}
			
		redirect('master/articles');
	}
}

?>