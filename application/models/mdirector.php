<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdirector extends CI_Model
{
	public function get_director($movie_id)
	{
		$query ="SELECT d.Director_Name,d.Director_Id FROM `movie` AS m LEFT JOIN movie_director AS md ON ( m.Movie_Id = md.Movie_Id ) LEFT JOIN director d ON (d.Director_Id = md.Director_Id )WHERE m.Movie_Id = ". $movie_id;
		$q = $this->db->query($query);

		return $q->result();
	}


	
	public function get_director_detail($director_id)
	{
		$query="SELECT * FROM director WHERE Director_Id =".$director_id;
		$q =$this->db->query($query);
		
		return $q->result();
	}


	public function director_see_all($director_id,$start_row,$limit)
	{
		$query="SELECT count( movie_comment.Movie_Comment_Id ) AS cnt,m.Movie_Id,m.Movie_Name,m.Movie_Image,m.Movie_Rating FROM movie_director AS md LEFT JOIN movie AS m ON(md.Movie_Id = m.Movie_Id) 
		 LEFT JOIN `movie_comment` ON ( m.Movie_Id = movie_comment.Movie_Id )
		 WHERE md.Director_Id =".$director_id." group by m.Movie_Id,m.Movie_Name,m.Movie_Image,m.Movie_Rating Limit ".$start_row.",".$limit;
		$q =$this->db->query($query);
		
		return $q->result();
	}


	public function director_see_all_($director_id)
	{
		$query="SELECT m.Movie_Id,m.Movie_Name,m.Movie_Image FROM movie_director AS md LEFT JOIN movie AS m ON(md.Movie_Id = m.Movie_Id) WHERE md.Director_Id =".$director_id;
		$q =$this->db->query($query);
		
		return $q->result();
	}



	public function director_movie_count($director_id)
	{

		$Q = $this->db->query("SELECT count(*) as cnt FROM `movie` AS m LEFT JOIN movie_director AS md ON ( m.Movie_Id = md.Movie_Id ) LEFT JOIN director d ON (d.Director_Id = md.Director_Id )WHERE d.Director_Id = ". $director_id);

			
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