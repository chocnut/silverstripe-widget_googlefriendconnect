<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GoogleFriendConnectWidget
 *
 * @author peter
 */
class GoogleFriendConnectWidget extends Widget {

    static $db = array(
        'SiteID' => 'Varchar(255)',
        'DivID' => 'Varchar(255)',
        'Width' => 'Int',
        'RowsOfFaces' => 'Int'
    );
    
    static $defaults = array(
        'Width' => 276,
        'RowsOfFaces' => 4
    );
    
    static $title = "Google Friend Connect Widget";
    
    static $cmsTitle = "Google Friend Connect Widget";
    
    static $description = "A widget that displays a Google Friend Connect";

    function GoogleFriendConnect() {
        
        //Includes googlefriendconnect javascript to the page
        Requirements::javascript("http://www.google.com/friendconnect/script/friendconnect.js");
        
        return <<<EOD
            <!-- Define the div tag where the gadget will be inserted. -->
            <div id="div-$this->DivID" style="width:$this->Width;border:1px solid #cccccc;"></div>
            <!-- Render the gadget into a div. -->
            <script type="text/javascript">
            var skin = {};
            skin['BORDER_COLOR'] = '#cccccc';
            skin['ENDCAP_BG_COLOR'] = '#e0ecff';
            skin['ENDCAP_TEXT_COLOR'] = '#333333';
            skin['ENDCAP_LINK_COLOR'] = '#0000cc';
            skin['ALTERNATE_BG_COLOR'] = '#ffffff';
            skin['CONTENT_BG_COLOR'] = '#ffffff';
            skin['CONTENT_LINK_COLOR'] = '#0000cc';
            skin['CONTENT_TEXT_COLOR'] = '#333333';
            skin['CONTENT_SECONDARY_LINK_COLOR'] = '#7777cc';
            skin['CONTENT_SECONDARY_TEXT_COLOR'] = '#666666';
            skin['CONTENT_HEADLINE_COLOR'] = '#333333';
            skin['NUMBER_ROWS'] = "$this->RowsOfFaces";
            google.friendconnect.container.setParentUrl('/' /* location of rpc_relay.html and canvas.html */);
            google.friendconnect.container.renderMembersGadget(
             { id: 'div-$this->DivID',
               site: "$this->SiteID" },
              skin);
            </script>
EOD;
    }

    function getCMSFields() {
        return new FieldSet(
                new TextField("SiteID", "Google Site ID"),
                new TextField("DivID","Generated GFC div id"),
                new TextField("Width"),
                new TextField("RowsOfFaces", 'Rows of Faces')
        );
    }

}
