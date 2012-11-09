<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mspecial_appereance extends CI_Model
{

	public function get_special_appereance($movie_id)
	{
		$query ="SELECT a.Actor_Name as special_appereance_name,a.Actor_Id as special_appereance_id FROM `movie` AS m LEFT JOIN movie_special_appereance AS ms ON ( ms.movie_id = m.movie_id ) LEFT JOIN actor a ON ( ms.special_appereance_id = a.actor_id )WHERE m.movie_id = ". $movie_id;
		$q = $this->db->query($query);

		return $q->result();
	}


	public function get_special_appereance_detail($special_appereance)
	{
		$query="SELECT * FROM actor WHERE actor_id =".$special_appereance;
		$q =$this->db->query($query);
		
		return $q->result();
	}

	
	public function special_appereance_see_all($type_id)
	{

		$query="SELECT m.Movie_Id,m.Movie_Name,m.Movie_Image FROM movie_special_appereance AS ma LEFT JOIN movie AS m ON(m.movie_id = ma.movie_id) WHERE ma.special_appereance_Id=".$type_id." limit 0,4";
		$q =$this->db->query($query);
		
		return $q->result();
	}


	
	public function special_appereances_movie_count($special_appereance_id)
	{
		$Q = $this->db->query("SELECT count(*) as cnt FROM `movie` AS m LEFT JOIN movie_special_appereance AS ms ON ( m.movie_id = ms.movie_id ) LEFT JOIN actor a ON ( a.actor_id = ms.special_appereance_id ) WHERE a.actor_id = ". $special_appereance_id );

			
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