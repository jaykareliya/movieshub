<?php
class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
	
		$this->load->model('madmin');
	}
	


	function chk_login()
	{	
		
		$email = $this->input->post('username');
		$password = $this->input->post('password');
		
		
		if($this->ion_auth->login($email,$password))
		{ //if login successful
			$this->data['message']= $this->ion_auth->messages();
			if($this->ion_auth->logged_in())
				{
					$this->data['Email']=$this->ion_auth->get_user()->email;

				}
				else
			{
				$this->data['Email']="";
			}
					
				redirect('Actor/manage_Actor','refresh');
		}
			else
			{ 
				
				$this->session->set_flashdata("error","Username or password does not match");
				redirect('','refresh');
			}	

	}
}