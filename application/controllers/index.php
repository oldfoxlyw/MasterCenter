<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller
{
	private $pageName = 'index';
	private $user = null;
	
	public function __construct()
	{
		parent::__construct ();
		$this->load->model('utils/check_user', 'check');
		$this->user = $this->check->validate();
	}
	
	public function index()
	{
		$data = array(
			'admin'			=>	$this->user,
			'page_name'		=>	$this->pageName
		);
		$this->render->render($this->pageName, $data);
	}
}

?>