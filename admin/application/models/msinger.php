<?php
class Msinger extends CI_Model
{
	
  
  	function getAllsingers()
  	{
 		$data = array();
    	 $this->db->select('Singer_id,Singer_name');
    	 $this->db->order_by("Singer_name", "asc"); 
     //$this->db->where('is_active !=',0);
     	$Q = $this->db->get('Singer');
  		$data[""] = "Select";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$data[$row['Singer_id']] = $row['Singer_name'];
       		}
     	}
    	$Q->free_result();  
    	return $data; 
  	}
  function getSingers()
  	{
  		if($_GET["Movie_Singer_id"])
  		{
  			$movie_id;
  			$Q = $this->db->query("select Singer_Id,Movie_Id from movie_Singer where Movie_Singer_id =".$_GET["Movie_Singer_id"]."");
  			foreach ($Q->result_array() as $row)
		    {
        		$movie_id = $row['Movie_Id'];
	       	}
	  	$Q = $this->db->query("select * from Singer where Singer_id not in(select Singer_id from movie_Singer where Movie_id =".$movie_id.") union (
	  		select * from Singer where Singer_id =(select Singer_id from movie_Singer where movie_Singer_id =".$_GET["Movie_Singer_id"].")) order by Singer_name asc");
	  }

	  	$data[""] = "Select";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$data[$row['Singer_Id']] = $row['Singer_Name'];
       		}
     	}
    	$Q->free_result();  
    	return $data; 
  	}
  		function bind_Singer()
	{
			if($_GET["Movie_id"])
	  	$Q = $this->db->query("select * from Singer where Singer_id not in(select Singer_id from movie_Singer where movie_id =".$_GET["Movie_id"].")  order by Singer_name asc");

	  	if($Q->num_rows()>0)
	   		return $Q->result();
	  	else
	   		return NULL;
	}
    function bind_dropdown_Singe()
    {
		$data = array();
     	$this->db->select('Singer_id,Singer_name');
     	 $this->db->order_by("Singer_name", "asc"); 
	    $Q = $this->db->get('Singer');
        $data['']='Select';
    	if ($Q->num_rows() > 0)
		{
	    	foreach ($Q->result_array() as $row)
		    {
        		$data[$row['Singer_id']] = $row['Singer_name'];
	       	}
    	}
	    $Q->free_result();  
    	return $data; 
    }
	

    function fill_Singer_table($alpha,$keyword)
    {
		//$Q = $this->db->get('category');
		if($alpha == "ALL")
			$alpha = "";
			
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Singer_name LIKE "1%" OR Singer_name LIKE "2%" OR Singer_name LIKE "3%" OR Singer_name LIKE "4%" OR Singer_name LIKE "5%" OR Singer_name LIKE "6%" OR Singer_name LIKE "7%" OR Singer_name LIKE "8%" OR Singer_name LIKE "9';
		}
		$Q = $this->db->query('SELECT * FROM Singer WHERE (Singer_name LIKE "'.$alpha.'%" AND Singer_name LIKE "'.$keyword.'%") ');
		return $Q->num_rows();
   	}
   

    function fill_Singer_table_condition($start_row,$limit,$alpha,$keyword)
    {
		if($alpha == "ALL")
			$alpha = "";
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Singer_name LIKE "1%" OR Singer_name LIKE "2%" OR Singer_name LIKE "3%" OR Singer_name LIKE "4%" OR Singer_name LIKE "5%" OR Singer_name LIKE "6%" OR Singer_name LIKE "7%" OR Singer_name LIKE "8%" OR Singer_name LIKE "9';

		}	
			
		$query_str = 'SELECT * FROM Singer WHERE (Singer_name LIKE "'.$alpha.'%" AND Singer_name LIKE "'.$keyword.'%")  LIMIT '.$start_row.','.$limit;
	    $Q = $this->db->query($query_str);
	    return $Q->result();
   	}
   

    function fill_Singer_details($Singer_id)
    {
		$this->db->where('Singer_id',$Singer_id);
			
   		$Q = $this->db->get('Singer');

		if($Q->num_rows()>0)
		{
			
			return $Q->result();
		
		}
		else
		{
			return NULL;

		}
    }
   
    /// Created by  :: Yash Shah
	/// Description :: This function is used to save new category
	/// Returns     :: TRUE/FALSE;
    function save_new_Singer()
    {
   		if(!($this->check_existance_of_Singer($this->input->post('txtSingerName'),0)))
		{
			$Singer_avatar = 'default_image.jpg';
		if($_FILES['Singer_avatar']['name'] != "")
		{
			$config['upload_path'] = './../images/Singer/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			$this->load->library('upload', $config);	
						
			if (!$this->upload->do_upload('Singer_avatar'))
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
				
				$Singer_avatar = $data['file1'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Singer/'.$data['file1'];
				$config['new_image'] = './../images/Singer/large/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 280;
				$config['height'] = 280;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
						
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Singer/'.$data['file1'];
				$config['new_image'] = './../images/Singer/medium/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 180;
				$config['height'] = 180;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Singer/'.$data['file1'];
				$config['new_image'] = './../images/Singer/small/';
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
				'Singer_name'=>$this->input->post('txtSingerName'),
			//	'Gender'=>($this->input->post('chkIsMale')==='on')?1:0,
				'Singer_DOB'=>$this->NullIfBlank($this->input->post('txtDOB')),
				'Singer_Death_Date'=>$this->NullIfBlank($this->input->post('txtDOD')),
			//	'Director_Birth_Place'=>$this->input->post('txtBirthPlace'),
				'Singer_avatar'=>$Singer_avatar,

			);
			$this->db->insert('Singer',$d);

			return TRUE;
		}
		else
			return FALSE;
   }
   
    
    function update_Singer()
    {
   		$Singer_id = $this->input->get('Singer_id');
   	
				
		if($_FILES['Singer_avatar']['name'] != "")
		{
			$config['upload_path'] = './../images/Singer/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			$this->load->library('upload', $config);	
						
			if (!$this->upload->do_upload('Singer_avatar'))
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
				
				$Singer_avatar = $data['file1'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Singer/'.$data['file1'];
				$config['new_image'] = './../images/Singer/large/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 280;
				$config['height'] = 280;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
						
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Singer/'.$data['file1'];
				$config['new_image'] = './../images/Singer/medium/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 180;
				$config['height'] = 180;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Singer/'.$data['file1'];
				$config['new_image'] = './../images/Singer/small/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 70;
				$config['height'] = 70;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
			}
			$this->delete_image($Singer_id,'Singer','Singer_avatar','Singer_id','Singer');
			$d = array(
				'Singer_name'=>$this->input->post('txtSingerName'),
				//'Gender'=>($this->input->post('chkIsMale')==='on')?1:0,
				'Singer_DOB'=>$this->NullIfBlank($this->input->post('txtDOB')),
				'Singer_Death_Date'=>$this->NullIfBlank($this->input->post('txtDOD')),
				//'Actor_Birth_Place'=>$this->input->post('txtBirthPlace'),
				'Singer_avatar'=>$Singer_avatar,

			);
			$this->db->where('Singer_id',$Singer_id);
			$this->db->update('Singer',$d);
		}
		else
		{
			$d = array(
				'Singer_name'=>$this->input->post('txtSingerName'),
				'Singer_DOB'=>$this->NullIfBlank($this->input->post('txtDOB')),
				'Singer_Death_Date'=>$this->NullIfBlank($this->input->post('txtDOD')),
				
				

			);
			$this->db->where('Singer_id',$Singer_id);
			$this->db->update('Singer',$d);
		}
		
			
			//header('location: http://www.ramigift.com/index.php/page/manage_category');
			return TRUE;
		
		
   }
   
  
    function delete_Singer()
    {
   		$Singer_id = $this->input->get('Singer_id');
		
		
			
		
			$this->db->where('Singer_id',$Singer_id);
			$Q = $this->db->get('Singer');
			if($Q->num_rows()>0)
			{
			
				/// Delete image
				//$this->delete_image($actor_id);
				
				$this->delete_image($Singer_id,'Singer','Singer_avatar','Singer_id','Singer');
				$this->db->where('Singer_id',$Singer_id);
				$this->db->delete('movie_Singer');
				// Image deleted
				$this->db->where('Singer_id',$Singer_id);
				$this->db->delete('Singer');
			}
			return TRUE;
			exit();
		
    }
   
    function check_existance_of_Singer($Singer_name,$Singer_id)
    {
	   	if($Singer_id!=0)
		{
   			$this->db->where('Singer_id !=',$Singer_id);
   		}
		$this->db->where('Singer_name',$Singer_name);
   		$Q = $this->db->get('Singer');
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
