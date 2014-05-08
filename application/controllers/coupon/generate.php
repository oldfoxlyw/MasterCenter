<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Generate extends CI_Controller
{
	private $pageName = 'coupon/generate';
	private $user = null;

	public function __construct()
	{
		error_reporting(E_ALL);
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

	public function process()
	{
		$prefix = $this->input->post("prefix", TRUE);
		$count = $this->input->post("count", TRUE);
		$comment = $this->input->post('comment', TRUE);

		$comment = empty($comment) ? '' : $comment;

		$chars = ['1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','P','Q','R','S','T','U','V','W','X','Y','Z'];

		if(!empty($prefix) && !empty($count))
		{
			$this->load->helper('array');
			$this->load->model('mcode');

			$success = 0;
			$fail = 0;
			$count = intval($count);

			for($i = 0; $i<$count; $i++)
			{
				$coupon = '';
				for($j = 0; $j<6; $j++)
				{
					$coupon .= random_element($chars);
				}
				$coupon = $prefix . $coupon;

				$parameter = array(
					'code'		=>	$coupon,
					'comment'	=>	$comment
				);
				if($this->mcode->create($parameter))
				{
					$success++;
				}
				else
				{
					$fail++;
				}
			}

			$json = array(
				'success'		=>	$success,
				'fail'			=>	$fail
			);

			$this->load->model('utils/return_format');

			header("Content-type:text/json");
			echo $this->return_format->format($json);
		}
	}
}