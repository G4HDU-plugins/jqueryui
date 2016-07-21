<?php
if ( !is_object( $jquery_obj ) ) {
    require_once( e_PLUGIN . "jquery/includes/jquery_class.php" );
    $jquery_obj = new jquery;
}
$footer_js[] = e_PLUGIN . "jquery/includes/fb_tools.js";
if ( $jquery_obj->jquery_active ) {
    $eplug_css[] = e_PLUGIN . "jquery/styles/jquery.css";
}
if ( $jquery_obj->jquery_qtip ) {
    $eplug_css[] = e_PLUGIN . "jquery/styles/jquery.qtip.min.css";
    $footer_js[] = e_PLUGIN . "jquery/includes/jquery.qtip.min.js";
}
if ( $jquery_obj->jquery_cookies ) {
    $footer_js[] = e_PLUGIN . "jquery/includes/jquery.cookies.min.js";
}
if ( $jquery_obj->jquery_autosize ) {
    $footer_js[] = e_PLUGIN . "jquery/includes/jquery.autosize-min.js";
}
if ( $jquery_obj->jquery_supertext ) {
    $footer_js[] = e_PLUGIN . "jquery/includes/jquery.supertextarea.min.js";
}
if ( $jquery_obj->jquery_easyconfirm ) {
    $footer_js[] = e_PLUGIN . "jquery/includes/jquery.easyconfirm.js";
}
if ( $jquery_obj->jquery_uiactive ) {
    #$footer_js[] = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.20/jquery-ui.min.js";
    $eplug_css[] = e_PLUGIN . "jquery/styles/uibase/jquery.ui.base.css";
    if ( $jquery_obj->jquery_uiusetheme ) {
        $uiurl = $themedir = e_THEME . $pref['sitetheme'] . "/jqueryui";
    } else {
        $uiurl = e_PLUGIN . "jquery/styles/ui/" . $jquery_obj->prefs['jquery_uitheme'];
    }
    $files = glob( $uiurl . "/*.css" );
    $cssname = basename( $files[0] );
    $eplug_css[] = "{$uiurl}/{$cssname}";
}
if ( $jquery_obj->jquery_s3slider_active ) {
    $eplug_css[] = e_PLUGIN . "jquery/styles/s3slider.css";
    $footer_js[] = e_PLUGIN . "jquery/includes/jquery.s3Slider.js";
}

if ( $jquery_obj->jquery_newsactive ) {
    // if the news ticker is active
    $eplug_css[] = e_PLUGIN . "jquery/styles/ticker-style.css";
    $footer_js[] = e_PLUGIN . 'jquery/includes/jquery.ticker-min.js';
}
if ( $jquery_obj->jquery_cbox_active ) {
    // if the color box lightbox is active
    $footer_js[] = e_PLUGIN . "jquery/includes/jquery.colorbox-min.js";
    switch ( $jquery_obj->prefs['jquery_cbox_style'] ) {
        case 2:
            $eplug_css[] = e_PLUGIN . "jquery/styles/colorbox_2.css";
            break;
        case 3:
            $eplug_css[] = e_PLUGIN . "jquery/styles/colorbox_3.css";
            break;
        case 4:
            $eplug_css[] = e_PLUGIN . "jquery/styles/colorbox_4.css";
            break;
        case 5:
            $eplug_css[] = e_PLUGIN . "jquery/styles/colorbox_5.css";
            break;
        case 1:
        default :
            $eplug_css[] = e_PLUGIN . "jquery/styles/colorbox_1.css";
            break;
    }
}
if ( $jquery_obj->jquery_superfishactive ) {
    $footer_js[] = e_PLUGIN . "jquery/includes/jquery.superfish.min.js";
    $footer_js[] = e_PLUGIN . "jquery/includes/jquery.supersubs.min.js";
    $footer_js[] = e_PLUGIN . "jquery/includes/jquery.hoverIntent.min.js";
    $eplug_css[] = e_PLUGIN . "jquery/styles/superfish-base.css";
    $eplug_css[] = e_PLUGIN . "jquery/styles/superfish_" . $jquery_obj->prefs['jquery_superfishskin'] . ".css";
    $eplug_css[] = e_PLUGIN . "jquery/styles/superfish-navbar.css";
}
if ( $jquery_obj->jquery_fredsel ) {
	$footer_js[] = e_PLUGIN . "jquery/includes/jquery.caroufredsel.min.js";
}
if ( $jquery_obj->jquery_colorpicker ) {
    $footer_js[] = e_PLUGIN . "jquery/includes/jquery.colorpicker.js";
    $eplug_css[] = e_PLUGIN . "jquery/styles/colorpicker.css";
}
$footer_js[] = e_PLUGIN . "jquery/includes/crdeutsch-multiselect/js/ui.multiselect.js";
$eplug_css[] = e_PLUGIN . "jquery/includes/crdeutsch-multiselect/css/ui.multiselect.css";
#$eplug_css[] = e_PLUGIN . "jquery/includes/crdeutsch-multiselect/css/common.css";