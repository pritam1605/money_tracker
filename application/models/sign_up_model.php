<?php

	class Sign_up_model extends CI_Model 
	{	
		var $username;
		var $password;
		var $email;
		private $table_name="users";


		public function __construct()
		{
			$this->load->database();	
			// It loads the database library. 
			// This will make the database class available through the $this->db object.
		}

		function check_username($username)
		{
			$where = array('username'=>$username);

			$query = $this->db->get_where($this->table_name,$where);

			if($query->num_rows() > 0)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}	

		function check_email($email)
		{
			$where = array('email'=>$email);

			$query = $this->db->get_where($this->table_name,$where);

			if($query->num_rows() > 0)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		} 

		function create_new_user()
		{
			
			$this->password = $this->salt_password();
			$this->username = $this->input->post('username');
			$this->email = $this->input->post('email');

			$data = array('username' => $this->username,'password' => $this->password,'email' => $this->email);
			return $this->db->insert($this->table_name,$data);
		}


		function salt_password()
		{	
			// this function will salt the passowrd before storing it into the database
			$password = $this->input->post('password');

			$hash_password = "$2y$10$";						// 2y = blowfish  10 = cost parameter i.e. 10 cycles

			$salt=$this->generate_salt(22);

			$format_and_salt = $hash_password . $salt;

			$password_hash = crypt($password,$format_and_salt);

			return $password_hash;
		}

		function generate_salt($length)
		{
			//Not 100% unique, not 100% random, but good enough for a salt
			//MD5 returns 32 characters

			$unique_random_string = md5(uniqid(mt_rand(),true));

			// Valid characters for a salt are [a-zA-Z0-9./]
			$base64_string = base64_encode($unique_random_string);

			// But not '+' which is valid in base64 encoding
			$modified_base64_string = str_replace('+','.',$base64_string);

			//Truncate string to the correct length
			$salt = substr($modified_base64_string, 0,$length);

			return $salt;
		}
	}