<?php
	require_once("./app/Entity.class.php");
	require_once("./model/Manager/CategorieManager.class.php");
	require_once("./model/Manager/UserManager.class.php");

	class Topic extends Entity{
		
		private $id;
		private $titre;
		private $datecreation;
		private $user;
		private $editable;
		private $nbMessages;
		private $categorie;
		private $nbVues;
		
		public function __construct($data){
			parent::hydrate(get_class($this), $data);
		}
		
		public function getId(){
			return $this->id;
		}
		public function getTitre(){
			return $this->titre;
		}
		public function getDatecreation(){
			return $this->datecreation->format("d/m/Y");
		}
		public function getUser(){
			return $this->user;
		}
		public function getEditable(){
			return $this->editable;
		}
		public function getCategorie(){
			return $this->categorie;
		}
		public function getNbMessages(){
			return $this->nbMessages;
		}
		public function getNbVues(){
			return $this->nbVues;
		}
		public function setId($id){
			$this->id = $id;
		}
		public function setTitre($titre){
			$this->titre = $titre;
		}
		public function setDatecreation($date){
			$this->datecreation = new DateTime($date);
		}
		public function setUser($u){
			$uman = new UserManager();
			$this->user = $uman->getById($u);
		}
		public function setEditable($edit){
			$this->editable = $edit;
		}
		public function setCategorie($c){
			$cman = new CategorieManager();
			$this->categorie = $cman->getById($c);
		}
		public function setNbMessages($nb){
		    $this->nbMessages = $nb;
		}
		public function setNbVues($nb){
		    $this->nbVues = $nb;
		}
		
		public function __toString(){
			return $this->titre;
		}
		
	}