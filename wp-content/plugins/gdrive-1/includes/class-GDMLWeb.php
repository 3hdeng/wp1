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
    function gdml_saveMappingFile($fileName, $folder, $description, $nonce, $nonceField)
    {
        $this->gdml_validateNonce($nonce, $nonceField);
        
        // Verify Google Drive mapping folder
        if(empty($folder))
            return "<div class='error'><p>Please set up Google Drive folder in Mapping Folder!</p></div>";
        
        // Verify file name
        if(empty($fileName))
            return "<div class='error'><p>File name is required!</p></div>";
        
        $filePath = "GDML-Mapping/{$fileName}";
        $fullFile = "https://googledrive.com/host/{$folder}/{$fileName}";

        if (@fclose(@fopen($fullFile,"r")))
        {
            $imageSize = getimagesize($fullFile);
            $imageWidth = $imageSize[0];
            $imageHeight = $imageSize[1];
            $fileType = $imageSize["mime"];
    
            $meta = array('aperture' => 0, 'credit' => '', 'camera' => '', 'caption' => $fileName, 'created_timestamp' => 0,
                'copyright' => '', 'focal_length' => 0, 'iso' => 0, 'shutter_speed' => 0, 'title' => $fileName);

            $attachment = array('post_mime_type' => $fileType, 'guid' => $filePath,
                'post_parent' => 0,	'post_title' => $fileName, 'post_content' => $description);

            $attach_id = wp_insert_attachment($attachment, $filePath, 0);
    
            $metadata = array("image_meta" => $meta, "width" => $imageWidth, "height" => $imageHeight,
                "file" => $filePath, "GDML" => TRUE);

            if(wp_update_attachment_metadata( $attach_id,  $metadata))
                return "<div class='updated'><p>File {$fileName} has been saved successfully.</p></div>" ;
                //+ "<div>" + print_r($meta, true) + "</div>";
        }
        else
            return "<div class='error'><p>File {$fileName} does not exist!</p></div>";
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