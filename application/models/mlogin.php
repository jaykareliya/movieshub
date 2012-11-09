<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model
{


	public function check_login()
	{
	
	if ($this->ci->ion_auth_model->login($this->input->post('email'), $this->input->post('password1')))
	{
		$this->set_message('login_successful');
		return TRUE;
	}
		
	}
}
?>