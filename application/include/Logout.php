<?php 
	/**
	 * Logout and end user session
	 */
	class Logout
	{
	    /**
	     * log out user
	     */
	    public function __construct()
	    {
	        session_start();
	        $this->index();
	    }

	    public function index()
	    {
	    	session_destroy();
	    	header("Location:".BASE_URL);
	    }
	}

?>