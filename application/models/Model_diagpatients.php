<?php

class Model_diagpatients extends MY_Model
{
	const DB_TABLE = 'ra_diag_patient';
	const DB_TABLE_PK = 'id';

    /**
     * 
     * Patient Id
     */
    public $patient_id;

    /**
     * 
     * Diagnosis
     */
    public $diagnosis;

     public function getDiagnosisData($patient_id)
    {

          $this->db->select('*');
          $this->db->from('ra_diag_patient');
          $this->db->where('patient_id', $patient_id);
          $this->db->where('is_deleted', '0');
          $this->db->order_by('id','desc');
          $this->db->limit(1);
          $query = $this->db->get();
          return $query->result();

    }

    public function deleteDiagnosis($id)
    {

        $data = array(
         'is_deleted' => '1',
         'deleted_date' => date('Y-m-d H:i:s'));

        $this->db->where('id',$id);
        $update = $this->db->update('ra_diag_patient',$data);
        return($update == true) ? true : false;


    }

    public function pie_chart_js()
    {

      $query = $this->db->query("SELECT COUNT(id) as count FROM ra_diag_patient GROUP BY diagnosis");
      $record = $query->result();
      $data = [];

      foreach ($record as $row) {
           $data['label'][] = $row->diagnosis;
           $data['data'][] = (int) $row->count;

      }

      $data['chart_data'] = json_encode($data);
  
   }

   public function getDiagnosisCount($id)
    {
        if($id) {
           $sql = "SELECT * FROM ra_diag_patient where patient_id = ? and is_deleted = ?";
           $query = $this->db->query($sql,array($id,'0'));
           return $query->num_rows();
        }  
    }


}