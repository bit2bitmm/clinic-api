<?php

class Model_reports extends CI_MODEL
{

		public function __construct()
		{

			parent::__construct();
		}

           	public function whoVisited($date=null)
			{
                 

				if($date)
				{

				// $sql = "SELECT name , patient_id, ra_complaint.is_deleted as deleted , ra_complaint.created_date as date_time FROM ra_complaint JOIN ra_patient on ra_complaint.patient_id =ra_patient.id where ra_complaint.created_date LIKE '%$date%' and ra_complaint.is_deleted = '0' ORDER BY ra_complaint.id desc ";

				$sql = "SELECT name , patient_id, ra_patient_visit.visited_date as date_time  FROM ra_patient_visit JOIN ra_patient on ra_patient_visit.patient_id =ra_patient.id where ra_patient_visit.visited_date LIKE '%$date%' ORDER BY ra_patient_visit.patient_id desc ";


				    $query = $this->db->query($sql);
				    return $query->result_array();

				}
		     
		        $date = mdate('%Y-%m-%d');
				$sql = "SELECT name , patient_id, ra_patient_visit.visited_date as date_time  FROM ra_patient_visit JOIN ra_patient on ra_patient_visit.patient_id =ra_patient.id where ra_patient_visit.visited_date LIKE '%$date%' ORDER BY ra_patient_visit.patient_id desc LIMIT 5 ";
				$query = $this->db->query($sql);
				return $query->result_array();

			}


			public function dailyVisits()
			{

            $sql = "SELECT  DATE_FORMAT(visited_date,'%m-%d') as y, COUNT(id) as a FROM ra_patient_visit WHERE YEAR(visited_date) = '" . date('Y') . "' and visited_date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()
		    GROUP BY DAY(visited_date) ORDER BY visited_date DESC";
            $query = $this->db->query($sql);
		    return $query->result_array();

			}

			public function countTodayPatients()
			{   
				$date = mdate('%Y-%m-%d');
				
				$sql = "SELECT * FROM ra_patient_visit where visited_date LIKE '%$date%'";
				$query = $this->db->query($sql);
				return $query->num_rows();
			} 

			public function countDailyPatients()
			{

				$this->db->select('*');
				$this->db->from('ra_patient_visit');
				$this->db->where('visited_date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()');
				$query = $this->db->get();
				return $query->num_rows();
				
			}

			private function months()
	        {
	     	return array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
	        }

			/* getting the year of the orders */
			public function getOrderYear()
			{
				$sql = "SELECT * FROM ra_patient_visit";
				$query = $this->db->query($sql, array(1));
				$result = $query->result_array();
				
				$return_data = array();
				foreach ($result as $k => $v) {
					$date = date('Y', strtotime($v['visited_date']));
					$return_data[] = $date;
				}

				$return_data = array_unique($return_data);

				return $return_data;
			}

			// getting the order reports based on the year and moths
			public function getOrderData($year)
			{	
				if($year) {
					$months = $this->months();
					
					$sql = "SELECT * FROM ra_patient_visit";
					$query = $this->db->query($sql, array(1));
					$result = $query->result_array();

					$final_data = array();
					foreach ($months as $month_k => $month_y) {
						$get_mon_year = $year.'-'.$month_y;	

						$final_data[$get_mon_year][] = '';
						foreach ($result as $k => $v) {
							$month_year = date('Y-m', strtotime($v['visited_date']));

							if($get_mon_year == $month_year) {
								$final_data[$get_mon_year][] = $v;
							}
						}
					}	

					return $final_data;
					
				}
			} 
}