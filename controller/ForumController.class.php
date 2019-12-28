<?php
	require_once("./model/Manager/CategorieManager.class.php");
	require_once("./model/Manager/TopicManager.class.php");
	require_once("./model/Manager/MessageManager.class.php");
	
	require_once("./app/Controller.class.php");
	require_once("./app/ControllerInterface.class.php");
	
	define("VIEW_DIR", "forum/");
	
	class ForumController extends Controller implements ControllerInterface{
		
		private $managers;
		
		public function __construct(){
			$this->managers = [
				"categorie" => new CategorieManager(),
				"topic"     => new TopicManager(),
				"message"   => new MessageManager()
			];
		}
		
		public function index(){ //$this->authenticationRequired();
			
			$categories = $this->managers['categorie']->getAll();
			foreach($categories as $cat){
				$cats[] = array(
					"categorie" => $cat, 
					"lastTopic" => $this->managers['topic']->getLastByCategorie($cat->getId())
				);
			}
			return array(
				"vue"  => VIEW_DIR."liste_categories",
				"data" => [
					"categories" => $cats,  
					"titre"      => "Liste des catégories"
				]
			);
		}
		
		public function sujets($idcat){ //$this->authenticationRequired();

			$sujets = $this->managers['topic']->getAllByCategorie($idcat);
			$cat = $this->managers['categorie']->getById($idcat);
			
			return array(
				"vue"  => VIEW_DIR."liste_sujets",
				"data" => [
					"categorie" => $cat, 
					"sujets"    => $sujets, 
					"titre"     => $cat->getNom()
				]
			);
		}
		
		public function voirTopic($idtopic){ //$this->authenticationRequired();

			$messages = $this->managers['message']->getAllByTopic($idtopic);
			$topic = $this->managers['topic']->getById($idtopic);
			
			$this->managers['topic']->addViewForTopic($topic);//ajoute 1 vue pour ce topic
			
			return array(
				"vue"  => VIEW_DIR."voir_topic",
				"data" => [
					"categorie" => $topic->getCategorie(),
					"sujet"     => $topic,
					"messages"  => $messages, 
					"titre"     => $topic->getTitre()
				]
			);
		}
		
		public function ajouterTopic($idcat){ 
        
            $this->authenticationRequired();
			
			if(!empty($_POST)){
				$titre  = $_POST['titre'];
				
				$newTopicId = $this->managers['topic']->insertTopic($titre, $idcat);
				
				if($newTopicId){
					$this->ajouterPost($newTopicId);
				}
				else Session::addFlash("error", "Erreur ! Contactez l'administrateur !");
			}
			
			return array(
				"vue"  => VIEW_DIR."form",
				"data" => [
					"categorie" => $this->managers['categorie']->getById($idcat),
					"titre"     => "Ajouter un nouveau sujet"
				]
			);
		}
		
		public function lock($idtopic){
                        
            $this->authenticationRequired();
			
			$topic = $this->managers['topic']->getById($idtopic);
			
			$status = $topic->getEditable() ? "clos" : "réactivé";
			
			if(Session::getUser() == $topic->getUser() || Session::isAdmin()){
				$this->managers['topic']->toggleClose($topic);
				$title = $topic->getTitre();
				Session::addFlash("notice", "Le sujet '$title' est $status !");
			}
			return $this->sujets($topic->getCategorie()->getId());
		}
		
		public function ajouterPost($idtopic){ $this->authenticationRequired();
			
			if(!empty($_POST)){
				
				$message  = $_POST['message'];
				if($message !== ""){
					if($this->managers['message']->insertMessage($idtopic, $message)){
						Session::addFlash("success", "Votre message a bien été ajouté !");
					}
					else{
						Session::addFlash("error", "Votre message est vide, andouille !");
					}
				}
			}
			return $this->redirect("forum", "voirTopic", ["id" => $idtopic]);
		}
		
		/*public function supprimer($id){
			
			if($voiture = $this->manager->getVoiture($id)){
				$nomvoiture = $voiture->getMarque()." ".$voiture->getModele();
				$imgpath = IMG_PATH.$voiture->getImg();
				
				if($this->manager->deleteVoiture($id)){
					unlink($imgpath);
					Session::addFlash("success", "$nomvoiture supprimée avec succès !");
				}
				else Session::addFlash("error", "Problème lors de la suppression !");
			}
			else Session::addFlash("error", "Véhicule inconnu");
			
			return array(
				"vue"  => VIEW_DIR."liste",
				"data" => $this->manager->getAll()
			);
		}*/
		
	}