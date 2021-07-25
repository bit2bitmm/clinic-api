<?php 

class Dashboard extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Dashboard';
		
		$this->load->model('model_users');
		$this->load->model('model_notifications');
		$this->load->model('model_patients');
		$this->load->model('model_pharmacy');
		$this->load->model('model_reports');
		$this->load->model('model_diagnosis');
		$this->data['patient_count'] = $this->model_patients->count();
		$this->data['expiryproduct'] = $this->model_notifications->getExpiryProduct();
		$this->data['ofsproduct'] = $this->model_notifications->getOfsProduct();
		$this->data['totalexpnoti'] = $this->model_notifications->getTotalExpNoti();
		$this->data['totalofspnoti'] = $this->model_notifications->getTotalOfsNoti();
	}

	/* 
	* It only redirects to the manage category page
	* It passes the total product, total paid orders, total users, and total stores information
	into the frontend.
	*/
	public function index()
	{
	try{
		 $dashdata = array(
		 'total_users' =>  $this->model_users->countTotalUsers(),
		 'total_medicines' => $this->model_pharmacy->countTotalMedicines(),
		 'total_todaypatients' => $this->model_reports->countTodayPatients(),
		 'total_diagnosis' => $this->model_diagnosis->get(),
		 'patient' => $this->model_reports->whoVisited(),
		 'chart_data' => $this->pie_chart_js()
	 );
	 echo(json_encode(array('data' => $dashdata , 'messageCode' => 1 , 'message' => 'Success')));
	}
	catch (Exception $e){
		echo(json_encode(array('data' => null , 'messageCode' => 0 , 'message' => $e->getMessage())));
	}
	
	}

	 public function pie_chart_js()
    {

      $query = $this->db->query("SELECT diagnosis,COUNT(id) as count FROM ra_diag_patient GROUP BY diagnosis");
      $record = $query->result();
      $data = [];

      foreach ($record as $row) {
           $data['label'][] = $row->diagnosis;
           $data['data'][] = (int) $row->count;

      }

     return json_encode($data);
  
   }

}