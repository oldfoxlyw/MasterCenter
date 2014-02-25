<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Order_check extends CI_Controller
{
	private $pageName = 'master/order_check';
	private $user = null;
	
// 	private $url = 'https://buy.itunes.apple.com/verifyReceipt';
	private $url = 'https://sandbox.itunes.apple.com/verifyReceipt';

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
		$this->load->model('mfunds');
		$this->load->model('utils/return_format');
		
		$serverId = $this->input->post('serverId');
		$guid = $this->input->post('guid');
		$accountName = $this->input->post('accountName');
		$nickname = $this->input->post('nickname');
		
		$parameter = array();
		$extension = array();
		if(!empty($serverId))
		{
			$parameter['server_id'] = $serverId;
		}
		if(!empty($guid))
		{
			$parameter['account_guid'] = $guid;
		}
		if(!empty($accountName))
		{
			$parameter['account_name'] = $accountName;
		}
		if(!empty($nickname))
		{
			$extension['like'] = array('account_nickname', $nickname);
		}
		$parameter['funds_flow_dir'] = 'CHECK_IN';
		$extension['order_by'] = array('funds_time', 'desc');
		$result = $this->mfunds->read($parameter, $extension);
		
		if(empty($result))
		{
			$result = array();
		}

		echo $this->return_format->format($result);
	}
	
	public function check_receipt()
	{
		$receipt = $this->input->post('receipt');
		
		$parameter = array(
				'receipt-data'	=>	$receipt
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $parameter);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json'
		));
		$result = curl_exec($ch);
		
		header('Content-type: text/json');
		
		$this->load->model('utils/return_format');
		echo $result;
	}
}

?>