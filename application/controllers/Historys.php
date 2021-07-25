<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Historys extends Admin_Controller
{

	public function __construct()
	{

		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Patients';

		$this->load->model('model_historys');
		
	}

	public function create()
	{

		try {
			
			if($this->input->post()) 
			{

				$this->model_historys->patient_id = $this->input->post('patient_id');
				$this->model_historys->history = $this->input->post('history');
				$this->model_historys->save();
				$this->model_historys->load($this->model_historys->id);

				echo json_encode($this->model_historys);
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
			if($this->input->post('history_id') == $id){

				$this->model_historys->load($this->input->post('history_id'));

				if($this->model_historys->patient_id == $this->input->post('patient_id')){

					$this->model_historys->deleteHistory($id);
					unset($_POST);
					echo(json_encode(array('data' => "Success", 'messageCode' => 1, 'message' => 'History deleted')));

				}else{
					echo(json_encode(array('data' => "Mismatch", 'messageCode' => 0, 'message' => 'History-id mismatch')));
				}
			}else{

					echo(json_encode(array('data' => 'Mismatch', 'messageCode' => 0, 'message' => 'History-id not found ')));
			}
		}catch(Exception $e){
			echo (json_encode(array('data' => null, 'messageCode' => 0, 'message' => $e->getMessage())));
		}

	}
}