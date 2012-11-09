<?php
class Madmin extends CI_Model
{
	function bind_dropdown_pages()
	{
		$data = array();
     	$this->db->select('id,title');
	    $Q = $this->db->get('pages');
        $data['0']='Select';
    	if ($Q->num_rows() > 0)
		{
	    	foreach ($Q->result_array() as $row)
		    {
        		$data[$row['id']] = $row['title'];
	        }
    	 }
	     $Q->free_result();  
    	 return $data; 
	}
	function login($user_email,$password)
	{
			$query_str = "select * from user where User_Email_Address = '".$user_email."' and Password = ".$password;
		$Q = $this->db->query($query_str);
		if($Q->num_rows()>0)
			return TRUE;
		else
			return FALSE;

	}
	function fill_admin_pages()
	{
		return $this->db->get('pages')->result();
	}
	
	function update_pages()
	{
		$page_id = $this->uri->segment(3);
		
		$description = array("description"=>$this->input->post("txtAdminPages"));
		$this->db->where("id",$page_id);
		$this->db->update("pages",$description);
	}
	
	function fill_faq_table()
	{
		return $this->db->get('faq')->num_rows();
	}
	function fill_faq_table_condition($start_row,$limit)
	{
		$query_str = "select * from faq limit $start_row,$limit";
		$Q = $this->db->query($query_str);
		if($Q->num_rows()>0)
			return $Q->result();
		else
			return NULL;
	}
	function get_client_detail()
	{


			$query_str = "select Count( url ) AS cnt, url,country_name,region_name,city,year(time) as year,month(time) as month FROM client_detail GROUP BY url";
		$Q = $this->db->query($query_str);
		if($Q->num_rows()>0)
			return $Q->result();
		else
			return NULL;
	}
		function get_client_detail_bycountry($country)
	{
			$query_str = "select Count( url ) AS cnt, url,country_name,region_name,city FROM client_detail where country_name = '".$country."' GROUP BY url";
		$Q = $this->db->query($query_str);
		if($Q->num_rows()>0)
			return $Q->result();
		else
			return NULL;
	}
	
		function get_country_detail()
	{
			$data = array();
     $query_str = "select country_name FROM client_detail GROUP BY country_name";
		$Q = $this->db->query($query_str);
		$i=0;
		$data[$i] = "select";
		$i++;
    	if ($Q->num_rows() > 0)
		{
	    	foreach ($Q->result_array() as $row)
		    {
        		$data[$i] = $row['country_name'];
        		$i++;
	       	}
    	}
	    $Q->free_result();  
    	return $data; 


			
	}
			function get_client_detail_bystate($state)
	{
			$query_str = "select Count( url ) AS cnt, url,country_name,region_name,city FROM client_detail where region_name = '".$state."' GROUP BY url";
		$Q = $this->db->query($query_str);
		if($Q->num_rows()>0)
			return $Q->result();
		else
			return NULL;
	}
	
		function get_state_detail()
	{
			$data = array();
     $query_str = "select region_name FROM client_detail GROUP BY region_name";
		$Q = $this->db->query($query_str);
		$i=0;
		$data[$i] = "select";
		$i++;
    	if ($Q->num_rows() > 0)
		{
	    	foreach ($Q->result_array() as $row)
		    {
        		$data[$i] = $row['region_name'];
        		$i++;
	       	}
    	}
	    $Q->free_result();  
    	return $data; 


			
	}
	function get_client_detail_bycity($city)
	{
			$query_str = "select Count( url ) AS cnt, url,country_name,region_name,city FROM client_detail where city = '".$city."' GROUP BY url";
		$Q = $this->db->query($query_str);
		if($Q->num_rows()>0)
			return $Q->result();
		else
			return NULL;
	}
	
		function get_city_detail()
	{
			$data = array();
     $query_str = "select city FROM client_detail GROUP BY city";
		$Q = $this->db->query($query_str);
		$i=0;
		$data[$i] = "select";
		$i++;
    	if ($Q->num_rows() > 0)
		{
	    	foreach ($Q->result_array() as $row)
		    {
        		$data[$i] = $row['city'];
        		$i++;
	       	}
    	}
	    $Q->free_result();  
    	return $data; 


			
	}
	
