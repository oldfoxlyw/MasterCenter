<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('ICrud.php');

class Mcode extends CI_Model implements ICrud
{
	
	private $accountTable = 'game_code';
	private $accountdb = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->accountdb = $this->load->database('productdb', TRUE);
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
			$this->accountdb->where('code', $id);
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
			$this->accountdb->where('code', $id);
			return $this->accountdb->delete($this->accountTable);
		}
		else
		{
			return false;
		}
	}
	
	public function db()
	{
		return $this->accountdb;
	}
}

?>