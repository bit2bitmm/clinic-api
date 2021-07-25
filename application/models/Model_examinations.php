<?php


 class Model_examinations extends MY_Model
 {

 	const DB_TABLE = "ra_exa_patient";
 	const DB_TABLE_PK = 'id';

 	/**
     * 
     * patient Id
     */
 	public $patient_id;

 	/**
     * 
     * s_bp
     */
 	public $s_bp;

 	/**
     * 
     * d_bp
     */
 	public $d_bp;

 	/**
     * 
     * pr
     */
 	public $pr;

 	/**
     * 
     * temp
     */
 	public $temp;

 	/**
     * 
     * spo2
     */
 	public $spo2;

     /**
     * 
     * rbs
     */
    public $rbs;

 	/**
     * 
     * weight
     */
 	public $weight;

 	/**
     * 
     * height
     */
 	public $height;

 	/**
     * 
     * bmi
     */
 	public $bmi;


     public function getExaminationData($patient_id)
    {

          $this->db->select('*');
          $this->db->from('ra_exa_patient');
          $this->db->where('patient_id', $patient_id);
          $this->db->where('is_deleted', '0');
          $this->db->order_by('id','desc');
          $this->db->limit(1);
          $query = $this->db->get();
          return $query->result();

    }

    public function deleteExamination($id)
    {

        $data = array(
         'is_deleted' => '1',
         'deleted_date' => date('Y-m-d H:i:s'));

        $this->db->where('id',$id);
        $update = $this->db->update('ra_exa_patient',$data);
        return($update == true) ? true : false;


    }

    public function getExamData($id)
    {
        if($id) {
           $sql = "SELECT * FROM ra_exa_patient where patient_id = ? and is_deleted = ?";
           $query = $this->db->query($sql,array($id,'0'));
           return $query->num_rows();
        }  
    }
 }