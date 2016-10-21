<?php 
	/**
	 * Welcome
	 */
	class Welcome extends Controller {
		public function __construct() {
			parent::__construct();

		}
		
		public function index() {
            $data = array(
                "content" => "welcome",
                "image" => 'http://inndeinc.com/assets/img/INNDEINC-SLOGON.png',
                "content_data" => array(
                    "image" => 'http://inndeinc.com/assets/img/INNDEINC-SLOGON.png',
                )
            );
            $this->load->view("template", $data);
		}
	}
?>