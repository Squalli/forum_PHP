<?php
	require_once("./app/Manager.class.php");
	require_once("./model/Entity/Topic.class.php");
	
	class TopicManager extends Manager{
		
		public function __construct(){
			parent::connexion();
		}
		
		public function getAllByCategorie($idcat){
			$data = parent::selectQuery("
				SELECT id, titre, datecreation, user, editable, nbMessages, nbVues
				FROM liste_topics
				WHERE categorie = :cat
				ORDER BY datecreation DESC",
				array("cat" => $idcat)
			);
			
			return parent::getMultipleResults($data, "Topic");
			
		}
		
		public function getLastByCategorie($idcat){
			$data = parent::selectQuery("
				SELECT id, titre, datecreation, user
				FROM topic
				WHERE datecreation IN (
					SELECT MAX(datecreation)
                    FROM topic
                    WHERE categorie = :cat
				)",
				array("cat" => $idcat)
			);
			
			return parent::getOneOrNullResult($data, "Topic");
			
		}
		
		public function getById($idtopic){
			
			$data = parent::selectQuery("
				SELECT id, titre, datecreation, user, editable, categorie, nbMessages, nbVues
				FROM liste_topics
				WHERE id = :param_id", array("param_id" => $idtopic));
			//--on ne renvoie qu'un seul objet ou null--//
			
			return parent::getOneOrNullResult($data, "Topic");
		}
		
		public function addViewForTopic(Topic $topic){
			
			$nb = $topic->getNbVues() + 1;
			$topic->setNbVues($nb);
			
			return parent::execQuery("
				UPDATE topic 
				SET nbVues = :nb
				WHERE id = :id", 
				array("id" => $topic->getId(), "nb" => $nb)
			);
		}
		
		public function insertTopic($titre, $idcat){
			
			$iduser = Session::getUser()->getId();
			
			parent::execQuery("
				INSERT INTO topic (titre, user, categorie)
				VALUES (:titre, :user, :cat)
				", 
				array(
					"titre" => $titre,
					"user" => $iduser,					
					"cat" => $idcat
				)
			);
			
			return parent::getLastInsertId();
		}
		
		public function toggleClose($topic){
			
			return parent::execQuery("
				UPDATE topic 
				SET editable = :status
				WHERE id = :id", 
				array(
					"status" => ($topic->getEditable() ? '0' : '1'),
					"id"     => $topic->getId()
				)
			);
		}
	}