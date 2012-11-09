<?php
class Mproducer extends CI_Model
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
  	function getProducers()
  	{
  		if($_GET["Movie_Producer_id"])
  		{
  			$movie_id;
  			$Q = $this->db->query("select Movie_Id from movie_Producer where Movie_Producer_id =".$_GET["Movie_Producer_id"]."");
  			foreach ($Q->result_array() as $row)
		    {
        		$movie_id = $row['Movie_Id'];
	       	}
	  	$Q = $this->db->query("select * from Producer where Producer_id not in(select Producer_id from movie_Producer where Movie_id =".$movie_id.") union (
	  		select * from Producer where Producer_id =(select Producer_id from movie_Producer where movie_Producer_id =".$_GET["Movie_Producer_id"].")) order by Producer_name asc");
	  }

	  	$data[""] = "Select";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$data[$row['Producer_Id']] = $row['Producer_Name'];
       		}
     	}
    	$Q->free_result();  
    	return $data; 
  	}
  function bind_Producer()
  {
  	if($_GET["Movie_id"])
	  	$Q = $this->db->query("select * from Producer where Producer_id not in(select Producer_id from movie_Producer where movie_id =".$_GET["Movie_id"].") order by Producer_name asc");

	  	if($Q->num_rows()>0)
	   		return $Q->result();
	  	else
	   		return NULL;
  }
    function bind_dropdown_Producer()
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
	

    function fill_Producer_table($alpha,$keyword)
    {
		//$Q = $this->db->get('category');
		if($alpha == "ALL")
			$alpha = "";
			
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Producer_name LIKE "1%" OR Producer_name LIKE "2%" OR Producer_name LIKE "3%" OR Producer_name LIKE "4%" OR Producer_name LIKE "5%" OR Producer_name LIKE "6%" OR Producer_name LIKE "7%" OR Producer_name LIKE "8%" OR Producer_name LIKE "9';
		}
		$Q = $this->db->query('SELECT * FROM Producer WHERE (Producer_name LIKE "'.$alpha.'%" AND Producer_name LIKE "'.$keyword.'%") ');
		return $Q->num_rows();
   	}
   

    function fill_Producer_table_condition($start_row,$limit,$alpha,$keyword)
    {
		if($alpha == "ALL")
			$alpha = "";
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Producer_name LIKE "1%" OR Producer_name LIKE "2%" OR Producer_name LIKE "3%" OR Producer_name LIKE "4%" OR Producer_name LIKE "5%" OR Producer_name LIKE "6%" OR Producer_name LIKE "7%" OR Producer_name LIKE "8%" OR Producer_name LIKE "9';

		}	
			
		$query_str = 'SELECT * FROM Producer WHERE (Producer_name LIKE "'.$alpha.'%" AND Producer_name LIKE "'.$keyword.'%")  LIMIT '.$start_row.','.$limit;
	    $Q = $this->db->query($query_str);
	    return $Q->result();
   	}
   
    /// Created by  :: Yash Shah
	/// Description :: This function is used to get all the records in category table
	/// Returns     :: All records in category table
    function fill_Producer_details($Producer_id)
    {
		$this->db->where('Producer_id',$Producer_id);
			
   		$Q = $this->db->get('Producer');

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
    function save_new_Producer()
    {
   		if(!($this->check_existance_of_Producer($this->input->post('txtProducerName'),0)))
		{
			$Producer_avatar = 'default_image.jpg';
		if($_FILES['Producer_avatar']['name'] != "")
		{
			$config['upload_path'] = './../images/Producer/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			$this->load->library('upload', $config);	
						
			if (!$this->upload->do_upload('Producer_avatar'))
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
				
				$Producer_avatar = $data['file1'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Producer/'.$data['file1'];
				$config['new_image'] = './../images/Producer/large/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 280;
				$config['height'] = 280;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
						
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Producer/'.$data['file1'];
				$config['new_image'] = './../images/Producer/medium/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 180;
				$config['height'] = 180;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Producer/'.$data['file1'];
				$config['new_image'] = './../images/Producer/small/';
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
				'Producer_name'=>$this->input->post('txtProducerName'),
			//	'Gender'=>($this->input->post('chkIsMale')==='on')?1:0,
				'Producer_DOB'=>$this->NullIfBlank($this->input->post('txtDOB')),
				'Producer_Death_Date'=>$this->NullIfBlank($this->input->post('txtDOD')),
			//	'Director_Birth_Place'=>$this->input->post('txtBirthPlace'),
				'Producer_avatar'=>$Producer_avatar,

			);
			$this->db->insert('Producer',$d);

			return TRUE;
		}
		else
			return FALSE;
   }
   
    
    function update_Producer()
    {
   		$Producer_id = $this->input->get('Producer_id');
   	
				
		if($_FILES['Producer_avatar']['name'] != "")
		{
			$config['upload_path'] = './../images/Producer/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			$this->load->library('upload', $config);	
						
			if (!$this->upload->do_upload('Producer_avatar'))
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
				
				$Producer_avatar = $data['file1'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Producer/'.$data['file1'];
				$config['new_image'] = './../images/Producer/large/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 280;
				$config['height'] = 280;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
						
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Producer/'.$data['file1'];
				$config['new_image'] = './../images/Producer/medium/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 180;
				$config['height'] = 180;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Producer/'.$data['file1'];
				$config['new_image'] = './../images/Producer/small/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 70;
				$config['height'] = 70;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
			}
			$this->delete_image($Producer_id,'Producer','Producer_avatar','Producer_id','Producer');
			$d = array(
				'Producer_name'=>$this->input->post('txtProducerName'),
				//'Gender'=>($this->input->post('chkIsMale')==='on')?1:0,
				'Producer_DOB'=>$this->NullIfBlank($this->input->post('txtDOB')),
				'Producer_Death_Date'=>$this->NullIfBlank($this->input->post('txtDOD')),
				//'Actor_Birth_Place'=>$this->input->post('txtBirthPlace'),
				'Producer_avatar'=>$Producer_avatar,

			);
			$this->db->where('Producer_id',$Producer_id);
			$this->db->update('Producer',$d);
		}
		else
		{
			$d = array(
				'Producer_name'=>$this->input->post('txtProducerName'),
				'Producer_DOB'=>$this->NullIfBlank($this->input->post('txtDOB')),
				'Producer_Death_Date'=>$this->NullIfBlank($this->input->post('txtDOD')),
				
				

			);
			$this->db->where('Producer_id',$Producer_id);
			$this->db->update('Producer',$d);
		}
		
			
			//header('location: http://www.ramigift.com/index.php/page/manage_category');
			return TRUE;
		
		
   }
   
  
    function delete_Producer()
    {
   		$Producer_id = $this->input->get('Producer_id');
		
		
			
		
			$this->db->where('Producer_id',$Producer_id);
			$Q = $this->db->get('Producer');
			if($Q->num_rows()>0)
			{
			
				/// Delete image
				//$this->delete_image($actor_id);
				
				$this->delete_image($Producer_id,'Producer','Producer_avatar','Producer_id','Producer');
				$this->db->where('Producer_id',$Producer_id);
				$this->db->delete('movie_Producer');
				// Image deleted
				$this->db->where('Producer_id',$Producer_id);
				$this->db->delete('Producer');
			}
			return TRUE;
			exit();
		
    }
   
    function check_existance_of_Producer($Producer_name,$Producer_id)
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
