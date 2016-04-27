<?php 
	/**
	 * Welcome
	 */
	class Welcome extends Controller {
		public function __construct() {
			parent::__construct();
			// $this->load->view();
//			echo $this->$load;
			// var_dump($this);
		}
		
		public function index() {
			echo " Praneeth Nidarshan";
		}
	}
?>