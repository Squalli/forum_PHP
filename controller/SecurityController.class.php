<?php
	require_once("./model/Manager/UserManager.class.php");
	require_once("./app/Controller.class.php");
	require_once("./app/ControllerInterface.class.php");
	require_once("./app/services/Upload.class.php");
	
	define("VIEW_DIR", "security/");
	
	class SecurityController extends Controller implements ControllerInterface{
		
		private $manager;
		
		public function __construct(){
			$this->manager = new UserManager();
		}
		
		public function index(){
			
			return $this->redirect("security", "login");
		}
		
		public function login(){
			
			if(!empty($_POST)){
				$login  = trim($_POST['login']);
				$pass   = $_POST['password'];
				
				if($login !== "" && $pass !== ""){
					if($this->manager->checkUser($login)){
						$user = $this->manager->getUser($login);
						$dbpass = $this->manager->getPassword($user->getId());
						if(password_verify($pass, $dbpass)){
							
							if(Session::setUser($user)){
								Session::addFlash("success", "Bienvenue ".$user);
							}
							else Session::addFlash("error", "Veuillez vous déconnecter avant !");
						    $this->redirect(Session::getLastPage());
							
						}
						else Session::addFlash("error", "Le mot de passe ne correspond pas !");
					}
					else Session::addFlash("error", "Cet utilisateur n'existe pas !");
				}
				else Session::addFlash("error", "Veuillez remplir tous les champs SVP !");
			}
			
			return array(
				"vue"  => VIEW_DIR."login",
				"data" => ["titre" => "Connexion"]
			);
		}
		
		public function register(){

			if(!empty($_POST)){
				
				$email  = trim($_POST['email']);
				$pseudo = trim($_POST['pseudo']);
				$pass   = $_POST['password'];
				$repeat = $_POST['pass-repeat'];
				$sexe   = $_POST['sexe'];
				
				if($email !== "" && $pseudo !== ""){
					if($pass !== "" && ($pass === $repeat)){
						
						/*ici il faudrait nettoyer, formater, balayer, astiquer, koss a toujou pimpan !*/
						
						if(!$this->manager->checkUser($email)){
							$hash = password_hash($pass, PASSWORD_DEFAULT);
							$avatar = Upload::uploadFile("avatar", "avatar-".$pseudo, IMG_PATH."avatars/");
							if($this->manager->insertUser($email, $pseudo, $hash, $sexe, $avatar)){
								Session::addFlash("success", "Inscription réussie, connectez-vous !");
								$this->redirect(Session::getLastPage());
							
							}
							else Session::addFlash("error", "Erreur de système, veuillez contacter l'administrateur !");
						}
						else Session::addFlash("error", "Email déjà utilisé !");
					}
					else Session::addFlash("error", "Problème de mot de passe !");
				}
				else {
					Session::addFlash("notice", "eeemps SVP !");
					Session::addFlash("error", "Veuillez remplir tous les champs SVP !");
				}
			}
			
			return array(
				"vue"  => VIEW_DIR."register",
				"data" => ["titre" => "Inscription"]
			);
		}
		
		public function logout(){
			
			Session::removeUser();
			Session::addFlash("success", "A bientôt !");
			$this->redirect(Session::getLastPage());
		}
	}