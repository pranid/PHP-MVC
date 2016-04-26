<?php 
	/**
	 * 
	 * User Registration Class
	 */
	class Register extends Parser
	{
		protected $db;
		protected $table_name = "tbl_user";
	    /**
	     * Register Constructor
	     */
	    public function __construct()
	    {
	        $this->db = new Database;
	    }

	    public function index()
	    {
	    	if($_POST) {
	    		$authentication = $this->login($_POST);
	    		echo json_encode($authentication);
	    	}else{
	    		exit("Sorry");
	    	}
	    }

	    /** Create New User */
	    private function createUser($data)
	    {
	    	echo "Register<br>";

	    	$data = array(
	    		'user_name' => 'PDO', 
	    		'password' => md5('someonea'),
	    		'email' => 'someonea@gmail.com'
				);

	    	return $this->db->insert('tbl_user',$data);
	    }
	}
?>