<?php 
	/**
	 * Welcome
	 */
	class Welcome extends Parser
	{
		protected $db;

	    /**
	     * Welcome
	     */
	    public function __construct()
	    {
	        $this->db = new Database;
	        $this->index();

	    }

	    /**
	     * Default method of the class
	     */
	    public function index()
	    {

	    	if($_POST) {
	    		$authentication = $this->login($_POST);
	    		echo json_encode($authentication);
			}else{
				$dir    = BASE_PATH.'/uploads/HD_IMG';
				// compress($img = null,$img_dir = null,$img_quality = null)
				$compressed_images = $this->compress($img = null,$dir,50);
				

				$this->view('template',array('content' => 'welcome','data' => array('images' => $compressed_images)));
		    }
		}

		/**
		 * Valdate user credintials and login user
		 * @param Array
		 * @return Boolean
		 */
		private function login($data)
		{
			if($data['username'] != "" && $data['password'] != "") {
				$condition = "user_name = '".$data['username']."'";
				$condition .= " AND password = '".md5($data['password'])."'";
				
				$this->db->select('*');
				$this->db->from('tbl_user');
				$this->db->where($condition);
				
				// Check if user exist
				if($this->db->get()){
	    			session_start();
	    			$_SESSION['username'] = $data['username'];
	    			$_SESSION['uid'] = $data['id'];
	    			return true;
	    		}else{
	    			return false;
	    		}
			}else{
				return false;
			}
		}
	}
?>