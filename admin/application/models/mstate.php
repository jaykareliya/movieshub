?php  
class Mstate extends CI_Model{
		  /// Created by  :: hardik Dave
	/// Description :: This function retruns all states from database
	/// Returns     :: details of shipment
	 function getState()
	 {
		 $data = array();
		 $this->db->select('id,name');
		
		 $Q = $this->db->get('state');
		 $data[""] = "Select";
		 if ($Q->num_rows() > 0)
		 {
		   foreach ($Q->result_array() as $row)
		   {
			 $data[$row['id']] = $row['name'];
		   }
		 }
		$Q->free_result();  
		return $data; 
	}
	function bind_dropdown_State($Country_id)
		{
	//	$category_id = $this->input->get('Country_id');
	  $this->db->select('State_id,State_name');
	  	$this->db->where('Country_id',$Country_id);
	  	$Q = $this->db->get('State');
	  
	  	if($Q->num_rows()>0)
	   		return $Q->result();
	  	else
	   		return NULL;
		}
		function bind_dropdown_State1($Country_id)
  	{
   		$data = array();
     	  $this->db->select('State_id,State_name');
     	
		$this->db->where('Country_id',$Country_id);
	    $Q = $this->db->get('state');
        $data['']='Select';
    	if ($Q->num_rows() > 0)
		{
	    	foreach ($Q->result_array() as $row)
		    {
        		$data[$row['State_id']] = $row['State_name'];
	        }
    	 }
	     $Q->free_result();  
    	 return $data; 
  	}
 }
 
?>