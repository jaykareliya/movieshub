<?php
class Muser extends CI_Model
{
	/// Created by  :: Yash Shah
	/// Description :: This function is used to get all users
	/// Returns     :: records in user table
	function get_users($alpha)
	{
		if($alpha == "ALL")
			$alpha = "";
		
		if($alpha == "0-9")
		{
			$alpha = '0%" OR email LIKE "1%" OR email LIKE "2%" OR email LIKE "3%" OR email LIKE "4%" OR email LIKE "5%" OR email LIKE "6%" OR email LIKE "7%" OR email LIKE "8%" OR email LIKE "9';
		}
			
		$this->db->where('email LIKE "'.$alpha.'%"');
		$Q = $this->db->get('users');
		if($Q->num_rows()>0)
			return $Q->num_rows();
		else
			return 0;
	}
	
	/// Created by  :: Yash Shah
	/// Description :: This function is used to delete user
	/// Returns     :: TRUE/FALSE
	function delete_user()
	{
		$user_id = $this->input->get('id');
		$this->db->where('id',$user_id);
		$this->db->delete('users');
		return TRUE;
	}
	
	/// Created by  :: Yash Shah
	/// Description :: This function is used to get perticular user details
	/// Returns     :: user details
	function fill_user_details()
	{
		$user_id = $this->input->get('id');
		$this->db->where('id',$user_id);
		$Q = $this->db->get('users');
		if($Q->num_rows()>0)
			return $Q->result();
		else
			return NULL;
	}
	
	/// Created by  :: Yash Shah
	/// Description :: This function is used to update user
	/// Returns     :: 
	function update_user()
	{
	
		$user_id = $this->input->get('id');
		$d = array(
				'first_name'=>$this->input->post('txtFirstName'),
				'last_name'=>$this->input->post('txtLastName'),
				'phone'=>$this->input->post('txtphone'),
				'company'=>$this->input->post('txtCompany'),
				'address'=>$this->input->post('txtAddress'),
				);
		$this->db->where('id',$user_id);
		$this->db->update('users',$d);
	}
	
	function fill_user_table_condition($start_row,$limit,$alpha)
	{
		if($alpha == "ALL")
			$alpha = "";
			
		if($alpha == "0-9")
		{
			$alpha = '0%" OR email LIKE "1%" OR email LIKE "2%" OR email LIKE "3%" OR email LIKE "4%" OR email LIKE "5%" OR email LIKE "6%" OR email LIKE "7%" OR email LIKE "8%" OR email LIKE "9';
		}
		
		$this->db->where('email LIKE "'.$alpha.'%"');
		$query_str = 'SELECT * FROM users WHERE email LIKE "'.$alpha.'%" LIMIT '.$start_row.','.$limit;
	    $Q = $this->db->query($query_str);
	    return $Q->result();
	}
}
?>