<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Patients extends Admin_Controller
	{

	public function __construct()
	{

		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Patients';

		$this->load->model('model_patients');
		$this->load->model('model_complaints');
		$this->load->model('model_historys');
		$this->load->model('model_Investigations');
		$this->load->model('model_medpatients');
		$this->load->model('model_prespatients');
		$this->load->model('model_examinations');
		$this->load->model('model_pharmacy');
		$this->load->model('model_diagnosis');
		$this->load->model('model_diagpatients');
		$this->load->model('model_notifications');
		$this->load->model('model_users');
		$this->data['patient_count'] = $this->model_patients->count();
		
					
		
	}

	public function index()
	{

		if(!in_array('viewPatient', $this->permission)) {

			redirect('dashboard', 'refresh');
		}

		$this->render_template('patients/index',$this->data);
	}

	public function fetchPatientData()
	{

		$result = array('data' => array());
	    
		$data = $this->model_patients->getPatientData();


	try{
		  
	 	echo(json_encode(array('data' => $data , 'messageCode' => 1 , 'message' => 'Success')));
	}
	catch (Exception $e){
		echo(json_encode(array('data' => null , 'messageCode' => 0 , 'message' => $e->getMessage())));
	}

	}

	public function create()
	{

		try{
			
			$data = array(
					
				'name' => $this->input->post('name'),
				'year'  => $this->input->post('year'),
				'month' => $this->input->post('month'),
				'day'   => $this->input->post('day'),
				'gender' => $this->input->post('gender'),
				'address' => $this->input->post('address'),
				
				);
			$patient_id = $this->model_patients->create($data);
			if($patient_id) {
				echo(json_encode(array('data' =>  $patient_id, 'messageCode' => 1 , 'message' => 'Success')));
			}else{
				echo(json_encode(array('data' => "Failed" , 'messageCode' => 0 , 'message' => 'Failed')));
			}
			
		}catch (Exception $e){
			echo(json_encode(array('data' => null , 'messageCode' => 0 , 'message' => $e->getMessage())));
		}

	}

	public function panel($patient_id=0)
	{

	    $this->data['complaint']    = $this->model_complaints->getComplaintData($patient_id);
	    $this->data['examination']  = $this->model_examinations->getExaminationData($patient_id);
	    $this->data['history']      = $this->model_historys->getHistoryData($patient_id);
	    $this->data['investigation']  = $this->model_Investigations->getInvestigationData($patient_id);
	    $this->data['diagnosis_data'] = $this->model_diagnosis->get();
	    $this->data['diagnosis_patient'] = $this->model_diagpatients->getDiagnosisData($patient_id);
	    $this->data['patient_data'] = $this->model_patients->getPatientData($patient_id);
	    $this->data['med_patient']= $this->model_medpatients->get_by_fkey('patient_id',$patient_id,'desc',0);
	    $this->data['pres_patient']= $this->model_prespatients->get_by_fkey('patient_id',$patient_id,'desc',0);
		$this->data['invoice']= $this->model_medpatients->get_by_fkey('patient_id',$patient_id,'desc',0);
		$user_id = $this->session->userdata('id');
		$this->data['user_data'] = $this->model_users->getUserData($user_id);

		echo(json_encode(array('data' =>  $this->data, 'messageCode' => 1 , 'message' => 'Success')));
	}

	public function detail($patient_id=0)
	{

		if(!in_array('createPatient', $this->permission)){

	       redirect('dashboard','refresh');

		}

		if(!$patient_id) {

			redirect('dashboard','refresh');
		}
	    $this->data['complaint_count'] = $this->model_complaints->getComplaintCount($patient_id);
	    $this->data['history_count'] = $this->model_historys->getHistoryCount($patient_id);
	    $this->data['investigation_count'] = $this->model_Investigations->getInvestCount($patient_id);
	    $this->data['examination_count'] = $this->model_examinations->getExamData($patient_id);
	    $this->data['diagnosis_count'] = $this->model_diagpatients->getDiagnosisCount($patient_id);
		$this->data['complaint']    = $this->model_patients->totalComplaints($patient_id);
	    $this->data['examination']  = $this->model_patients->totalExaminations($patient_id);
	    $this->data['history']      = $this->model_patients->totalHistorys($patient_id);
	    $this->data['investigation']  = $this->model_patients->totalInvestigations($patient_id);
	    $this->data['diagnosis_data'] = $this->model_diagnosis->get();
	    $this->data['diagnosis_patient'] = $this->model_patients->totalDiagnosis($patient_id);
	    $this->data['patient_data'] = $this->model_patients->getPatientData($patient_id);
	    $this->data['med_patient']= $this->model_medpatients->get_by_fkey('patient_id',$patient_id,'desc',0);
	    $this->data['pres_patient']= $this->model_prespatients->get_by_fkey('patient_id',$patient_id,'desc',0);
		$this->data['invoice']= $this->model_medpatients->get_by_fkey('patient_id',$patient_id,'desc',0);
		$user_id = $this->session->userdata('id');
		$this->data['user_data'] = $this->model_users->getUserData($user_id);

	    $this->render_template('patients/pdetail',$this->data);


	}

	public function update($patient_id)
	{

		try{
	        $data = array(
	          
	           'name' => $this->input->post('name'),
	           'year'  => $this->input->post('year'),
	           'month' => $this->input->post('month'),
	           'day'   => $this->input->post('day'),   
	           'gender' => $this->input->post('gender'),
	           'address' => $this->input->post('address'),
	           'updated_date' =>  date("y-m-d h:i:s")
	         
	        );

	        $update = $this->model_patients->update($data,$patient_id);

	        if($update == true) {
	           	echo(json_encode(array('data' => $data , 'messageCode' => 1 , 'message' => 'Success')));
	        }
	        else {
	        	echo(json_encode(array('data' => "Failed" , 'messageCode' => 0 , 'message' => 'Failed')));
	        }
		}catch (Exception $e){
				echo(json_encode(array('data' => null , 'messageCode' => 0 , 'message' => $e->getMessage())));
		}

	}

	public function count()
	{

		if(!in_array('createPatient', $this->permission)) {

			redirect('dashboard','refresh');
		}

	    $this->form_validation->set_rules('patient_id', 'Patient', 'trim|required');

		if ($this->form_validation->run() == TRUE) {

	        $data = array(
	           
	           'patient_id' => $this->input->post('patient_id'),
	           
	        );

	         $this->model_patients->addVisit($data);
		}

		echo "Done";	    
		
	}

	public function delete()
	{

		$patient_id = $this->input->post('patient_id');

	    if($patient_id) {
	        $delete = $this->model_patients->delete($patient_id);
	        if($delete == true) {
	            echo(json_encode(array('data' => "Success" , 'messageCode' => 1 , 'message' => 'Success')));
	        }else {
	           	echo(json_encode(array('data' => null , 'messageCode' => 0 , 'message' => 'Failed')));
	        }
	    }else {
	       
	       	echo(json_encode(array('data' => null , 'messageCode' => 0 , 'message' => 'Failed')));

	    }

	}

	public function getInvoices()
	{

		$patient_id = $this->input->post('id'); 
		$this->panel($patient_id);
		$result   = $this->model_medpatients->get_by_fkey('patient_id',$patient_id,'desc',0);
		echo  json_encode($result);
		
	}

	public function searchAddress()
	{

	    $address = $this->input->get('add');

	    $this->db->like('address', $address);
	    $this->db->group_by('address');

	    $data = $this->db->get("ra_patient")->result();

	    echo json_encode($data);
	}


	public function searchPatient()
	{

		$name = $this->input->get('name');

		$this->db->like('name',$name);
		$this->db->where('is_deleted','0');

		$data = $this->db->get("ra_patient")->result();

		echo json_encode($data);
	     
	}

	public function searchResult()
	{
	  
	    $url= str_replace(array('(',')'),'',urldecode($this->uri->segment(3)));

	    $value = explode('-',$url);

	    $name = $value[0];

	    $age = $value[1];

	    $id = $this->model_patients->getPatientId($name,$age);

	    redirect('patients/panel/'.$id);

	}


	}