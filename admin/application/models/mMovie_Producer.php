<?php
class MMovie_Producer extends CI_Model
{
	
  
  	function getAllProducers()
  	{
 		$data = array();
    	 $this->db->select('Producer_id,Producer_name');
    	     	  $this->db->order_by("Producer_name", "asc"); 
     //$this->db->where('is_active !=',0);
     	$Q = $this->db->get('Producer');
  		$data[""] = "Select";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$data[$row['Producer_id']] = $row['Producer_name'];
       		}
     	}
    	$Q->free_result();  
    	return $data; 
  	}
  
    function bind_dropdown_Movie_Producer()
    {
		$data = array();
     	$this->db->select('Producer_id,Producer_name');
     	 $this->db->order_by("Producer_name", "asc"); 
	    $Q = $this->db->get('Producer');
        $data['']='Select';
    	if ($Q->num_rows() > 0)
		{
	    	foreach ($Q->result_array() as $row)
		    {
        		$data[$row['Producer_id']] = $row['Producer_name'];
	       	}
    	}
	    $Q->free_result();  
    	return $data; 
    }
	

    function fill_Movie_Producer_table($alpha,$keyword)
    {
		//$Q = $this->db->get('category');
		if($alpha == "ALL")
			$alpha = "";
			
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Movie_name LIKE "1%" OR Movie_name LIKE "2%" OR Movie_name LIKE "3%" OR Movie_name LIKE "4%" OR Movie_name LIKE "5%" OR Movie_name LIKE "6%" OR Movie_name LIKE "7%" OR Movie_name LIKE "8%" OR Movie_name LIKE "9';
		}
		$Q = $this->db->query('SELECT * FROM Movie right join Movie_Producer on (movie_Producer.Movie_Id = Movie.Movie_Id) WHERE (movie.Movie_name LIKE "'.$alpha.'%" AND movie.Movie_name LIKE "'.$keyword.'%") ');
		return $Q->num_rows();
   	}
   

    function fill_Movie_Producer_table_condition($start_row,$limit,$alpha,$keyword)
    {
		if($alpha == "ALL")
			$alpha = "";
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Movie_name LIKE "1%" OR Movie_name LIKE "2%" OR Movie_name LIKE "3%" OR Movie_name LIKE "4%" OR Movie_name LIKE "5%" OR Movie_name LIKE "6%" OR Movie_name LIKE "7%" OR Movie_name LIKE "8%" OR Movie_name LIKE "9';

		}	
			
		$query_str = 'SELECT * FROM Movie right join Movie_Producer on (movie_Producer.Movie_Id = Movie.Movie_Id) left join Producer on (Producer.Producer_id = movie_Producer.Producer_id) WHERE (movie.Movie_name LIKE "'.$alpha.'%" AND movie.Movie_name LIKE "'.$keyword.'%")  LIMIT '.$start_row.','.$limit;
	    $Q = $this->db->query($query_str);
	    return $Q->result();
   	}
   
    
    function fill_Movie_Producer_details($Movie_Producer_id)
    {
		$this->db->where('Movie_Producer_id',$Movie_Producer_id);
			
   		$Q = $this->db->get('Movie_Producer');

		if($Q->num_rows()>0)
		{
			
			return $Q->result();
		
		}
		else
		{
			return NULL;

		}
    }
   
   
    function save_new_Movie_Producer()
    {
   		
			
			$d = array(
				'Movie_id'=>$this->input->post('ddlMovie'),
			//	'Gender'=>($this->input->post('chkIsMale')==='on')?1:0,
				'Producer_id'=>$this->input->post('ddlProducer'),
				

			);
			$this->db->insert('Movie_Producer',$d);

			return TRUE;
		
   }
   
    
    function update_Movie_Producer()
    {
   		$Movie_Producer_id = $this->input->get('Movie_Producer_id');
   	
			$d = array(
				'Movie_id'=>$this->input->post('ddlMovie'),
			
				'Producer_id'=>$this->input->post('ddlProducer'),
				

			);
			$this->db->where('Movie_Producer_id',$Movie_Producer_id);
			$this->db->update('Movie_Producer',$d);
			
			
		
		
			
			//header('location: http://www.ramigift.com/index.php/page/manage_category');
			return TRUE;
		
		
   }
   
  
    function delete_Movie_Producer()
    {
   		$Movie_Producer_id = $this->input->get('Movie_Producer_id');
		
		
			
		
			$this->db->where('Movie_Producer_Id',$Movie_Producer_id);
			$Q = $this->db->get('Movie_Producer');
			if($Q->num_rows()>0)
			{
			
				$this->db->where('Movie_Producer_id',$Movie_Producer_id);
				$this->db->delete('Movie_Producer');
			}
			return TRUE;
			exit();
		
    }
   
    function check_existance_of_Movie_Producer($Producer_name,$Producer_id)
    {
	   	if($Producer_id!=0)
		{
   			$this->db->where('Producer_id !=',$Producer_id);
   		}
		$this->db->where('Producer_name',$Producer_name);
   		$Q = $this->db->get('Producer');
		if($Q->num_rows>0)
			return TRUE;
		else
			return FALSE;
    }
   

    function NullIfBlank($date_parameter)
    {
   		if($date_parameter=="" || $date_parameter==NULL)
			return NULL;
		else
		{
			$date_year=substr($date_parameter,6,4);
			$date_month=substr($date_parameter,3,2);
			$date_day=substr($date_parameter,0,2);
			$date=date("Y-m-d", mktime(0,0,0,$date_month,$date_day,$date_year));
			return $date;
		}
    }
	

	function check_foreign_key($category_id)
	{
		
 		$this->db->select('*');
     	$this->db->where('sub_category.category_id =',$category_id);
		$this->db->where('product.category_id =',$category_id);
		
     	$Q = $this->db->get('sub_category,product');
	
  		$data[""] = "Select";
     	
		if($Q->num_rows() == 0)
			return TRUE;
		else
			return FALSE;
	}
	function get_category_by_sub_category($sub_cat_id)
	{
		
	}
	
	function delete_image($id_value,$table,$field_name,$field_id,$path)
	{
		
		
			$data = array();
     	$this->db->select($field_name);
     	$this->db->where($field_id,$id_value);
	    $Q = $this->db->get($table);
       $image_name ="default_image.jpg";
    	if ($Q->num_rows() > 0)
		{
	    	foreach ($Q->result_array() as $row)
		    {
        		$image_name = $row[$field_name];
	       	}
    	}
			
			
			
			
		if($image_name!="default_image.jpg")
		{
			$image_default = "./../images/".$path."/".$image_name;
			$image_large = "./../images/".$path."/large/".$image_name;
			$image_medium = "./../images/".$path."/medium/".$image_name;
			$image_small = "./../images/".$path."/small/".$image_name;
			$return = @unlink($image_default);
			$return = @unlink($image_large);
			$return = @unlink($image_medium);
			$return = @unlink($image_small);
		}
	}
}
?>