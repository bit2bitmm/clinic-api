<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Examinations extends Admin_Controller
{

	public function __construct()
	{

		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Examination';

		$this->load->model('model_examinations');
		
		
	}

	public function create()
	{

		try {

			if($this->input->post()){
				
				foreach($this->input->post() as $key => $value)
					// var_dump($this->input->post());
					$this->model_examinations->$key = $value;
					$this->model_examinations->save();
					$this->model_examinations->load($this->model_examinations->id);

					echo json_encode(array($this->model_examinations));

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

			if($this->input->post('examination_id') == $id) {

				$this->model_examinations->load($this->input->post('examination_id'));

				if($this->model_examinations->patient_id == $this->input->post('patient_id')){

					$this->model_examinations->deleteExamination($id);
					echo(json_encode(array('data' => "Success", 'messageCode' => 1, 'message' => 'Examination-data deleted')));


				} else {

					echo json_encode(array('data' => 'Fail', 'messageCode' => 0, 'message' => 'Patient-id does not match'));
				}
			} else {

				echo json_encode(array('data' => 'Fail', 'messageCode' => 0, 'message' => 'Examination-id does not match'));
			}
			
		}catch(Exception $e) {
			echo json_encode(array('data' => 'Fail', 'messageCode' => 0, 'message' => 'Fail'));
		}

    }
}