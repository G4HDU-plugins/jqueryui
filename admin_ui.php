<?php
/*
   +---------------------------------------------------------------+
   |	JQuery Plugin for e107
   |
   |	Copyright (C) Fathr Barry Keal 2003 - 2010
   |	http://www.keal.me.uk
   |
   |	Released under the terms and conditions of the
   |	GNU General Public License (http://gnu.org).
   +---------------------------------------------------------------+
*/
require_once( "../../class2.php" );

if ( !defined( 'e107_INIT' ) ) {
    exit;
}
if ( !getperms( "P" ) ) {
    header( "location:" . e_BASE . "index.php" );
    exit;
}
include_lan( e_PLUGIN . "jquery/languages/" . e_LANGUAGE . "_jquery.php" );

if ( !is_object( $jquery_obj ) ) {
    require_once( e_PLUGIN . "jquery/includes/jquery_class.php" );
    $jquery_obj = new jquery;
}
require_once( e_ADMIN . "auth.php" );
if ( !defined( "ADMIN_WIDTH" ) ) {
    define( ADMIN_WIDTH, "width:100%;" );
}

if ( isset( $_POST['savesettings'] ) ) {
    $jquery_obj->prefs['jquery_uiusetheme'] = (int)$_POST['jquery_uiusetheme'];
    $jquery_obj->prefs['jquery_uitheme'] = $_POST['jquery_uitheme'];
    $jquery_obj->save_prefs();
    $jquery_msg_type .= 'success' ;
    $jquery_msg_text .= "<li>".JQUERY_UI06 ."</li>";
}
// get any info in the current theme
// look for directory jqueryui
$jquery_text = "
<form id='dataform' method='post' action='" . e_SELF . "'>
	<table class='fborder' style='" . ADMIN_WIDTH . "' >";
$jquery_text .= "
		<tr>
			<td class='fcaption' colspan='3' style='text-align:left'>" . JQUERY_UI02 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='3' style='text-align:left'>" . $jquery_obj->message_box( $jquery_msg_type, $jquery_msg_text ) . "</td>
		</tr>		";
$themedir = e_THEME . $pref['sitetheme'] . "/jqueryui";
if ( is_dir( $themedir ) ) {
    $files = glob( $themedir . '/*.png' );
    $filename = basename( $files[0] );
    $jquery_text .= "
		<tr>
			<td class='forumheader3' colspan='3' style='text-align:left'>" . JQUERY_UI07 . "</td>
		</tr>

		<tr>
			<td class='forumheader3' style='width:20%;'>" . JQUERY_UI05 . "</td>
			<td class='forumheader3' style='width:10%;'>
				<input type='checkbox' name='jquery_uiusetheme' class='tbox' value='1' " . ( $jquery_obj->prefs['jquery_uiusetheme'] == '1'?'checked="checked"':'' ) . " />
			</td>
			<td class='forumheader3' style='width:30%;'>
				<img src='" . $files[0] . "' style='width:90px;height:80px;border:0px;' alt='' />
			</td>
		</tr>";
}
$jquery_text.="
		<tr>
			<td class='forumheader3' colspan='3' style='text-align:left'>" . JQUERY_UI08 . "</td>
		</tr>";


$uidir = 'styles/ui';
$files = glob( $uidir . '/*' );
$i=0;
foreach($files as $dir) {
$tmp=str_replace("\\","/",$dir);
	$dirname=strrchr($tmp,'/');
	// strip leading /
	$dirname=substr($dirname,1);

    $jquery_text .= "
		<tr>
			<td class='forumheader3' style='width:20%;'>" . $dirname . "</td>
			<td class='forumheader3' style='width:10%;'>
				<input type='radio' name='jquery_uitheme' id='jquery_uitheme_{$i}' class='tbox' value='{$dirname}' " . ( $jquery_obj->prefs['jquery_uitheme'] == $dirname?'checked="checked"':'' ) . " />
			</td>
			<td class='forumheader3' style='width:30%;'>
				<label for='jquery_uitheme_{$i}'>
				<img src='" . $dir . "/ui.png' style='width:90px;height:80px;border:0px;' alt='' />
				</label>
			</td>
		</tr>";
	$i++;
}

$jquery_text .= "

		<tr>
			<td class='forumheader2' colspan='3' style='text-align:left;vertical-align:top;'>
				<input class='button' name='savesettings' type='submit' value='" . JQUERY_UI04 . "' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='3' style='text-align:left;vertical-align:top;'>&nbsp;</td>
		</tr>";
$jquery_text .= "
	</table>
</form>";
$ns->tablerender( JQUERY_UI01, $jquery_text );
require_once( e_ADMIN . "footer.php" );