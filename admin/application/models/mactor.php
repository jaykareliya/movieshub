<?php
class Mactor extends CI_Model
{
	/// Created By :: Hardik Dave
  
  	function getAllActors()
  	{
 		$data = array();
    	 $this->db->select('Actor_id,Actor_name');
    	 $this->db->order_by("Actor_name", "asc"); 
     //$this->db->where('is_active !=',0);
     	$Q = $this->db->get('Actor');
  		$data[""] = "Select";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$data[$row['Actor_id']] = $row['Actor_name'];
       		}
     	}
    	$Q->free_result();  
    	return $data; 
  	}
  	function getActors()
  	{
  		if($_GET["Movie_Actor_id"])
  		{
  			$movie_id;
  			$Q = $this->db->query("select Movie_Id from movie_actor where Movie_Actor_id =".$_GET["Movie_Actor_id"]."");
  			foreach ($Q->result_array() as $row)
		    {
        		$movie_id = $row['Movie_Id'];
	       	}
	  	$Q = $this->db->query("select * from actor where actor_id not in(select actor_id from movie_actor where Movie_id =".$movie_id.") union (
	  		select * from actor where actor_id =(select actor_id from movie_actor where movie_actor_id =".$_GET["Movie_Actor_id"].")) order by actor_name asc");
	  }

	  	$data[""] = "Select";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$data[$row['Actor_Id']] = $row['Actor_Name'];
       		}
     	}
    	$Q->free_result();  
    	return $data; 
  	}
  
	function bind_actor()
	{
	
		if($_GET["Movie_id"])
	  	$Q = $this->db->query("select * from actor where actor_id not in(select actor_id from movie_actor where movie_id =".$_GET["Movie_id"].") order by actor_name asc");

	  	if($Q->num_rows()>0)
	   		return $Q->result();
	  	else
	   		return NULL;
	}
    function bind_dropdown_Actor()
    {
		$data = array();
     	$this->db->select('Actor_id,Actor_name');
     	 $this->db->order_by("Actor_name", "asc"); 
	    $Q = $this->db->get('Actor');
        $data['']='Select';
    	if ($Q->num_rows() > 0)
		{
	    	foreach ($Q->result_array() as $row)
		    {
        		$data[$row['ACtor_id']] = $row['Actor_name'];
	       	}
    	}
	    $Q->free_result();  
    	return $data; 
    }
	
	/// Created by  :: Yash Shah
	/// Description :: This function binds the dropdown for category for offers
	/// Returns     :: category_id,category_name
    
   
    /// Created by  :: Yash Shah
	/// Description :: This function is used to get number of records in category table
	/// Returns     :: Number of records in category table
    function fill_Actor_table($alpha,$keyword)
    {
		//$Q = $this->db->get('category');
		if($alpha == "ALL")
			$alpha = "";
			
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Actor_name LIKE "1%" OR Actor_name LIKE "2%" OR Actor_name LIKE "3%" OR Actor_name LIKE "4%" OR Actor_name LIKE "5%" OR Actor_name LIKE "6%" OR Actor_name LIKE "7%" OR Actor_name LIKE "8%" OR Actor_name LIKE "9';
		}
		$Q = $this->db->query('SELECT * FROM Actor WHERE (Actor_name LIKE "'.$alpha.'%" AND Actor_name LIKE "'.$keyword.'%") ');
		return $Q->num_rows();
   	}
   
    /// Created by  :: Yash Shah
	/// Description :: This function is used to find records in category table for the pagination
	/// Parameters  :: $start_row --> starting row of record
	///				   $limit     --> limit of records per page
	/// Returns     :: Records per page in category table
    function fill_Actor_table_condition($start_row,$limit,$alpha,$keyword)
    {
		if($alpha == "ALL")
			$alpha = "";
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Actor_name LIKE "1%" OR Actor_name LIKE "2%" OR Actor_name LIKE "3%" OR Actor_name LIKE "4%" OR Actor_name LIKE "5%" OR Actor_name LIKE "6%" OR Actor_name LIKE "7%" OR Actor_name LIKE "8%" OR Actor_name LIKE "9';

		}	
			
		$query_str = 'SELECT * FROM Actor WHERE (Actor_name LIKE "'.$alpha.'%" AND Actor_name LIKE "'.$keyword.'%")  LIMIT '.$start_row.','.$limit;
	    $Q = $this->db->query($query_str);
	    return $Q->result();
   	}
   
    /// Created by  :: Yash Shah
	/// Description :: This function is used to get all the records in category table
	/// Returns     :: All records in category table
    function fill_actor_details($actor_id)
    {
		$this->db->where('actor_id',$actor_id);
		
   		$Q = $this->db->get('actor');
		if($Q->num_rows()>0)
			return $Q->result();
		else
			return NULL;
    }
   
    /// Created by  :: Yash Shah
	/// Description :: This function is used to save new category
	/// Returns     :: TRUE/FALSE;
    function save_new_Actor()
    {
   		if(!($this->check_existance_of_actor($this->input->post('txtActorName'),0)))
		{
			$actor_avatar = 'default_image.jpg';
		if($_FILES['actor_avatar']['name'] != "")
		{
			$config['upload_path'] = './../images/Actor/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			$this->load->library('upload', $config);	
						
			if (!$this->upload->do_upload('actor_avatar'))
			{
				$error = array('error' => 'The file you have uploaded is of invalid format. Only JPG | GIF | PNG format is allowed. ');
				print_r($error);
				exit();
			}
			else
			{
				$image = $this->upload->data();
				if ($image['file_name'])
				{
					$data['file1'] = $image['file_name'];
				}
				
				$actor_avatar = $data['file1'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Actor/'.$data['file1'];
				$config['new_image'] = './../images/Actor/large/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 280;
				$config['height'] = 280;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
						
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Actor/'.$data['file1'];
				$config['new_image'] = './../images/Actor/medium/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 180;
				$config['height'] = 180;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Actor/'.$data['file1'];
				$config['new_image'] = './../images/Actor/small/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 70;
				$config['height'] = 70;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
			}
		}
			$d = array(
				'Actor_name'=>$this->input->post('txtActorName'),
				'Gender'=>($this->input->post('chkIsMale')==='on')?1:0,
				'Actor_DOB'=>$this->NullIfBlank($this->input->post('txtDOB')),
				'Actor_Death_Date'=>$this->NullIfBlank($this->input->post('txtDOD')),
				'Actor_Birth_Place'=>$this->input->post('txtBirthPlace'),
				'Actor_avatar'=>$actor_avatar,

			);
			$this->db->insert('actor',$d);

			return TRUE;
		}
		else
			return FALSE;
   }
   
    function update_actor()
    {
   		$actor_id = $this->input->get('actor_id');
   	
		$actor_avatar = 'default_image.jpg';
		if($_FILES['actor_avatar']['name'] != "")
		{
			$config['upload_path'] = './../images/Actor/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			$this->load->library('upload', $config);	
						
			if (!$this->upload->do_upload('actor_avatar'))
			{
				$error = array('error' => 'The file you have uploaded is of invalid format. Only JPG | GIF | PNG format is allowed. ');
				print_r($error);
				exit();
			}
			else
			{
				$image = $this->upload->data();
				if ($image['file_name'])
				{
					$data['file1'] = $image['file_name'];
				}
				
				$actor_avatar = $data['file1'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Actor/'.$data['file1'];
				$config['new_image'] = './../images/Actor/large/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 280;
				$config['height'] = 280;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
						
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Actor/'.$data['file1'];
				$config['new_image'] = './../images/Actor/medium/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 180;
				$config['height'] = 180;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Actor/'.$data['file1'];
				$config['new_image'] = './../images/Actor/small/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 70;
				$config['height'] = 70;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
			}
			$this->delete_image($actor_id,'actor','Actor_avatar','actor_id','actor');
			$d = array(
				'Actor_name'=>$this->input->post('txtActorName'),
				'Gender'=>($this->input->post('chkIsMale')==='on')?1:0,
				'Actor_DOB'=>$this->NullIfBlank($this->input->post('txtDOB')),
				'Actor_Death_Date'=>$this->NullIfBlank($this->input->post('txtDOD')),
				'Actor_Birth_Place'=>$this->input->post('txtBirthPlace'),
				'Actor_avatar'=>$actor_avatar,

			);
			$this->db->where('actor_id',$actor_id);
			$this->db->update('actor',$d);
		}
		else
		{
			$d = array(
				'Actor_name'=>$this->input->post('txtActorName'),
				'Gender'=>($this->input->post('chkIsMale')==='on')?1:0,
				'Actor_DOB'=>$this->NullIfBlank($this->input->post('txtDOB')),
				'Actor_Death_Date'=>$this->NullIfBlank($this->input->post('txtDOD')),
				'Actor_Birth_Place'=>$this->input->post('txtBirthPlace'),
				

			);
			$this->db->where('actor_id',$actor_id);
			$this->db->update('actor',$d);
		}
		
			
			//header('location: http://www.ramigift.com/index.php/page/manage_category');
			return TRUE;
		
		
   }
   
    /// Created by  :: Yash Shah
	/// Description :: This function is used to delete category
	/// Returns     :: TRUE/FALSE
    function delete_actor()
    {
   		$actor_id = $this->input->get('Actor_id');
		
		
			
		
			$this->db->where('actor_id',$actor_id);
			$Q = $this->db->get('actor');
			if($Q->num_rows()>0)
			{
			
				/// Delete image
				//$this->delete_image($actor_id);
				
				$this->delete_image($actor_id,'actor','Actor_avatar','actor_id','actor');
				$this->db->where('actor_id',$actor_id);
				$this->db->delete('movie_actor');
				// Image deleted
				$this->db->where('actor_id',$actor_id);
				$this->db->delete('Actor');
			}
			return TRUE;
			exit();
		
    }
   
    /// Created by  :: Yash Shah
	/// Description :: This function is used to check if the category already exists or not
	/// Returns     :: TRUE/FALSE
    function check_existance_of_actor($actor_name,$actor_id)
    {
	   	if($actor_id!=0)
		{
   			$this->db->where('actor_id !=',$actor_id);
   		}
		$this->db->where('Actor_name',$actor_name);
   		$Q = $this->db->get('Actor');
		if($Q->num_rows>0)
			return TRUE;
		else
			return FALSE;
    }
   
    /// Created by  :: Yash Shah
	/// Description :: This function is used to check weather the given datetime is null or not
	/// Returns     :: NULL/PARAMETER
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
	
	/// Created by  :: Yash Shah
	/// Description :: This function is used to check weather a foreign key is associated with this category or not
	/// Returns     :: TRUE/FALSE
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
	/// Created by  :: Yash Shah
	/// Description :: This function is used to delete image from server if admin updates or deletes image
	/// Returns     :: 

	function delete_image($id_value,$table,$field_name,$field_id,$path)
	{
		
		/*$getcategory_url = $this->db->select("banner_image")->from("category")->where("id", $category_id)->get();
			
			$result_object = $getcategory_url->row();
			
			$image_name = $result_object->banner_image;
			*/
			
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
