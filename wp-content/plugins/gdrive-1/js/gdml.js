jQuery(document).ready(function($)
{
    /*
     * Define jquery tab function
     * Created on 26 August 2014
     * Updated on 26 August 2014
     * */

    $('#tabs').tabs();

    //hover states on the static widgets
    $('#dialog_link, ul#icons li').hover(
        function() {$(this).addClass('ui-state-hover');},
        function() {$(this).removeClass('ui-state-hover');}
    );


    /*
     * Define jquery button function
     * Created on 26 August 2014
     * Updated on 5 September 2014
     * */
    $('#btnSaveMappingFile, #btnSaveMappingFolder').button();

    var ajaxData;
    function setPostData(urls){
        var data = {
            action: 'gdml_action',
             mappingFileNonce: $("#mapping-file-nonce").val(),
             fileUrls: urls
        };
        ajaxData= data; //JSON.stringify(data);
    }
    
    $('#btnSaveMappingFile').click(btnClick_saveMappingFile);
    
    function btnClick_saveMappingFile()
    {
        // Show loading animation image
        $('#btnSaveMappingFile').button('disable');
        //$('#imgLoadingButton').fadeIn();
        $('#info').fadeOut();

        console.log("btnSaveMappingFile clicked");
        console.log(ajaxurl);
       

        //xxx var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        $.post(ajaxurl, ajaxData, function(msg)
        {
            // Hide loading animation image
            $('#btnSaveMappingFile').button('enable');
            //$('#imgLoadingButton').fadeOut();
            $('#info').html(msg);
            $('#info').fadeIn();
            console.log(msg);
        }).fail(function() {
    alert( "error , btnSaveMappingFile" );
  })
  .always(function() {
    alert( "finished" );
});
        return false;
        
    } 
    
//================
    $('#btnSaveMappingFolder').click(function()
    {
        // Show loading animation image
        $('#btnSaveMappingFolder').button('disable');
        $('#imgFolderButton').fadeIn();
        $('#info').fadeOut();

        // Declare data
        var data = {
            action: 'gdml_action',
            mappingFolder: $("#mappingFolder").val(),
            mappingFolderNonce: $("#mapping-folder-nonce").val()
        };

        $.post(ajaxurl, data, function(msg)
        {
            // Hide loading animation image
            $('#btnSaveMappingFolder').button('enable');
            $('#imgFolderButton').fadeOut();
            $('#info').html(msg);
            $('#info').fadeIn();
        });    
        return false;

    }); // end of button


    /*
     * Define jquery tooltips function
     * Created on 26 August 2014
     * Updated on 26 August 2014
     * */
    var tooltips = $( "[title]" ).tooltip({
        position: {
            my: "left top",
            at: "right+5 top-5"
        }
    }); // end of tooltips

    /*
     * Show documentation about Google Drive folder
     * Created on 28 August 2014
     * Updated on 28 August 2014
     * */
     
    $('#hrefFolderDocumentation').on('click',function(e) 
    {
        $("#folderDocumentation").slideToggle().siblings('div').slideUp();
    });

}); // end of jQuery