<?php
/*
   +---------------------------------------------------------------+
   |	JQuery Plugin for e107
   |
   |	Copyright (C) Fathr Barry Keal 2003 - 2010
   |	http://www.keal.me.uk
   |
   |	http://jacklmoore.com/notes/colorbox-for-beginners/
   |	http://jacklmoore.com/colorbox/
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
    $jquery_obj->prefs['jquery_s3slider_active'] = intval( $_POST['jquery_s3slider_active'] );
    $jquery_obj->prefs['jquery_s3slider_style'] = intval( $_POST['jquery_s3slider_style'] );

    $jquery_obj->save_prefs();
    $jquery_msg_type .= 'success' ;
    $jquery_msg_text .= "<li>" . JQUERY_S3_03 . "</li>" ;
}
// get list of news feeds
$sql->db_Select( 'newsfeed', 'newsfeed_id,newsfeed_name', 'order by newsfeed_name', 'nowhere', false );
$jquery_newsfeedlist = '<select class="tbox" name="jquery_newsfeed">';
while ( $row = $sql->db_Fetch() ) {
    $jquery_newsfeedlist .= "<option value='{$row['newsfeed_id']}' " . ( $row['newsfeed_id'] == $jquery_obj->prefs['jquery_newsfeed']?'selected="selected"':'' ) . ">" . $tp->toFORM( $row['newsfeed_name'] ) . '</option>';
}
$jquery_newsfeedlist .= '</select>';
$jquery_text = "
<form id='dataform' method='post' action='" . e_SELF . "'>
	<table class='fborder' style='" . ADMIN_WIDTH . "' >";
$jquery_text .= "
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>" . JQUERY_S3_04 . "</td>
		</tr>";
$jquery_text .= "
		<tr>
			<td class='forumheader3' colspan='2' style='text-align:left'>" . $jquery_obj->message_box( $jquery_msg_type, $jquery_msg_text ) . "</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_S3_05 . "</td><td class='forumheader3'>
				<input type='checkbox' name='jquery_s3slider_active' class='tbox' value='1' " . ( $jquery_obj->prefs['jquery_s3slider_active'] == 1?'checked="checked"':'' ) . " />
			</td>
		</tr>
		<!--
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_S3_02 . "</td><td class='forumheader3'>
				<select class='tbox' name='jquery_s3slider_style' id='jquery_s3slider_style' >
					<option value='1' " . ( $jquery_obj->prefs['jquery_s3slider_style'] == 1?"selected='selected'":"" ) . ">" . JQUERY_S3_03 . " 1</option>
					<option value='2' " . ( $jquery_obj->prefs['jquery_s3slider_style'] == 2?"selected='selected'":"" ) . ">" . JQUERY_S3_03 . " 2</option>
					<option value='3' " . ( $jquery_obj->prefs['jquery_s3slider_style'] == 3?"selected='selected'":"" ) . ">" . JQUERY_S3_03 . " 3</option>
					<option value='4' " . ( $jquery_obj->prefs['jquery_s3slider_style'] == 4?"selected='selected'":"" ) . ">" . JQUERY_S3_03 . " 4</option>
					<option value='5' " . ( $jquery_obj->prefs['jquery_s3slider_style'] == 5?"selected='selected'":"" ) . ">" . JQUERY_S3_03 . " 5</option>
				</select>
			</td>
		</tr>
		-->
		<tr>
			<td class='forumheader2' colspan='2' style='text-align:left;vertical-align:top;'>
				<input class='button' name='savesettings' type='submit' value='" . JQUERY_S3_02 . "' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left;vertical-align:top;'>&nbsp;</td>
		</tr>";
$jquery_text .= "
	</table>
</form>";
$ns->tablerender( JQUERY_S3_01, $jquery_text );
require_once( e_ADMIN . "footer.php" );