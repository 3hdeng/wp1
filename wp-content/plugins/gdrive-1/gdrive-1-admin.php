<?php
$currentPath = plugin_dir_url(__FILE__);
$mappingFolder = get_option('gdml_mapping_folder');
?>

<!--
Show notification after submitting form
Created on 26 August 2014
Updated on 26 August 2014
-->
<div id="info" style="display: none"></div>

<!--
Define tabs
Created on 26 August 2014
Updated on 26 August 2014
-->
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">About</a></li>
        <li><a href="#tabs-2">File Picker</a></li>
        <li><a href="#tabs-3">Files mapped from gdrive to wp media lib</a></li>
    </ul>
    
        <div id="tabs-1" style="background: whitesmoke;">
        <div>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIHTwYJKoZIhvcNAQcEoIIHQDCCBzwCAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYBwX0Qi96qTVyUMcJlpTS9y2dz8x4acVZUqAr+/LqbnZaXWZQEpO7wcrl5cSZlO3uQNV1M4sXn0W8pkBQxegHhh77MF8UbFyAUofRoDKPuhOqVW2BS7rZzR2cE0xob2qkRQijdsxIERBW7pEfyZzrErB6ZcVMA4//z4EC4I+GCdBTELMAkGBSsOAwIaBQAwgcwGCSqGSIb3DQEHATAUBggqhkiG9w0DBwQIeJn29sNILMKAgaiRhmM3YRnfhdbkrICYQnvhiqkEnfxUu8IUsgKgIr3VjJGyHxCcnezgyIQ/QvOe2E+VDCtkSQu/1p+Z+q/uql2UEQznXdz5cqO6PNBQsrJCZuAbTSXSdjmPOYzMH+hAqtfSm/Eu/QnI3ZA9reCRwNWxKHM0YuDws7NsxjfsawDltqnHx7OJ2M7ynVD0XWp2Eo/7DMNd6bJLelkOjcYhSkcsP3tPYZziKCigggOHMIIDgzCCAuygAwIBAgIBADANBgkqhkiG9w0BAQUFADCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wHhcNMDQwMjEzMTAxMzE1WhcNMzUwMjEzMTAxMzE1WjCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wgZ8wDQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBAMFHTt38RMxLXJyO2SmS+Ndl72T7oKJ4u4uw+6awntALWh03PewmIJuzbALScsTS4sZoS1fKciBGoh11gIfHzylvkdNe/hJl66/RGqrj5rFb08sAABNTzDTiqqNpJeBsYs/c2aiGozptX2RlnBktH+SUNpAajW724Nv2Wvhif6sFAgMBAAGjge4wgeswHQYDVR0OBBYEFJaffLvGbxe9WT9S1wob7BDWZJRrMIG7BgNVHSMEgbMwgbCAFJaffLvGbxe9WT9S1wob7BDWZJRroYGUpIGRMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbYIBADAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBBQUAA4GBAIFfOlaagFrl71+jq6OKidbWFSE+Q4FqROvdgIONth+8kSK//Y/4ihuE4Ymvzn5ceE3S/iBSQQMjyvb+s2TWbQYDwcp129OPIbD9epdr4tJOUNiSojw7BHwYRiPh58S1xGlFgHFXwrEBb3dgNbMUa+u4qectsMAXpVHnD9wIyfmHMYIBmjCCAZYCAQEwgZQwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tAgEAMAkGBSsOAwIaBQCgXTAYBgkqhkiG9w0BCQMxCwYJKoZIhvcNAQcBMBwGCSqGSIb3DQEJBTEPFw0xNDA4MjkwNDIzNTVaMCMGCSqGSIb3DQEJBDEWBBS/1rEpC+R9Swnyc7GEkOPYPJJdjTANBgkqhkiG9w0BAQEFAASBgLUfmoaUpcXbHmEY1Ouf094EwZtu5uaksFw0+HTbgfuh92EjCBSBNS1DIeNDww8xyoCekzLekdZN1FXZ4wWOmeH8bnFrlIEsFHOVF7A//8XFPPqNQ6rfEL6ZTlCRYsdLEsN9jj6fc1ngLv2WQb6lttWINBWMPOTQT9N/zc+N1uov-----END PKCS7-----QwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tAgEAMAkGBSsOAwIaBQCgXTAYBgkqhkiG9w0BCQMxCwYJKoZIhvcNAQcBMBwGCSqGSIb3DQEJBTEPFw0xNDA4MjkwNDIzNTVaMCMGCSqGSIb3DQEJBDEWBBS/1rEpC+R9Swnyc7GEkOPYPJJdjTANBgkqhkiG9w0BAQEFAASBgLUfmoaUpcXbHmEY1Ouf094EwZtu5uaksFw0+HTbgfuh92EjCBSBNS1DIeNDww8xyoCekzLekdZN1FXZ4wWOmeH8bnFrlIEsFHOVF7A//8XFPPqNQ6rfEL6ZTlCRYsdLEsN9jj6fc1ngLv2WQb6lttWINBWMPOTQT9N/zc+N1uov-----END PKCS7-----
                ">
                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
            <i>*Please donate to support development of this plugin.</i>
        </div>
        <h4>Google Picker to map gdrive to wp Media Library</h4>
        Contributor         : elf deng<br>
        Requires at least    : Wordpress 3.5<br>
        Tested up to         : Wordpress 4.0<br>
        Version              : 1.0<br>
        License              : GPLv2 or later<br>
        License URI          : http://www.gnu.org/licenses/gpl-2.0.html<br>
        <p>Description:<br>
        Mapping file from Google Drive into Wordpress Media. 
        </p>

        <p>Features:<br>
        - Mapping files from Google Drive into WordPress Media Library.<br>
        - Attach Google Drive files to Wordpress posts.<br>
        - Support Google Drive CDN.<br>
        </p>

        <p>Required:<br>
        - PHP 5.3.0</p>
        
        <p>How it works: to be done yet ...
        <br />1. xxxx 
        <br />2. xxxx
        <br />3. Set up Google Drive folder in Wordpress Admin >> Media >> Google Drive Media Library >> Mapping Folder.
        <br />4. Add file name in Wordpress Admin >> Media >> Google Drive Media Library >> Mapping File.
        <br />5. Go to menu Google Drive folder in Wordpress Admin >> Media >> Library. Now you can see your Google Drive file in preview.
        </p>
    </div> <!-- end of tab 1 -->

    <div id="tabs-2">
        <button id="show_gpicker"  type="button">show files dialog</button>
      
        <dialog id="gpickerDialog">  
          <script src="<?php echo  plugin_dir_url(__FILE__) ?>/js/my_gpicker.js?<?php echo time(); ?>"></script>
           <script src="https://apis.google.com/js/api.js"></script>
           
                 <h3>Sample Dialog!</h3>  
                 <div id="result"></div>
                   <!-- ajax post action -->
                   <form id="frmMappingFile" name="frmMappingFile" method="post">
          <?php $mappingFileNonce = wp_create_nonce( "mapping-file-nonce" ); ?>
          <input type="hidden" name="mapping-file-nonce" id="mapping-file-nonce" value="<?php echo $mappingFileNonce ?>">
          <input type="text" id="fileUrls" name="fileUrls" value="" />
          <button id="btnSaveMappingFile">SaveMappingFiles</button>
                   </form>
                   
                 <button id="exit_gpicker">Close Dialog</button>   
           </dialog>  
         
 <script>
    //wp_enqueue_script('my_gpicker',  plugin_dir_url(__FILE__)."js/my_gpicker.js");
    //wp_enqueue_script('my_gapi', "https://apis.google.com/js/api.js"); 
    //?onload=onApiLoad");
    //?onload=onGapiLoad
 
     (function() {  
    var dialog = document.getElementById('gpickerDialog');  
    document.getElementById('show_gpicker').onclick = function() {  
        onGapiLoad();
        dialog.show();  
    };  
    document.getElementById('exit_gpicker').onclick = function() {  
        dialog.close();  
    };  
})(); 
 </script>
    </div> <!-- end of tab 2 -->

    <div id="tabs-3">
        <form id="frmMappingFolder" name="frmMappingFolder">
        <table>
            <tr>
                <td>Google Drive Folder</td>
                <td>:</td>
                <td>
                    <input type="text" id="mappingFolder" name="mappingFolder" value="<?php echo $mappingFolder ?>"
                        title="eg: 0CoQaLQyW8F1cT1Y3OXZxxxxxXxS" size="40">
                </td>
                <td><p style="font-size: 12px; color: blue;">&nbsp;&nbsp;
                    <a href="#" id="hrefFolderDocumentation">What's this?</a></p></td>
            </tr>
        </table>

        <?php $mappingFolderNonce = wp_create_nonce( "mapping-folder-nonce" );?>
        <input type="hidden" name="mapping-folder-nonce" id="mapping-folder-nonce" value="<?php echo $mappingFolderNonce ?>" >
        <p style="margin-left:140px;">
            <button id="btnSaveMappingFolder"><?php _e('Save') ?>
                <img src="<?php echo $currentPath ?>images/preloader-flat.gif" id="imgFolderButton" style="display: none;">
            </button>
        </p>
        </form>

        <div id="folderDocumentation" style="display: none; background: whitesmoke; padding: 10px;">
            <h4>To find Google Drive folder:</h4>
            <ol>
                <li>Locate and select the <strong>folder </strong>you wish to share.</li>
                <li>Click <strong>Share >> Share</strong> from menu.
                    <div class="leftImage" style="margin-top: 0pt;">
                    <img width="600px" height="auto" src="<?php echo $currentPath ?>/images/documentation/folder-share.png" alt="Screenshot of Google Drive">
                    </div>
                </li>
                <br>
                <li><strong>Sharing settings</strong> dialog box will appear. Select and copy Google Drive folder like in red highlight.
                    <br>Please make sure you set up folder access as <strong>Public on the web</strong>.
                    <div class="leftImage" style="margin-top: 0pt;">
                        <img width="600px" height="auto" src="<?php echo $currentPath ?>/images/documentation/folder-id.png" alt="Screenshot of Google Drive">
                    </div>
                </li>
            </ol>
        </div>

    </div> <!-- end of tab 3 -->

</div> <!-- end of tabs -->