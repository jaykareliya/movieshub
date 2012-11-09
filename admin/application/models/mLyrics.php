<?php
class MLyrics extends CI_Model
{
	
  
  	function getAllLyrics()
  	{
 		$data = array();
    	 $this->db->select('Lyrics_id,Lyrics_name');
    	  $this->db->order_by("Lyrics_name", "asc");
     //$this->db->where('is_active !=',0);
     	$Q = $this->db->get('Lyrics');
  		$data[""] = "Select";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$data[$row['Lyrics_id']] = $row['Lyrics_name'];
       		}
     	}
    	$Q->free_result();  
    	return $data; 
  	}
  
    function bind_dropdown_Singe()
    {
		$data = array();
     	$this->db->select('Lyrics_id,Lyrics_name');
     	  $this->db->order_by("Lyrics_name", "asc");
	    $Q = $this->db->get('Lyrics');
        $data['']='Select';
    	if ($Q->num_rows() > 0)
		{
	    	foreach ($Q->result_array() as $row)
		    {
        		$data[$row['Lyrics_id']] = $row['Lyrics_name'];
	       	}
    	}
	    $Q->free_result();  
    	return $data; 
    }
    function getLyrics()
    {
    	if($_GET["Movie_Lyrics_id"])
  		{
  			$movie_id;
  			$Q = $this->db->query("select Movie_Id from movie_Lyrics where Movie_Lyrics_id =".$_GET["Movie_Lyrics_id"]."");
  			foreach ($Q->result_array() as $row)
		    {
        		$movie_id = $row['Movie_Id'];
	       	}
	  	$Q = $this->db->query("select * from Lyrics where Lyrics_id not in(select Lyrics_id from movie_Lyrics where Movie_id =".$movie_id.") union (
	  		select * from Lyrics where Lyrics_id =(select Lyrics_id from movie_Lyrics where movie_Lyrics_id =".$_GET["Movie_Lyrics_id"].")) order by Lyrics_name asc");
	  }

	  	$data[""] = "Select";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$data[$row['Lyrics_Id']] = $row['Lyrics_Name'];
       		}
     	}
    	$Q->free_result();  
    	return $data; 
    }
	function bind_Lyrics()
	{
			if($_GET["Movie_id"])
	  	$Q = $this->db->query("select * from Lyrics where Lyrics_id not in(select Lyrics_id from movie_Lyrics where movie_id =".$_GET["Movie_id"].") order by Lyrics_name asc");

	  	if($Q->num_rows()>0)
	   		return $Q->result();
	  	else
	   		return NULL;
	}

    function fill_Lyrics_table($alpha,$keyword)
    {
		//$Q = $this->db->get('category');
		if($alpha == "ALL")
			$alpha = "";
			
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Lyrics_name LIKE "1%" OR Lyrics_name LIKE "2%" OR Lyrics_name LIKE "3%" OR Lyrics_name LIKE "4%" OR Lyrics_name LIKE "5%" OR Lyrics_name LIKE "6%" OR Lyrics_name LIKE "7%" OR Lyrics_name LIKE "8%" OR Lyrics_name LIKE "9';
		}
		$Q = $this->db->query('SELECT * FROM Lyrics WHERE (Lyrics_name LIKE "'.$alpha.'%" AND Lyrics_name LIKE "'.$keyword.'%") ');
		return $Q->num_rows();
   	}
   

    function fill_Lyrics_table_condition($start_row,$limit,$alpha,$keyword)
    {
		if($alpha == "ALL")
			$alpha = "";
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Lyrics_name LIKE "1%" OR Lyrics_name LIKE "2%" OR Lyrics_name LIKE "3%" OR Lyrics_name LIKE "4%" OR Lyrics_name LIKE "5%" OR Lyrics_name LIKE "6%" OR Lyrics_name LIKE "7%" OR Lyrics_name LIKE "8%" OR Lyrics_name LIKE "9';

		}	
			
		$query_str = 'SELECT * FROM Lyrics WHERE (Lyrics_name LIKE "'.$alpha.'%" AND Lyrics_name LIKE "'.$keyword.'%")  LIMIT '.$start_row.','.$limit;
	    $Q = $this->db->query($query_str);
	    return $Q->result();
   	}
   

    function fill_Lyrics_details($Lyrics_id)
    {
		$this->db->where('Lyrics_id',$Lyrics_id);
			
   		$Q = $this->db->get('Lyrics');

		if($Q->num_rows()>0)
		{
			
			return $Q->result();
		
		}
		else
		{
			return NULL;

		}
    }
   
  
    function save_new_Lyrics()
    {
   		if(!($this->check_existance_of_Lyrics($this->input->post('txtLyricsName'),0)))
		{
			$Lyrics_avatar = 'default_image.jpg';
		if($_FILES['Lyrics_avatar']['name'] != "")
		{
			$config['upload_path'] = './../images/Lyrics/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			$this->load->library('upload', $config);	
						
			if (!$this->upload->do_upload('Lyrics_avatar'))
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
				
				$Lyrics_avatar = $data['file1'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Lyrics/'.$data['file1'];
				$config['new_image'] = './../images/Lyrics/large/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 280;
				$config['height'] = 280;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
						
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Lyrics/'.$data['file1'];
				$config['new_image'] = './../images/Lyrics/medium/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 180;
				$config['height'] = 180;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Lyrics/'.$data['file1'];
				$config['new_image'] = './../images/Lyrics/small/';
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
				'Lyrics_name'=>$this->input->post('txtLyricsName'),
			
				'Lyrics_avatar'=>$Lyrics_avatar,

			);
			$this->db->insert('Lyrics',$d);

			return TRUE;
		}
		else
			return FALSE;
   }
   
    
    function update_Lyrics()
    {
   		$Lyrics_id = $this->input->get('Lyrics_id');
   	
				
		if($_FILES['Lyrics_avatar']['name'] != "")
		{
			$config['upload_path'] = './../images/Lyrics/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			$this->load->library('upload', $config);	
						
			if (!$this->upload->do_upload('Lyrics_avatar'))
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
				
				$Lyrics_avatar = $data['file1'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Lyrics/'.$data['file1'];
				$config['new_image'] = './../images/Lyrics/large/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 280;
				$config['height'] = 280;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
						
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Lyrics/'.$data['file1'];
				$config['new_image'] = './../images/Lyrics/medium/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 180;
				$config['height'] = 180;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Lyrics/'.$data['file1'];
				$config['new_image'] = './../images/Lyrics/small/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 70;
				$config['height'] = 70;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
			}
			$this->delete_image($Lyrics_id,'Lyrics','Lyrics_avatar','Lyrics_id','Lyrics');
			$d = array(
				'Lyrics_name'=>$this->input->post('txtLyricsName'),
				
				'Lyrics_avatar'=>$Lyrics_avatar,

			);
			$this->db->where('Lyrics_id',$Lyrics_id);
			$this->db->update('Lyrics',$d);
		}
		else
		{
			$d = array(
				'Lyrics_name'=>$this->input->post('txtLyricsName'),
				
				

			);
			$this->db->where('Lyrics_id',$Lyrics_id);
			$this->db->update('Lyrics',$d);
		}
		
			
		
			return TRUE;
		
		
   }
   
  
    function delete_Lyrics()
    {
   		$Lyrics_id = $this->input->get('Lyrics_id');
		
		
			
		
			$this->db->where('Lyrics_id',$Lyrics_id);
			$Q = $this->db->get('Lyrics');
			if($Q->num_rows()>0)
			{
			
				/// Delete image
				//$this->delete_image($actor_id);
				
				$this->delete_image($Lyrics_id,'Lyrics','Lyrics_avatar','Lyrics_id','Lyrics');
				$this->db->where('Lyrics_id',$Lyrics_id);
				$this->db->delete('movie_Lyrics');
				// Image deleted
				$this->db->where('Lyrics_id',$Lyrics_id);
				$this->db->delete('Lyrics');
			}
			return TRUE;
			exit();
		
    }
   
    function check_existance_of_Lyrics($Lyrics_name,$Lyrics_id)
    {
	   	if($Lyrics_id!=0)
		{
   			$this->db->where('Lyrics_id !=',$Lyrics_id);
   		}
		$this->db->where('Lyrics_name',$Lyrics_name);
   		$Q = $this->db->get('Lyrics');
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
