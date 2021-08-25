<?php

class Model_diagnosis extends MY_Model
{
	const DB_TABLE = 'ra_diagnosis';
	const DB_TABLE_PK = 'id';

    /**
     * 
     * Diagnosis
     */
    public $name;


    public function getDiagnosis() {

        $this->db->select('*');
        $this->db->from('ra_diagnosis');
        $query = $this->db->get();
        return $query->result();
    }


}