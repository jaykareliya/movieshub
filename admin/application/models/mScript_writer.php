<?php
class MScript_writer extends CI_Model
{
	
  
  	function getAllScript_writers()
  	{
 		$data = array();
    	 $this->db->select('Script_writer_id,Script_writer_name');
    	    	$this->db->order_by("Script_writer_name", "asc"); 
     //$this->db->where('is_active !=',0);
     	$Q = $this->db->get('Script_writer');
  		$data[""] = "Select";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$data[$row['Script_writer_id']] = $row['Script_writer_name'];
       		}
     	}
    	$Q->free_result();  
    	return $data; 
  	}
  
    function bind_dropdown_Singe()
    {
		$data = array();
     	$this->db->select('Script_writer_id,Script_writer_name');
     	  	$this->db->order_by("Script_writer_name", "asc"); 
	    $Q = $this->db->get('Script_writer');
        $data['']='Select';
    	if ($Q->num_rows() > 0)
		{
	    	foreach ($Q->result_array() as $row)
		    {
        		$data[$row['Script_writer_id']] = $row['Script_writer_name'];
	       	}
    	}
	    $Q->free_result();  
    	return $data; 
    }
    	function getScript_writers()
  	{
  		if($_GET["Movie_Script_Writer_id"])
  		{
  			$movie_id;
  			$Q = $this->db->query("select Movie_Id from movie_Script_writer where Movie_Script_writer_id =".$_GET["Movie_Script_Writer_id"]."");
  			foreach ($Q->result_array() as $row)
		    {
        		$movie_id = $row['Movie_Id'];
	       	}
	  	$Q = $this->db->query("select * from Script_writer where Script_writer_id not in(select Script_writer_id from movie_Script_writer where Movie_id =".$movie_id.") union (
	  		select * from Script_writer where Script_writer_id =(select Script_writer_id from movie_Script_writer where movie_Script_writer_id =".$_GET["Movie_Script_Writer_id"].")) order by Script_writer_name asc");
	  }

	  	$data[""] = "Select";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$data[$row['Script_Writer_Id']] = $row['Script_Writer_Name'];
       		}
     	}
    	$Q->free_result();  
    	return $data; 
  	}
	function bind_Script_writer()
	{
		if($_GET["Movie_id"])
	  	$Q = $this->db->query("select * from Script_writer where Script_writer_id not in(select Script_writer_id from movie_Script_writer where movie_id =".$_GET["Movie_id"].") order by Script_writer_name asc");

	  	if($Q->num_rows()>0)
	   		return $Q->result();
	  	else
	   		return NULL;
	}


    function fill_Script_writer_table($alpha,$keyword)
    {
		//$Q = $this->db->get('category');
		if($alpha == "ALL")
			$alpha = "";
			
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Script_writer LIKE "1%" OR Script_writer_name LIKE "2%" OR Script_writer_name LIKE "3%" OR Script_writer_name LIKE "4%" OR Script_writer_name LIKE "5%" OR Script_writer_name LIKE "6%" OR Script_writer_name LIKE "7%" OR Script_writer_name LIKE "8%" OR Script_writer_name LIKE "9';
		}
		$Q = $this->db->query('SELECT * FROM Script_writer WHERE (Script_writer_name LIKE "'.$alpha.'%" AND Script_writer_name LIKE "'.$keyword.'%") ');
		return $Q->num_rows();
   	}
   

    function fill_Script_writer_table_condition($start_row,$limit,$alpha,$keyword)
    {
		if($alpha == "ALL")
			$alpha = "";
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Script_writer_name LIKE "1%" OR Script_writer_name LIKE "2%" OR Script_writer_name LIKE "3%" OR Script_writer_name LIKE "4%" OR Script_writer_name LIKE "5%" OR Script_writer_name LIKE "6%" OR Script_writer_name LIKE "7%" OR Script_writer_name LIKE "8%" OR Script_writer_name LIKE "9';

		}	
			
		$query_str = 'SELECT * FROM Script_writer WHERE (Script_writer_name LIKE "'.$alpha.'%" AND Script_writer_name LIKE "'.$keyword.'%")  LIMIT '.$start_row.','.$limit;
	    $Q = $this->db->query($query_str);
	    return $Q->result();
   	}
   

    function fill_Script_writer_details($Script_writer_id)
    {
		$this->db->where('Script_writer_id',$Script_writer_id);
			
   		$Q = $this->db->get('Script_writer');

		if($Q->num_rows()>0)
		{
			
			return $Q->result();
		
		}
		else
		{
			return NULL;

		}
    }
   
  
    function save_new_Script_writer()
    {
    
   		if(!($this->check_existance_of_Script_writer($this->input->post('txtScript_writerName'),0)))
		{	
			$Script_writer_avatar = 'default_image.jpg';
		if($_FILES['Script_writer_avatar']['name'] != "")
		{
			$config['upload_path'] = './../images/Script_writer/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			$this->load->library('upload', $config);	
						
			if (!$this->upload->do_upload('Script_writer_avatar'))
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
				
				$Script_writer_avatar = $data['file1'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Script_writer/'.$data['file1'];
				$config['new_image'] = './../images/Script_writer/large/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 280;
				$config['height'] = 280;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
						
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Script_writer/'.$data['file1'];
				$config['new_image'] = './../images/Script_writer/medium/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 180;
				$config['height'] = 180;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Script_writer/'.$data['file1'];
				$config['new_image'] = './../images/Script_writer/small/';
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
				'Script_writer_name'=>$this->input->post('txtScript_writerName'),
			
				'Script_writer_avatar'=>$Script_writer_avatar,

			);
			$this->db->insert('Script_writer',$d);

			return TRUE;
		}
		else
			return FALSE;
   }
   
    
    function update_Script_writer()
    {
   		$Script_writer_id = $this->input->get('Script_writer_id');
   	
				
		if($_FILES['Script_writer_avatar']['name'] != "")
		{
			$config['upload_path'] = './../images/Script_writer/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			$this->load->library('upload', $config);	
						
			if (!$this->upload->do_upload('Script_writer_avatar'))
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
				
				$Script_writer_avatar = $data['file1'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Script_writer/'.$data['file1'];
				$config['new_image'] = './../images/Script_writer/large/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 280;
				$config['height'] = 280;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
						
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Script_writer/'.$data['file1'];
				$config['new_image'] = './../images/Script_writer/medium/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 180;
				$config['height'] = 180;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Script_writer/'.$data['file1'];
				$config['new_image'] = './../images/Script_writer/small/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 70;
				$config['height'] = 70;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
			}
			$this->delete_image($Script_writer_id,'Script_writer','Script_writer_avatar','Script_writer_id','Script_writer');
			$d = array(
				'Script_writer_name'=>$this->input->post('txtScript_writerName'),
				
				'Script_writer_avatar'=>$Script_writer_avatar,

			);
			$this->db->where('Script_writer_id',$Script_writer_id);
			$this->db->update('Script_writer',$d);
		}
		else
		{
			$d = array(
				'Script_writer_name'=>$this->input->post('txtScript_writerName'),
				
				

			);
			$this->db->where('Script_writer_id',$Script_writer_id);
			$this->db->update('Script_writer',$d);
		}
		
			
		
			return TRUE;
		
		
   }
   
  
    function delete_Script_writer()
    {
   		$Script_writer_id = $this->input->get('Script_writer_id');
		
		
			
		
			$this->db->where('Script_writer_id',$Script_writer_id);
			$Q = $this->db->get('Script_writer');
			if($Q->num_rows()>0)
			{
			
				/// Delete image
				//$this->delete_image($actor_id);
				
				$this->delete_image($Script_writer_id,'Script_writer','Script_writer_avatar','Script_writer_id','Script_writer');
				$this->db->where('Script_writer_id',$Script_writer_id);
				$this->db->delete('movie_Script_writer');
				// Image deleted
				$this->db->where('Script_writer_id',$Script_writer_id);
				$this->db->delete('Script_writer');
			}
			return TRUE;
			exit();
		
    }
   
    function check_existance_of_Script_writer($Script_writer_name,$Script_writer_id)
    {
	   	if($Script_writer_id!=0)
		{
   			$this->db->where('Script_writer_id !=',$Script_writer_id);
   		}
		$this->db->where('Script_writer_name',$Script_writer_name);
   		$Q = $this->db->get('Script_writer');
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
