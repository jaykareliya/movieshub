<?php
class MMovie_News extends CI_Model
{
	
  
  	function getAllMovie_News()
  	{
 		$data = array();
    	 $this->db->select('Movie_News_id,Movie_News_Desc');
     //$this->db->where('is_active !=',0);
     	$Q = $this->db->get('Movie_News');
  		$data[""] = "Select";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$data[$row['Movie_News_id']] = $row['Movie_News_Desc'];
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
	  		select * from actor where actor_id =(select actor_id from movie_actor where movie_actor_id =".$_GET["Movie_Actor_id"]."))");
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
	  	$Q = $this->db->query("select * from actor where actor_id not in(select actor_id from movie_actor where movie_id =".$_GET["Movie_id"].")");

	  	if($Q->num_rows()>0)
	   		return $Q->result();
	  	else
	   		return NULL;
	}
    function bind_dropdown_Movie_News()
    {
		$data = array();
     	$this->db->select('Actor_id,Actor_name');
     	
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
	
	
    function fill_Movie_News_table($alpha,$keyword)
    {
		//$Q = $this->db->get('category');
		if($alpha == "ALL")
			$alpha = "";
			
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Movie_News_Title LIKE "1%" OR Movie_News_Title LIKE "2%" OR Movie_News_Title LIKE "3%" OR Movie_News_Title LIKE "4%" OR Movie_News_Title LIKE "5%" OR Movie_News_Title LIKE "6%" OR Movie_News_Title LIKE "7%" OR Movie_News_Title LIKE "8%" OR Movie_News_Title LIKE "9';
		}
		$Q = $this->db->query('SELECT * FROM Movie_News WHERE (Movie_News_Title LIKE "'.$alpha.'%" AND Movie_News_Title LIKE "'.$keyword.'%") ');
		return $Q->num_rows();
   	}
   
  
    function fill_Movie_News_table_condition($start_row,$limit,$alpha,$keyword)
    {
		if($alpha == "ALL")
			$alpha = "";
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Movie_News_Title LIKE "1%" OR Movie_News_Title LIKE "2%" OR Movie_News_Title LIKE "3%" OR Movie_News_Title LIKE "4%" OR Movie_News_Title LIKE "5%" OR Movie_News_Title LIKE "6%" OR Movie_News_Title LIKE "7%" OR Movie_News_Title LIKE "8%" OR Movie_News_Title LIKE "9';

		}	
			
		$query_str = 'SELECT * FROM Movie_News WHERE (Movie_News_Title LIKE "'.$alpha.'%" AND Movie_News_Title LIKE "'.$keyword.'%")  LIMIT '.$start_row.','.$limit;
	    $Q = $this->db->query($query_str);
	    return $Q->result();
   	}
   

    function fill_Movie_News_details($Movie_News_id)
    {
		$this->db->where('Movie_News_id',$Movie_News_id);
		
   		$Q = $this->db->get('Movie_News');
		if($Q->num_rows()>0)
			return $Q->result();
		else
			return NULL;
    }
   
    
    function save_new_Movie_News()
    {
   		if(!($this->check_existance_of_Movie_News($this->input->post('txtMovie_NewsTitle'),0)))
		{
			$Movie_News_Image = 'default_image.jpg';
		if($_FILES['Movie_News_Image']['name'] != "")
		{
			$config['upload_path'] = './../images/Movie_News/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			$this->load->library('upload', $config);	
						
			if (!$this->upload->do_upload('Movie_News_Image'))
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
				
				$Movie_News_Image = $data['file1'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Movie_News/'.$data['file1'];
				$config['new_image'] = './../images/Movie_News/large/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 280;
				$config['height'] = 280;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
						
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Movie_News/'.$data['file1'];
				$config['new_image'] = './../images/Movie_News/medium/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 180;
				$config['height'] = 180;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Movie_News/'.$data['file1'];
				$config['new_image'] = './../images/Movie_News/small/';
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
				'Movie_News_Title'=>$this->input->post('txtMovie_NewsTitle'),
				'Movie_News_Description'=>$this->input->post('txtMovie_NewsDescription'),
				'Movie_News_Type'=>$this->input->post('ddlMovie_Type'),
				'Movie_News_Image'=>$Movie_News_Image,
				

			);
			$this->db->insert('Movie_News',$d);

			return TRUE;
		}
		else
			return FALSE;
   }
   
    function update_Movie_News()
    {
   		$Movie_News_id = $this->input->get('Movie_News_id');
   	
		$Movie_News_Image = 'default_image.jpg';
		if($_FILES['Movie_News_Image']['name'] != "")
		{
			$config['upload_path'] = './../images/Movie_News/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			$this->load->library('upload', $config);	
						
			if (!$this->upload->do_upload('Movie_News_Image'))
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
				
				$Movie_News_Image = $data['file1'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Movie_News/'.$data['file1'];
				$config['new_image'] = './../images/Movie_News/large/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 280;
				$config['height'] = 280;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
						
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Movie_News/'.$data['file1'];
				$config['new_image'] = './../images/Movie_News/medium/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 180;
				$config['height'] = 180;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Movie_News/'.$data['file1'];
				$config['new_image'] = './../images/Movie_News/small/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 70;
				$config['height'] = 70;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
			}
			$this->delete_image($Movie_News_id,'Movie_News','Movie_News_Image','Movie_News_id','Movie_News');
			$d = array(
				'Movie_News_Title'=>$this->input->post('txtMovie_NewsTitle'),
				'Movie_News_Description'=>$this->input->post('txtMovie_NewsDescription'),
				'Movie_News_Type'=>$this->input->post('ddlMovie_Type'),
				'Movie_News_Image'=>$Movie_News_Image,

			);
			$this->db->where('Movie_News_id',$Movie_News_id);
			$this->db->update('Movie_News',$d);
		}
		else
		{
			$d = array(
				'Movie_News_Title'=>$this->input->post('txtMovie_NewsTitle'),
				'Movie_News_Description'=>$this->input->post('txtMovie_NewsDescription'),
				'Movie_News_Type'=>$this->input->post('ddlMovie_Type'),
				
				

			);
			$this->db->where('Movie_News_id',$Movie_News_id);
			$this->db->update('Movie_News',$d);
		}
		
			
			//header('location: http://www.ramigift.com/index.php/page/manage_category');
			return TRUE;
		
		
   }
   
    
    function delete_Movie_News()
    {
   		$Movie_News_id = $this->input->get('Movie_News_id');
		
		
			
		
			$this->db->where('Movie_News_id',$Movie_News_id);
			$Q = $this->db->get('Movie_News');
			if($Q->num_rows()>0)
			{
			
				/// Delete image
				//$this->delete_image($actor_id);
				
				$this->delete_image($Movie_News_id,'Movie_News','Movie_News_Image','Movie_News_id','Movie_News');
				
				// Image deleted
				$this->db->where('Movie_News_id',$Movie_News_id);
				$this->db->delete('Movie_News');
			}
			return TRUE;
			exit();
		
    }
   
    
    function check_existance_of_Movie_News($Movie_News_Title,$Movie_News_id)
    {
	   	if($Movie_News_id!=0)
		{
   			$this->db->where('Movie_News_id !=',$Movie_News_id);
   		}
		$this->db->where('Movie_News_Title',$Movie_News_TItle);
   		$Q = $this->db->get('Movie_News');
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
