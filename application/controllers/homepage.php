<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Sign_up extends CI_Controller 
	{
		public function __construct()
		{
			parent::__construct();

			$this->load->helper(array('form','url','html'));
			$this->load->library('form_validation');

			$this->load->model('sign_up_model');				// loading the model to check for authentication
		}

		public function index()
		{				
			$data['title'] = 'Register';

			$config = array(
				               array(
				                     'field'   => 'username', 
				                     'label'   => 'Username', 
				                     'rules'   => 'trim|required|min_length[5]|max_length[30]|callback_username_check'
				                  	),
				               array(
				                     'field'   => 'password', 
				                     'label'   => 'Password', 
				                     'rules'   => 'trim|required|matches[confirmpassword]|min_length[8]|max_length[30]|alpha_numeric'
				                  	),
				               array(
				                     'field'   => 'confirmpassword', 
				                     'label'   => 'Confirm Password', 
				                     'rules'   => 'trim|required'
				                  	),
				               array(
				                     'field'   => 'email', 
				                     'label'   => 'Email', 
				                     'rules'   => 'trim|required|valid_email|callback_email_check'
				                  	)
				            );

			$this->form_validation->set_rules($config);
			//$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('templates/header', $data);
				$this->load->view('sign_up');
				$this->load->view('templates/footer');
			}
			else
			{
				if(! $this->sign_up_model->create_new_user())
				{
					show_error('Problem occured while creating a new user');
				}
				else
				{
					$this->load->view('homepage');
				}
			}
		}

		public function username_check($str)
		{	
			
			if ($this->sign_up_model->check_username($str))
			{
				$this->form_validation->set_message('username_check', 'This %s has aready been used.');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}

		public function email_check($str)
		{	
			if ($this->sign_up_model->check_email($str))
			{
				$this->form_validation->set_message('email_check', 'This %s has aready been registered.');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}

	}