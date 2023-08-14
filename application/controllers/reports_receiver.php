<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Reports_Receiver extends CI_Controller{

	public function index() {
		$this->load->helper('common_helper');
		$this->load->view('reports_receiver/index');
	}	

	public function receivereports() 
	{
		$this->load->helper(array('form'));
		$this->load->library('form_validation');

		try
		{
        	$this->form_validation->set_rules('name', 'Name', 'required');
        	$this->form_validation->set_rules('details', 'Details', 'required');
        	$this->form_validation->set_rules('lat', 'Latitude', 'required');
        	$this->form_validation->set_rules('lng', 'Longitude', 'required');

        	$name 			= $this->input->post("name");
        	$details 		= $this->input->post("details");
        	$lat 			= $this->input->post("lat");
        	$lng 			= $this->input->post("lng");

			if ($this->form_validation->run() == TRUE)
	        {
	        	$commandText = "SELECT * FROM crimes WHERE name = '$name'";
				$result = $this->db->query($commandText);
				$query_result = $result->result();

				if(count($query_result)==1)
				{
					$crime_id = $query_result[0]->id;
				}

				$this->load->model('crime_details');
				$this->crime_details->crime_id 		= $crime_id;
				$this->crime_details->name 			= $name;
				$this->crime_details->details 		= $details;
				$this->crime_details->lat 			= $lat;
				$this->crime_details->lng 			= $lng;
				$this->crime_details->save(0);

				$data = array();  
				$data['success'] = true;
				$data['data'] = "Successfully Reported";
	        }
	        else
	        {
	            $data = array('success' => false, 'data' => preg_replace("/[\n\r]/",".",strip_tags(validation_errors())));
	        }

			die(json_encode($data));
		}
		catch(Exception $e)
		{
			$data = array("success"=> false, "data"=>$e->getMessage());
			die(json_encode($data));
		}
	}
}