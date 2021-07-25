<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');


class Pharmacy extends Admin_Controller
{

	/**
     * Product::__construct()
     *
     */
	public function __construct()
	{

		parent::__construct();

	    $this->not_logged_in();

		$this->data['page_title'] = 'Pharmacy';
	    $this->load->model('model_pharmacy');
	    $this->load->model('model_medpatients');
	    $this->load->model('model_prespatients');
	    $this->load->model('model_notifications');
	    $this->load->model('model_patients');
	   	$this->data['patient_count'] = $this->model_patients->count();
		$this->data['allproduct'] = $this->model_pharmacy->getProductData();


	}
     public function index()
    {

	  	try{
			$pharmacy_data =  $this->data;
			echo(json_encode(array('data' => $pharmacy_data , 'messageCode' => 1 , 'message' => 'Success')));
		}catch (Exception $e){
			echo(json_encode(array('data' => null , 'messageCode' => 0 , 'message' => $e->getMessage())));
		}
    }

     public function fetchProductData()
     {

     	 $result = array('data' => array());

         $data = $this->model_pharmacy->getProductData();

		foreach ($data as $key=>$value){

		    $buttons = '';
            
             if(in_array('updatePharmacy', $this->permission)) {
    			$buttons .= '<a href="'.base_url('pharmacy/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

			if(in_array('deletePharmacy', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			if(in_array('createPharmacy', $this->permission)) {

				$buttons .=' <a href="'.base_url('pharmacy/check/'.$value['id']).'" class="btn btn-default" title="Check Availability"><i class="fa fa-file"></i></a>';
			}

			$qty_status = '';

          if($value['remain_quantity'] <=10 && $value['remain_quantity'] !=0 ) {

          $qty_status = '<span class="label label-warning">Low !</span>';
              }else if($value['remain_quantity'] <= 0) {
          $qty_status = '<span class="label label-danger">Out of stock !</span>';
           }

			$status = ($value['status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

		     $buttons .="&nbsp;&nbsp;&nbsp;".$status;


			$result['data'][$key] = array(

				$value['medicine_name'],
				$value['remain_quantity']."    ".$qty_status,
				$value['expire_date'],
				$value['selling_price'],
				$buttons
			
			);

     }

     echo json_encode($result);

   }  
	/**
  *add_product
  *
  */
	public function create()
	{

      	try{

			if ($this->input->post())
			{
					$product = $this->input->post();
					foreach($product as $key => $value)
					$this->model_pharmacy->$key = $value;
					$this->model_pharmacy->save();
			
					echo(json_encode(array('data' => "Success" , 'messageCode' => 1 , 'message' => 'Success')));
					
			}else{
					echo(json_encode(array('data' => "Failed" , 'messageCode' => 0 , 'message' => 'Failed')));
			}

    	}catch (Exception $e){
				echo(json_encode(array('data' => null , 'messageCode' => 0 , 'message' => $e->getMessage())));
		}

	}


	/**
  *update_product
  *
  */

	public function update($product_id=0)
	{

		$this->model_pharmacy->load($product_id);

		try{

		if($this->input->post() && $product_id != '')
		{
				$product = $this->input->post(); 
				foreach($product as $key => $value)
				$this->model_pharmacy->$key = $value;
				$this->model_pharmacy->save();	
				$this->model_pharmacy->updateDate($product_id);
			
				echo(json_encode(array('data' => $data , 'messageCode' => 1 , 'message' => 'Success')));

		}else{

				echo(json_encode(array('data' => "Failed" , 'messageCode' => 0 , 'message' => 'Failed')));
		}

		}catch (Exception $e){
				echo(json_encode(array('data' => null , 'messageCode' => 0 , 'message' => $e->getMessage())));
		}
		
	}

	public function delete($product_id=0)
	{

		$product_id = $this->input->post('product_id');
		
        if($product_id) {

            $delete = $this->model_pharmacy->deleteProduct($product_id);
   
            if($delete == true) {
                echo(json_encode(array('data' => "Success" , 'messageCode' => 1 , 'message' => 'Success')));
            }
            else {
    
               	echo(json_encode(array('data' => null , 'messageCode' => 0 , 'message' => 'Failed')));
            }
        }else {
            	echo(json_encode(array('data' => null , 'messageCode' => 0 , 'message' => 'Failed')));
        }

	}

	public function search()
	{

		if(!in_array('createPharmacy', $this->permission)){

			redirect('dashboard','refresh');
          
		}
			$this->data['patient_id']  = urldecode($this->uri->segment(3));
			$this->data['product_list'] = $this->model_pharmacy->getActiveMed();

			$this->load->view('pharmacy/search',$this->data);
	}

	public function getTableMedRow()
  {
		$products = $this->model_pharmacy->getActiveMed();
		echo json_encode($products);
  }

	public function getProductValueById()
  	{

		$med_id = $this->input->post('product_id');

		if($med_id) {
		$medicine_data = $this->model_pharmacy->searchmed($med_id);
		echo json_encode($medicine_data);


		}

	}

	public function prescription()
	{

		  if(!in_array('createPharmacy', $this->permission)){

		  	    redirect('dashboard','refresh');

		  }

		 $this->data['patient_id']  = urldecode($this->uri->segment(3));

		  $this->load->view('pharmacy/prescription',$this->data);
	}

	public function assign()
	{
		
		try {

				foreach ($this->input->post() as $key => $value) {
					
				$this->model_medpatients->create();

				unset($_POST);
			
				echo json_encode(array('messageCode' => 1, 'message' => 'Medicines Assigned :)'));

				}

		}catch(Exception $e){
			echo json_encode(array('data' => 'Error' , 'messageCode' => 0, 'message' => $e->getMessage()));
		}
		
	}

	public function assignPres()
	{

		if(!in_array('createPatient', $this->permission)){

			redirect('dashboard','refresh');
		}

	     $this->form_validation->set_rules(array(
        array( 'field' => 'patient_id', 'label' => 'Patient ID', 'rules' => 'required|is_numeric', ),
        array( 'field' => 'product[]', 'label' => 'Medicine Name', 'rules' => 'required', ),
        array( 'field' => 'quantity[]', 'label' => 'Number of Item', 'rules' => 'required|is_numeric',),
      ));

		if($this->form_validation->run() == TRUE) {

			foreach ($this->input->post() as $key => $value) {
				
			$this->model_prespatients->createPrescription();

			$patient_id = $this->input->post('patient_id');

			redirect('patients/panel/'.$patient_id);

        }
		 
		 }else{

		 // $this->form_validation->error();

		 	echo "Sorry";
		}

	}


	public function deletedpi($med_patient_id)
	{

		if(!in_array('createPatient', $this->permission)){

			redirect('dashboard','refresh');
		}

			$this->form_validation->set_rules(array(
        array( 'field' => 'drug_patient_id', 'label' => 'ID', 'rules' => 'required|trim|is_numeric|has_no_schar', ),
        array( 'field' => 'drug_id', 'label' => 'Drug ID', 'rules' => 'required|trim|is_numeric|has_no_schar', ),
        array( 'field' => 'patient_id', 'label' => 'Patient ID', 'rules' => 'required|trim|is_numeric|has_no_schar', ),
      ));

	     if($this->input->post('drug_patient_id')  == $med_patient_id)
      {

      	  $this->model_medpatients->load($this->input->post('drug_patient_id'));
      	  if($this->model_medpatients->med_id == $this->input->post('drug_id') &&
           $this->model_medpatients->patient_id==$this->input->post('patient_id'))
        {
          $this->model_medpatients->delete();
          $this->model_pharmacy->load($this->input->post('drug_id'));
			  if( $this->input->post('type') == "Tabs"){
				  $this->model_pharmacy->remain_tab_quantity  = (int) $this->model_pharmacy->remain_tab_quantity  +(int)$this->input->post('quantity');
				  
				  if($this->input->post('quantity') < $this->model_pharmacy->tab_quantity){
					  $this->model_pharmacy->remain_quantity  = $this->model_pharmacy->remain_quantity +1;
					  $this->model_pharmacy->used_quantity 	  =  $this->model_pharmacy->used_quantity -1;
				  }
				  else{
					  $this->model_pharmacy->remain_quantity =  (int)  $this->model_pharmacy->remain_quantity + (round((int) $this->input->post('quantity')/ (int)  $this->model_pharmacy->tab_quantity));
					  $this->model_pharmacy->used_quantity = (int)  $this->model_pharmacy->used_quantity - (round((int) $this->input->post('quantity') / (int)  $this->model_pharmacy->tab_quantity));
				  }
			  }
			  else{
				  $this->model_pharmacy->remain_quantity = $this->model_pharmacy->remain_quantity + $this->input->post('quantity');
				  $this->model_pharmacy->used_quantity = $this->model_pharmacy->used_quantity - $this->input->post('quantity');
				  $this->model_pharmacy->remain_tab_quantity = $this->model_pharmacy->remain_tab_quantity + (int)($this->input->post('quantity') * $this->model_pharmacy->tab_quantity);
			  }

		  $this->model_pharmacy->save();

          unset($_POST);
          echo 'ok';
        }else{
        echo 'mismatch';
        echo $this->model_medpatients->med_id.",";
		echo $this->model_medpatients->patient_id."<br>";
		echo $this->input->post('drug_id').",";
		echo $this->input->post('patient_id');
          //$data['error']='<div class="alert alert-danger">Payment Data Mismatch<div>';
        }
      }else{

      	echo "still error";  

      }
	}

	public function deleteppi($pres_patient_id)
	{

		if(!in_array('createPatient', $this->permission)){

			redirect('dashboard','refresh');
		}

			$this->form_validation->set_rules(array(
        array( 'field' => 'pres_patient_id', 'label' => 'ID', 'rules' => 'required|trim|is_numeric|has_no_schar', ),
        array( 'field' => 'pres_name', 'label' => 'Drug ID', 'rules' => 'required|trim|is_numeric|has_no_schar', ),
        array( 'field' => 'patient_id', 'label' => 'Patient ID', 'rules' => 'required|trim|is_numeric|has_no_schar', ),
      ));

	     if($this->input->post('pres_patient_id')  == $pres_patient_id)
      {

      	  $this->model_prespatients->load($this->input->post('pres_patient_id'));
      	  if($this->model_prespatients->pres_name == $this->input->post('pres_name') &&
           $this->model_prespatients->patient_id==$this->input->post('patient_id'))
        {
          $this->model_prespatients->delete();
          unset($_POST);
          echo 'ok';
        }else{
          echo 'mismatch';
          echo $this->model_prespatients->pres_name.",";
      	echo $this->model_prespatients->patient_id."<br>";
      	echo $this->input->post('pres_name').",";
      	echo $this->input->post('patient_id');
          //$data['error']='<div class="alert alert-danger">Payment Data Mismatch<div>';
        }
      }else{

      	echo "still error";  

      }
	}
	
	
	public function check()
	{

		$product_id= urldecode($this->uri->segment(3));
		$this->data['product'] = $this->model_pharmacy->getProductData($product_id);

		$this->load->view('pharmacy/check',$this->data);

	}
	
	public function _fill_product_unit()
	{
		return array( 'Bot'=>'Bot',
					  'Stp'=>'Stp',
					  'Box'=>'Box',
					  'Tube'=>'Tube',
					  'Inj'=>'Inj',
					  'Unit'=>'Unit',
					  'Sachet'=>'Sachet',);
	}
}
