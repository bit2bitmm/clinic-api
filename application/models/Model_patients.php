<?php

		class Model_patients extends CI_Model
		{

			public function __construct()
			{

				parent::__construct();
			}

			public function getPatientData($id = null)
			{
		     
		     if($id) {

				$sql = "SELECT * FROM ra_patient WHERE is_deleted = '0' and id = ?";
				$query = $this->db->query($sql, array($id));
				return $query->row_array();
			  }
			     $sql = "SELECT * FROM ra_patient WHERE is_deleted = ?";
			     $query = $this->db->query($sql, array('0'));
			     return $query->result_array();

			}

			public function getPatientId($name,$age)
			{
				
		          $this->db->select('*');
		          $this->db->from('ra_patient');
		          $this->db->where('name', $name);
		          $this->db->where('year', $age);
		          $this->db->where('is_deleted', '0');
		          $query = $this->db->get();
		          return $query->row()->id;

			}

			public function create($data)
			{
		       
		       if($data) {
		        
		          $insert = $this->db->insert('ra_patient', $data);
		          
		          $patient_id = $this->db->insert_id();

		       }

		       return ($patient_id) ? $patient_id : false;

			}

			public function update($data,$id)
			{

				if($data && $id) {
		            
					$this->db->where('id',$id);
					$update = $this->db->update('ra_patient',$data);
					return ($update == true) ? true : false;
				}
			}

			public function visitingCount($id)
			{

				if($id) {
		           
		           $sql = "SELECT * FROM ra_patient_visit where patient_id = ?";
		           $query = $this->db->query($sql,array($id));
		           return $query->num_rows();

				}  
			}

			

			public function delete($id)
			{

				 if($id) {
		            
		            $this->db->set('deleted_date', mdate("%Y-%m-%d %H:%i:%s"));
		            $this->db->set('is_deleted','1');
				 	$this->db->where('id',$id);
				 	$update = $this->db->update('ra_patient');
				 	return($update == true) ? true : false;
				 }
			}

			public function count()
			{

				$sql = "SELECT * FROM ra_patient where is_deleted = '0'";
				$query = $this->db->query($sql);
				return $query->num_rows();
			}

			public function addVisit($data)
			{
                
                  if($data) {
		        
		          $insert = $this->db->insert('ra_patient_visit', $data);
		          

		         }

		          return ($insert) ? $insert : false;



			}  

			public function totalComplaints($patient_id='')
			{
                  $this->db->select('*');
			      $this->db->from('ra_complaint');
			      $this->db->where('patient_id', $patient_id);
			      $this->db->where('is_deleted', '0');
			      $this->db->order_by('id','desc');
			      $query = $this->db->get();
			      return $query->result();
               

			}

			public function totalHistorys($patient_id='')
			{

			  $this->db->select('*');
		      $this->db->from('ra_history');
		      $this->db->where('patient_id', $patient_id);
		      $this->db->where('is_deleted', '0');
		      $this->db->order_by('id','desc');
		      $query = $this->db->get();
		      return $query->result();

			}

			public function totalInvestigations($patient_id='')
			{

				  $this->db->select('*');
			      $this->db->from('ra_investigation');
			      $this->db->where('patient_id', $patient_id);
			      $this->db->where('is_deleted', '0');
			      $this->db->order_by('id','desc');
			      $query = $this->db->get();
			      return $query->result();

			}

			public function totalExaminations($patient_id='')
			{

				  $this->db->select('*');
			      $this->db->from('ra_exa_patient');
			      $this->db->where('patient_id', $patient_id);
			      $this->db->where('is_deleted', '0');
			      $this->db->order_by('id','desc');
			      $query = $this->db->get();
			      return $query->result();


			}

			public function totalDiagnosis($patient_id='')
			{
				  $this->db->select('*');
		          $this->db->from('ra_diag_patient');
		          $this->db->where('patient_id', $patient_id);
		          $this->db->where('is_deleted', '0');
		          $this->db->order_by('id','desc');
		          $query = $this->db->get();
		          return $query->result();
			}

			 public function searchPatient($query)
		    {
			  $this->db->like('name', $query);
			  $query = $this->db->get('ra_patient');
			  if($query->num_rows() > 0)
			  {
			   foreach($query->result_array() as $row)
			   {
			    $output[] = array(
			     'name'  => $row["name"],
			     'address'  => $row["address"]
			    );
			   }
			   echo json_encode($output);
			  }
		    }
		}