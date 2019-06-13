<?php

	abstract class Manager{
		
		private static $dsn    = "mysql:dbname=forum;host=localhost:3306";
		private static $userdb = "root";
		private static $pass   = "";
		
		private static $pdo;
		
		protected function connexion(){
			
			try{
				self::$pdo = new PDO(
					//chemin d'accès à la base de données (nom et serveur hôte)
						self::$dsn, 
					//nom d'utilisateur de la BDD
						self::$userdb, 
					//Mot de passe
						self::$pass,
					//tableau d'options de connexion
						array(
						//encodage des résultats récupérés
						   PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
						//type d'erreur que le driver PDO lèvera
						   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						//mode de récupération des données de requète
						   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
						)              
				);
			}
			catch(PDOException $e){
				echo "Connexion à la base échouée : ".$e->getMessage();
				die();
			}
		}
		
		protected function selectQuery($sql, $params = null){
			try{
				//on prepare, qu'il y ait des paramètres ou pas, la requête
				$statement = self::$pdo->prepare($sql);
				//et on l'exécute (si params est null, ça change rien)
				$statement->execute($params);
				
				if($statement->rowCount() > 1){
					return $statement->fetchAll();
				}
				else return $statement->fetch();
				
			}	
				
			catch(PDOException $e){//erreur de requète
				print "La fonction ".__FUNCTION__." dans le fichier ".__FILE__." à la ligne ".__LINE__." a échoué !!!<br>";
				print "Requête executée : <strong>".$sql."</strong><br>";
				print $e->getMessage();
				die();
			}
			finally{
				$statement->closeCursor();
			}
		}
		
		protected function execQuery($sql, $params){
			try{
				$statement = self::$pdo->prepare($sql);
				return $statement->execute($params);
			}	
				
			catch(PDOException $e){//erreur de requète
				print "La fonction ".__METHOD__." dans le fichier ".__FILE__." à la ligne ".__LINE__." a échoué !!!<br>";
				print "Requête executée : <strong>".$sql."</strong><br>";
				print $e->getMessage();
				die();
			}
			finally{
				$statement->closeCursor();
			}
		}
		
		protected function getLastInsertId(){
			return self::$pdo->lastInsertId();
		}
		
	//--fonctions de renvoi--//	
		protected function getMultipleResults($records, $class){
			
			
			if(isset($records[0])){
				foreach($records as $record){
					$results[] = new $class($record);
					
				}
				return $results;
			}
			else if($records){
				return array(new $class($records));
			} 
			return false;
			
		}
		
		protected function getOneOrNullResult($record, $class){
			if(!empty($record)){
				return new $class($record);
			}
			return null;
		}
	}