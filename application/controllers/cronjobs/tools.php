<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Tools extends CI_Controller
{
	private $productdb = null;
	
	public function __construct()
	{
		parent::__construct ();
	}
	
	public function init()
	{
		$this->load->model('mserver');
		$this->load->model('maccount');

		$server1 = '103';
		$server2 = '104';
		
		$db = $this->load->database('accountdb', TRUE);
		$sql = "SELECT COUNT(*) AS `count` FROM `web_account` WHERE `server_id`='{$server1}'";
		$query = $db->query($sql);
		$result = $query->row();
		$count1 = $result->count;
		$query->free_result();

		$sql = "SELECT COUNT(*) AS `count` FROM `web_account` WHERE `server_id`='{$server2}'";
		$query = $db->query($sql);
		$result = $query->row();
		$count2 = $result->count;
		$query->free_result();
		
		$active1 = 1;
		$active2 = 0;

		$productdb = $this->load->database('productdb', TRUE);
		$sql = "INSERT INTO `server_balance` VALUES('{$server1}', {$count1}, {$active1})";
		$productdb->query($sql);
		$sql = "INSERT INTO `server_balance` VALUES('{$server2}', {$count2}, {$active2})";
		$productdb->query($sql);
	}
	
	public function check()
	{
		$this->load->model('mserver');
		$this->load->model('maccount');

		$id1 = 7;
		$id2 = 8;
		
		$server1 = '103';
		$server2 = '104';
		
		$productdb = $this->load->database('productdb', TRUE);
		$sql = 'SELECT * FROM `server_balance` WHERE `last_active` = 0';
		$result = $productdb->query($sql)->row();
		$serverId = $result->server_id;
		
		if($serverId == $server1)
		{
			$nertId = $id2;
			$nextServer = $server2;
		}
		else
		{
			$nertId = $id1;
			$nextServer = $server1;
		}

		$db = $this->load->database('accountdb', TRUE);
		$sql = "SELECT COUNT(*) AS `count` FROM `web_account` WHERE `server_id`='{$serverId}'";
		$query = $db->query($sql);
		$result = $query->row();
		$count = $result->count;
		$query->free_result();
		
		if(intval($count) >= (intval($result->count) + 1000))
		{
			$parameter = array(
					'server_recommend'	=>	1
			);
			$this->mserver->update($id1, $parameter);

			$parameter = array(
					'server_recommend'	=>	0
			);
			$this->mserver->update($id2, $parameter);
			
			$sql = 'UPDATE `server_balance` SET `last_active` = 0';
			$productdb->query($sql);
			$sql = "UPDATE `server_balance` SET `last_active` = 1, `count`={$count} WHERE `server_id`='{$serverId}'";
			$productdb->query($sql);
		}
	}
}

?>