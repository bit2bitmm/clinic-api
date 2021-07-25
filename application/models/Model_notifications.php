<?php

class Model_notifications extends MY_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function getExpiryProduct()
	{

		$date = date('Y-m-d');    
		$inc_date = date('Y-m-d', strtotime("+2 month", strtotime($date))); 
		$sql = "SELECT  * FROM ra_pharmacy WHERE DATE(expire_date) <= '$inc_date' and status = '1' and is_deleted ='0' ORDER BY expire_date ASC ";
		$query = $this->db->query($sql);
		return $query->result_array();

	}
    //**** Products'out of stock notification ***//
	public function getOfsProduct()
	{

		$quantity = "10";
		$sql = "SELECT * FROM ra_pharmacy where remain_quantity <= '$quantity' and status = '1' and is_deleted ='0' ORDER BY remain_quantity DESC";
		$query = $this->db->query($sql);

		return $query->result_array();

	}

	//*** Count for all products expire notifications ***//

	public function getTotalExpNoti()
	{

		$date = date('Y-m-d');    
		$inc_date = date('Y-m-d', strtotime("+2 month", strtotime($date))); 

		$sql = "SELECT  * FROM ra_pharmacy WHERE DATE(expire_date) <= '$inc_date' and status = '1' and is_deleted ='0' ORDER BY expire_date ASC ";
		$query = $this->db->query($sql);
		$ex_quantity = $query->num_rows();
		return $ex_quantity;

	}

   //*** Count for all out of stock notifications ***//

	public function getTotalOfsNoti(){
		$quantity = "10";
		$sql1 = "SELECT * FROM ra_pharmacy where remain_quantity <= '$quantity' and status = '1' and is_deleted ='0' ORDER BY remain_quantity DESC";
		$query1 = $this->db->query($sql1); 

		$ofs_quantity = $query1->num_rows();
		
		return $ofs_quantity;

	}
}