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
    $jquery_obj->prefs['jquery_newsactive'] = intval( $_POST['jquery_newsactive'] );
    $jquery_obj->prefs['jquery_newsrandom'] = intval( $_POST['jquery_newsrandom'] );
    $jquery_obj->prefs['jquery_newsnumnews'] = intval( $_POST['jquery_newsnumnews'] );
    $jquery_obj->prefs['jquery_newsfeed'] = intval( $_POST['jquery_newsfeed'] );
    $jquery_obj->prefs['jquery_newsnumfeed'] = intval( $_POST['jquery_newsnumfeed'] );
    $jquery_obj->prefs['jquery_static_content'] = $tp->toDB( $_POST['jquery_static_content'] );
    $jquery_obj->prefs['jquery_title'] = $tp->toDB( $_POST['jquery_title'] );

    $jquery_obj->prefs['jquery_newscontent'] = intval( $_POST['jquery_newscontent'] );
    $jquery_obj->prefs['jquery_speed'] =  $_POST['jquery_speed'] ;
    $jquery_obj->prefs['jquery_showcontrols'] = intval( $_POST['jquery_showcontrols'] );
    $jquery_obj->prefs['jquery_reveal'] = intval( $_POST['jquery_reveal'] );
    $jquery_obj->prefs['jquery_direction'] = intval( $_POST['jquery_direction'] );
    $jquery_obj->prefs['jquery_outspeed'] = intval( $_POST['jquery_outspeed'] );
    $jquery_obj->prefs['jquery_inspeed'] = intval( $_POST['jquery_inspeed'] );
    $jquery_obj->prefs['jquery_pause'] = intval( $_POST['jquery_pause'] );

    $jquery_obj->save_prefs();
    $jquery_msg_type .= 'success' ;
    $jquery_msg_text .= "<li>".JQUERY_NEWS_03 ."</li>";
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
			<td class='fcaption' colspan='2' style='text-align:left'>" . JQUERY_NEWS_04 . "</td>
		</tr>";
