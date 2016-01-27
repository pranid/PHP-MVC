<?php 
	class Parser
	{

    	public function view($page,$data = array())
	    {
	    	extract($data);
			if(!include (BASE_PATH.'/application/pages/'.$page.'.php')){
	    		die('Sorry! Page not found');
	    	}
	    	
	    }

	    /**
	     * Get all the files and folders of a directory
	     */
	    public function getInsideDirectory($dir) {
  
		   $result = array();

		   $cdir = scandir($dir);
		   foreach ($cdir as $key => $value)
		   {
		      if (!in_array($value,array(".","..")))
		      {
		         if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
		         {
		            $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
		         }
		         else
		         {
		            $result[] = $value;
		         }
		      }
		   }
		  
		   return $result;
		} 

		public function formatImageUrl($images,$folder_path)
		{
			if(is_array($images)) {
				foreach ($images as $key => $value) {
					$images[$key] = BASE_URL.'/'.$folder_path.'/'.$value;
				}
				return $images;
			}else{
				$image = BASE_URL.'/'.$folder_path.'/'.$images;
				return $image;
			}
		}

		public function compress($img = null,$img_dir = null,$img_quality = null) { 

			$compressed_images = array();


			$get_dir_images = $this->getInsideDirectory($img_dir);
			$get_gallery_images = $this->getInsideDirectory(IMG_GALLERY);

			$img_exist = array_diff($get_dir_images, $get_gallery_images);

			if(sizeof($img_exist) > 0) {
				foreach ($img_exist as $key => $value) {
					$src_img = $img_dir.'/'.$value;
					$info = getimagesize($src_img); 
					$destination = IMG_GALLERY.'/'.$value;
					// $destination = imagecreatefromstring(IMG_GALLERY.'/'.$value);
					// var_dump($destination);

					if ($info['mime'] == 'image/jpeg') {
						$image = imagecreatefromjpeg($src_img); 
					} elseif ($info['mime'] == 'image/gif') {
						$image = imagecreatefromgif($src_img); 
					} elseif ($info['mime'] == 'image/png') {
						$image = imagecreatefrompng($src_img); 
					}

					$newwidth = 850;
					$newheight = 478;

					// var_dump(imagesx($image).' X '.imagesy($image));
					$width = (int)imagesx($image);
					$height = (int)imagesy($image);
					// var_dump($destination);
					// var_dump($image);
					// $destination = imagecreatefromjpeg($destination);
					// Resize
					// imagecopyresized($image,$image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

					imagejpeg($image,$destination); 
					// imagedestroy($destination);
					
					// array_push($compressed_images, $this->formatImageUrl($value,'gallery'));
				}
				return $compressed_images;
			}else{
				return $this->formatImageUrl($get_gallery_images,'gallery');
			}

			exit();
		} 


	}
?>