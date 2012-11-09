<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mmovie extends CI_Model
{
		public function get_movie($movie_id)
	{

		$query="SELECT count( movie_comment.movie_comment_id ) AS cnt,movie.* FROM movie LEFT JOIN `movie_comment` ON ( movie.movie_id = movie_comment.movie_id ) WHERE  movie.movie_id =".$movie_id; 
		$q= $this->db->query($query);

		return $q->result();
		

	}


	public function get_all_movie()
	{

		$query="SELECT *
					FROM (

					SELECT count( movie_comment.movie_comment_id ) AS cnt, movie.Movie_Id,movie.Movie_Image, movie.Movie_Name,movie.Movie_Rating
					FROM movie
					LEFT JOIN `movie_comment` ON ( movie.movie_id = movie_comment.movie_id )
					GROUP BY movie.movie_id, movie.movie_id, movie.movie_name,movie.Movie_Rating
					)t1
					order by t1.Movie_Name DESC limit 0,3";
		$q= $this->db->query($query);

		return $q->result();
	}



public function movie_search($movie_name)
 {

  $query="SELECT count( movie_comment.movie_comment_id ) AS cnt, movie.Movie_Id,movie.Movie_Image, movie.Movie_Name,movie.Movie_Rating FROM movie LEFT JOIN `movie_comment` ON ( movie.movie_id = movie_comment.movie_id ) where movie_name like '".$movie_name."%' group by Movie_Id,Movie_Image,Movie_Name,Movie_Rating order by movie_name asc ";
  $q= $this->db->query($query);

  return $q->result();
 }


	public function get_rating($user_id)
	{

		$movie_id = $_GET['Movie_Id'];
		$score=$_GET['score'];

		$Q = $this->db->query("SELECT count(*) as cnt from movie_rating where user_id =  ".$user_id." and movie_id = ".$movie_id);

			
  		$cnt="";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$cnt = $row['cnt'];
       		}
     	}
    	

		if($cnt >= '1')
		{
			$d=array(
				'Rating'=>$score,
			);
			$this->db->where('User_Id',$user_id);
			$this->db->where('movie_id',$movie_id);
			$Q = $this->db->update('movie_rating',$d);
		}
		else
		{
			
			$d=array(
				'User_Id'=>$user_id,
				'Rating'=>$score,
				'Movie_Id'=>$movie_id,
			);
			
			$Q = $this->db->insert('movie_rating',$d);
		}

		$Q = $this->db->query("SELECT count(*) as cnt from movie_rating where  movie_id = ".$movie_id);

			
  		$cnt="";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$cnt = $row['cnt'];
       		}
     	}
    	
		$Q = $this->db->query("SELECT sum(Rating) as sum from movie_rating where movie_id = ".$movie_id);

			
  		$sum="";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$sum = $row['sum'];
       		}
     	}
     	$res = $sum/$cnt;
     	$d=array(
				'Movie_Rating'=>$res,
			);
			
			$this->db->where('movie_id',$movie_id);
			$Q = $this->db->update('movie',$d);
	}


