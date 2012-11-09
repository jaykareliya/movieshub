<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Msinger extends CI_Model
{


	public function get_singer($movie_id)
	{

		$query="SELECT s.Singer_Name, s.Singer_Id  FROM `movie` m LEFT JOIN movie_singer ms ON ( ms.movie_id = m.movie_id ) LEFT JOIN Singer  s ON ( ms.singer_id = s.singer_id ) WHERE m.movie_id =  ".$movie_id;
		$q= $this->db->query($query);

		return $q->result();
		

	}


	public function get_singer_detail($singer_id)
	{
		$query="SELECT * FROM singer WHERE singer_id =".$singer_id;
		$q =$this->db->query($query);
		
		return $q->result();
	}


	public function singer_see_all($singer_id,$start_row,$limit)
	{
		$query="SELECT count( movie_comment.movie_comment_id ) AS cnt,m.Movie_Id,m.Movie_Name,m.Movie_Image,m.Movie_Rating FROM movie_singer AS ms LEFT JOIN movie AS m ON(m.movie_id = ms.movie_id) 
LEFT JOIN `movie_comment` ON ( m.movie_id = movie_comment.movie_id )
		WHERE ms.singer_id=".$singer_id." 
group by m.Movie_Id,m.Movie_Name,m.Movie_Image,m.Movie_Rating
		limit ".$start_row." ,".$limit;
		$q =$this->db->query($query);
		
		return $q->result();
	}


	public function singer_count($singer_id)
	{
		$Q = $this->db->query("SELECT count(*) as cnt FROM `movie` m LEFT JOIN movie_singer ms ON ( ms.movie_id = m.movie_id ) LEFT JOIN Singer  s ON ( ms.singer_id = s.singer_id ) WHERE s.singer_id = " .$singer_id);

			
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