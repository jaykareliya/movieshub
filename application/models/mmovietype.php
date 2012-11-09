<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mmovietype extends CI_Model
{
	public function get_movietype()
	{
		$query ="SELECT * FROM movie_type order by movie_type_name asc ";
		$q = $this->db->query($query);

		return $q->result();
	}

	
	public function get_movietype_detail($movie_id)
	{
		
		$Q = $this->db->query("SELECT * FROM movie  where movie_id=".$movie_id);
		if ($Q->num_rows() > 0)
		{
			$query ="SELECT count( movie_comment.movie_comment_id ) AS cnt,mt.Movie_Type_Id,mt.Movie_Type_Name FROM `movie` AS m LEFT JOIN movie_type AS mt ON ( m.movie_type = mt.movie_type_id ) LEFT JOIN `movie_comment` ON ( m.movie_id = movie_comment.movie_id ) WHERE  m.movie_id=".$movie_id;
			$q = $this->db->query($query);

			return $q->result();
		}
		else
		{
			exit();
			return $Q->result();
		}
	}



	
	public function movie_type()
	{
		$movie_type_id=$this->uri->segment(3);
		$Q = $this->db->query("SELECT * FROM movie WHERE movie_type=".$movie_type_id." limit 0,4");
		if ($Q->num_rows() > 0)
		{
			$query ="SELECT count( movie_comment.movie_comment_id ) AS cnt,mt.Movie_Type_Id,mt.Movie_Type_Name,m.* FROM `movie` AS m left JOIN movie_type AS mt ON ( m.movie_type = mt.movie_type_id )  LEFT JOIN `movie_comment` ON ( m.movie_id = movie_comment.movie_id )  WHERE  m.movie_type=".$movie_type_id." group by mt.Movie_Type_Id,mt.Movie_Type_Name,m.movie_id,m.movie_name,m.movie_release_date,
                     m.movie_type,m.movie_rating,m.movie_url,m.movie_image,m.Movie_Description,m.Movie_Duration,m.Movie_In_Theater limit 0,3";
			$q = $this->db->query($query);

			return $q->result();
		}
		else
		{
			return $Q->result();
		}
	}


	
	public function fill_movie_type($type_id)
	{
		$Q ="SELECT count(*) AS cnt FROM `movie` AS m WHERE movie_type=".$type_id;

		$q = $this->db->query($Q);
			$cnt="";
			foreach ($q->result_array() as $row)
   			{
         		$cnt = $row['cnt'];
       		}
		return $cnt;
	}
	
	
	public function movie_type_see_all($start_row,$limit,$movie_type_id)
	{
		
		$Q ="SELECT count( movie_comment.movie_comment_id ) AS cnt,mt.Movie_Type_Id,mt.Movie_Type_Name,m.* FROM `movie` AS m left JOIN movie_type AS mt ON ( m.movie_type = mt.movie_type_id )  LEFT JOIN `movie_comment` ON ( m.movie_id = movie_comment.movie_id ) WHERE  m.movie_type=".$movie_type_id." group by mt.Movie_Type_Id,mt.Movie_Type_Name,m.movie_id,m.movie_name,m.movie_release_date,
			m.movie_type,m.movie_rating,m.movie_url,m.movie_image,m.Movie_Description,m.Movie_Duration,m.Movie_In_Theater LIMIT ".$start_row.','.$limit;

		$q = $this->db->query($Q);

		return $q->result();
	}




	public function movie_type_trailer()
	{
		$movie_type_id=$this->uri->segment(3);
		$query ="SELECT Movie_Type_Name,Movie_Type_Id FROM movie_type WHERE movie_type_id =".$movie_type_id;
		$q = $this->db->query($query);

		return $q->result();
	}


	public function movie_type_trailer_count()
	{
		$movie_type_id=$this->uri->segment(3);
		
		$Q = $this->db->query("SELECT count(*) as cnt FROM movie WHERE Movie_Type =".$movie_type_id);

			
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
	

	public function movie_type_check()
	{
		$movie_type_id = $this->uri->segment(3);

		$Q = $this->db->query("SELECT count(*) as cnt from movie where `Movie_Type` =".$movie_type_id);
		
		$cnt="";
		if($Q->num_rows() > 0)
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