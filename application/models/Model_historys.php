<?php

class Model_historys extends MY_Model 
{

	const DB_TABLE = 'ra_history';
	const DB_TABLE_PK = 'id';

    /**
     * 
     * Patient Id
     */
    public $patient_id;

    /**
     * 
     * Complaint
     */
    public $history;

     public function getHistoryData($patient_id)
    {
          $this->db->select('*');
          $this->db->from('ra_history');
          $this->db->where('patient_id', $patient_id);
          $this->db->where('is_deleted', '0');
          $this->db->order_by('id','desc');
          $this->db->limit(1);
          $query = $this->db->get();
          return $query->result();

    }

    public function deleteHistory($id)
    {

        $data = array(
         'is_deleted' => '1',
         'deleted_date' => date('Y-m-d H:i:s'));

        $this->db->where('id',$id);
        $update = $this->db->update('ra_history',$data);
        return($update == true) ? true : false;

    }

    public function getHistoryCount($id)
    {
        if($id) {
           $sql = "SELECT * FROM ra_history where patient_id = ? and is_deleted = ?";
           $query = $this->db->query($sql,array($id,'0'));
           return $query->num_rows();
        }  
    }
}