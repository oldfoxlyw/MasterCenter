<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('ICrud.php');

class Maccount extends CI_Model implements ICrud
{
	
	private $accountTable = 'web_account';
	private $accountdb = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->accountdb = $this->load->database('accountdb', TRUE);
	}
	
	public function count($parameter = null, $extension = null)
	{
		if(!empty($parameter))
		{
			foreach($parameter as $key=>$value)
			{
				$this->accountdb->where($key, $value);
			}
		}
		return $this->accountdb->count_all_results($this->accountTable);
	}
	
	public function create($row)
	{
		if(!empty($row))
		{
			if($this->accountdb->insert($this->accountTable, $row))
			{
				return $this->accountdb->insert_id();
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	public function read($parameter = null, $extension = null, $limit = 0, $offset = 0)
	{
		if(!empty($parameter))
		{
			foreach($parameter as $key=>$value)
			{
				$this->accountdb->where($key, $value);
			}
		}
		if(!empty($extension))
		{
			if(!empty($extension['like']))
			{
				$this->accountdb->like($extension['like'][0], $extension['like'][1]);
			}
			if(!empty($extension['order_by']))
			{
				$this->accountdb->order_by($extension['order_by'][0], $extension['order_by'][1]);
			}
		}
		if($limit==0 && $offset==0) {
			$query = $this->accountdb->get($this->accountTable);
		} else {
			$query = $this->accountdb->get($this->accountTable, $limit, $offset);
		}
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function update($id, $row)
	{
		if(!empty($id) && !empty($row))
		{
			$this->accountdb->where('GUID', $id);
			return $this->accountdb->update($this->accountTable, $row);
		}
		else
		{
			return false;
		}
	}
	
	public function delete($id)
	{
		if(!empty($id))
		{
			$this->accountdb->where('GUID', $id);
			return $this->accountdb->delete($this->accountTable);
		}
		else
		{
			return false;
		}
	}
}

?>