<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Company_details_model extends CI_Model
{
	var $table = 'company_details';
	var $column_order = array(null, 'field1','field2','field3','field4','field5'); //set column field database for datatable orderable
	var $column_search = array('field1','field2','field3','field4','field5'); //set column field database for datatable searchable 
	var $order = array('cd_id' => 'asc'); // default order 
	function __construct()
	{
		parent::__construct();


		$this->tableName = 'company_details';
	}


	function insert($insArr)
	{

		$sql = $this->db->set($insArr)->get_compiled_insert($this->tableName);
		$sql = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $sql);
		$this->db->query($sql);

	}
	public function update($up_arr,$cond)
	{
        $this->db->set($up_arr); 
        $this->db->where($cond); 
		$this->db->update($this->tableName, $up_arr);
	}
	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables($company_cat)
	{
		$this->_get_datatables_query();
		$this->db->where('field4',$company_cat);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($company_cat)
	{
		$this->db->where('field4',$company_cat);
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($company_cat)
	{
		$this->db->where('field4',$company_cat);		
		$this->db->from($this->table);
		$this->db->count_all_results();
	}
}
?>
