<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller{

	public function index() {
		$this->load->helper('common_helper');
		$this->load->view('dashboard/index');
	}	

	public function generatecrimelist() 
	{
		$query = $this->uri->segment('3');
		if($query == 'priority-code-all'){
			$query = 'priority-code';
		}
		$query = str_replace('-', ' ', $query);
		try {
			$commandText = "SELECT 
								a.id,
								a.name,
								a.details,
								REPLACE(LOWER(b.name), ' ', '') AS type,
								a.lat,
								a.lng
							FROM crime_details a
								LEFT JOIN crimes b ON b.id = a.crime_id
								LEFT JOIN priorities c ON c.id = b.priority_id
							WHERE c.description LIKE '%$query%' OR b.name LIKE '%$query%'";
			$result = $this->db->query($commandText);
			$query_result = $result->result();

			if(count($query_result) == 0){
				$data = array("data" => "No records found!");
				die(json_encode($data));
			}

			foreach($query_result as $key => $value){
				$data['data'][] = array(
					'id' 			=> $value->id,
					'name' 			=> $value->name,
					'details' 		=> $value->details,
					'lat' 			=> $value->lat,
					'lng' 			=> $value->lng,
					'type' 			=> $value->type
				);
			}
			die(json_encode($data));

		}
		catch (Exception $e) {
			print $e->getMessage();
			die();
		}
	}

	public function receivereports() 
	{
		try
		{
			$name			= mysql_real_escape_string(strip_tags(trim($_GET['name'])));
			$details 		= mysql_real_escape_string(strip_tags(trim($_GET['details'])));
			$lat 			= mysql_real_escape_string(strip_tags(trim($_GET['lat'])));
			$lng 			= mysql_real_escape_string(strip_tags(trim($_GET['lng'])));

			$commandText = "SELECT * FROM crimes WHERE name = '$name'";
			$result = $this->db->query($commandText);
			$query_result = $result->result();

			if(count($query_result)==1)
			{
				$crime_id = $query_result[0]->id;
			}

			$this->load->model('crime_details');
			$this->crime_details->crime_id 			= $crime_id;
			$this->crime_details->name 				= $name;
			$this->crime_details->details 			= $details;
			$this->crime_details->lat 				= $lat;
			$this->crime_details->lng 				= $lng;
			$this->crime_details->save(0);

			$data = array();  
			$data['success'] = true;
			$data['data'] = "Successfully Reported";
			die(json_encode($data));

		}
		catch(Exception $e)
		{
			$data = array("success"=> false, "data"=>$e->getMessage());
			die(json_encode($data));
		}
	}
}