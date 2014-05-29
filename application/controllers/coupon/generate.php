<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Generate extends CI_Controller
{
	private $pageName = 'coupon/generate';
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

	public function process()
	{
		$prefix = $this->input->post("prefix", TRUE);
		$width = $this->input->post("width", TRUE);
		$count = $this->input->post("count", TRUE);
		$comment = $this->input->post('comment', TRUE);
		$server_id = $this->input->post('server_id', TRUE);

		$width = empty($width) ? 6 : intval($width);
		$comment = empty($comment) ? '' : $comment;
		$server_id = empty($server_id) ? '' : $server_id;

		$chars = array('1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','P','Q','R','S','T','U','V','W','X','Y','Z');

		if(!empty($prefix) && !empty($count))
		{
			$this->load->helper('array');
			$this->load->model('mcode');

			$success = 0;
			$fail = 0;
			$result = array();
			$count = intval($count);

			for($i = 0; $i<$count; $i++)
			{
				$coupon = '';
				for($j = 0; $j<$width; $j++)
				{
					$coupon .= random_element($chars);
				}
				$coupon = $prefix . $coupon;

				$parameter = array(
					'code'		=>	$coupon,
					'comment'	=>	$comment,
					'server_id'	=>	$server_id
				);
				if($this->mcode->create($parameter) !== FALSE)
				{
					$success++;
					array_push($result, $coupon);
				}
				else
				{
					$fail++;
				}
			}

			$json = array(
				'success'		=>	$success,
				'fail'			=>	$fail,
				'result'		=>	$result
			);

			$this->load->model('utils/return_format');

			header("Content-type:text/json");
			echo $this->return_format->format($json);
		}
	}
}