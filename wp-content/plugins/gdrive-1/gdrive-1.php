<?php
/**
 * @package gdrive-1
 */
/*
    Plugin Name: gdrive-1
    Plugin URI: http://wordpress.org/plugins/my-gdrive-1
    Description: Mapping file from google drive into Wordpress Media
    Author: elf deng
    Version: 1.0
    License: GNU General Public License v2.0 or later
    License URI: http://www.opensource.org/licenses/gpl-license.php
*/

/**
 * Copyright (c)2016 elf deng
 * 
 */


require_once "includes/class-GDMLWeb.php";


add_filter('wp_get_attachment_url', 'gdml_getMediaURLFile');
function gdml_getMediaURLFile($url)
{
    $folder = get_option('gdml_mapping_folder');
    $arr = wp_upload_dir();
    
    if(strpos($url, 'GDML-Mapping/'))
    	$url = str_replace($arr['baseurl'] . '/GDML-Mapping/', 'https://googledrive.com/host/' . $folder . '/', $url);

    return $url;
    //$url will be 'https://googledrive.com/host/' . $folder . '/''
}


/*
 * Embed java script and css style
 * Created on 26 August 2014
 * Updated on 5 September 2014
 * */
function gdml_adminScript()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-dialog');
    wp_enqueue_script('jquery-ui-tooltip');
    wp_enqueue_script('jquery-ui-tabs');
    //var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ';
    wp_enqueue_script('gdml-javascript',  plugin_dir_url(__FILE__)."js/gdml.js");
    //wp_enqueue_script('my_gpicker',  plugin_dir_url(__FILE__)."js/my_gpicker.js");
    //wp_enqueue_script('my_gapi', "https://apis.google.com/js/api.js"); //?onload=onApiLoad");
    wp_enqueue_style ('gdml-css', plugin_dir_url(__FILE__).'css/gdml.css');
    wp_enqueue_style ('jquery-ui-css', plugin_dir_url(__FILE__).'css/jquery-ui.css');
    //wp_enqueue_style ('jquery-ui-css-admin', plugin_dir_url( __FILE__ ).'css/jquery-ui-classic.css' );
}


/*
 * Add page on Wordpress Admin -> Media
 * Created on 26 August 2014
 * Updated on 26 August 2014
 * */
function gdml_media_actions()
{
    if(!is_admin()) 
        wp_die("You are not authorized to view this page");
    else 
    {
        add_media_page("gdrive-1", "gdrive-1", 1, "gdrive-1-admin",
            "gdml_media");
        add_action('admin_enqueue_scripts', 'gdml_adminScript');

    }
}

function gdml_media()
{
    include "gdrive-1-admin.php";
}

add_action('admin_menu', 'gdml_media_actions');


/*
 * Add logic to process ajax post 
 * Created on 26 August 2014
 * Updated on 26 August 2014
 * */

function gdml_ajax_cb()
{
    //echo "enter gdml_ajax_post(), ";
    $logfname= wp_upload_dir()["path"]."/mylog.txt";
    echo $logfname. " , ";
    
    try{
    $logfile=fopen($logfname, "a+"); 
    fwrite($logfile, "//===".PHP_EOL);
    fwrite($logfile, "enter gdml_ajax_post()".PHP_EOL); 
    }catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        echo "sth wrong when open $logfname !";
    }
    
    
    /*if(isset($_POST['mappingFolderNonce']))
    {
        $GDMLWebService = new GDMLWeb();
        $message = $GDMLWebService->gdml_saveMappingFolder($_POST['mappingFolder'], 
            $_POST['mappingFolderNonce'], 'mapping-folder-nonce');
        echo $message;
    }*/

    if(isset($_POST['mappingFileNonce']))
    {
        $GDMLWebService = new GDMLWeb();
        //$folder = get_option('gdml_mapping_folder');
        fwrite($logfile, $_POST['fileUrls'].PHP_EOL); 
        $tmp=$_POST['fileUrls'];
        //if(get_magic_quotes_gpc()){
        //      $tmp = stripslashes($tmp);
        //      }
        //$tmp = trim($tmp);
        $docs=json_decode(stripslashes($tmp), true); //return array instead of object
        if($docs==null) fwrite($logfile, json_last_error_msg().PHP_EOL);
        
        fwrite($logfile, gettype($docs).PHP_EOL);

        for($i=0; $i< count($docs); $i++){
            fwrite($logfile, gettype($docs[$i]).PHP_EOL);
            //$docs[$i]=urldecode($docs[$i]);
            //fwrite($logfile, $docs[$i].PHP_EOL); 
        }  
        $message = $GDMLWebService->gdml_saveMappingFile($docs,
            $_POST['mappingFileNonce'], 'mapping-file-nonce');
        //echo $message;
        fwrite($logfile, $message.PHP_EOL); 
    }
    if($logfile) fclose($logfile);
    echo "gdml_ajax_cb done, where is logfile?";
    wp_die();
}

add_action('wp_ajax_gdml_action', 'gdml_ajax_cb');
