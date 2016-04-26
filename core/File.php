<?php 
    class File {
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

					// The file
					$filename = $src_img;
					$percent = 0.25;

					// Content type
					header('Content-Type: image/jpeg');

					// Get new dimensions
					list($width, $height) = getimagesize($filename);
					$new_width = $width * $percent;
					$new_height = $height * $percent;

					$new_width = 850;
					$new_height = 478;

					// Resample
					$image_p = imagecreatetruecolor($new_width, $new_height);
					// $image = imagecreatefromjpeg($filename);
					imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

					// Output
					imagejpeg($image_p, $destination, 100);
					

					array_push($compressed_images, $this->formatImageUrl($value,'gallery'));
				}
				return $compressed_images;
			}else{
				return $this->formatImageUrl($get_gallery_images,'gallery');
			}

			exit();
		} 

    }
?>