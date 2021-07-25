<?php

class Model_medpatients extends My_Model {

	const DB_TABLE = 'ra_med_patient';
	const DB_TABLE_PK = 'med_patient_id';

	 /**
     * patient id
     * @var int
     */
    public $patient_id;

    /**
     * medicine id
     * @var int
     */
    public $med_id;

    /**
     * quantity
     * @var int
     */
    public $quantity;
	/**
     * type
     * @var varchar
     */
	public $type;

    /**
     * Total Cost
     * @var int
     */
    public $total_cost;

    /**
     * assign date
     * @var int
     */
    public $assign_date;


    public function create()
    {
        $this->load->model('model_pharmacy');
        $date = now();

        $count_product = count($this->input->post('product'));
        for($x = 0; $x < $count_product; $x++) {
        
            $items = array(
                'patient_id' => $this->input->post('patient_id'),
                'med_id' => $this->input->post('product')[$x],
                'quantity' => $this->input->post('quantity')[$x],
				'type' => $this->input->post('type')[$x],
                'total_cost' => $this->input->post('totalamt')[$x],
                'highlighted' => $this->input->post('highlight')[$x],
                'assign_date' => $date,
            );

            $this->db->insert('ra_med_patient',$items); 

            $product_data = $this->fetchAllProduct($this->input->post('product')[$x]);
			
			$remain_quantity = 0;
			$used_quantity = 0;
			$remain_tab_quantity = 0;
			$type = $this->input->post('type')[$x];
			$quantity = $this->input->post('quantity')[$x];
			if($type == "Tabs"){
				$remain_tab_quantity = (int) $product_data['remain_tab_quantity'] - (int) $this->input->post('quantity')[$x];
				if($this->input->post('quantity')[$x] < $product_data['tab_quantity']){
					$used_quantity =  (int) $product_data['used_quantity'] + 1;
					$remain_quantity = (int) $product_data['remain_quantity'] -1;
				}
				else{
					$used_quantity =  (int) $product_data['used_quantity'] + (round((int) $this->input->post('quantity')[$x] / (int) $product_data['tab_quantity']));
					$remain_quantity = (int) $product_data['remain_quantity'] - (round((int) $this->input->post('quantity')[$x] / (int) $product_data['tab_quantity']));
				}

			}
			else{
				$remain_quantity = (int) $product_data['remain_quantity'] - (int) $this->input->post('quantity')[$x];
				$used_quantity = (int) $product_data['used_quantity'] + (int) $this->input->post('quantity')[$x];
				$remain_tab_quantity = (int) $product_data['remain_tab_quantity'] - ((int) $this->input->post('quantity')[$x] * (int) $product_data['tab_quantity']);
			}

			
            $update_product = array('remain_quantity' => $remain_quantity,
                                    'used_quantity' => $used_quantity,
									'remain_tab_quantity' => $remain_tab_quantity); 

            $this->model_pharmacy->update($update_product, $this->input->post('product')[$x]);

            $this->model_pharmacy->updateDate($this->input->post('product')[$x]);

        }   

    }
    
    public function fetchAllProduct($id)
    {
        $sql = "SELECT * FROM ra_pharmacy where id = ? ";
        $query = $this->db->query($sql,array($id));
        return $query->row_array();
    }


}