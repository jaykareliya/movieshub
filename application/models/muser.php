<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MUser extends CI_Model
{
	public function update_user_details($id='')
    {
   		$id = $this->input->post('id');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$username = $first_name." ".$last_name;
		$this->load->library('image_lib');
   		



		$user_image = 'default_image.jpg';
		if($_FILES['user_image']['name'] != "")
		{	
			$ext=preg_replace("/.*\.([^.]+)$/","\\1", $_FILES['user_image']['name']);
			$fileType=$_FILES['user_image']['type'];

			$config['upload_path'] = './images/User';
			$config['allowed_types'] = $ext.'|'.$fileType;
			$config['max_size'] = 2000;
			$config['overwrite'] = FALSE;
			$config['remove_spaces'] = TRUE;
			$config['encrypt_name'] = TRUE;
			$config['max_width']  = 0;
			$config['max_height']  = 0;
			$this->load->library('upload', $config);
			
			if (!$this->upload->do_upload('user_image'))
			{
				$this->session->set_flashdata("error","The file you have uploaded is of invalid format. Only JPG | GIF | PNG format is allowed.");
				redirect('user/user_details/'.$id,'refresh');
				exit();
			}
			else
			{
				
				
				$image = $this->upload->data();
					if ($image['file_name'])
					{
						$data['file1'] = $image['file_name'];
					}
					$user_image = $data['file1'];;
					$config['image_library'] = 'gd2';
					$config['source_image'] = './images/User/'.$data['file1'];
					$config['new_image'] = './images/User/large/';
					$config['maintain_ratio'] = TRUE;
					$config['overwrite'] = false;
					$config['width'] = 350;
					$config['height'] = 350;
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
							
					$config['image_library'] = 'gd2';
					$config['source_image'] = './images/User/'.$data['file1'];
					$config['new_image'] = './images/User/medium/';
					$config['maintain_ratio'] = TRUE;
					$config['overwrite'] = false;
					$config['width'] = 120;
					$config['height'] = 125;
					$this->image_lib->clear();
					$this->image_lib->initialize($config);
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					
					$config['image_library'] = 'gd2';
					$config['source_image'] = './images/User/'.$data['file1'];
					$config['new_image'] = './images/User/small/';
					$config['maintain_ratio'] = FALSE;
					$config['overwrite'] = false;
					$config['width'] = 30;
					$config['height'] = 30;
					$this->image_lib->clear();
					$this->image_lib->initialize($config);
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
				
				
			}
			$this->delete_image($id,'users','user_image','id','User');
			$d = array(
			    'username'=>$username,
			    'email'=>$this->input->post('email'),
			    'name'=>$first_name,
			    'first_name'=>$first_name,
			    'gender'=>$this->input->post('gender'),
			    'date_of_birth'=>$this->input->post('txtDOB'),
			    'country'=>$this->input->post('country'),
			    'zip'=>$this->input->post('postal'),
			    'Last_Name'=>$last_name,
			    'user_image'=>$user_image,
			    'phone'=>$this->input->post('phone'),
			);

			$this->db->where('id',$id);
			$this->db->update('users',$d);
		}
		else
		{
			$d = array(
				'username'=>$username,
				'email'=>$this->input->post('email'),
				'name'=>$first_name,
				'first_name'=>$first_name,
				'gender'=>$this->input->post('gender'),
				'date_of_birth'=>$this->input->post('txtDOB'),
				'country'=>$this->input->post('country'),
				'zip'=>$this->input->post('postal'),
				'Last_Name'=>$last_name,
				'phone'=>$this->input->post('phone'),
			);
				

			
			$this->db->where('id',$id);
			$this->db->update('users',$d);
		}
		
			
			
			return TRUE;
		
		
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




    public function get_user_details($id='')
    {	
    	
    	$id = $this->uri->segment(3);
    	$query = $this->db->get_where('users',array('id'=>$id));
	 			
 		return $query->row_array();
 	
    }

	public function update_user_detail()
	{	
		 
   
     	$Q = $this->db->query('select max(id) as id from users');
  		$max_id="";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$max_id = $row['id'];
       		}
     	}
    	
	if($_FILES['user_image']['name'] != "")
			{
				$ext=preg_replace("/.*\.([^.]+)$/","\\1", $_FILES['user_image']['name']);
				$fileType=$_FILES['user_image']['type'];

				$config['upload_path'] = './images/User/';
				$config['allowed_types'] = $ext.'|'.$fileType;
				$config['max_size'] = '2000';
				$config['remove_spaces'] = true;
				$config['overwrite'] = false;
				$config['encrypt_name'] = true;
				$config['max_width']  = '';
				$config['max_height']  = '';
				$this->load->library('upload', $config);	
							
				
				if (!$this->upload->do_upload('user_image'))
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
					$user_image = $data['file1'];;
					$config['image_library'] = 'gd2';
					$config['source_image'] = './images/User/'.$data['file1'];
					$config['new_image'] = './images/User/large/';
					$config['maintain_ratio'] = TRUE;
					$config['overwrite'] = false;
					$config['width'] = 350;
					$config['height'] = 350;
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
							
					$config['image_library'] = 'gd2';
					$config['source_image'] = './images/User/'.$data['file1'];
					$config['new_image'] = './images/User/medium/';
					$config['maintain_ratio'] = TRUE;
					$config['overwrite'] = false;
					$config['width'] = 120;
					$config['height'] = 125;
					$this->image_lib->clear();
					$this->image_lib->initialize($config);
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					
					$config['image_library'] = 'gd2';
					$config['source_image'] = './images/User/'.$data['file1'];
					$config['new_image'] = './images/User/small/';
					$config['maintain_ratio'] = FALSE;
					$config['overwrite'] = false;
					$config['width'] = 30;
					$config['height'] = 30;
					$this->image_lib->clear();
					$this->image_lib->initialize($config);
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
			}
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$username = $first_name." ".$last_name;

		$d = array(
			'name'=>$this->input->post('first_name'),
			'country'=>$this->input->post('country'),
			'zip'=>$this->input->post('postal'),
			'phone'=>$this->input->post('phone'),
			'first_name'=>$this->input->post('first_name'),
			'Last_Name'=>$this->input->post('last_name'),
			'gender'=>$this->input->post('gender'),
			'date_of_birth'=>$this->input->post('txtDOB'),
			'user_image'=>$user_image,

			);

    	$this->db->where('id',$max_id);
    	$this->db->update('users',$d);
    
		}
	}

	
	
	function insert_comment($Comment_id,$message)
		{
			$d = array(
				'Movie_id'=>$Comment_id,
				'User_id'=>$this->ion_auth->get_user()->id,
				'Comment'=>$message,
				);
				$this->db->insert('Movie_Comment',$d);
		}


	
	function movie_comment()
	{
		$result = array();
		$movie_id = $this->uri->segment(3);
		
		$query_str = 'select t1.* from (SELECT u.*,mc.movie_comment_id as movie_comment_id,mc.Comment,mc.time,TIMESTAMPDIFF(MINUTE, `time`, NOW()) as min,TIMESTAMPDIFF(SECOND, `time`, NOW()) as sec ,TIMESTAMPDIFF(DAY, `time`, NOW()) as day,
			TIMESTAMPDIFF(HOUR, `time`, NOW()) as hr from movie_comment mc left join movie m on (m.movie_id = mc.movie_id) left join users u on (u.id = mc.user_id) where mc.movie_id = '.$movie_id .'
		)t1
		order by t1.time desc';
		
		$query = $this->db->query($query_str);
		
			return $query->result();
	}


	
	public function get_news()
	{
		$query ="SELECT *,Movie_News_Date,TIMESTAMPDIFF(MINUTE, `Movie_News_Date`, NOW()) as min,TIMESTAMPDIFF(SECOND, `Movie_News_Date`, NOW()) as sec ,TIMESTAMPDIFF(DAY, `Movie_News_Date`, NOW()) as day,
			TIMESTAMPDIFF(HOUR, `Movie_News_Date`, NOW()) as hr FROM movie_news LIMIT 0,3";
		$q =$this->db->query($query);
			return $q->result();
	}


	
	public function home_seeall_count()
	{
		$Q = $this->db->query("SELECT count(*) as cnt FROM movie");

			
  		$cnt="";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$cnt = $row['cnt'];
       		}
     	}
    	

		return $cnt;
	}

	
	public function news_seeall_count()
	{
		$Q = $this->db->query("SELECT count(*) as cnt FROM movie_news ORDER BY Movie_News_Date DESC");

			
  		$cnt="";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$cnt = $row['cnt'];
       		}
     	}
    	

		return $cnt;
	}


	
	public function news_detail_see_all($start_row,$limit)
	{
		$query= "SELECT * FROM movie_news ORDER BY Movie_News_Date DESC Limit ".$start_row.",".$limit;
		$q =$this->db->query($query);
			return $q->result();
	}

	

	public function movie_review($row,$limit)
	{
		$result = array();
		$Movie_id = $this->uri->segment(3);
	
		$query='select t1.* from (SELECT u.first_name,u.last_name,u.user_image,mr.Movie_Review_Id as Movie_Review_Id,mr.Review_Type as Review_Type,mr.Review_Desc as Review_Desc,mr.Review_Time,TIMESTAMPDIFF(MINUTE, `Review_Time`, NOW()) as min,TIMESTAMPDIFF(SECOND, `Review_Time`, NOW()) as sec ,TIMESTAMPDIFF(DAY, `Review_Time`, NOW()) as day, TIMESTAMPDIFF(HOUR, `Review_Time`, NOW()) as hr from movie_review mr left join movie m on (m.movie_id = mr.Movie_Id) left join users u on (u.id = mr.user_id) where mr.Movie_Id = '.$Movie_id.' )t1 order by t1.Review_Time desc limit '.$row.','.$limit;

    		$q =$this->db->query($query);
			return $q->result();
	}
	public function movie_review_see_all()
	{
		$result = array();
		$Movie_id = $this->uri->segment(3);
	
		$query='select t1.* from (SELECT u.first_name,u.last_name,u.user_image,mr.Movie_Review_Id as Movie_Review_Id,mr.Review_Type as Review_Type,mr.Review_Desc as Review_Desc,mr.Review_Time,TIMESTAMPDIFF(MINUTE, `Review_Time`, NOW()) as min,TIMESTAMPDIFF(SECOND, `Review_Time`, NOW()) as sec ,TIMESTAMPDIFF(DAY, `Review_Time`, NOW()) as day, TIMESTAMPDIFF(HOUR, `Review_Time`, NOW()) as hr from movie_review mr left join movie m on (m.movie_id = mr.Movie_Id) left join users u on (u.id = mr.user_id) where mr.Movie_Id = '.$Movie_id.' )t1 order by t1.Review_Time desc';

    		$q =$this->db->query($query);
			return $q->result();
	}

	function insert_review($movie_review_id,$message)
		{
			

			$d = array(
				
				'Movie_Id'=>$movie_review_id,
				'User_Id'=>$this->ion_auth->get_user()->id,
				'Review_Desc'=>$message,
				);

		
				$this->db->insert('movie_review',$d);
		}

	public function movie_review_count()
	{
		$movie_id = $this->uri->segment(3);


		$Q = $this->db->query("SELECT count( movie_review.movie_review_id ) AS cnt FROM movie LEFT JOIN `movie_review` ON ( movie.movie_id = movie_review.movie_id) WHERE movie.movie_id = ".$movie_id );		
			
  		$cnt="";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$cnt = $row['cnt'];
       		}
     	}
     	
		return $cnt;
	}

	



	public function critic_review()
	 {
	  $result = array();
	  $Movie_id = $this->uri->segment(3);
	 
	  $Q = "SELECT
	    `critic_review`.`Creview_Id`
	    , `movie`.`Movie_Name`
	    , `movie`.`Movie_Image`
	    , `critic_review`.`Creview_Title`
	    , `critic_review`.`Creview_Desc`
	    , `critic_review`.`Creview_Time`
	FROM
	    `movie`
	    INNER JOIN `critic_review` 
	        ON (`movie`.`Movie_Id` = `critic_review`.`Movie_Id`) WHERE `movie`.`Movie_Id` =".$Movie_id;

	  $q = $this->db->query($Q);

	   return $q->result();
	 }


	 public function critic_review_count()
	 {
	 	$movie_id = $this->uri->segment(3);
		$Q = $this->db->query("SELECT count( critic_review.Creview_Id ) AS cnt FROM movie LEFT JOIN `critic_review` ON ( movie.movie_id = critic_review.movie_id) WHERE movie.movie_id = ".$movie_id );		
			
  		$cnt="";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$cnt = $row['cnt'];
       		}
     	}
     	
		return $cnt;
	 	
	 }
}

?>