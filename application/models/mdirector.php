<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdirector extends CI_Model
{
	public function get_director($movie_id)
	{
		$query ="SELECT d.Director_Name,d.Director_Id FROM `movie` AS m LEFT JOIN movie_Director AS md ON ( m.movie_id = md.movie_id ) LEFT JOIN director d ON (d.director_id = md.director_id )WHERE m.movie_id = ". $movie_id;
		$q = $this->db->query($query);

		return $q->result();
	}


	
	public function get_director_detail($director_id)
	{
		$query="SELECT * FROM director WHERE director_id =".$director_id;
		$q =$this->db->query($query);
		
		return $q->result();
	}


	public function director_see_all($director_id,$start_row,$limit)
	{
		$query="SELECT count( movie_comment.movie_comment_id ) AS cnt,m.Movie_Id,m.Movie_Name,m.Movie_Image,m.Movie_Rating FROM Movie_Director AS md LEFT JOIN movie AS m ON(md.movie_id = m.movie_id) 
		 LEFT JOIN `movie_comment` ON ( m.movie_id = movie_comment.movie_id )
		 WHERE md.director_id =".$director_id." group by m.Movie_Id,m.Movie_Name,m.Movie_Image,m.Movie_Rating Limit ".$start_row.",".$limit;
		$q =$this->db->query($query);
		
		return $q->result();
	}


	public function director_see_all_($director_id)
	{
		$query="SELECT m.Movie_Id,m.Movie_Name,m.Movie_Image FROM Movie_Director AS md LEFT JOIN movie AS m ON(md.movie_id = m.movie_id) WHERE md.director_id =".$director_id;
		$q =$this->db->query($query);
		
		return $q->result();
	}



	public function director_movie_count($director_id)
	{

		$Q = $this->db->query("SELECT count(*) as cnt FROM `movie` AS m LEFT JOIN movie_Director AS md ON ( m.movie_id = md.movie_id ) LEFT JOIN director d ON (d.director_id = md.director_id )WHERE d.director_id = ". $director_id);

			
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