	function get_client_detail_bydate($date)
	{
		
			$query_str = "select Count( url ) AS cnt, url,country_name,region_name,city FROM client_detail where DATE_FORMAT(time,'%d-%m-%Y') = '".$date."' GROUP BY url";
		
		$Q = $this->db->query($query_str);
		if($Q->num_rows()>0)
			return $Q->result();
		else
			return NULL;
	}
	function get_client_detail_byweek($week)
	{
			$query_str = "select Count( url ) AS cnt, url,country_name,region_name,city FROM client_detail WHERE time between DATE_SUB('".$week."', INTERVAL 7 DAY) AND '".$week."' GROUP BY url";
		$Q = $this->db->query($query_str);
		if($Q->num_rows()>0)
			return $Q->result();
		else
			return NULL;
	}
	function get_client_detail_bymonth($month)
	{
		$current_year = date("Y");
			$query_str = "select Count( url ) AS cnt, url,country_name,region_name,city FROM client_detail where year(Time) = ".$current_year." and month(Time) = ".$month." GROUP BY url";
		$Q = $this->db->query($query_str);
		if($Q->num_rows()>0)
			return $Q->result();
		else
			return NULL;
	}
	
		function get_month_detail()
	{
			$data = array();
    		$data[0] = 'Select';
        	$data[1] = 'January';
        	$data[2] = 'February';
        	$data[3] = 'March';
        	$data[4] = 'April';
        	$data[5] = 'May';
        	$data[6] = 'June';
        	$data[7] = 'July';
        	$data[8] = 'August';
        	$data[9] = 'September';
        	$data[10] = 'October';
        	$data[11] = 'November';
        	$data[12] = 'December';	
	   
    	return $data; 


			
	}
		function get_client_detail_byyear($year)
	{
			$data = array();
		
		$current_year = date("Y");
		$current_month = date('m'); 
		if($year == $current_year)
		{
			$query_str = "select Count( url ) AS cnt, url,country_name,region_name,city FROM client_detail where year(Time) = ".$year." and month(Time) <= ".$current_month." GROUP BY url";

		}
		else
		{
			$query_str = "select Count( url ) AS cnt, url,country_name,region_name,city FROM client_detail where year(Time) = ".$year."  GROUP BY url";

		}
		$Q = $this->db->query($query_str);
		if($Q->num_rows()>0)
			return $Q->result();
		else
			return NULL;
	}
	function save_new_faq()
	{
		$d = array(
			'question'=>$this->input->post('txtQuestion'),
			'answer'=>$this->input->post('txtAnswer'),
			'is_active'=>($this->input->post('chkIsActive')==='on')?1:0,
		);
		$this->db->insert('faq',$d);
		return TRUE;
	}
	function fill_faq_details($faq_id)
	{
		$this->db->where('id',$faq_id);
		$Q = $this->db->get('faq');
		if($Q->num_rows()>0)
			return $Q->result();
		else
			return NULL;
	}
	function update_faq()
	{
		$d = array(
			'question'=>$this->input->post('txtQuestion'),
			'answer'=>$this->input->post('txtAnswer'),
			'is_active'=>($this->input->post('chkIsActive')==='on')?1:0,
		);
		$faq_id = $this->input->get('id');
		$this->db->where('id',$faq_id);
		$this->db->update('faq',$d);
	}
	function delete_faq()
	{
		$faq_id = $this->input->get('id');
		$this->db->where('id',$faq_id);
		$this->db->delete('faq');
	}
	
	function update_password()
	{
		$old_password = $this->input->post("txtOldPassword");
		$new_password = $this->input->post("txtNewPassword");
	}
	
	  function get_page($id)
    {
		$this->db->where('id',$id);
   		$Q = $this->db->get('pages');
		if($Q->num_rows()>0)
			return $Q->row();
		else
			return NULL;
    }
	 
	  function get_all_pages()
    {
   		$Q = $this->db->get('pages');
		if($Q->num_rows()>0)
			return $Q->result();
		else
			return NULL;
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