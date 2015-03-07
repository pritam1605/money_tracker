<?php

	class Login_model extends CI_Model 
	{	
		var $username;
		var $password;


		public function __construct()
		{
			$this->load->database();	
			// It loads the database library. 
			// This will make the database class available through the $this->db object.
		}

		public function check_login()
		{
			$this->username=$this->input->post('username');
			$this->password=$this->input->post('password');

			$where = array('username'=>$this->username);

			$query = $this->db->get_where('users',$where);
			
			if($query->num_rows == 1)
			{
				$existing_hash = $query->row()->password;				// extracting the current hash

				if($this->password_check($this->password,$existing_hash))		// applying the hash to check whetherthe password matches or not
				{
					return $query->row();
				}
				else
				{
					return FALSE;
				}
			}
			else
			{
				return FALSE;
			}
		}	


		function password_check($password,$existing_hash)
		{
			// existing hash contains format and salt at start

			$hash = crypt($password, $existing_hash);

			if($hash === $existing_hash)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		} 
	}