<?php
class GDMLWeb
{
    /*
    * Verify nonce for security
    * Created on 27 August 2014
    * Updated on 27 August 2014
    * */
    public function gdml_validateNonce($nonce, $field)
    {
        if (!wp_verify_nonce($nonce, $field)) 
            die('<div class="error"><p>Security check failed!</p></div>');
    }


    /*
    * Save Mapping Folder
    * Created on 27 August 2014
    * Updated on 27 August 2014
    * */
    public function gdml_saveMappingFolder($mappingFolder, $nonce, $nonceField)
    {
        
        $this->gdml_validateNonce($nonce, $nonceField);
        $url = "https://googledrive.com/host/{$mappingFolder}/";
        
        if(empty($mappingFolder))
            return "<div class='error'><p>Google Drive folder is required!</p></div>";

        if (!@file_get_contents($url)) 
            return "<div class='error'><p>Google Drive folder does not exist!</p></div>";

        $mappingFolder = sanitize_text_field($mappingFolder);
        
        if(update_option('gdml_mapping_folder', $mappingFolder))
            return "<div class='updated'><p>Google Drive folder has been saved successfully.</p></div>";
    }
    
    /*
    * Save Mapping File
    * Created on 27 August 2014
    * Updated on 27 August 2014
    * */
    function gdml_saveMappingFile($urls, $nonce, $nonceField)
    {
       $currentPath = plugin_dir_url(__FILE__);
       $logfname=$currentPath."/mylog.txt";
       $logfile=fopen($logfname, "a+"); 
       //$urls to $url, $folder, $filename
       fwrite($logfile, "//===".PHP_EOL);
       
       $this->gdml_validateNonce($nonce, $nonceField);
        
       $ret=array();
      
       
       for($i=0; $i< $urls.length(); $i++)
       {
        $url=sanitize_text_field($urls[i]);
       
        //file_put_contents($logfile, $url, FILE_APPEND);
        fwrite($logfile, $url.PHP_EOL);
        //use PHP_EOL instead of "\n"
        //https://wp1-deng3h.c9users.io/wp-content/uploads/2016/07/cropped-0009-e1468978949141.jpg

        $folder="dir1";
        $filename= basename($url);
        fwrite($logfile, $filename.PHP_EOL);
        $filePath = "GDML-Mapping/{$folder}/{$fileName}";
        //$fullFile = $url; 
        //"https://googledrive.com/host/{$folder}/{$fileName}";

        if (@fclose(@fopen($url,"r")))
        {
            fwrite($logfile, "opened successfully".PHP_EOL);
            $imageSize = getimagesize($url);
            $imageWidth = $imageSize[0];
            $imageHeight = $imageSize[1];
            $fileType = $imageSize["mime"];
            //=== how to get camera info from image/photo file
            $meta = array('aperture' => 0, 'credit' => '', 'camera' => '', 'caption' => $fileName, 'created_timestamp' => 0,
                'copyright' => '', 'focal_length' => 0, 'iso' => 0, 'shutter_speed' => 0, 'title' => $fileName);

            $attachment = array('post_mime_type' => $fileType, 'guid' => $filePath,
                'post_parent' => 0,	'post_title' => $fileName, 'post_content' => $description);

            $attach_id = wp_insert_attachment($attachment, $filePath, 0);
    
            $metadata = array("image_meta" => $meta, "width" => $imageWidth, "height" => $imageHeight,
                "file" => $filePath, "GDML" => TRUE);

            if(wp_update_attachment_metadata( $attach_id,  $metadata)){
              $ret[]="{$filePath} done";
              fwrite($logfile, "attached to wp media lib".PHP_EOL);
            }
               
        }
        else{
            $ret[]="{$filePath} failed";
            //return "<div class='error'><p>File {$filePath} does not exist!</p></div>";
             fwrite($logfile, "failed ...".PHP_EOL);
        }
       }
       
       fclose($logfile);
       return '<div>'.arr2ul($ret).'</div>';
    }

    
function arr2ul($array) {
  $output = '<ul>';
  foreach ($array as  $value) {
    $function = is_array($value) ? __FUNCTION__ : 'htmlspecialchars';
    $output .= '<li>'. $function($value) . '</i></li>';
  }
  return $output . '</ul>';
}
    
    /**
     * */
     //=== php function
function retrieveAllFiles($service) {
  $result = array();
  $pageToken = NULL;

  do {
    try {
      $parameters = array();
      if ($pageToken) {
        $parameters['pageToken'] = $pageToken;
      }
      $files = $service->files->listFiles($parameters);

      $result = array_merge($result, $files->getItems());
      $pageToken = $files->getNextPageToken();
    } catch (Exception $e) {
      print "An error occurred: " . $e->getMessage();
      $pageToken = NULL;
    }
  } while ($pageToken);
  return $result;
} 
     
} // end of class
?>