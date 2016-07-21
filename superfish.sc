global $jquery_obj;
if(!is_object($jquery_obj)){
	require(e_PLUGIN."jquery/includes/jquery_class.php");
	$jquery_obj=newjquery;
}
echo $jquery_obj->superfish();