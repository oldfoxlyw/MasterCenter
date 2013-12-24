<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permission extends CI_Controller
{
	private $pageName = 'permission';
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
			'admin'					=>	$this->user,
			'page_name'			=>	$this->pageName
		);
		$this->render->render($this->pageName, $data);
	}
	
	public function lists()
	{
		$this->load->model('mpermission');
		$this->load->model('utils/return_format');
		
		$sEcho = $this->input->get_post('sEcho');
		$offset = $this->input->get_post('iDisplayStart');
		$limit = $this->input->get_post('iDisplayLength');
		$keyword = $this->input->get_post('sSearch');

		$extension = null;
		if(!empty($keyword))
		{
			$like = array(
				array('permission_name', $keyword)
			);
			$extension['like'] = $like;
		}
		$count = $this->mpermission->count();
		$result = $this->mpermission->read(null, $extension, $limit, $offset);
		$data = array(
			'sEcho'							=>	$sEcho,
			'iTotalRecords'				=>	$count,
			'iTotalDisplayRecords'	=>	$count,
			'aaData'						=>	$result
		);
		
		echo $this->return_format->format($data);
	}
	
	public function add()
	{
		$this->pageName = 'permission_add';
		$this->check->permission($this->pageName);
		
		$data = array(
			'admin'					=>	$this->user,
			'page_name'			=>	$this->pageName,
		);
		$this->render->render($this->pageName, $data);
	}
	
	public function edit($permissionId = 0)
	{
		if(!empty($permissionId))
		{
			$this->pageName = 'permission_add';
			$this->load->model('mpermission');
			$result = $this->mpermission->read(array(
				'permission_id'		=>	$permissionId
			));
			if($result !== FALSE)
			{
				$result = $result[0];
				$permissionList = explode(',', $result->permission_list);
				$data = array(
					'admin'							=>	$this->user,
					'page_name'					=>	$this->pageName,
					'edit'							=>	'1',
					'old_permission_id'		=>	$permissionId,
					'value'							=>	$result,
					'permission_check'		=>	$permissionList
				);
				$this->render->render($this->pageName, $data);
			}
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'NO_PARAM', '', 'permission', true, 5);
		}
	}
	
	public function delete($permissionId = 0)
	{
		if(!empty($permissionId))
		{
			$this->load->model('mpermission');
			
			$this->mpermission->delete($permissionId);
			redirect('permission');
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'NO_PARAM', '', 'permission', true, 5);
		}
	}
	
	public function submit()
	{
		$this->load->model('mpermission');
		
		$post = $this->input->post();
		$edit = $post['edit'];
		$oldPermissionId = $post['oldPermissionId'];
		$permissionId = $post['permissionId'];
		$permissionName = $post['permissionName'];
		
		$splice = array(
			'edit',
			'oldPermissionId',
			'permissionId',
			'permissionName',
			'title-checkbox',
			'global_config',
			'online_config',
			'user_config',
			'order_config',
			'behavior_config',
			'master_config'
		);
		
		foreach($post as $key => $value)
		{
			if(in_array($key, $splice))
			{
				unset($post[$key]);
			}
		}
		$permission = implode(',', $post);
		
		if(!empty($edit))
		{
			if($oldPermissionId == $permissionId)
			{
				$parameter = array(
					'permission_name'	=>	$permissionName,
					'permission_list'		=>	$permission
				);
			}
			else
			{
				$result = $this->mpermission->read(array(
					'permission_id'		=>	$permissionId
				));
				if(!empty($result))
				{
					showMessage(MESSAGE_TYPE_ERROR, 'PERMISSION_ID_EXIST', '', 'permission', true, 5);
				}
				else
				{
					$parameter = array(
						'permission_id'			=>	$permissionId,
						'permission_name'	=>	$permissionName,
						'permission_list'		=>	$permission
					);
				}
			}
			$this->mpermission->update($oldPermissionId, $parameter);
		}
		else
		{
			$result = $this->mpermission->read(array(
				'permission_id'		=>	$permissionId
			));
			if(!empty($result))
			{
				showMessage(MESSAGE_TYPE_ERROR, 'PERMISSION_ID_EXIST', '', 'permission', true, 5);
			}
			else
			{
				$parameter = array(
					'permission_id'			=>	$permissionId,
					'permission_name'	=>	$permissionName,
					'permission_list'		=>	$permission
				);
				$this->mpermission->create($parameter);
			}
		}
		
		redirect('permission');
	}
}

?>