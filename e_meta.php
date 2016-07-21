<?php

global $jquery_obj;
if ( !is_object( $jquery_obj ) ) {
    require_once( e_PLUGIN . "jquery/includes/jquery_class.php" );
    $jquery_obj = new jquery;
}
$jquery_sfish=( $jquery_obj->jquery_superfishactive?'var jquery_sfishactive=true':'var jquery_sfishactive=false');
$jquery_s3slider=( $jquery_obj->jquery_superfishactive?'var jquery_s3slider=true':'var jquery_s3slider=false');

if ( $jquery_obj->jquery_active ) {
    echo"
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' ></script>
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.19/jquery-ui.min.js' ></script>";
}
	    echo"
<script type='text/javascript'>
	jQuery.noConflict();
	{$jquery_sfish};
	{$jquery_s3slider};
</script>
";


