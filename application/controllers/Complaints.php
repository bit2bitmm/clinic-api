<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Complaints extends Admin_Controller
{

	public function __construct()
	{

		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Patients';

		$this->load->model('model_complaints');

		
	}

	public function create()
	{

		try {
			
			if($this->input->post()) 
			{

				$this->model_complaints->patient_id = $this->input->post('patient_id');
				$this->model_complaints->complaint = $this->input->post('complaint');
				$this->model_complaints->save();
				$this->model_complaints->load($this->model_complaints->id);

				echo json_encode($this->model_complaints);
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
			if($this->input->post('complaint_id') == $id){

				$this->model_complaints->load($this->input->post('complaint_id'));

				if($this->model_complaints->patient_id == $this->input->post('patient_id')){

					$this->model_complaints->deleteComplaint($id);
					unset($_POST);
					echo(json_encode(array('data' => "Success", 'messageCode' => 1, 'message' => 'Complaint deleted')));

				}else{
					echo(json_encode(array('data' => "Mismatch", 'messageCode' => 0, 'message' => 'Patient-id mismatch')));

				}
			}else{

					echo(json_encode(array('data' => 'Mismatch', 'messageCode' => 0, 'message' => 'Complaint-id not found ')));
			}
		}catch(Exception $e){
			echo (json_encode(array('data' => null, 'messageCode' => 0, 'message' => $e->getMessage())));
		}

    }

}