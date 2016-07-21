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
    $cache_tag = 'nq_superfish';
if ( isset( $_POST['savesettings'] ) ) {

    $jquery_obj->prefs['jquery_superfishactive'] = (int)$_POST['jquery_superfishactive'];
    $jquery_obj->prefs['jquery_superfishskin'] = $_POST['jquery_superfishskin'];
    $jquery_obj->save_prefs();
	$e107cache->clear( $cache_tag );

    $jquery_msg_type .= 'success' ;
    $jquery_msg_text .= "<li>" . JQUERY_SFISH_05 . "</li>" ;
}
$skinlist = glob( "styles/superfish_*.css" );

$jquery_text = "
<form id='dataform' method='post' action='" . e_SELF . "'>
	<table class='fborder' style='" . ADMIN_WIDTH . "' >";
$jquery_text .= "
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>" . JQUERY_SFISH_02 . "</td>
		</tr>";
$jquery_text .= "
		<tr>
			<td class='forumheader3' colspan='2' style='text-align:left'>" . $jquery_obj->message_box( $jquery_msg_type, $jquery_msg_text ) . "</td>
		</tr>";
$jquery_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_SFISH_03 . "</td><td class='forumheader3'>
				<input type='checkbox' name='jquery_superfishactive' class='tbox' value='1' " . ( $jquery_obj->prefs['jquery_superfishactive'] == 1?'checked="checked"':'' ) . "' />
			</td>
		</tr>";
$jquery_text .= "
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>" . JQUERY_SFISH_07 . "</td>
		</tr>";
$search = array( 'superfish_', '.css' );
$replace = array( '', '' );
foreach ( $skinlist as $value ) {
    $filename = basename( $value );
    $name = str_ireplace( $search, $replace, $filename );
    $jquery_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . $name . "</td><td class='forumheader3'>
				<input type='radio' name='jquery_superfishskin' class='tbox' " . ( $jquery_obj->prefs['jquery_superfishskin'] == $name?"checked='checked'":'' ) . "value='{$name}'  />
			</td>
		</tr>";
}
$jquery_text .= "
		<tr>
			<td class='forumheader2' colspan='2' style='text-align:left;vertical-align:top;'>
				<input class='button' name='savesettings' type='submit' value='" . JQUERY_SFISH_04 . "' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left;vertical-align:top;'>&nbsp;</td>
		</tr>";
$jquery_text .= "
	</table>
</form>";
$ns->tablerender( JQUERY_SFISH_01, $jquery_text , 'adminsupfish' );
require_once( e_ADMIN . "footer.php" );