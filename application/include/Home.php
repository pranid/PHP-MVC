<?php 
	/**
	 * Home
	 */
	class Home extends Parser
	{
		protected $db;

	    /**
	     * Home
	     */

	    public function __construct()
	    {
	    	session_start();
	        $this->db = new Database;
	        $this->index();

	        if(!isset($_SESSION['username'])) {
	        	header("Location:".BASE_URL);
	        }
	    }

	    public function index()
	    {
	    	$this->load_view('template/header');
	    	$this->load_view('home');
	    	$this->load_view('template/footer');
	    }
	}

 ?>