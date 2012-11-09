<?php
class MMovie_Special_Appereance extends CI_Model
{
	
  
  	function getAllSpecial_Appereances()
  	{
 			$Q = $this->db->query("select actor_id as Special_Appereance_id,actor_name as Special_Appereance_name from actor order by Special_Appereance_name asc");
  		$data[""] = "Select";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$data[$row['Special_Appereance_id']] = $row['Special_Appereance_name'];
       		}
     	}
    	$Q->free_result();  
    	return $data; 
  	}
  
    function bind_dropdown_Movie_Special_Appereance()
    {
		$data = array();
     	$this->db->select('actor_id as Special_Appereance_id,actor_name as Special_Appereance_name');
     	
	    $Q = $this->db->get('actor');
        $data['']='Select';
    	if ($Q->num_rows() > 0)
		{
	    	foreach ($Q->result_array() as $row)
		    {
        		$data[$row['Special_Appereance_id']] = $row['Special_Appereance_name'];
	       	}
    	}
	    $Q->free_result();  
    	return $data; 
    }
    function bind_Movie_Special_Appereance()
	{
	
		if($_GET["Movie_id"])
	   $Q = $this->db->query("select actor_id as Special_Appereance_id,actor_name as Special_Appereance_name from actor where actor_id not 
   in (select actor_id from movie_actor where movie_id = ".$_GET["Movie_id"].") and actor_id not 
   in (select special_appereance_id from movie_special_appereance where movie_id = ".$_GET["Movie_id"].") order by Special_Appereance_name asc ");

	  	if($Q->num_rows()>0)
	   		return $Q->result();
	  	else
	   		return NULL;
	}
	

    function fill_Movie_Special_Appereance_table($alpha,$keyword)
    {
		//$Q = $this->db->get('category');
		if($alpha == "ALL")
			$alpha = "";
			
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Movie_name LIKE "1%" OR Movie_name LIKE "2%" OR Movie_name LIKE "3%" OR Movie_name LIKE "4%" OR Movie_name LIKE "5%" OR Movie_name LIKE "6%" OR Movie_name LIKE "7%" OR Movie_name LIKE "8%" OR Movie_name LIKE "9';
		}
		$Q = $this->db->query('SELECT * FROM Movie right join Movie_Special_Appereance on (movie_Special_Appereance.Movie_Id = Movie.Movie_Id) WHERE (movie.Movie_name LIKE "'.$alpha.'%" AND movie.Movie_name LIKE "'.$keyword.'%") ');
		return $Q->num_rows();
   	}
    	function getSpecial_Appereances()
  	{
  		if($_GET["Movie_Special_Appereance_id"])
  		{
  			$movie_id;
  			$Q = $this->db->query("select Movie_Id from movie_Special_Appereance where Movie_Special_Appereance_id =".$_GET["Movie_Special_Appereance_id"]."");
  			foreach ($Q->result_array() as $row)
		    {
        		$movie_id = $row['Movie_Id'];
	       	}
	  	$Q = $this->db->query("select actor_id as Special_Appereance_id,actor_name as Special_Appereance_name from actor where actor_id not in(select Special_Appereance_id from movie_Special_Appereance where Movie_id =".$movie_id.") and actor_id not in
	  	 (select actor_id from movie_actor where movie_id = ".$movie_id.") union (
	  		select actor_id as Special_Appereance_id,actor_name as Special_Appereance_name from actor where actor_id =(select Special_Appereance_id from movie_Special_Appereance where movie_Special_Appereance_id =".$_GET["Movie_Special_Appereance_id"].") order by  Special_Appereance_name asc)
	  	");
	  }

	  	$data[""] = "Select";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$data[$row['Special_Appereance_id']] = $row['Special_Appereance_name'];
       		}
     	}
    	$Q->free_result();  
    	return $data; 
  	}

    function fill_Movie_Special_Appereance_table_condition($start_row,$limit,$alpha,$keyword)
    {
		if($alpha == "ALL")
			$alpha = "";
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Movie_name LIKE "1%" OR Movie_name LIKE "2%" OR Movie_name LIKE "3%" OR Movie_name LIKE "4%" OR Movie_name LIKE "5%" OR Movie_name LIKE "6%" OR Movie_name LIKE "7%" OR Movie_name LIKE "8%" OR Movie_name LIKE "9';

		}	
			
		$query_str = 'SELECT Movie.*,Movie_Special_Appereance.*,actor.actor_id as Special_Appereance_Id,actor.actor_name as Special_Appereance_Name FROM Movie right join Movie_Special_Appereance on (movie_Special_Appereance.Movie_Id = Movie.Movie_Id) left join Actor on (actor.actor_id = movie_Special_Appereance.Special_Appereance_id) WHERE (movie.Movie_name LIKE "'.$alpha.'%" AND movie.Movie_name LIKE "'.$keyword.'%")  LIMIT '.$start_row.','.$limit;
	    $Q = $this->db->query($query_str);
	    
	    return $Q->result();
   	}
   
  
    function fill_Movie_Special_Appereance_details($Movie_Special_Appereance_id)
    {
		$this->db->where('Movie_Special_Appereance_id',$Movie_Special_Appereance_id);
			
   		$Q = $this->db->get('Movie_Special_Appereance');

		if($Q->num_rows()>0)
		{
			
			return $Q->result();
		
		}
		else
		{
			return NULL;

		}
    }
   
    function save_new_Movie_Special_Appereance()
    {
   		
			
			$d = array(
				'Movie_id'=>$this->input->post('ddlMovie'),
			//	'Gender'=>($this->input->post('chkIsMale')==='on')?1:0,
				'Special_Appereance_id'=>$this->input->post('ddlSpecial_Appereance'),
				

			);
			$this->db->insert('Movie_Special_Appereance',$d);

			return TRUE;
		
   }
   
    
    function update_Movie_Special_Appereance()
    {
   		$Movie_Special_Appereance_id = $this->input->get('Movie_Special_Appereance_id');
   	
			$d = array(
				'Movie_id'=>$this->input->post('ddlMovie'),
			
				'Special_Appereance_id'=>$this->input->post('ddlSpecial_Appereance'),
				

			);
			$this->db->where('Movie_Special_Appereance_id',$Movie_Special_Appereance_id);
			$this->db->update('Movie_Special_Appereance',$d);
			
			
		
		
			
			
			return TRUE;
		
		
   }
   
  
    function delete_Movie_Special_Appereance()
    {
   		$Movie_Special_Appereance_id = $this->input->get('Movie_Special_Appereance_id');
		
		
			
		
			$this->db->where('Movie_Special_Appereance_Id',$Movie_Special_Appereance_id);
			$Q = $this->db->get('Movie_Special_Appereance');
			if($Q->num_rows()>0)
			{
			
				$this->db->where('Movie_Special_Appereance_id',$Movie_Special_Appereance_id);
				$this->db->delete('Movie_Special_Appereance');
			}
			return TRUE;
			exit();
		
    }
   
    function check_existance_of_Movie_actor($Director_name,$Director_id)
    {
	   	if($Director_id!=0)
		{
   			$this->db->where('Director_id !=',$Director_id);
   		}
		$this->db->where('Director_name',$Director_name);
   		$Q = $this->db->get('Director');
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
