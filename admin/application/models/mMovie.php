<?php
class MMovie extends CI_Model
{
	/// Created By :: Hardik Dave
  
  	function getAllMovies()
  	{
 		$data = array();
    	 $this->db->select('Movie_id,Movie_name');
    	  	 $this->db->order_by("Movie_name", "asc"); 
     //$this->db->where('is_active !=',0);
     	$Q = $this->db->get('Movie');
  		$data[""] = "Select";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$data[$row['Movie_id']] = $row['Movie_name'];
       		}
     	}
    	$Q->free_result();  
    	return $data; 
  	}
  
	
    function bind_dropdown_Movie()
    {
		$data = array();
     	$this->db->select('Movie_id,Movie_name');
     	  	 $this->db->order_by("Movie_name", "asc"); 
	    $Q = $this->db->get('Movie');
        $data['']='Select';
    	if ($Q->num_rows() > 0)
		{
	    	foreach ($Q->result_array() as $row)
		    {
        		$data[$row['Movie_id']] = $row['Movie_name'];
	       	}
    	}
	    $Q->free_result();  
    	return $data; 
    }
	

    function fill_Movie_table($alpha,$keyword)
    {
		//$Q = $this->db->get('category');
		if($alpha == "ALL")
			$alpha = "";
			
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Movie_name LIKE "1%" OR Movie_name LIKE "2%" OR Movie_name LIKE "3%" OR Movie_name LIKE "4%" OR Movie_name LIKE "5%" OR Movie_name LIKE "6%" OR Movie_name LIKE "7%" OR Movie_name LIKE "8%" OR Movie_name LIKE "9';
		}
		$Q = $this->db->query('SELECT * FROM Movie WHERE (Movie_name LIKE "'.$alpha.'%" AND Movie_name LIKE "'.$keyword.'%") ');
		return $Q->num_rows();
   	}

    function fill_Movie_table_condition($start_row,$limit,$alpha,$keyword)
    {
		if($alpha == "ALL")
			$alpha = "";
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Movie_name LIKE "1%" OR Movie_name LIKE "2%" OR Movie_name LIKE "3%" OR Movie_name LIKE "4%" OR Movie_name LIKE "5%" OR Movie_name LIKE "6%" OR Movie_name LIKE "7%" OR Movie_name LIKE "8%" OR Movie_name LIKE "9';

		}	
			
		$query_str = 'SELECT * FROM Movie WHERE (Movie_name LIKE "'.$alpha.'%" AND Movie_name LIKE "'.$keyword.'%")  LIMIT '.$start_row.','.$limit;
	    $Q = $this->db->query($query_str);
	    return $Q->result();
   	}

    function fill_Movie_details($Movie_id)
    {
		$this->db->where('Movie_id',$Movie_id);
		
   		$Q = $this->db->get('Movie');
		if($Q->num_rows()>0)
			return $Q->result();
		else
			return NULL;
    }

    function save_new_Movie()
    {
   		$this->load->library('upload');
			$Movie_Image = 'default_image.jpg';
		
		if($_FILES['Movie_Image']['name'] != "")
		{
			$config['upload_path'] = './../images/Movie/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			$config['file_name']='';
			$this->upload->initialize($config); 
			
						
			if (!$this->upload->do_upload('Movie_Image'))
			{
				$error = array('error' => 'The file you have uploaded is of invalid format. Only JPG | GIF | PNG format is allowed. ');
				 echo $this->upload->display_errors();
				exit();
			}
			else
			{
				$image = $this->upload->data();
				if ($image['file_name'])
				{
					$data['file1'] = $image['file_name'];
				}
				
				$Movie_Image = $data['file1'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Movie/'.$data['file1'];
				$config['new_image'] = './../images/Movie/large/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 280;
				$config['height'] = 280;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
						
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Movie/'.$data['file1'];
				$config['new_image'] = './../images/Movie/medium/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 180;
				$config['height'] = 180;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Movie/'.$data['file1'];
				$config['new_image'] = './../images/Movie/small/';
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
				'Movie_name'=>$this->input->post('txtMovieName'),
				'Movie_Release_Date'=>$this->NullIfBlank($this->input->post('txtDOB')),
				'Movie_Type'=>$this->input->post('ddlMovie_Type'),
				'Movie_Url'=> $this->input->post('txtMovie_url'),
				'Movie_Image'=>$Movie_Image,
				'Movie_Description'=>$this->input->post('txtMovieDesc'),
				'Movie_Duration'=>$this->input->post('txtMovie_Duration'),
				'Movie_In_Theater'=>($this->input->post('chkIntheater')==='on')?1:0,
				'Movie_Description'=>$this->input->post('txtMovie_Description'),
			);
			$this->db->insert('Movie',$d);

			return TRUE;
		
   }

    function update_Movie()
    {
   		$Movie_id = $this->input->get('Movie_id');
   	
				$Movie_Image = 'default_image.jpg';
		if($_FILES['Movie_Image']['name'] != "")
		{
			$config['upload_path'] = './../images/Movie/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			$this->load->library('upload', $config);	
						
			if (!$this->upload->do_upload('Movie_Image'))
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
				
				$Movie_Image = $data['file1'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Movie/'.$data['file1'];
				$config['new_image'] = './../images/Movie/large/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 280;
				$config['height'] = 280;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
						
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Movie/'.$data['file1'];
				$config['new_image'] = './../images/Movie/medium/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 180;
				$config['height'] = 180;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './../images/Movie/'.$data['file1'];
				$config['new_image'] = './../images/Movie/small/';
				$config['maintain_ratio'] = FALSE;
				$config['overwrite'] = false;
				$config['width'] = 70;
				$config['height'] = 70;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config); //load library
				$this->image_lib->resize(); //do whatever specified in config
				
			}
			$this->delete_image($Movie_id,'Movie','Movie_Image','Movie_id','Movie');
			$d = array(
				'Movie_name'=>$this->input->post('txtMovieName'),
				'Movie_Release_Date'=>$this->NullIfBlank($this->input->post('txtDOB')),
				'Movie_Type'=>$this->input->post('ddlMovie_Type'),
				'Movie_Url'=> $this->input->post('txtMovie_url'),
				'Movie_Image'=>$Movie_Image,
				'Movie_Description'=>$this->input->post('txtMovieDesc'),
				'Movie_Duration'=>$this->input->post('txtMovie_Duration'),
					'Movie_In_Theater'=>($this->input->post('chkIntheater')==='on')?1:0,
				'Movie_Description'=>$this->input->post('txtMovie_Description'),

			);
			$this->db->where('Movie_id',$Movie_id);
			$this->db->update('Movie',$d);
		}
		else
		{
			$d = array(
				'Movie_name'=>$this->input->post('txtMovieName'),
				'Movie_Release_Date'=>$this->NullIfBlank($this->input->post('txtDOB')),
				'Movie_Type'=>$this->input->post('ddlMovie_Type'),
				'Movie_Url'=> $this->input->post('txtMovie_url'),
				'Movie_Description'=>$this->input->post('txtMovieDesc'),
				'Movie_Duration'=>$this->input->post('txtMovie_Duration'),
					'Movie_In_Theater'=>($this->input->post('chkIntheater')==='on')?1:0,
				'Movie_Description'=>$this->input->post('txtMovie_Description'),
				);
			$this->db->where('Movie_id',$Movie_id);
			$this->db->update('Movie',$d);
		}
		
			
			return TRUE;
		
		
   }
   

    function delete_Movie()
    {
   		$Movie_id = $this->input->get('Movie_id');
		
		
			
		
			$this->db->where('Movie_id',$Movie_id);
			$Q = $this->db->get('Movie');
			if($Q->num_rows()>0)
			{
			
				
				$this->delete_image($Movie_id,'Movie','Movie_Image','Movie_id','Movie');
				
				// Image deleted
				$this->db->where('Movie_id',$Movie_id);
				$this->db->delete('Movie');
			}
			return TRUE;
			exit();
		
    }

    function check_existance_of_Movie($Movie_name,$Movie_id)
    {
	   	if($Movie_id!=0)
		{
   			$this->db->where('Movie_id !=',$Movie_id);
   		}
		$this->db->where('Movie_name',$Movie_name);
   		$Q = $this->db->get('Movie');
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
