<?php
class Mdirector extends CI_Model
{
	
  
  	function getAlldirectors()
  	{
 		$data = array();
    	 $this->db->select('director_id,director_name');
    	  	 $this->db->order_by("director_name", "asc"); 
     //$this->db->where('is_active !=',0);
     	$Q = $this->db->get('director');
  		$data[""] = "Select";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$data[$row['director_id']] = $row['director_name'];
       		}
     	}
    	$Q->free_result();  
    	return $data; 
  	}
  	function getDirectors()
  	{
  		if($_GET["Movie_Director_id"])
  		{
  			$movie_id;
  			$Q = $this->db->query("select Movie_Id from movie_Director where Movie_Director_id =".$_GET["Movie_Director_id"]."");
  			foreach ($Q->result_array() as $row)
		    {
        		$movie_id = $row['Movie_Id'];
	       	}
	  	$Q = $this->db->query("select * from Director where Director_id not in(select Director_id from movie_Director where Movie_id =".$movie_id.") union (
	  		select * from Director where Director_id =(select Director_id from movie_Director where movie_Director_id =".$_GET["Movie_Director_id"].")) order by Director_name asc");
	  }

	  	$data[""] = "Select";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$data[$row['Director_id']] = $row['Director_Name'];
       		}
     	}
    	$Q->free_result();  
    	return $data; 
  	}

    function bind_dropdown_director()
    {
		$data = array();
     	$this->db->select('director_id,director_name');
     	  	 $this->db->order_by("director_name", "asc"); 
	    $Q = $this->db->get('director');
        $data['']='Select';
    	if ($Q->num_rows() > 0)
		{
	    	foreach ($Q->result_array() as $row)
		    {
        		$data[$row['director_id']] = $row['director_name'];
	       	}
    	}
	    $Q->free_result();  
    	return $data; 
    }
	function bind_Director()
	{
			if($_GET["Movie_id"])
	  	$Q = $this->db->query("select * from Director where Director_id not in(select Director_id from movie_Director where movie_id =".$_GET["Movie_id"].") order by Director_name asc ");

	  	if($Q->num_rows()>0)
	   		return $Q->result();
	  	else
	   		return NULL;
	}

    function fill_director_table($alpha,$keyword)
    {
		//$Q = $this->db->get('category');
		if($alpha == "ALL")
			$alpha = "";
			
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Director_name LIKE "1%" OR Director_name LIKE "2%" OR Director_name LIKE "3%" OR Director_name LIKE "4%" OR Director_name LIKE "5%" OR Director_name LIKE "6%" OR Director_name LIKE "7%" OR Director_name LIKE "8%" OR Director_name LIKE "9';
		}
		$Q = $this->db->query('SELECT * FROM Director WHERE (Director_name LIKE "'.$alpha.'%" AND Director_name LIKE "'.$keyword.'%") ');
		return $Q->num_rows();
   	}
   

    function fill_Director_table_condition($start_row,$limit,$alpha,$keyword)
    {
		if($alpha == "ALL")
			$alpha = "";
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Director_name LIKE "1%" OR Director_name LIKE "2%" OR Director_name LIKE "3%" OR Director_name LIKE "4%" OR Director_name LIKE "5%" OR Director_name LIKE "6%" OR Director_name LIKE "7%" OR Director_name LIKE "8%" OR Director_name LIKE "9';

		}	
			
		$query_str = 'SELECT * FROM Director WHERE (Director_name LIKE "'.$alpha.'%" AND Director_name LIKE "'.$keyword.'%")  LIMIT '.$start_row.','.$limit;
	    $Q = $this->db->query($query_str);
	    return $Q->result();
   	}
   
    /// Created by  :: Yash Shah
	/// Description :: This function is used to get all the records in category table
	/// Returns     :: All records in category table
    function fill_Director_details($Director_id)
    {
		$this->db->where('Director_id',$Director_id);
			
   		$Q = $this->db->get('director');

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
    function save_new_Director()
    {
   		if(!($this->check_existance_of_Director($this->input->post('txtDirectorName'),0)))
		{
			$Director_avatar = 'default_image.jpg';
		if($_FILES['Director_avatar']['name'] != "")
		{
			$config['upload_path'] = './../images/Director/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			$this->load->library('upload', $config);	
						
			if (!$this->upload->do_upload('Director_avatar'))
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
				
				$Director_avatar = $data['file1'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Director/'.$data['file1'];
				$config['new_image'] = './../images/Director/large/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 280;
				$config['height'] = 280;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
						
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Director/'.$data['file1'];
				$config['new_image'] = './../images/Director/medium/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 180;
				$config['height'] = 180;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Director/'.$data['file1'];
				$config['new_image'] = './../images/Director/small/';
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
				'Director_name'=>$this->input->post('txtDirectorName'),
			//	'Gender'=>($this->input->post('chkIsMale')==='on')?1:0,
				'Director_DOB'=>$this->NullIfBlank($this->input->post('txtDOB')),
				'Director_Death_Date'=>$this->NullIfBlank($this->input->post('txtDOD')),
			//	'Director_Birth_Place'=>$this->input->post('txtBirthPlace'),
				'Director_avatar'=>$Director_avatar,

			);
			$this->db->insert('Director',$d);

			return TRUE;
		}
		else
			return FALSE;
   }
   
    /// Created by  :: Yash Shah
	/// Description :: This function is used to update information for category
	/// Returns     :: TRUE/FALSE
    function update_Director()
    {
   		$Director_id = $this->input->get('Director_id');
   	
				$Director_avatar = 'default_image.jpg';
		if($_FILES['Director_avatar']['name'] != "")
		{
			$config['upload_path'] = './../images/Director/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			$this->load->library('upload', $config);	
						
			if (!$this->upload->do_upload('Director_avatar'))
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
				
				$Director_avatar = $data['file1'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Director/'.$data['file1'];
				$config['new_image'] = './../images/Director/large/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 280;
				$config['height'] = 280;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
						
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Director/'.$data['file1'];
				$config['new_image'] = './../images/Director/medium/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 180;
				$config['height'] = 180;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Director/'.$data['file1'];
				$config['new_image'] = './../images/Director/small/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 70;
				$config['height'] = 70;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
			}
			$this->delete_image($Director_id,'Director','Director_avatar','Director_id','Director');
			$d = array(
				'Director_name'=>$this->input->post('txtDirectorName'),
				//'Gender'=>($this->input->post('chkIsMale')==='on')?1:0,
				'Director_DOB'=>$this->NullIfBlank($this->input->post('txtDOB')),
				'Director_Death_Date'=>$this->NullIfBlank($this->input->post('txtDOD')),
				//'Actor_Birth_Place'=>$this->input->post('txtBirthPlace'),
				'Director_avatar'=>$Director_avatar,

			);
			$this->db->where('Director_id',$Director_id);
			$this->db->update('Director',$d);
		}
		else
		{
			$d = array(
				'Director_name'=>$this->input->post('txtDirectorName'),
				'Director_DOB'=>$this->NullIfBlank($this->input->post('txtDOB')),
				'Director_Death_Date'=>$this->NullIfBlank($this->input->post('txtDOD')),
							);
			$this->db->where('Director_id',$Director_id);
			$this->db->update('Director',$d);
		}
		
			
			//header('location: http://www.ramigift.com/index.php/page/manage_category');
			return TRUE;
		
		
   }
   
  
    function delete_Director()
    {
   		$Director_id = $this->input->get('Director_id');
		
		
			
		
			$this->db->where('Director_id',$Director_id);
			$Q = $this->db->get('Director');
			if($Q->num_rows()>0)
			{
			
				/// Delete image
				//$this->delete_image($actor_id);
				
				$this->delete_image($Director_id,'Director','Director_avatar','Director_id','Director');
					$this->db->where('Director_id',$Director_id);
				$this->db->delete('movie_Director');
				// Image deleted
				$this->db->where('Director_id',$Director_id);
				$this->db->delete('Director');
			}
			return TRUE;
			exit();
		
    }
   
    function check_existance_of_Director($Director_name,$Director_id)
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
