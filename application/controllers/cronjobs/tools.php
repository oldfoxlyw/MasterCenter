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
		$server3 = '105';
		
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

		$sql = "SELECT COUNT(*) AS `count` FROM `web_account` WHERE `server_id`='{$server3}'";
		$query = $db->query($sql);
		$result = $query->row();
		$count3 = $result->count;
		$query->free_result();
		
		$active1 = 0;
		$active2 = 0;
		$active3 = 1;

		$productdb = $this->load->database('productdb', TRUE);
		$sql = "INSERT INTO `server_balance` VALUES('{$server1}', {$count1}, {$active1})";
		$productdb->query($sql);
		$sql = "INSERT INTO `server_balance` VALUES('{$server2}', {$count2}, {$active2})";
		$productdb->query($sql);
		$sql = "INSERT INTO `server_balance` VALUES('{$server3}', {$count3}, {$active3})";
		$productdb->query($sql);
	}
	
	public function check()
	{
		$this->load->model('mserver');
		$this->load->model('maccount');

		$id1 = 7;
		$id2 = 8;
		$id3 = 9;
		
		$server1 = '103';
		$server2 = '104';
		$server3 = '105';
		
		$productdb = $this->load->database('productdb', TRUE);
		$sql = 'SELECT * FROM `server_balance` WHERE `next_active` = 1';
		$lastResult = $productdb->query($sql)->row();
		$serverId = $lastResult->server_id;
		
		if($serverId == $server1)
		{
			$nertId = $id2;
			$nextServer = $server2;
		}
		else if($serverId == $server2)
		{
			$nertId = $id3;
			$nextServer = $server3;
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
		
		echo 'last active:' . $serverId;
		echo 'nextId:' . $nertId;
		echo 'nextServer:' . $nextServer;
		echo 'currentCount:' . $count;
		echo 'lastCount:' . intval($lastResult->count);
		
		if(intval($count) >= (intval($lastResult->count) + 1000))
		{
			echo 'revert';
			$sql = 'UPDATE `server_list` SET `server_recommend` = 0';
			$productdb->query($sql);
			
			$parameter = array(
					'server_recommend'	=>	1
			);
			$this->mserver->update($nertId, $parameter);
			
			$sql = 'UPDATE `server_balance` SET `next_active` = 0';
			$productdb->query($sql);
			$sql = "UPDATE `server_balance` SET `next_active` = 1, `count`={$count} WHERE `server_id`='{$serverId}'";
			$productdb->query($sql);
		}
	}
}

?>