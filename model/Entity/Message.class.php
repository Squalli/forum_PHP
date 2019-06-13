<?php
	require_once("./app/Entity.class.php");
	//require_once("./model/Manager/TopicManager.class.php");
	require_once("./model/Manager/UserManager.class.php");

	class Message extends Entity{
		
		private $id;
		private $text;
		private $datecreation;
		private $user;
		
		public function __construct($data){
			parent::hydrate(get_class($this), $data);
		}
		
		public function getId(){
			return $this->id;
		}
		public function getText(){
			return $this->text;
		}
		public function getDatecreation(){
			return $this->datecreation->format("d/m/Y H:i:s");
		}
		public function getUser(){
			return $this->user;
		}
		
		public function setId($id){
			$this->id = $id;
		}
		public function setText($text){
			$this->text = $text;
		}
		public function setDatecreation($date){
			$this->datecreation = new DateTime($date);
		}
		public function setUser($u){
			$uman = new UserManager();
			$this->user = $uman->getById($u);
		}
		
	}