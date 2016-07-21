
global $jquery_obj;
if (!is_object($jquery_obj)) {
    require_once(e_PLUGIN . "jquery/includes/jquery_class.php");
    $jquery_obj = new jquery;
}
echo $jquery_obj->news_ticker();