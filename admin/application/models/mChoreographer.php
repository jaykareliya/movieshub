<?php
class MChoreographer extends CI_Model
{
	
  
  	function getAllChoreographers()
  	{
 		$data = array();
    	 $this->db->select('Choreographer_id,Choreographer_name');
    	 	 $this->db->order_by("Choreographer_name", "asc"); 
     //$this->db->where('is_active !=',0);
     	$Q = $this->db->get('Choreographer');
  		$data[""] = "Select";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$data[$row['Choreographer_id']] = $row['Choreographer_name'];
       		}
     	}
    	$Q->free_result();  
    	return $data; 
  	}
  
    function bind_dropdown_Singe()
    {
		$data = array();
     	$this->db->select('Choreographer_id,Choreographer_name');
     	 $this->db->order_by("Choreographer_name", "asc"); 
	    $Q = $this->db->get('Choreographer');
        $data['']='Select';
    	if ($Q->num_rows() > 0)
		{
	    	foreach ($Q->result_array() as $row)
		    {
        		$data[$row['Choreographer_id']] = $row['Choreographer_name'];
	       	}
    	}
	    $Q->free_result();  
    	return $data; 
    }
	
function getChoreographers()
  	{
  		if($_GET["Movie_Choreographer_id"])
  		{
  			$movie_id;
  			$Q = $this->db->query("select Movie_Id from movie_Choreographer where Movie_Choreographer_id =".$_GET["Movie_Choreographer_id"]."");
  			foreach ($Q->result_array() as $row)
		    {
        		$movie_id = $row['Movie_Id'];
	       	}
	  	$Q = $this->db->query("select * from Choreographer where Choreographer_id not in(select Choreographer_id from movie_Choreographer where Movie_id =".$movie_id.") union (
	  		select * from Choreographer where Choreographer_id =(select Choreographer_id from movie_Choreographer where movie_Choreographer_id =".$_GET["Movie_Choreographer_id"]."))
	  	order by Choreographer_name asc");
	  }

	  	$data[""] = "Select";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$data[$row['Choreographer_Id']] = $row['Choreographer_Name'];
       		}
     	}
    	$Q->free_result();  
    	return $data; 
  	}
  
	function bind_Choreographer()
	{
	
		if($_GET["Movie_id"])
	  	$Q = $this->db->query("select * from Choreographer where Choreographer_id not in(select Choreographer_id from movie_Choreographer where movie_id =".$_GET["Movie_id"].")");

	  	if($Q->num_rows()>0)
	   		return $Q->result();
	  	else
	   		return NULL;
	}
    function fill_Choreographer_table($alpha,$keyword)
    {
		//$Q = $this->db->get('category');
		if($alpha == "ALL")
			$alpha = "";
			
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Choreographer_name LIKE "1%" OR Choreographer_name LIKE "2%" OR Choreographer_name LIKE "3%" OR Choreographer_name LIKE "4%" OR Choreographer_name LIKE "5%" OR Choreographer_name LIKE "6%" OR Choreographer_name LIKE "7%" OR Choreographer_name LIKE "8%" OR Choreographer_name LIKE "9';
		}
		$Q = $this->db->query('SELECT * FROM Choreographer WHERE (Choreographer_name LIKE "'.$alpha.'%" AND Choreographer_name LIKE "'.$keyword.'%") ');
		return $Q->num_rows();
   	}
   

    function fill_Choreographer_table_condition($start_row,$limit,$alpha,$keyword)
    {
		if($alpha == "ALL")
			$alpha = "";
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Choreographer_name LIKE "1%" OR Choreographer_name LIKE "2%" OR Choreographer_name LIKE "3%" OR Choreographer_name LIKE "4%" OR Choreographer_name LIKE "5%" OR Choreographer_name LIKE "6%" OR Choreographer_name LIKE "7%" OR Choreographer_name LIKE "8%" OR Choreographer_name LIKE "9';

		}	
			
		$query_str = 'SELECT * FROM Choreographer WHERE (Choreographer_name LIKE "'.$alpha.'%" AND Choreographer_name LIKE "'.$keyword.'%")  LIMIT '.$start_row.','.$limit;
	    $Q = $this->db->query($query_str);
	    return $Q->result();
   	}
   

    function fill_Choreographer_details($Choreographer_id)
    {
		$this->db->where('Choreographer_id',$Choreographer_id);
			
   		$Q = $this->db->get('Choreographer');

		if($Q->num_rows()>0)
		{
			
			return $Q->result();
		
		}
		else
		{
			return NULL;

		}
    }
   
  
    function save_new_Choreographer()
    {
    
   		if(!($this->check_existance_of_Choreographer($this->input->post('txtChoreographerName'),0)))
		{	
			$Choreographer_avatar = 'default_image.jpg';
		if($_FILES['Choreographer_avatar']['name'] != "")
		{
			$config['upload_path'] = './../images/Choreographer/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			$this->load->library('upload', $config);	
						
			if (!$this->upload->do_upload('Choreographer_avatar'))
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
				
				$Choreographer_avatar = $data['file1'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Choreographer/'.$data['file1'];
				$config['new_image'] = './../images/Choreographer/large/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 280;
				$config['height'] = 280;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
						
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Choreographer/'.$data['file1'];
				$config['new_image'] = './../images/Choreographer/medium/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 180;
				$config['height'] = 180;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Choreographer/'.$data['file1'];
				$config['new_image'] = './../images/Choreographer/small/';
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
				'Choreographer_name'=>$this->input->post('txtChoreographerName'),
			
				'Choreographer_avatar'=>$Choreographer_avatar,

			);
			$this->db->insert('Choreographer',$d);

			return TRUE;
		}
		else
			return FALSE;
   }
   
    
    function update_Choreographer()
    {
   		$Choreographer_id = $this->input->get('Choreographer_id');
   	
				
		if($_FILES['Choreographer_avatar']['name'] != "")
		{
			$config['upload_path'] = './../images/Choreographer/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			$this->load->library('upload', $config);	
						
			if (!$this->upload->do_upload('Choreographer_avatar'))
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
				
				$Choreographer_avatar = $data['file1'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Choreographer/'.$data['file1'];
				$config['new_image'] = './../images/Choreographer/large/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 280;
				$config['height'] = 280;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
						
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Choreographer/'.$data['file1'];
				$config['new_image'] = './../images/Choreographer/medium/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 180;
				$config['height'] = 180;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Choreographer/'.$data['file1'];
				$config['new_image'] = './../images/Choreographer/small/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 70;
				$config['height'] = 70;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
			}
			$this->delete_image($Choreographer_id,'Choreographer','Choreographer_avatar','Choreographer_id','Choreographer');
			$d = array(
				'Choreographer_name'=>$this->input->post('txtChoreographerName'),
				
				'Choreographer_avatar'=>$Choreographer_avatar,

			);
			$this->db->where('Choreographer_id',$Choreographer_id);
			$this->db->update('Choreographer',$d);
		}
		else
		{
			$d = array(
				'Choreographer_name'=>$this->input->post('txtChoreographerName'),
				
				

			);
			$this->db->where('Choreographer_id',$Choreographer_id);
			$this->db->update('Choreographer',$d);
		}
		
			
		
			return TRUE;
		
		
   }
   
  
    function delete_Choreographer()
    {
   		$Choreographer_id = $this->input->get('Choreographer_id');
		
		
			
		
			$this->db->where('Choreographer_id',$Choreographer_id);
			$Q = $this->db->get('Choreographer');
			if($Q->num_rows()>0)
			{
			
				/// Delete image
				//$this->delete_image($actor_id);
				
				$this->delete_image($Choreographer_id,'Choreographer','Choreographer_avatar','Choreographer_id','Choreographer');
					$this->db->where('Choreographer_id',$Choreographer_id);
				$this->db->delete('movie_Choreographer');
				// Image deleted
				$this->db->where('Choreographer_id',$Choreographer_id);
				$this->db->delete('Choreographer');
			}
			return TRUE;
			exit();
		
    }
   
    function check_existance_of_Choreographer($Choreographer_name,$Choreographer_id)
    {
	   	if($Choreographer_id!=0)
		{
   			$this->db->where('Choreographer_id !=',$Choreographer_id);
   		}
		$this->db->where('Choreographer_name',$Choreographer_name);
   		$Q = $this->db->get('Choreographer');
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
