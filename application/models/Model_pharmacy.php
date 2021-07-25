<?php
class Model_pharmacy extends MY_Model{
	
	const DB_TABLE = 'ra_pharmacy';
	const DB_TABLE_PK = 'id';
	
	/**
     * Medicine Name
     * @var string
     */
	public $medicine_name;
	
	/**
     * Quantity
     * @var int
     */
	public $quantity;
	
	/**
     * Tab Quantity
     * @var int
     */
	public $tab_quantity;

	/**
     * Used Quantity
     * @var int
     */
	public $used_quantity;
	
	/**
     * Remain Quantity
     * @var int
     */
	public $remain_quantity;
	/**
     * Remain Tab Quantity
     * @var int
     */
	public $remain_tab_quantity;

	/**
     * Register Date
     * @var date
     */
	public $register_date;
	
	/**
     *  Expire Date
     * @var date
     */
	public $expire_date;
	
	/**
     * Description
     * @var string
     */
	public $description;
	
	/**
     * Sell Type
     * @var string
     */
	public $sell_type;
	
	/**
     * Actual price
     * @var int
     */
	public $actual_price;
	
	/**
     * Selling Price
     * @var int
     */
	public $selling_price;

	/**
     * Profit Price
     * @var string
     */
	public $profit_price;
	
	/**
     * Status
     * @var string
     */
	public $status;
	
	/**
     * Is Delete
     * @var int
     */
	public $is_deleted;
	
	/**
     * Created Date
     * @var datetime
     */
	public $created_date;
	
	/**
     * Modified Date 
     * @var datetime
     */
	public $modified_date;
	
	/**
     * Deleted Date
     * @var datetime
     */
	public $deleted_date;
	

public function getProductData($id=null){
	if ($id == ''){
          $this->db->select('*');
          $this->db->from('ra_pharmacy');
          $this->db->where('is_deleted', '0');
          $query = $this->db->get();
      return $query->result_array();
     }
     else{
          $this->db->select('*');
          $this->db->from('ra_pharmacy');
          $this->db->where('id', $id);
          $this->db->where('is_deleted', '0');
          $query = $this->db->get();
      return $query->result_array();
     }
	
}
	public function deleteProduct($id)
	{
		$data = array(
		 'is_deleted' => '1',
		 'deleted_date' => date('Y-m-d H:i:s'));
		
		$this->db->where('id',$id);
		$update = $this->db->update('ra_pharmacy',$data);
		return($update == true) ? true : false;
	}

	public function update($data,$id)
    {

	    if($data && $id) {
		            
		    $this->db->where('id',$id);
		    $update = $this->db->update('ra_pharmacy',$data);
		    return ($update == true) ? true : false;
	    }
    }
	
	public function updateDate($id)
	{
		$data = array('modified_date'=>  date('Y-m-d H:i:s'));
		$this->db->where('id',$id);
		$this->db->update('ra_pharmacy',$data);

	}

	public function getActiveMed()
	{
		$this->db->select("*");
        $this->db->from("ra_pharmacy");
        $this->db->where("status","1");
        $this->db->where("is_deleted","0");
        
        $query = $this->db->get();

        $result = $query->result_array();

        return $result;
	}

	public function searchmed($id)
	{

		$this->db->select('*');
		$this->db->from('ra_pharmacy');
		$this->db->like('id',$id);
		$this->db->where('status','1');
		$query = $this->db->get();
		return $query->row_array();

	}

	public function countTotalMedicines()
	{
		$sql = "SELECT * FROM ra_pharmacy WHERE is_deleted = '0'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
}


?>