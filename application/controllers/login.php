<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Login extends CI_Controller 
	{	
		var $data= array('title' => 'Login');

		public function __construct()
		{
			parent::__construct();

			$this->load->helper(array('form','url','html'));
			$this->load->library('form_validation');

			$this->load->model('login_model');				// loading the model to check for authentication

			
		}

		public function index($msg=NULL)
		{	
			$this->data['msg'] = $msg;

			$this->load->view('templates/login/login_header', $this->data);
			$this->load->view('login/login');
			$this->load->view('templates/login/login_footer');
		}

		public function sign_in()
		{				
			//$data['title'] = 'Login';
			$this->data['header'] = 'Welcome to Money Tracker';

			$config = array(
				               array(
				                     'field'   => 'username', 
				                     'label'   => 'Username', 
				                     'rules'   => 'required'
				                  	),
				               array(
				                     'field'   => 'password', 
				                     'label'   => 'Password', 
				                     'rules'   => 'required'
				                  	)
				            );

			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->index();
			}
			else
			{
				if(! $this->login_model->check_login())
				{
					//show_error('Username/Password do not match');

					$msg = "<div class='alert alert-error'>
								<font color=red>Invalid username and/or password.</font><br />
							</div>";
							
					$this->index($msg);
				}
				else
				{	
					/*$this->load->view('templates/header', $this->data);
					$this->load->view('homepage');
					$this->load->view('templates/footer');*/
					redirect('homepage');
				}
			}
		}
	}