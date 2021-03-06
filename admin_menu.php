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
if (!defined('e107_INIT')) {
    exit;
}

include_lan(e_PLUGIN . "jquery/languages/" . e_LANGUAGE . "_jquery.php");
$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = JQUERY_M02;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_ui']['text'] = JQUERY_M08;
$var['admin_ui']['link'] = "admin_ui.php";

$var['admin_newsticker']['text'] = JQUERY_M05;
$var['admin_newsticker']['link'] = "admin_newsticker.php";

$var['admin_colourbox']['text'] = JQUERY_M06;
$var['admin_colourbox']['link'] = "admin_colourbox.php";

$var['admin_superfish']['text'] = JQUERY_M07;
$var['admin_superfish']['link'] = "admin_superfish.php";

$var['admin_s3slider']['text'] = JQUERY_M10;
$var['admin_s3slider']['link'] = "admin_s3slider.php";

$var['admin_readme']['text'] = JQUERY_M03;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = JQUERY_M04;
$var['admin_vupdate']['link'] = "admin_vupdate.php";
#print $_SERVER['HTTP_HOST'];
show_admin_menu(JQUERY_M01, $action, $var);
/*
if (strpos($_SERVER['HTTP_HOST'], 'pssportal') === false) {
    $fb_donate = "
<form method='post' action='https://www.paypal.com/cgi-bin/webscr' id='paypal_donate_form'>
	<div style='text-align:center;'>
		<input type='hidden' name='cmd' value='_xclick' />
    	<input type='hidden' name='business' value='bazpaypal@keal.me.uk' id='paypal_donate_email' />
		<input type='hidden' name='item_name' value='Donation for e107plugins' />
		<input type='hidden' name='currency_code' value='GBP' />
		<input type='hidden' name='no_shipping' value='1' />
		<input type='hidden' name='no_note' value='1' />
		<input type='hidden' name='cn' value='Comments' />
		<input type='hidden' name='return' value='http://www.keal.me.uk/plugins/custompages/paypal_donation.php' />
		<input type='hidden' name='cancel_return' value='http://www.keal.me.uk/plugins/custompages/paypal_cancel.php' />
" . FB_D02 . "
		<div style='padding-top:5px'>
    		<input type='image' name='submit'  src='https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif' alt='' title='Make a Donation with PayPal' style='border:none' />
    	</div>

    </div>
</form>";

    $ns->tablerender(FB_D01, $fb_donate, 'fb_donate');
}
*/