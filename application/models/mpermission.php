<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('ICrud.php');

class Mpermission extends CI_Model implements ICrud
{
	private $accountTable = 'system_permission';
	private $admindb = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->admindb = $this->load->database('admindb', TRUE);
	}
	
	public function count($parameter = null, $extension = null)
	{
		if(!empty($parameter))
		{
			foreach($parameter as $key=>$value)
			{
				$this->admindb->where($key, $value);
			}
		}
		if(!empty($extension))
		{
			if(!empty($extension))
			{
				if(!empty($extension['like']))
				{
					foreach($extension['like'] as $like)
					{
						$this->admindb->or_like($like[0], $like[1]);
					}
				}
			}
		}
		return $this->admindb->count_all_results($this->accountTable);
	}
	
	public function create($row)
	{
		if(!empty($row))
		{
			if($this->admindb->insert($this->accountTable, $row))
			{
				return $this->admindb->insert_id();
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
				$this->admindb->where($key, $value);
			}
		}
		if(!empty($extension))
		{
			if(!empty($extension))
			{
				if(!empty($extension['like']))
				{
					foreach($extension['like'] as $like)
					{
						$this->admindb->or_like($like[0], $like[1]);
					}
				}
			}
		}
		if($limit==0 && $offset==0) {
			$query = $this->admindb->get($this->accountTable);
		} else {
			$query = $this->admindb->get($this->accountTable, $limit, $offset);
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
			$this->admindb->where('permission_level', $id);
			return $this->admindb->update($this->accountTable, $row);
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
			$this->admindb->where('permission_level', $id);
			return $this->admindb->delete($this->accountTable);
		}
		else
		{
			return false;
		}
	}
}

?>