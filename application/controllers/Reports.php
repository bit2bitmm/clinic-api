<?php

defined('BASEPATH') OR exit('No direct script access allowed');


  class Reports extends Admin_Controller
  {

  	public function __construct()
  	{

  		parent::__construct();

  		$this->not_logged_in();


  		$this->data['page_title'] = 'Reports';

  		$this->load->model('model_reports');
  		$this->load->model('model_patients');
  		$this->load->model('model_notifications');
  		$this->data['patient_count'] = $this->model_patients->count();
		$this->data['expiryproduct'] = $this->model_notifications->getExpiryProduct();
		$this->data['ofsproduct'] = $this->model_notifications->getOfsProduct();
		$this->data['totalexpnoti'] = $this->model_notifications->getTotalExpNoti();
		$this->data['totalofspnoti'] = $this->model_notifications->getTotalOfsNoti();

  	}


  	public function totalVisits()
	{
           $date = $this->uri->segment(3);
           $this->data['tvisits'] = $this->model_reports->whoVisited($date);	
           $this->data['tvisitqty'] = $this->model_reports->countTodayPatients();
           $this->data['dvisitqty'] = $this->model_reports->countDailyPatients();
  		   $this->data['chart_data'] = json_encode($this->model_reports->dailyVisits());
           $this->render_template('patients/totalvisits',$this->data);

	}

	public function yearlyVisits()
	{

		   if(!in_array('viewPatient', $this->permission)) {

				redirect('dashboard', 'refresh');
			}
		
		$today_year = date('Y');

		if($this->input->post('select_year')) {
			$today_year = $this->input->post('select_year');
		}

		$parking_data = $this->model_reports->getOrderData($today_year);
		$this->data['report_years'] = $this->model_reports->getOrderYear();


		$final_parking_data = array();
		foreach ($parking_data as $k => $v) {
			
			if(count($v) > 1) {
				$total_amount_earned = array();
				foreach ($v as $k2 => $v2) {
					if($v2) {
						$total_amount_earned[] = $v2['patient_id'];						
					}
				}
				$final_parking_data[$k] = count($total_amount_earned);	
			}
			else {
				$final_parking_data[$k] = 0;	
			}
			
		}
		
		$this->data['selected_year'] = $today_year;
		// $this->data['company_currency'] = "Kyat";
		$this->data['results'] = $final_parking_data;

		$this->render_template('patients/monthlyvisit.php',$this->data);

	}
  }