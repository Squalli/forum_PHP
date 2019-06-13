<?php
	require_once("./app/Manager.class.php");
	require_once("./model/Entity/Message.class.php");
	
	class MessageManager extends Manager{
		
		public function __construct(){
			parent::connexion();
		}
		
		public function getAllByTopic($idtopic){
			$data = parent::selectQuery("
				SELECT id, text, datecreation, user
				FROM message
				WHERE topic = :topic
				ORDER BY datecreation ASC",
				array("topic" => $idtopic)
			);
			
			return parent::getMultipleResults($data, "Message");
			
		}
		
		public function insertMessage($idtopic, $texte){
			
			$iduser = Session::getUser()->getId();
			
			return parent::execQuery("
				INSERT INTO message (text, user, topic)
				VALUES (:text, :user, :topic)
				", 
				array(
					"text" => $texte,
					"user" => $iduser,					
					"topic" => $idtopic
				)
			);
		}
		
	}