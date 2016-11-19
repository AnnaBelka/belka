<?
	
	class Db {
		public $dbc;
		protected $query;
		protected $result;
		
		function __construct(){

			$this->dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if (!$this->dbc) {
				die();
			}
			$this->dbc->set_charset("utf8");
			return $this->dbc;
		}

		public function makeQuery($query){

			$this->result = mysqli_query($this->dbc, $query);

			if (!$this->result) {	
				die();
			}
			return (is_bool($this->result))?  $this->result : mysqli_fetch_all_my($this->result);
		} 

		function __destruct(){
			mysqli_close($this->dbc);
		}
	}

?>