<?php
	require_once("./app/Manager.class.php");
	require_once("./model/Entity/Categorie.class.php");
	
	class CategorieManager extends Manager{
		
		public function __construct(){
			parent::connexion();
		}
		
		public function getAll(){
			$data = parent::selectQuery("
				SELECT id, nom, nbSujets 
				FROM liste_categories");
			//--on renvoie systématiquement un tableau d'objets-//	
			return parent::getMultipleResults($data, "Categorie");
		}
		
		public function getById($idcat){
			
			$data = parent::selectQuery("
				SELECT id, nom, nbSujets
				FROM liste_categories
				WHERE id = :param_id", array("param_id" => $idcat));
			//--on ne renvoie qu'un seul objet ou null--//
			return parent::getOneOrNullResult($data, "Categorie");
		}
		
	}