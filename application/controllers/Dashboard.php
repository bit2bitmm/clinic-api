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
		 $deshdata = array(
		 'total_users' =>  $this->model_users->countTotalUsers(),
		 'total_medicines'  => $this->model_pharmacy->countTotalMedicines(),
		 'total_todaypatients'     => $this->model_reports->countTodayPatients(),
		 'total_diagnosis' => $this->model_diagnosis->get(),
		 'patient'     => $this->model_reports->whoVisited(),
		 'chart_data' => $this->pie_chart_js()
	 );
	 echo(json_encode(array('data' => $deshdata , 'messageCode' => 1 , 'message' => 'Success')));
	}
	catch (Exception $e){
		echo(json_encode(array('data' => null , 'messageCode' => 0 , 'message' => $e->getMessage())));
	}
	}


	 public function pie_chart_js()
    {

      // $query = $this->db->query("SELECT ra_diagnosis.name,COUNT(ra_diag_patient.diagnosis) as count FROM ra_diag_patient INNER JOIN ra_diagnosis ON ra_diagnosis.name = ra_diag_patient.diagnosis GROUP BY ra_diagnosis.name");
      // $row = $query->result_array();
      // $json_data = array();

     $this->db->select('diagnosis, COUNT(*) as count');
     $this->db->group_by('diagnosis');
     $result = $this->db->get('ra_diag_patient');
     $row=$result->result_array();
     $json_data = array();

      foreach ($row as $rec) {
           $json_array['label'] = explode(",",$rec['diagnosis']);
           $json_array['value'] =  $rec['count'];
           array_push($json_data,$json_array);
      }

     return $json_data;
  
   }

public function countOccurences($str, $word) 
{ 

	$a = explode(" ", $str); 

	// search for pattern in string 
	$count = 0; 
	for ($i = 0; $i < sizeof($a); $i++) 
	{ 
		
	// if match found increase count 
	if ($word == $a[$i]) 
		$count++; 
	} 

	return $count; 
} 

}