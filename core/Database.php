<?php 
	/**
	 * Connect to  Database and do all the Crud operations
	 */
	class Database
	{
		private $connection;
		private $select_data;
		private $insert_data;
		private $table;
		private $condition;
		private $order;
		private $limit;

	    public function __construct()
	    {
	        // $this->openConnection('localhost','photo_lib_v2','postgres','root','pgsql');
	    }
		
		/**
		 * Opening Database Connection
		 * Connect to PostgreSQL using native functions
		 */
		protected function openConnection($host,$database,$user,$password,$db_driver)
		{
		   	try {
				if($db_driver == 'pgsql') {
					$this->connection = new PDO('pgsql:host='.$host.';dbname='.$database,$user , $password);
				}else if($db_driver == 'mysql') {
					$this->connection = new PDO('mysql:host='.$host.';dbname='.$database,$user , $password);
				}else {
					exit('Database driver not suported');
				}

			} catch (Exception  $e) {
				exit($e->getMessage());
			}
		}

		/**
		 * Set select data
		 */
		public function select($select_data)
		{
			$this->select_data = $select_data;
		}

		/**
		 * Set table
		 */
		public function from($table)
		{
			$this->table = $table;
		}

		/**
		 * Set where 
		 */
		public function where($condition)
		{
			$this->condition = $condition;
		}

		/**
		 * Set order
		 */
		public function order($order)
		{
			$this->order = $order;
		}

		/** Insert Query Builder */
		public function insert($table_name, $data)
		{
			// Creates Columns part of insert query
			$columns = implode(", ", array_keys($data));
			
			$values = "";
			
			// Creates Values part of insert query
			foreach (array_values($data) as $key => $value) {
				$values .= "'".$value."',";
			}
			
			$values =  rtrim($values,",");
			$sql = "INSERT INTO ".$table_name." (".$columns.") VALUES (".$values.")";
			
			// return pg_affected_rows($this->executeQuery($sql));
			return $this->executeQuery($sql)->rowCount();
		}

		/** Select Query Builder */
		public function get($table_name = "")
		{
			$sql;
			// If table name set get all records
			if(isset($table_name)) {
				$sql = "SELECT * FROM $table_name";
			}else{
				$sql = "SELECT $this->select_data FROM $this->table ";

				// Check for the condition
				if($this->condition) {
					$sql .= "WHERE $this->condition";
				}

				if($this->order) {
					$sql .= "ORDER BY $this->order";
				}
			}
		   	
		   	return $this->executeQuery($sql)->fetchAll();
		}

		/** Update Query Builder */
		public function update($table_name, $data)
		{
			$column = array_keys($data);
			$value = array_values($data);

			$sql = "";
			$set = "";
			
			// Creats update part
			for ($i=0; $i < sizeof($data); $i++) { 
				$set .= $column[$i] ." = '". $value[$i] ."', ";
			}

			$set = rtrim($set, " ,");

			$sql = "UPDATE ".$table_name." SET ".$set;
			
			if($this->condition) {
				$sql .= " WHERE $this->condition";
			}

			return $this->executeQuery($sql)->rowCount();
		}

		/** Delete Query Builder */
		public function delete($table_name)
		{
			$sql = "DELETE FROM ".$table_name;
			
			if($this->condition) {
				$sql .= " WHERE $this->condition";
			}
			
			return $this->executeQuery($sql)->rowCount();
		}

		private function executeQuery($sql) {
			try {
				// return pg_fetch_assoc(pg_query($this->connection,$sql));
				return $this->connection->query($sql);
			} catch (Exception $e) {
				exit($e->getMessage());
			}
		}

	}
?>