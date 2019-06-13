<?php
	require_once("./app/Manager.class.php");
	require_once("./model/Entity/User.class.php");
	
	class UserManager extends Manager{
		
		public function __construct(){
			parent::connexion();
		}
		
		public function checkUser($login){
			$result = parent::selectQuery("
				SELECT COUNT(id) AS nb
				FROM user
				WHERE email = :login
				OR pseudo = :login", 
				array("login" => $login)
			);
			
			return $result['nb'];
		}
		
		public function getUser($login){
			$data = parent::selectQuery("
				SELECT id, email, pseudo, dateinscription, sexe, avatar, role
				FROM user
				WHERE email = :login
				OR pseudo = :login", 
				array("login" => $login)
			);
			
			return parent::getOneOrNullResult($data, "User");
		}
		
		public function getById($id){
			$data = parent::selectQuery("
				SELECT id, email, pseudo, dateinscription, sexe, avatar, role
				FROM user
				WHERE id = :id", 
				array("id" => $id)
			);
			
			return parent::getOneOrNullResult($data, "User");
		}
		
		public function getPassword($id){
			$data = parent::selectQuery("
				SELECT password
				FROM user
				WHERE id = :id", 
				array("id" => $id)
			);
			
			return $data['password'];
		}
		
		public function insertUser($email, $pseudo, $hash, $sexe = null, $avatar = null){
			return parent::execQuery("
				INSERT INTO user (email, pseudo, password, sexe, avatar)
				VALUES (:email, :pseudo, :password, :sexe, :avatar)
				", 
				array(
					"email" => $email,
					"pseudo" => $pseudo,					
					"password" => $hash,
					"sexe" => $sexe,
					"avatar" => $avatar
				)
			);
			
		}
		
	}
	