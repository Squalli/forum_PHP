<?php
	require_once("./app/Entity.class.php");

	class User extends Entity{
		
		private $id;
		private $pseudo;
		private $email;
		private $dateinscription;
		private $sexe;
		private $avatar;
		private $role;
				
		public function __construct($data){
			parent::hydrate(get_class($this), $data);
		}
		
		public function getId(){
			return $this->id;
		}
		
		public function getEmail(){
			return $this->email;
		}
		
		public function getPseudo(){
			return $this->pseudo;
		}
		
		public function getDateinscription(){
			return strftime("%A %e %B %Y", $this->dateinscription->getTimestamp());
		}
		
		public function getAvatar(){
			return $this->avatar;
		}
		
		public function getSexe(){
			return $this->sexe;
		}
		
		public function getRole(){
			return $this->role;
		}
		
		public function setPseudo($pseudo){
			$this->pseudo = $pseudo;
		}
		
		public function setEmail($email){
			$this->email = $email;
		}
		
		public function setId($id){
			$this->id = $id;
		}
		
		public function setDateinscription($date){
			$this->dateinscription = new DateTime($date);
		}
		
		public function setSexe($sexe){
			$this->sexe = $sexe;
		}
		
		public function setAvatar($filename){
			if($filename){
				$this->avatar = $filename;
			}
			else $this->avatar = "avatar_default.png";
		}
		
		public function setRole($role){
			$this->role = $role;
		}
		
		public function __toString(){
			return $this->pseudo;
		}
	}