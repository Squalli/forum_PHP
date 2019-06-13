<?php
	
	abstract class Upload{
		
		private static $mimeTypesAllowed = ["image/jpeg","image/jpg","image/png","image/gif"];
		private static $maxSize = 2048000;
		
		public static function uploadFile($inputName, $filename, $path){
			
			if(is_uploaded_file($_FILES[$inputName]['tmp_name'])){
								 
				$upload_info = array(
					'name' => $filename,
					'size' => $_FILES[$inputName]['size'],
					'mime' => finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES[$inputName]['tmp_name']),
					'extension' => pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION),
					'folder_to_move' => $path,
					'error_code' => $_FILES[$inputName]['error']
				);
				
				if(in_array($upload_info['mime'], self::$mimeTypesAllowed, true)){
					
					if($upload_info['error_code'] === 0){
						move_uploaded_file(
							$_FILES[$inputName]['tmp_name'], 
							$path.$upload_info['name'].".".$upload_info['extension']
						);
						return $upload_info['name'].".".$upload_info['extension'];
					}
					else Session::addFlash("error", "L'image est corrompue, réessayez !");
				}
				else Session::addFlash("error", "Extension de fichier non autorisée !");
			}
			
			return false;
		}
	}