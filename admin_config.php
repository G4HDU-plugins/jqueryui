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
require_once("../../class2.php");

if (!defined('e107_INIT')) {
    exit;
}
if (!getperms("P")) {
    header("location:" . e_BASE . "index.php");
    exit;
}
include_lan(e_PLUGIN . "jquery/languages/" . e_LANGUAGE . "_jquery.php");

if (!is_object($jquery_obj)) {
    require_once(e_PLUGIN . "jquery/includes/jquery_class.php");
    $jquery_obj = new jquery;
}
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH")) {
    define(ADMIN_WIDTH, "width:100%;");
}

if (isset($_POST['savesettings'])) {
    $jquery_obj->prefs['jquery_active'] = (int)$_POST['jquery_active'];
    $jquery_obj->prefs['jquery_uiactive'] = (int)$_POST['jquery_uiactive'];
    $jquery_obj->prefs['jquery_autosize'] = (int)$_POST['jquery_autosize'];
    $jquery_obj->prefs['jquery_supertext'] = (int)$_POST['jquery_supertext'];
    $jquery_obj->prefs['jquery_qtip'] = (int)$_POST['jquery_qtip'];
    $jquery_obj->prefs['jquery_cookies'] = (int)$_POST['jquery_cookies'];
    $jquery_obj->prefs['jquery_colorpicker'] = (int)$_POST['jquery_colorpicker'];
    $jquery_obj->prefs['jquery_easyconfirm'] = (int)$_POST['jquery_easyconfirm'];
    $jquery_obj->prefs['jquery_fredsel'] = (int)$_POST['jquery_fredsel'];
    $jquery_obj->save_prefs();
    $jquery_msg_type .= 'success' ;
    $jquery_msg_text .= "<li>".JQUERY_C05 ."</li>";
}
$jquery_text = "
<form id='dataform' method='post' action='" . e_SELF . "'>
	<table class='fborder' style='" . ADMIN_WIDTH . "' >";
$jquery_text .= "
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>" . JQUERY_C02 . "</td>
		</tr>";
$jquery_text .= "
		<tr>
			<td class='forumheader3' colspan='2' style='text-align:left'>" . $jquery_obj->message_box($jquery_msg_type, $jquery_msg_text) . "</td>
		</tr>";

$jquery_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_C03 . "</td><td class='forumheader3'>
				<input type='checkbox' name='jquery_active' class='tbox' value='1' " . ($jquery_obj->prefs['jquery_active'] == 1?'checked="checked"':'') . " />
			</td>
		</tr>";
$jquery_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_UI03 . "</td><td class='forumheader3'>
				<input type='checkbox' name='jquery_uiactive' class='tbox' value='1' " . ($jquery_obj->prefs['jquery_uiactive'] == 1?'checked="checked"':'') . " />
			</td>
		</tr>";
$jquery_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_C20 . "</td><td class='forumheader3'>
				<input type='checkbox' name='jquery_autosize' class='tbox' value='1' " . ($jquery_obj->prefs['jquery_autosize'] == 1?'checked="checked"':'') . " />
			</td>
		</tr>";
$jquery_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_C07 . "</td><td class='forumheader3'>
				<input type='checkbox' name='jquery_supertext' class='tbox' value='1' " . ($jquery_obj->prefs['jquery_supertext'] == 1?'checked="checked"':'') . " />
			</td>
		</tr>";
$jquery_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_C10 . "</td><td class='forumheader3'>
				<input type='checkbox' name='jquery_qtip' class='tbox' value='1' " . ($jquery_obj->prefs['jquery_qtip'] == 1?'checked="checked"':'') . " />
			</td>
		</tr>";
$jquery_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_C09 . "</td><td class='forumheader3'>
				<input type='checkbox' name='jquery_cookies' class='tbox' value='1' " . ($jquery_obj->prefs['jquery_cookies'] == 1?'checked="checked"':'') . " />
			</td>
		</tr>";
$jquery_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_C06 . "</td><td class='forumheader3'>
				<input type='checkbox' name='jquery_colorpicker' class='tbox' value='1' " . ($jquery_obj->prefs['jquery_colorpicker'] == 1?'checked="checked"':'') . " />
			</td>
		</tr>";
$jquery_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_C08 . "</td><td class='forumheader3'>
				<input type='checkbox' name='jquery_easyconfirm' class='tbox' value='1' " . ($jquery_obj->prefs['jquery_easyconfirm'] == 1?'checked="checked"':'') . " />
			</td>
		</tr>";
$jquery_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JQUERY_C11 . "</td><td class='forumheader3'>
				<input type='checkbox' name='jquery_fredsel' class='tbox' value='1' " . ($jquery_obj->prefs['jquery_fredsel'] == 1?'checked="checked"':'') . " />
			</td>
		</tr>";
$jquery_text .= "
		<tr>
			<td class='forumheader2' colspan='2' style='text-align:left;vertical-align:top;'>
				<input class='button' name='savesettings' type='submit' value='" . JQUERY_C04 . "' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left;vertical-align:top;'>&nbsp;</td>
		</tr>";
$jquery_text .= "
	</table>
</form>";
$ns->tablerender(JQUERY_C01, $jquery_text);
require_once(e_ADMIN . "footer.php");