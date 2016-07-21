<?php
/*
   +---------------------------------------------------------------+
   |	Job Search Plugin for e107
   |
   |	Copyright (C) Father Barry Keal 2003 - 2008
   |	http://www.keal.me.uk
   |
   |	Released under the terms and conditions of the
   |	GNU General Public License (http://gnu.org).
   +---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . "jquery/languages/" . e_LANGUAGE . "_jquery.php");
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "JQuery";
$eplug_version = "1.1";
$eplug_author = "Father Barry";

$eplug_url = "http://www.keal.me.uk/";
$eplug_email = "";
$eplug_description = JQUERY_A02;
$eplug_compatible = "e107v7";
$eplug_readme = "admin_readme.php"; // leave blank if no readme file
$eplug_compliant = true;
$eplug_status = true;
$eplug_latest = true;
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "jquery";
// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . "/images/jquery_32.png";
$eplug_icon_small = $eplug_folder . "/images/jquery_16.png";
$eplug_caption = JQUERY_A01;
// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = "";
// List of sql requests to create tables -----------------------------------------------------------------------------
#$eplug_sql = file_get_contents(e_PLUGIN . "{$eplug_folder}/jquery_sql.php");
#preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
#$eplug_table_names = $matches[1];
// create tables -----------------------------------------------------------------------------------------------
#$eplug_tables = explode(";", str_replace("CREATE TABLE ", "CREATE TABLE " . MPREFIX, $eplug_sql));
#for ($i = 0; $i < count($eplug_tables); $i++)
#{
	#$eplug_tables[$i] .= ";";
#}
#array_pop($eplug_tables); // Get rid of last (empty) entry

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = false;
#$eplug_link_name = JOBSCH_P04;
#$eplug_link_url = e_PLUGIN . "job_search/index.php";
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = JQUERY_A03;
// upgrading ...
$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";

$eplug_upgrade_done = JQUERY_A04;
if (!function_exists("jquery_uninstall"))
{
	function jquery_uninstall()
	{
		global $sql;
		$sql->db_Delete("core", " e107_name='jquery' ");
	}
}

?>