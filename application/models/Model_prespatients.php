<?php

class Model_prespatients extends My_Model {

	const DB_TABLE = 'ra_pres_patient';
	const DB_TABLE_PK = 'pres_patient_id';

	 /**
     * patient id
     * @var int
     */
    public $patient_id;

    /**
     * medicine id
     * @var int
     */
    public $pres_name;

    /**
     * quantity
     * @var int
     */
    public $quantity;

    
    /**
     * assign date
     * @var int
     */
    public $assign_date;


    public function createPrescription()
    {
       
        $date = now();
        $count_product = count($this->input->post('product'));
        for($x = 0; $x < $count_product; $x++) {
          
            $items = array(
                'patient_id' => $this->input->post('patient_id'),
                'pres_name' => $this->input->post('product')[$x],
                'quantity' => $this->input->post('quantity')[$x],
                'highlighted' => $this->input->post('highlight')[$x],
                'assign_date' => $date,
            );

            $this->db->insert('ra_pres_patient',$items); 

    }

}

}