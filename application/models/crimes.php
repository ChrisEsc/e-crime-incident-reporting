<?php
	class crimes extends My_Model {
		const DB_TABLE = 'crimes';
		const DB_TABLE_PK = 'id';

		public $id;
		public $priority_id;
		public $name;
	}
?>