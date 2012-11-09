<?php
class Madmindetail extends CI_Model
{
 /// Created by  :: hardik Dave
 /// Description :: This function check old password of admin login
 /// Returns     :: true if it is correct or false if not
 function check_pass($oldpass)
 {
	$querystr="select * from users where password='".md5($oldpass)."' ";
	$result=$this->db->query($querystr); 
	if($result->num_rows() >0)
	{
		return true;
	}
	else
	{
		return false;
	} 
 }
 /// Created by  :: hardik Dave
 /// Description :: This function update the old password
 /// Returns     :: true 
  function change_password($user_name)
 {
    $data = array(
      'password' => md5($this->input->post('retype_newpass'))
     );
   
  $this->db->where('user_name',$user_name);
  $this->db->update('users', $data);
 }
 /// Created by  :: hardik Dave
 /// Description :: This function check login at admin side
 /// Returns     :: true if it is correct or false if not
 function chk_login($password)
 {
 
  $query_str =  $this->db->query("select * from users where trim(user_name) = '".$this->input->post('username')."' and trim(password) = '".md5($password)."'");
  $this->load->library('session');
  if ($query_str->num_rows() > 0)
  {
  
    return true;
  }
  else
  {
  
    return false;
  }
  
 }
 function chk_dupli()
 {
 

 	$id = $this->input->get('id');
	$tableName = $this->input->get('TableName');
	$fieldName = $this->input->get('FieldName');
	$FieldValue = $this->input->get('FieldValue');
	$NameOfId = $this->input->get('NameOfId');
	 
	  	$this->db->where($fieldName,$FieldValue);
		if($id!=0)
		{
			$this->db->where($NameOfId." != ",$id);
		}
	  	$Q = $this->db->get($tableName);

 	if($Q->num_rows() > 0)
	{	
		return $Q->num_rows();
	}
	else
		return 0;
	
 }
}
?>