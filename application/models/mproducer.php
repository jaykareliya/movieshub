<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mproducer extends CI_Model
{

	public function get_producer($movie_id)
	{
		$query="SELECT p.Producer_Name,p.Producer_Id FROM `movie` AS m LEFT JOIN movie_Producer AS mp ON ( m.movie_id = mp.movie_id ) LEFT JOIN Producer p ON (p.Producer_id = mp.Producer_id )WHERE m.movie_id = ". $movie_id;
		$q=$this->db->query($query);

		return $q->result();
	}


	public function get_producer_detail($producer_id)
	{
		$query="SELECT * FROM Producer WHERE producer_id =".$producer_id;
		$q =$this->db->query($query);
		
		return $q->result();
	}


	
	public function producer_see_all($producer_id,$start_row,$limit)
	{
		$query="SELECT count( movie_comment.movie_comment_id ) AS cnt,m.Movie_Id,m.Movie_Name,m.Movie_Image,m.Movie_Rating FROM movie_Producer AS mp LEFT JOIN movie AS m ON(m.movie_id = mp.movie_id)
				LEFT JOIN `movie_comment` ON ( m.movie_id = movie_comment.movie_id )
				WHERE mp.Producer_id=".$producer_id."
				group by m.Movie_Id,m.Movie_Name,m.Movie_Image,m.Movie_Rating
		   		limit ".$start_row." ,".$limit;
		$q =$this->db->query($query);
		
		return $q->result();
	}



	public function producer_count($producer_id)
	{
		$Q = $this->db->query("SELECT count(*) as cnt FROM `movie` AS m LEFT JOIN movie_Producer AS mp ON ( m.movie_id = mp.movie_id ) LEFT JOIN Producer p ON (p.Producer_id = mp.Producer_id )WHERE p.producer_id = ". $producer_id);

			
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