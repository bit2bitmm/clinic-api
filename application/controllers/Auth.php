<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_auth');
	}

	/* 
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/
	public function login()
	{		
		$email_exists = $this->model_auth->check_email('r@gmail.com');

		if($email_exists == TRUE) {
			$login = $this->model_auth->login('r@gmail.com', '12345678');

			if($login) {

				$logged_in_sess = array(
					'id' => $login['id'],
					'username'  => $login['username'],
					'email'     => $login['email'],
					'password' => '',
					'logged_in' => TRUE
				);

				$this->session->set_userdata($logged_in_sess);
				echo(json_encode(array('data' => $logged_in_sess , 'messageCode' => 1 , 'message' => 'login Success')));
			}
			else {
				echo(json_encode(array('data' => null , 'messageCode' => 0 , 'message' => 'login failed')));
			}
		}
		else {
			echo(json_encode(array('data' => null , 'messageCode' => 0 , 'message' => 'Email does not exist')));
		}		
	}

	/*
		clears the session and redirects to login page
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login', 'refresh');
	}

}
