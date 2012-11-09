<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mlyrics extends CI_Model
{
	public function get_lyrics($movie_id)

	{
		$query ="SELECT l.Lyrics_Name,l.Lyrics_Id FROM movie_lyrics AS ml LEFT JOIN lyrics AS l ON (ml.lyrics_id = l.lyrics_id) LEFT JOIN movie AS m ON (m.movie_id =ml.movie_id) WHERE m.movie_id =" .$movie_id;
		$q=$this->db->query($query);

		return $q->result();

	}


	public function get_lyrics_detail($lyrics_id)
	{
		$query="SELECT * FROM lyrics WHERE lyrics_id =".$lyrics_id;
		$q =$this->db->query($query);
		
		return $q->result();
	}


	public function lyrics_see_all($lyrics_id,$start_row,$limit)
	{
		$query="SELECT count( movie_comment.movie_comment_id ) AS cnt,m.Movie_Id,m.Movie_Name,m.Movie_Image,m.Movie_Rating FROM movie_lyrics AS ml LEFT JOIN movie AS m ON(m.movie_id = ml.movie_id) 
LEFT JOIN `movie_comment` ON ( m.movie_id = movie_comment.movie_id )

		WHERE ml.lyrics_id=".$lyrics_id." 
			group by m.Movie_Id,m.Movie_Name,m.Movie_Image,m.Movie_Rating
				limit ".$start_row." ,".$limit;
		$q =$this->db->query($query);
		
		return $q->result();
	}


	public function lyrics_count($lyrics_id)
	{
		$Q = $this->db->query("SELECT count(*) as cnt FROM movie_lyrics AS ml LEFT JOIN lyrics AS l ON (ml.lyrics_id = l.lyrics_id) LEFT JOIN movie AS m ON (m.movie_id =ml.movie_id)  WHERE l.lyrics_id =" .$lyrics_id);			
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