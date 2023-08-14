<?php
	class crime_details extends My_Model {
		const DB_TABLE = 'crime_details';
		const DB_TABLE_PK = 'id';

		public $id;
		public $crime_id;
		public $name;
		public $details;
		public $lat;
		public $lng;
	}
?>