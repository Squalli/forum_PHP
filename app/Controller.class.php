<?php

	abstract class Controller{
		
		protected function redirect($ctrl = null, $action = null, $params = null){
			
			$route = "Location: index.php";
			
			if($ctrl){
				$pos = strpos($ctrl, "http://");
				if($pos === false){
					$route.= "?control=".$ctrl;
					if($action){
						$route.= "&action=".$action;
						if($params){
							foreach($params as $paramName => $paramValue){
								$route.= "&$paramName=".$paramValue;
							}
						}
					}
				}
				else{
					$route = "Location: $ctrl";
				}
			}
			
			header($route);
			exit;
		}
		
		protected function authenticationRequired(){
			if(!Session::getUser()){
				Session::addFlash("notice", "Veuillez vous connecter SVP !");
				$this->redirect("security", "login");
			}
			
		}
		
	}