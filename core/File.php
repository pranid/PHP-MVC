<?php

/**
 * Created by PhpStorm.
 * User: Praneeth Nidarshan
 * Date: 10/22/2016
 * Time: 9:18 AM
 */
class File
{
    private $quality = 50;
    private $destination;
    private $temp_url;

    /**
     * File constructor.
     * @param $destination
     */
    public function __construct()
    {
        global $_config;
        $this->destination = $_config['base_uri'] . "/cache/images";
        $this->temp_url = $_config['base_url'] . "/cache/images";
    }


    private function setImageCompressionQuality($imagePath, $file)
    {
        $image_info = getimagesize($imagePath);
        $percent = 0.5;

        # Changing Image Resolution
        list($width, $height) = getimagesize($imagePath);
        $img_width = $width * $percent;
        $img_height = $height * $percent;

        $destination = $this->destination . "/" . $img_width . "X" . $img_height . "_" . $file;
        $url = $this->temp_url . "/" . $img_width . "X" . $img_height . "_" . $file;

        if (!file_exists($destination)) {
            # Creating Image from source
            if ($image_info['mime'] == 'image/jpeg') {
                $image = imagecreatefromjpeg($imagePath);
            } elseif ($image_info['mime'] == 'image/gif') {
                $image = imagecreatefromgif($imagePath);
            } elseif ($image_info['mime'] == 'image/png') {
                $image = imagecreatefrompng($imagePath);
            }

            # Re-sampling Image
            $new_image = imagecreatetruecolor($img_width, $img_height);
            imagecopyresampled($new_image, $image, 0, 0, 0, 0, $img_width, $img_height, $width, $height);

            # Create Image File
            imagejpeg($new_image, $destination, $this->quality);
        }

        return $url;
    }

    public function getDirFiles($dir, $url = null)
    {
        try {
            $dir_files = scandir($dir);
            $files = array();

            if (!$dir_files) {
                return "Empty Folder or Folder not found.";
            } else {
                foreach ($dir_files as $file) {
                    if (!in_array($file, array(".", ".."))) {
                        $img_uri = "$dir/$file";

                        $file = array(
                            'temp_url' => $this->setImageCompressionQuality($img_uri, $file),
                            'img_url' => "$url/$file",
                        );
                        array_push($files, $file);
                    }
                }

                return $files;
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}