$jquery_text .= "
		<tr>
			<td class='forumheader3' colspan='2' style='text-align:left'>" . $jquery_obj->message_box( $jquery_msg_type, $jquery_msg_text ) . "</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_NEWS_05 . "</td><td class='forumheader3'>
				<input type='checkbox' name='jquery_newsactive' class='tbox' value='1' " . ( $jquery_obj->prefs['jquery_newsactive'] == 1?'checked="checked"':'' ) . " />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_NEWS_18 . "</td><td class='forumheader3'>
				<input type='checkbox' name='jquery_newsrandom' class='tbox' value='1' " . ( $jquery_obj->prefs['jquery_newsrandom'] == 1?'checked="checked"':'' ) . " />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_NEWS_13 . "</td>
			<td class='forumheader3'>
				<input type='radio' name='jquery_newscontent' id='jquery_newscontent0' class='tbox' value='0' " . ( $jquery_obj->prefs['jquery_newscontent'] == 0?'checked="checked"':'' ) . " style='border:0px;' /><label for='jquery_newscontent0' > " . JQUERY_NEWS_10 . "</label> <input type='text' class='tbox' style='width:40px;' name='jquery_newsnumnews' value='" . $jquery_obj->prefs['jquery_newsnumnews'] . "' /> " . JQUERY_NEWS_17 . "<br />
				<input type='radio' name='jquery_newscontent' id='jquery_newscontent1' class='tbox' value='1' " . ( $jquery_obj->prefs['jquery_newscontent'] == 1?'checked="checked"':'' ) . " style='border:0px;' /><label for='jquery_newscontent1' > " . JQUERY_NEWS_11 . "</label> {$jquery_newsfeedlist} <input type='text' style='width:40px;' class='tbox' name='jquery_newsnumfeed' value='" . $jquery_obj->prefs['jquery_newsnumfeed'] . "' /> " . JQUERY_NEWS_17 . "<br />
				<input type='radio' name='jquery_newscontent' id='jquery_newscontent2' class='tbox' value='2' " . ( $jquery_obj->prefs['jquery_newscontent'] == 2?'checked="checked"':'' ) . " style='border:0px;' /><label for='jquery_newscontent2' > " . JQUERY_NEWS_12 . "</label> <textarea class='tbox' rows='6' cols='50' style='width:95%' name='jquery_static_content' >" . $jquery_obj->prefs['jquery_static_content'] . "</textarea>
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_NEWS_30 . "</td><td class='forumheader3'>
				<input type='text' style='width:140px;' name='jquery_title' class='tbox' value='" . $jquery_obj->prefs['jquery_title'] . "' />
			</td>
		</tr>

		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_NEWS_07 . "</td>
			<td class='forumheader3'>
				<input type='radio' name='jquery_showcontrols' id='jquery_showcontrols0' class='tbox' value='0' " . ( $jquery_obj->prefs['jquery_showcontrols'] == 0?'checked="checked"':'' ) . " style='border:0px;' /><label for='jquery_showcontrols0' > " . JQUERY_NEWS_08 . "</label><br />
				<input type='radio' name='jquery_showcontrols' id='jquery_showcontrols1' class='tbox' value='1' " . ( $jquery_obj->prefs['jquery_showcontrols'] == 1?'checked="checked"':'' ) . " style='border:0px;' /><label for='jquery_showcontrols1' > " . JQUERY_NEWS_09 . "</label>
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_NEWS_23 . "</td>
			<td class='forumheader3'>
				<input type='radio' name='jquery_direction' id='jquery_direction0' class='tbox' value='0' " . ( $jquery_obj->prefs['jquery_direction'] == 0?'checked="checked"':'' ) . " style='border:0px;' /><label for='jquery_direction0' > " . JQUERY_NEWS_24 . "</label><br />
				<input type='radio' name='jquery_direction' id='jquery_direction1' class='tbox' value='1' " . ( $jquery_obj->prefs['jquery_direction'] == 1?'checked="checked"':'' ) . " style='border:0px;' /><label for='jquery_direction1' > " . JQUERY_NEWS_25 . "</label>
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_NEWS_20 . "</td>
			<td class='forumheader3'>
				<input type='radio' name='jquery_reveal' id='jquery_reveal0' class='tbox' value='0' " . ( $jquery_obj->prefs['jquery_reveal'] == 0?'checked="checked"':'' ) . " style='border:0px;' /><label for='jquery_reveal0' > " . JQUERY_NEWS_21 . "</label><br />
				<input type='radio' name='jquery_reveal' id='jquery_reveal1' class='tbox' value='1' " . ( $jquery_obj->prefs['jquery_reveal'] == 1?'checked="checked"':'' ) . " style='border:0px;' /><label for='jquery_reveal1' > " . JQUERY_NEWS_22 . "</label>
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_NEWS_06 . "</td><td class='forumheader3'>
				<input type='text' style='width:40px;' name='jquery_speed' class='tbox' value='" . $jquery_obj->prefs['jquery_speed'] . "' /> " . JQUERY_NEWS_15 . "
			</td>
		</tr>

		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_NEWS_26 . "</td><td class='forumheader3'>
				<input type='text' style='width:40px;' name='jquery_outspeed' class='tbox' value='" . $jquery_obj->prefs['jquery_outspeed'] . "' /> " . JQUERY_NEWS_28 . "
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_NEWS_27 . "</td><td class='forumheader3'>
				<input type='text' style='width:40px;' name='jquery_inspeed' class='tbox' value='" . $jquery_obj->prefs['jquery_inspeed'] . "' /> " . JQUERY_NEWS_28 . "
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_NEWS_29 . "</td><td class='forumheader3'>
				<input type='text' style='width:40px;' name='jquery_pause' class='tbox' value='" . $jquery_obj->prefs['jquery_pause'] . "' /> " . JQUERY_NEWS_28 . "
			</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2' style='text-align:left;vertical-align:top;'>
				<input class='button' name='savesettings' type='submit' value='" . JQUERY_NEWS_02 . "' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left;vertical-align:top;'>&nbsp;</td>
		</tr>";
$jquery_text .= "
	</table>
</form>";
$ns->tablerender( JQUERY_NEWS_01, $jquery_text );
require_once( e_ADMIN . "footer.php" );