<?php
	require_once("./model/Entity/User.class.php");
	session_start();
	
	abstract class Session{
		
		private static $mTypes = ["success", "notice", "error"];

		public static function setUser($user){
			if(!isset($_SESSION['user'])){
				$_SESSION['user'] = $user;
				return true;
			}
			return false;
		}
		
		public static function getUser(){
			if(isset($_SESSION["user"])){
				return $_SESSION['user'];
			}
			return false;
		}
		
		public static function removeUser(){
			unset($_SESSION['user']);
		}
		
		public static function isAdmin(){
			if(isset($_SESSION['user']) && $_SESSION['user']->getRole() === "ADMIN"){
				return true;
			}
			return false;
		}
		
		public static function getFlashes(){
			if(isset($_SESSION["messages"])){
				$flashes = $_SESSION["messages"];
				unset($_SESSION["messages"]);
			}
			else $flashes = [];
			return $flashes;
		}
		
		public static function addFlash($type, $msg){
			
			if(in_array($type, self::$mTypes)){
				$_SESSION["messages"][$type][] = $msg;
			}
		}
		
		public static function setLastPage($ctrl = null){
			
			if(!isset($_SESSION['lastPage']) || 
				self::getCurrentPage() !== $_SESSION['lastPage'] ||
				$ctrl !== "SecurityController"
				){
				$_SESSION['lastPage'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			}
		}
		
		public static function getCurrentPage(){
			return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		}
		
		public static function getLastPage(){
			if(isset($_SESSION['lastPage'])){
				$url = $_SESSION['lastPage'];
			}
			else $url = null;
			return $url;
		}
	}