
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('ICrud.php');

class Mserver extends CI_Model implements ICrud
{
	
	private $accountTable = 'server_list';
	private $productdb = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->productdb = $this->load->database('productdb', TRUE);
	}
	
	public function count($parameter = null, $extension = null)
	{
		if(!empty($parameter))
		{
			foreach($parameter as $key=>$value)
			{
				$this->productdb->where($key, $value);
			}
		}
		if(!empty($extension))
		{
		}
		return $this->productdb->count_all_results($this->accountTable);
	}
	
	public function create($row)
	{
		if(!empty($row))
		{
			if($this->productdb->insert($this->accountTable, $row))
			{
				return $this->productdb->insert_id();
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
				if($key == 'partner')
				{
					$this->productdb->like('partner', $value);
				}
				else
				{
					$this->productdb->where($key, $value);
				}
			}
		}
		if(!empty($extension))
		{
			if(!empty($extension['order_by']))
			{
				$this->productdb->order_by($extension['order_by'][0], $extension['order_by'][1]);
			}
		}
		if($limit==0 && $offset==0) {
			$query = $this->productdb->get($this->accountTable);
		} else {
			$query = $this->productdb->get($this->accountTable, $limit, $offset);
		}
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function update($id, $row)
	{
		if(!empty($id) && !empty($row) && is_array($id))
		{
			$this->productdb->where('game_id', $id['game_id']);
			$this->productdb->where('account_server_section', $id['section_id']);
			$this->productdb->where('account_server_id', $id['server_id']);
			return $this->productdb->update($this->accountTable, $row);
		}
		else
		{
			return false;
		}
	}
	
	public function delete($id)
	{
		if(!empty($id) && is_array($id))
		{
			$this->productdb->where('game_id', $id['game_id']);
			$this->productdb->where('account_server_section', $id['section_id']);
			$this->productdb->where('account_server_id', $id['server_id']);
			return $this->productdb->delete($this->accountTable);
		}
		else
		{
			return false;
		}
	}
}

?>