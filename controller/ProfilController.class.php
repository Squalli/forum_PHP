<?php
	require_once("./model/Manager/UserManager.class.php");
	require_once("./app/Controller.class.php");
	require_once("./app/ControllerInterface.class.php");
	
	//require_once("./app/services/Upload.class.php");
	
	define("VIEW_DIR", "profil/");
	
	class ProfilController extends Controller implements ControllerInterface{
		
		private $managers;
		
		public function __construct(){
			$this->manager = new UserManager();
		}
		
		public function index(){ $this->authenticationRequired();
			return $this->redirect("profil", "voir", ["id" => Session::getUser()->getId()]);
		}
		
		public function voir($iduser){ $this->authenticationRequired();
			
			$user = $this->manager->getById($iduser);
			
			return array(
				"vue"  => VIEW_DIR."voir_profil",
				"data" => [
					"user" => $user,
					"titre" => "Profil de ".$user
				]
			);
		}
		
	}