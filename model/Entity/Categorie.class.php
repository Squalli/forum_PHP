<?php
	require_once("./app/Entity.class.php");

	class Categorie extends Entity{
		
		private $id;
		private $nom;
		private $nbSujets = null;
		
		public function __construct($data){
			parent::hydrate(get_class($this), $data);
		}
		
		public function getId(){
			return $this->id;
		}
		
		public function getNom(){
			return $this->nom;
		}
		
		public function getNbSujets(){
			return $this->nbSujets;
		}
		
		public function setId($id){
			$this->id = $id;
		}
		
		public function setNom($nom){
			$this->nom = $nom;
		}
		
		public function setNbSujets($nb){
			$this->nbSujets = $nb;
		}
		
		public function __toString(){
			return $this->nom;
		}
	}