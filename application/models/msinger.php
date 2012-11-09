<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Msinger extends CI_Model
{


	public function get_singer($movie_id)
	{

		$query="SELECT s.Singer_Name, s.Singer_Id  FROM `movie` m LEFT JOIN movie_singer ms ON ( ms.Movie_Id = m.Movie_Id ) LEFT JOIN singer  s ON ( ms.Singer_Id = s.Singer_Id ) WHERE m.Movie_Id =  ".$movie_id;
		$q= $this->db->query($query);

		return $q->result();
		

	}


	public function get_singer_detail($singer_id)
	{
		$query="SELECT * FROM singer WHERE Singer_Id =".$singer_id;
		$q =$this->db->query($query);
		
		return $q->result();
	}


	public function singer_see_all($singer_id,$start_row,$limit)
	{
		$query="SELECT count( movie_comment.Movie_Comment_Id ) AS cnt,m.Movie_Id,m.Movie_Name,m.Movie_Image,m.Movie_Rating FROM movie_singer AS ms LEFT JOIN movie AS m ON(m.Movie_Id = ms.Movie_Id) 
LEFT JOIN `movie_comment` ON ( m.Movie_Id = movie_comment.Movie_Id )
		WHERE ms.Singer_Id=".$singer_id." 
group by m.Movie_Id,m.Movie_Name,m.Movie_Image,m.Movie_Rating
		limit ".$start_row." ,".$limit;
		$q =$this->db->query($query);
		
		return $q->result();
	}


	public function singer_count($singer_id)
	{
		$Q = $this->db->query("SELECT count(*) as cnt FROM `movie` m LEFT JOIN movie_singer ms ON ( ms.Movie_Id = m.Movie_Id ) LEFT JOIN singer  s ON ( ms.Singer_Id = s.Singer_Id ) WHERE s.Singer_Id = " .$singer_id);

			
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