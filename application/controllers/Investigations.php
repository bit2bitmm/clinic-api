<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Investigations extends Admin_Controller
{

	public function __construct()
	{

		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Patients';

		$this->load->model('model_Investigations');
		
	}

	public function create()
	{

		try {
			
			if($this->input->post()) 
			{

				$this->model_Investigations->patient_id = $this->input->post('patient_id');
				$this->model_Investigations->investigation = $this->input->post('investigation');
				$this->model_Investigations->save();
				$this->model_Investigations->load($this->model_Investigations->id);

				echo json_encode($this->model_Investigations);
			}else{
				echo(json_encode(array('data' => "Fail", 'messageCode' => 0, 'message' => 'Fail')));

			}

		}catch(Exception $e){
			echo(json_encode(array('data' => null, 'messageCode' => 0, 'message' => $e->getMessage())));
		}
	
}

	public function delete($id)
    {

        try {
			if($this->input->post('investigation_id') == $id){

				$this->model_Investigations->load($this->input->post('investigation_id'));

				if($this->model_Investigations->patient_id == $this->input->post('patient_id')){

					$this->model_Investigations->deleteInvestigation($id);
					unset($_POST);
					echo(json_encode(array('data' => "Success", 'messageCode' => 1, 'message' => 'Investigation deleted')));

				}else{
					echo(json_encode(array('data' => "Mismatch", 'messageCode' => 0, 'message' => 'Patient-id mismatch')));
				}
			}else{

					echo(json_encode(array('data' => 'Mismatch', 'messageCode' => 0, 'message' => 'Investigation-id not found ')));
			}
		}catch(Exception $e){
			echo (json_encode(array('data' => null, 'messageCode' => 0, 'message' => $e->getMessage())));
		}

	}

}