public function director_movie_count($director_id)
	{
		$Q = $this->db->query("SELECT count(*) as cnt  FROM Movie_Director AS md LEFT JOIN movie AS m ON(md.movie_id = m.movie_id)  WHERE md.director_id =".$director_id." group by m.Movie_Id,m.Movie_Name,m.Movie_Image");
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

	public function producer_movie_count($producer_id)
	{
		$Q = $this->db->query("SELECT count(*) as cnt FROM `movie` AS m LEFT JOIN movie_Producer AS mp ON ( m.movie_id = mp.movie_id ) LEFT JOIN Producer p ON (p.Producer_id = mp.Producer_id )  WHERE p.producer_id = ". $producer_id." group by m.Movie_Id,m.Movie_Name,m.Movie_Image ");

			
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


	public function actor_movie_count($actor_id)
	{
		$Q = $this->db->query("SELECT count(*) as cnt FROM `movie` AS m LEFT JOIN movie_actor AS ma ON ( m.movie_id = ma.movie_id ) LEFT JOIN actor a ON ( a.actor_id = ma.actor_id )   WHERE a.actor_id = ". $actor_id." group by m.Movie_Id,m.Movie_Name,m.Movie_Image" );

			
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




	public function singer_movie_count($singer_id)
	{
		$Q = $this->db->query("SELECT count(*) as cnt FROM `movie` m LEFT JOIN movie_singer ms ON ( ms.movie_id = m.movie_id ) LEFT JOIN Singer  s ON ( ms.singer_id = s.singer_id )  WHERE s.singer_id = " .$singer_id." group by m.Movie_Id,m.Movie_Name,m.Movie_Image ");

			
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


	
	public function script_writer_movie_count($script_writer_id)
	 {
	 	$Q = $this->db->query("SELECT count(*) as cnt FROM movie_script_writer AS ms LEFT JOIN Script_writer AS s ON (ms.script_writer_id = s.script_writer_id) LEFT JOIN movie AS m ON (m.movie_id =ms.movie_id) group by m.Movie_Id,m.Movie_Name,m.Movie_Image  WHERE s.script_writer_id =" .$script_writer_id);

			
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



	
	 public function lyrics_movie_count($lyrics_id)
	{
		$Q = $this->db->query("SELECT count(*) as cnt FROM movie_lyrics AS ml LEFT JOIN lyrics AS l ON (ml.lyrics_id = l.lyrics_id) LEFT JOIN movie AS m ON (m.movie_id =ml.movie_id) group by m.Movie_Id,m.Movie_Name,m.Movie_Image   WHERE l.lyrics_id =" .$lyrics_id);			
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


	public function choreographer_count()
	{
		$choreographer_id=$this->uri->segment(3);
		$Q = $this->db->query("SELECT count(*) as cnt FROM movie_choreographer AS mc LEFT JOIN choreographer AS c ON (mc.choreographer_id = c.choreographer_id) LEFT JOIN movie AS m ON (m.movie_id = mc.movie_id) group by m.Movie_Id,m.Movie_Name,m.Movie_Image  WHERE c.choreographer_id =".$choreographer_id);

			
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


	public function see_all($start_row,$limit)
	{
		$query="SELECT *
					FROM (

					SELECT count( movie_comment.movie_comment_id ) AS cnt, movie.Movie_Id,movie.Movie_Image, movie.Movie_Name,movie.Movie_Rating
					FROM movie
					LEFT JOIN `movie_comment` ON ( movie.movie_id = movie_comment.movie_id )
					GROUP BY movie.movie_id, movie.movie_id, movie.movie_name,movie.Movie_Rating
					)t1 order by t1.Movie_Name asc
					limit ".$start_row.",".$limit;
		$q=$this->db->query($query);
		return $q->result();
	}


	public function see_all_type($type_id)
	{
		$query="SELECT *
					FROM (

					SELECT count( movie_comment.movie_comment_id ) AS cnt, movie.Movie_Id,movie.Movie_Image, movie.Movie_Name,movie.Movie_Rating
					FROM movie
					LEFT JOIN `movie_comment` ON ( movie.movie_id = movie_comment.movie_id )
					GROUP BY movie.movie_id, movie.movie_id, movie.movie_name,movie.Movie_Rating
					where movie_type=".$type_id."
					)t1 order by t1.movie_name
					"; 
		$q=$this->db->query($query);
		return $q->result();
	}


	public function movie_in_theater()
	{
		$Q = $this->db->query("SELECT * FROM movie  where movie_in_theater=1 ORDER BY Movie_Release_Date DESC");
		if ($Q->num_rows() > 0)
		{
			$query="SELECT count( movie_comment.movie_comment_id ) AS cnt, movie.Movie_Id,movie.Movie_Image, movie.Movie_Name,movie.Movie_Rating
						FROM movie
						LEFT JOIN `movie_comment` ON ( movie.movie_id = movie_comment.movie_id ) where movie_in_theater=1  
group by movie.Movie_Id,movie.Movie_Image, movie.Movie_Name,movie.Movie_Rating
ORDER BY  movie.Movie_Name asc limit 0,3"; 
			$q= $this->db->query($query);

			return $q->result();
		}
		else
		{
			return $Q->result();
		}
	}



	public function movie_in_theater_see_all($start_row,$limit)
	{

		$query="SELECT count( movie_comment.movie_comment_id ) AS cnt, movie.Movie_Id,movie.Movie_Image, movie.Movie_Name,movie.Movie_Rating FROM movie LEFT JOIN `movie_comment` ON ( movie.movie_id = movie_comment.movie_id )  where movie_in_theater=1 group by movie.Movie_Id,movie.Movie_Image, movie.Movie_Name,movie.Movie_Rating ORDER BY  movie.Movie_Name asc LIMIT ".$start_row.','.$limit;
			$q= $this->db->query($query);

		return $q->result();
	}


	public function movie_in_theater_count()
	{
		
		
		$Q = $this->db->query("SELECT count(*) as cnt FROM movie WHERE movie_in_theater=1  ORDER BY  movie.Movie_Name asc");

			
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


	public function commingsoon()
	{

		$Q = $this->db->query("SELECT * FROM movie where DATE_FORMAT(Movie_Release_Date, '%Y/%m/%d' )>DATE_FORMAT(now(), '%Y/%m/%d' )  ORDER BY Movie_Release_Date DESC");
		if ($Q->num_rows() > 0)
		{
			$query="SELECT count( movie_comment.movie_comment_id ) AS cnt, movie.Movie_Id,movie.Movie_Image,movie.Movie_Name,movie.Movie_Rating FROM movie LEFT JOIN `movie_comment` ON ( movie.movie_id = movie_comment.movie_id )  where DATE_FORMAT(Movie_Release_Date, '%Y/%m/%d' )>DATE_FORMAT(now(), '%Y/%m/%d' )  group by movie.Movie_Id,movie.Movie_Image, movie.Movie_Name,movie.Movie_Rating ORDER BY Movie_Release_Date DESC LIMIT 0,3";
			$q= $this->db->query($query);

			return $q->result();
		}
		else
		{

			return $Q->result();
		}
		
	}


	public function commingsoon_see_all($start_row,$limit)
	{

		$query="SELECT count( movie_comment.movie_comment_id ) AS cnt, movie.Movie_Id,movie.Movie_Image, movie.Movie_Name,movie.Movie_Rating FROM movie LEFT JOIN `movie_comment` ON ( movie.movie_id = movie_comment.movie_id )  where DATE_FORMAT( Movie_Release_Date, '%Y/%m/%d' ) > DATE_FORMAT( now( ) , '%Y/%m/%d' ) group by movie.Movie_Id,movie.Movie_Image, movie.Movie_Name,movie.Movie_Rating ORDER BY Movie_Release_Date DESC LIMIT ".$start_row.','.$limit;
		$q= $this->db->query($query);

		return $q->result();
	}



	public function commingsoon_count()
	{
		$Q = $this->db->query("SELECT count(*) as cnt FROM movie where DATE_FORMAT( Movie_Release_Date, '%Y/%m/%d' ) > DATE_FORMAT( now( ) , '%Y/%m/%d' ) ORDER BY Movie_Release_Date DESC");

			
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
	function get_auto_complete()
	{
		$query_str = "SELECT m.movie_id,m.movie_name from movie m order by m.movie_name asc";
		
		$Q = $this->db->query($query_str);
		
		$result_count = $Q->num_rows();
		$result_array = $Q->result();
		
		$data['result_count'] = $result_count;
		$data['result_array'] = $result_array;
		
		return $data;
	}



	public function most_comment()
	{
		$query="SELECT *
					FROM (

					SELECT count( movie_comment.movie_comment_id ) AS cnt, movie.Movie_Id,movie.Movie_Image, movie.Movie_Name,movie.Movie_Rating
					FROM movie
					LEFT JOIN `movie_comment` ON ( movie.Movie_Id = movie_comment.Movie_Id )
					GROUP BY movie.Movie_Id, movie.Movie_Id, movie.Movie_Name,movie.Movie_Rating
					)t1
					ORDER BY t1.cnt DESC limit 0,3";
	$q= $this->db->query($query);

	return $q->result();
	}


	public function most_comment_see_all($start_row,$limit)
	{
		$query="SELECT *
					FROM (

					SELECT count( movie_comment.movie_comment_id ) AS cnt, movie.Movie_Id,movie.Movie_Image, movie.Movie_Name,movie.Movie_Rating
					FROM movie
					LEFT JOIN `movie_comment` ON ( movie.Movie_Id = movie_comment.Movie_Id )
					GROUP BY movie.Movie_Id, movie.Movie_Id, movie.Movie_Name,movie.Movie_Rating
					)t1
					ORDER BY t1.cnt DESC LIMIT ".$start_row.','.$limit;
					
					$q= $this->db->query($query);
					return $q->result();
	}


	function movie_search_count($movie_name)
	{
		$Q = $this->db->query("SELECT count(*) as cnt FROM Movie where movie_name like ".$movie_name."%");

			
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


	public function most_comment_count()
	{
		$Q = $this->db->query("SELECT count(*) as cnt FROM Movie");

			
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


	public function top_rated()
	{
		$query="SELECT count( movie_comment.movie_comment_id ) AS cnt, movie.Movie_Id,movie.Movie_Image, movie.Movie_Name,movie.Movie_Rating FROM movie LEFT JOIN `movie_comment` ON ( movie.movie_id = movie_comment.movie_id ) group by movie.Movie_Id,movie.Movie_Image, movie.Movie_Name,movie.Movie_Rating   ORDER BY `Movie_Rating` DESC LIMIT 0,3";			
			$q= $this->db->query($query);
					return $q->result();
	}

	public function top_rated_see_all($start_row,$limit)
	{
		$query="SELECT count( movie_comment.movie_comment_id ) AS cnt, movie.Movie_Id,movie.Movie_Image, movie.Movie_Name,movie.Movie_Rating FROM movie LEFT JOIN `movie_comment` ON ( movie.movie_id = movie_comment.movie_id ) group by movie.Movie_Id,movie.Movie_Image, movie.Movie_Name,movie.Movie_Rating ORDER BY `Movie_Rating` DESC Limit ".$start_row.",".$limit;
			
			$q= $this->db->query($query);
					return $q->result();
	}



	public function top_rated_count()
	{
		$query="SELECT count(*) as cnt FROM movie  ORDER BY `Movie_Rating` DESC";
		$Q = $this->db->query($query);

			
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

	function get_latest_movie_see_all($start_row,$limit)
	{
		$query="SELECT count( movie_comment.movie_comment_id ) AS cnt, movie.Movie_Id,movie.Movie_Image, movie.Movie_Name,movie.Movie_Rating FROM movie 
		LEFT JOIN `movie_comment` ON ( movie.movie_id = movie_comment.movie_id )
		where DATE_FORMAT( Movie_Release_Date, '%Y/%m/%d' ) < DATE_FORMAT( now( ) , '%Y/%m/%d' )
		 group by  movie.movie_id,movie.movie_image, movie.movie_name,movie.Movie_Rating  
		ORDER BY `Movie_Release_Date` desc LIMIT ".$start_row.",".$limit;
						
						$q= $this->db->query($query);
						return $q->result();
	}
	

	public function get_latest_movie()
	{
		$query="SELECT count( movie_comment.movie_comment_id ) AS cnt, movie.movie_id,movie.movie_image, movie.movie_name,movie.Movie_Rating FROM movie 
		LEFT JOIN `movie_comment` ON ( movie.movie_id = movie_comment.movie_id ) 
		where DATE_FORMAT( Movie_Release_Date, '%Y/%m/%d' ) < DATE_FORMAT( now( ) , '%Y/%m/%d' )
		group by  movie.movie_id,movie.movie_image, movie.movie_name,movie.Movie_Rating  ORDER BY `Movie_Release_Date` desc LIMIT 0,3";
					
					$q= $this->db->query($query);
					return $q->result();
	}



	public function latest_movie_count()
	{
		$Q = $this->db->query("SELECT count(*) as cnt  FROM movie ORDER BY `Movie_Release_Date` desc ");

			
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



	public function get_actors_movie($actor_id)
	{
		$query =	
		"SELECT count( movie_comment.movie_comment_id ) AS cnt,m.movie_id,m.movie_name,m.movie_image 
		
		FROM actor a LEFT JOIN movie_actor AS ma ON ( a.actor_id = ma.actor_id) right JOIN `movie` AS m ON ( m.movie_id = ma.movie_id  ) 
		LEFT JOIN `movie_comment` ON ( m.movie_id = movie_comment.movie_id ) 
		WHERE a.actor_id =". $actor_id ." GROUP BY m.movie_id, m.movie_name, m.movie_image
		union
		SELECT count( movie_comment.movie_comment_id ) AS cnt,m.movie_id,m.movie_name,m.movie_image 
		
		FROM actor a left join movie_special_appereance mas on (mas.Special_Appereance_Id = a.actor_id)  right JOIN `movie` AS m ON ( m.movie_id = mas.movie_id  ) 
		LEFT JOIN `movie_comment` ON ( m.movie_id = movie_comment.movie_id ) 
		WHERE a.actor_id =". $actor_id ." GROUP BY m.movie_id, m.movie_name, m.movie_image";

		$q = $this->db->query($query);

		return $q->result();
	}

	
	public function get_producer_movie($producer_id)
	{
		$query ="SELECT count( movie_comment.movie_comment_id ) AS cnt,m.movie_id,m.movie_name,m.movie_image FROM producer p LEFT JOIN movie_producer AS mp ON ( p.producer_id = mp.producer_id) right JOIN   `movie` AS m ON ( m.movie_id = mp.movie_id  ) LEFT JOIN `movie_comment` ON ( m.movie_id = movie_comment.movie_id )  WHERE p.producer_id = ". $producer_id. " group by m.movie_id,m.movie_name,m.movie_image limit 0,3";
		
		$q = $this->db->query($query);

		return $q->result();
	}




	
	public function get_director_movie($director_id)
	{
		$query ="SELECT count( movie_comment.movie_comment_id ) AS cnt,m.movie_id,m.movie_name,m.movie_image FROM director d LEFT JOIN movie_director AS md ON ( d.director_id = md.director_id) right JOIN   `movie` AS m ON ( m.movie_id = md.movie_id  ) LEFT JOIN `movie_comment` ON ( m.movie_id = movie_comment.movie_id ) WHERE d.director_id= ".$director_id. " group by m.movie_id,m.movie_name,m.movie_image LIMIT 0,3"; 
		$q = $this->db->query($query);

		return $q->result();
	}




	public function get_singer_movie($singer_id)
	{
		$query ="SELECT count( movie_comment.movie_comment_id ) AS cnt,m.movie_id,m.movie_name,m.movie_image FROM singer s LEFT JOIN movie_singer AS ms ON ( s.singer_id = ms.singer_id) right JOIN   `movie` AS m ON ( m.movie_id = ms.movie_id  ) LEFT JOIN `movie_comment` ON ( m.movie_id = movie_comment.movie_id ) WHERE s.singer_id = ". $singer_id. " group by m.movie_id,m.movie_name,m.movie_image limit 0,3";
		
		$q = $this->db->query($query);

		return $q->result();
	}



	public function get_script_writer_movie($script_writer_id)
	{
		$query ="SELECT count( movie_comment.movie_comment_id ) AS cnt,m.movie_id,m.movie_name,m.movie_image FROM script_writer sw LEFT JOIN movie_script_writer AS msw ON ( sw.script_writer_id = msw.script_writer_id) right JOIN   `movie` AS m ON ( m.movie_id = msw.movie_id  ) LEFT JOIN `movie_comment` ON ( m.movie_id = movie_comment.movie_id ) WHERE sw.script_writer_id = ". $script_writer_id. " group by m.movie_id,m.movie_name,m.movie_image limit 0,3";
		
		$q = $this->db->query($query);

		return $q->result();
	}


	public function get_lyrics_movie($lyrics_id)
	{
		$query ="SELECT count( movie_comment.movie_comment_id ) AS cnt,m.movie_id,m.movie_name,m.movie_image FROM lyrics l LEFT JOIN movie_lyrics AS ml ON ( l.lyrics_id = ml.lyrics_id) right JOIN   `movie` AS m ON ( m.movie_id = ml.movie_id  ) LEFT JOIN `movie_comment` ON ( m.movie_id = movie_comment.movie_id ) WHERE l.lyrics_id = ". $lyrics_id. " group by m.movie_id,m.movie_name,m.movie_image limit 0,3";
		
		$q = $this->db->query($query);
	
		return $q->result();
	}



	public function get_choreographer_movie($choreographer_id)
	{
		$query ="SELECT count( movie_comment.movie_comment_id ) AS cnt,m.movie_id,m.movie_name,m.movie_image FROM choreographer c LEFT JOIN movie_choreographer AS mc ON ( c.choreographer_id = mc.choreographer_id) right JOIN   `movie` AS m ON ( m.movie_id = mc.movie_id  ) LEFT JOIN `movie_comment` ON ( m.movie_id = movie_comment.movie_id ) WHERE c.choreographer_id = ". $choreographer_id. " group by m.movie_id,m.movie_name,m.movie_image limit 0,3";
		
		$q = $this->db->query($query);
	
		return $q->result();
	}



	public function choreographer_movie_count($choreographer_id)
	{
			$Q = $this->db->query("SELECT count(m.*) as cnt,m.movie_id,m.movie_name,m.movie_image FROM movie as m Left join movie_choreographer as mc on(mc.movie_id = m.movie_id) GROUP BY m.Movie_Id, m.Movie_Id, m.Movie_Name,m.Movie_Rating  WHERE mc.choreographer_id = ". $choreographer_id);

			
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


	public function get_news()
	{
		$query ="SELECT *,Movie_News_Date,TIMESTAMPDIFF(MINUTE, `Movie_News_Date`, NOW()) as min,TIMESTAMPDIFF(SECOND, `Movie_News_Date`, NOW()) as sec ,TIMESTAMPDIFF(DAY, `Movie_News_Date`, NOW()) as day,
			TIMESTAMPDIFF(HOUR, `Movie_News_Date`, NOW()) as hr FROM news LIMIT 0,4";
		$q =$this->db->query($query);
			return $q->result();
	}




	public function visible_seeall()
	{
		
		$Q = $this->db->query("SELECT count(*) as cnt from movie");
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
	
 public function commingsoon_check()
 {
 		$Q = $this->db->query("SELECT COUNT(*) AS cnt FROM movie WHERE DATE_FORMAT(Movie_Release_Date , '%Y/%m/%d' ) > DATE_FORMAT( now() , '%Y/%m/%d' )");
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

 public function in_theater_check()
 {
 	$Q = $this->db->query("SELECT COUNT(Movie_In_Theater) AS cnt FROM movie WHERE Movie_In_Theater=1");
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