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
        try{
       //$currentPath = plugin_dir_url(__FILE__);
       $logfname=wp_upload_dir()["path"]."/mylog2.txt";
       $logfile=fopen($logfname, "a+"); 
       //$urls to $url, $folder, $filename
       fwrite($logfile, "//=== {$logfname} , gdml_saveMappingFile()".PHP_EOL);
        fwrite($logfile, gettype($urls).PHP_EOL);
         fwrite($logfile,$nonce.PHP_EOL);
         fwrite($logfile,$nonceField.PHP_EOL); 
         
       for($i=0; $i< count($urls); $i++)
       {
        $url=$urls[$i];
        fwrite($logfile, $url.PHP_EOL);
       }
       //$ret=$urls;
       fclose($logfile);
       //return '<div>'.arr2ul($ret).'</div>';
       return '<div> i am a pig </div>';
        } catch(Exception  $e){
           $msg= $e->getMessage();
           //echo $msg;
           return "my error caught ".$msg;
        }
        
        
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