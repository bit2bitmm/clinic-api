<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Diagnosis extends Admin_Controller
{

	public function __construct()
	{
       
        parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Diagnosis';

		$this->load->model('model_diagnosis');
        $this->load->model('model_diagpatients');
		
    }

    public function create()
    {

        try{
            if($this->input->post())
            {
                $this->model_diagnosis->name = $this->input->post('name');
                $this->model_diagnosis->save();
                $this->model_diagnosis->load($this->model_diagnosis->id);

                echo json_encode($this->model_diagnosis);
            }else{
                
                echo json_encode(array('data' => 'No data found', 'messageCode' => 0));
            }
        }catch(Exception $e) {
                echo json_encode(array('data' => 'Error', 'messageCode' => 0, 'message' => $e->getMessage()));
        }

    }

    public function assign()
    {

        try {
            if($this->input->post())
            {
                $this->model_diagpatients->patient_id = $this->input->post('patient_id');

                $this->model_diagpatients->diagnosis = implode(",", $this->input->post('diagnosis'));
                $this->model_diagpatients->save();
                $this->model_diagpatients->load($this->model_diagpatients->id);

                echo json_encode($this->model_diagpatients);

            }else{

                echo json_encode(array('data' => 'No data found', 'messageCode' => 0));

            }

        }catch(Exception $e) {

                echo json_encode(array('data' => 'Error', 'messageCode' => 0, 'message' => $e->getMessage()));

        }
    }

    public function delete($id)
    {

        try {

			if($this->input->post('diagnosis_id') == $id) {

				$this->model_diagpatients->load($this->input->post('diagnosis_id'));

				if($this->model_diagpatients->patient_id == $this->input->post('patient_id')){

					$this->model_diagpatients->deleteDiagnosis($id);
					echo(json_encode(array('data' => "Success", 'messageCode' => 1, 'message' => 'Diagnosis-data deleted')));


				} else {

					echo json_encode(array('data' => 'Fail', 'messageCode' => 0, 'message' => 'Patient-id does not match'));
				}
			} else {

				echo json_encode(array('data' => 'Fail', 'messageCode' => 0, 'message' => 'Diagnosis-id does not match'));
			}
			
		}catch(Exception $e) {
			echo json_encode(array('data' => 'Fail', 'messageCode' => 0, 'message' => $e->getMessage()));
		}
        

    }
}