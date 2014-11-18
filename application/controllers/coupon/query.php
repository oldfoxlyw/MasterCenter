<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Query extends CI_Controller
{
	private $pageName = 'coupon/query';
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
		$coupon = $this->input->post('coupon');
		if(!empty($coupon))
		{
			$this->load->model('mcode');
			$result = $this->mcode->read(array(
				'code'		=>	$coupon
			));
			echo json_encode($result);
		}
	}
}