<?php 

	namespace MYtoSL {

		use \SleekDB\Store as DBController;

		class Importer {

			public static function MYSQLITables($server, $user, $pass, $db){

				$ConnectServ_SQL = mysqli_connect($server, $user, $pass, $db); 
				mysqli_set_charset($ConnectServ_SQL, "utf8");

				if (mysqli_connect_errno()) { return mysqli_connect_errno(); }
				else { 

					$arrayPost = array();
					$response = mysqli_query($ConnectServ_SQL, 'SHOW TABLES');

					$i = 0;

					while ($return = mysqli_fetch_array($response)) {
						$arrayPost[$i] = $return[0];
						$i++;
					}

					return $arrayPost;

				}
				
				mysqli_close($ConnectServ_SQL);

			}

			public static function MYSQLIContent($server, $user, $pass, $db, $table){

				$ConnectServ_SQL = mysqli_connect($server, $user, $pass, $db); 
				mysqli_set_charset($ConnectServ_SQL, "utf8");

				if (mysqli_connect_errno()) { return mysqli_connect_errno(); }
				else { 

					$arrayPost = array();
					$response = mysqli_query($ConnectServ_SQL, 'SELECT * FROM '.$table); 
					$i = 0;
					while ($return = mysqli_fetch_array($response)) {

						foreach($return as $key => $value) {
							if ((!intval($key)) and ($key != 0)) {
								$arrayPost[$i][$key] = $return[$key];
							}
						}
						$i++;
					}

					return $arrayPost;

				}
				
				mysqli_close($ConnectServ_SQL);

			}

			public static function SleekDBImport($route, $data, $table){

				$newsStore = new \SleekDB\Store($table, $route);
				return $newsStore->insert($data);

			}

			public static function MySQLtoSleekDB($server, $user, $pass, $db, $route){

				$getTables = self::MYSQLITables($server, $user, $pass, $db);

				for ($i=0; $i < count($getTables) ; $i++) { 

					$return = self::MYSQLIContent($server, $user, $pass, $db, $getTables[$i]); 

					if (!empty($return)) { 

						for ($r=0; $r < count($return) ; $r++) { 
							self::SleekDBImport($route, $return[$r], $getTables[$i]);
						}

					}

				}

				return 1;

			}

		}	

	}

?>