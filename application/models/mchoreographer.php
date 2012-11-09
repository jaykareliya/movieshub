<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mchoreographer extends CI_Model
{
	public function get_choreographer($movie_id)
	{
		$query ="SELECT c.Choreographer_Name,c.Choreographer_Id FROM movie_choreographer AS mc LEFT JOIN choreographer AS c ON (mc.choreographer_id = c.choreographer_id) LEFT JOIN movie AS m ON (m.movie_id = mc.movie_id) WHERE m.movie_id =".$movie_id;
		$q = $this->db->query($query);

		return $q->result();
	}



	
	public function get_choreographer_detail($choreographer_id)
	{
		$query="SELECT * FROM choreographer WHERE choreographer_id =".$choreographer_id;
		$q =$this->db->query($query);
		
		return $q->result();
	}



	public function choreographer_see_all($choreographer_id,$Start_row,$limit)
	{
		$choreographer_id=$this->uri->segment(3);
		$query="SELECT count( movie_comment.movie_comment_id ) AS cnt,m.Movie_Id,m.Movie_Name,m.Movie_Image,m.Movie_Rating  FROM movie_singer AS ms LEFT JOIN movie AS m ON(m.movie_id = ms.movie_id) 
LEFT JOIN `movie_comment` ON ( m.movie_id = movie_comment.movie_id )
		WHERE ms.singer_id=".$choreographer_id." 
group by m.Movie_Id,m.Movie_Name,m.Movie_Image,m.Movie_Rating
		limit ".$start_row." ,".$limit;
		$q =$this->db->query($query);
		
		return $q->result();
	}



	
	public function choreographer_count()
	{
		$choreographer_id=$this->uri->segment(3);
		$Q = $this->db->query("SELECT count(*) as cnt FROM movie_choreographer AS mc LEFT JOIN choreographer AS c ON (mc.choreographer_id = c.choreographer_id) LEFT JOIN movie AS m ON (m.movie_id = mc.movie_id) WHERE c.choreographer_id =".$choreographer_id);

			
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