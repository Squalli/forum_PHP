<?php
	setlocale(LC_TIME, 'fr_FR');

	require("./app/services/Session.class.php");
	
	/*--chemins des contrôleurs et des vues--*/
	define("CTRL_PATH",    "./controller/");
	define("VIEW_PATH",    "./view/");
	define("CSS_PATH",     "./public/css/");
	define("IMG_PATH",     "./public/img/");
	define("SCRIPT_PATH",  "./public/js/");
	
	define("DEFAULT_CTRL", "Forum");
	
	/*par défaut*/
	$file      = CTRL_PATH.DEFAULT_CTRL."Controller.class.php";
	$ctrlclass = DEFAULT_CTRL."Controller";
	$method    = "index";
	$param     = null;

	/*vérifie s'il y a une sollicitation de l'utilisateur pour une vue précise*/
	if(!empty($_GET) && isset($_GET['control'])){
		/*si le nom d'un controleur est présent dans l'URL*/
		/*exemple = ?control=forum  */
		
		/* $ctrl = 'Forum' */
		$ctrl = ucfirst($_GET['control']);
		/* fichier à ouvrir = 'Forum.controller.php' */
		$file = CTRL_PATH.$ctrl."Controller.class.php";

		if(file_exists($file)){
			/* nom de la classe à appeller = 'ForumController' */
			$ctrlclass = $ctrl."Controller";
		}
	}
	
	/*ouvrons le fichier */
	require_once($file);
	/*et créons un objet de la classe voulue */
	$controller = new $ctrlclass();
		
	/*vérifions maintenant si une méthode est précisée*/
	//new ForumController();
	if(!empty($_GET) && isset($_GET['action']) && method_exists($controller, $_GET['action'])){
		$method = $_GET['action'];
	}
		
	/*il y a un paramètre dans l'URL, je le considère également*/
	if(!empty($_GET) && isset($_GET['id'])){
		$param = $_GET['id'];
	}
	
/*--------APPEL DU CONTROLEUR--------*/
	$result = $controller->$method($param);
	
	
/*--------CHARGEMENT PAGE----------*/	
	ob_start();//démarre un buffer (tampon de sortie)
	/*j'affiche dans le buffer le HTML qui devra être inséré
	au milieu du template*/
	include(VIEW_PATH.$result['vue'].".php");
	/*je mets cet affichage dans une variable*/
	$page = ob_get_contents();
	/*j'efface le tampon*/
	ob_end_clean();

/*--------CHARGEMENT MESSAGES----------*/		
	ob_start();
	include(VIEW_PATH."flashmessages.php");
	$messages = ob_get_contents();
	/*j'efface le tampon*/
	ob_end_clean();
		
	if(!isset($_GET['async'])){
	/*--------CHARGEMENT TEMPLATE PRINCIPAL----------*/	
		include(VIEW_PATH."template.php");
	}
	else{
		echo $messages;
		echo $page;
	}
	
	Session::setLastPage($ctrlclass);	


	