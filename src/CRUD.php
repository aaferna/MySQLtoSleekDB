<?php 

namespace CRUD{

    use \SleekDB\Store as DBController;

	class Activity {

	    public $database;
	    public $root;
	    public $db;

	    public function __construct($database, $root){

	    	$this->database = $database;
	    	$this->root = $root;

	    }

	    public function InvokeDB(){

	    	$this->db = new DBController($this->database, $this->root);

	    }

	    public static function FormatData($array){

			return array('count' => count($array), 'data' => $array);

		}

	 	public function Manager(){

	 		$this->InvokeDB();
	 		return $this->db;

	 	}

	}

}

?>