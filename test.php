<?php

require_once( "../../class2.php" );
if ( !is_object( $jquery_obj ) ) {
    require_once( e_PLUGIN . "jquery/includes/jquery_class.php" );
    $jquery_obj = new jquery;
}
require_once( HEADERF );

    #
$flexi_text = "";

$flexi_text = '<script type="text/javascript">
jQuery(document).ready(function(){
  	jQuery("button").click(function(){
	fbj_message_box("warning","<ul><li>message</li><li>msg</li></ul>");
    jQuery("#thing").css("background-color","yellow");
  });
});
		jQuery(function(){
			jQuery("ul.sf-menu").superfish();
		});
</script><!--<div id="thing"><button>Click me</button></div>
-->';


$flexi_text .= $jquery_obj->message_box( 'error', 'fg' );
$calendar_options['fieldname']='caltest1';
$calendar_options['fieldid']='caltest1';
$calendar_options['class']='tbox';
#$calendar_options['style']='width:50px;';
$calendar_options['showAnim']='slide';
$calendar_options['changeMonth']=false;
$calendar_options['changeYear']=false;
$calendar_options['dateFormat']='dd/mm/yy';
$calendar_options['readonly']=false;
$calendar_options['yearRange']='1900:c-0';
$calendar_options['appendText']='';
$calendar_options['autoSize']=true;
$calendar_options['navigationAsDateFormat']=false;
$calendar_options['firstDay']=1;
$calendar_options['showOn']='both';
$calendar_options['minDate']='01/01/1900';
$calendar_options['maxDate']='31/12/2012';
$calendar_options['showWeek']=true;
$calendar_options['showButtonPanel']=true;
$calendar_options['closeText']='Done';
$calendar_options['yearSuffix']=' AD';
$date='06/05/2011';
$flexi_text.="
<a href='#' class='jpop' >Click</a>
<textarea name='baz1' id='baz1' rows='3' cols='60'></textarea><br /><br />
<textarea class='autosize autosize-style' name='baz' id='baz' rows='3' cols='60'></textarea><br /><br />
<a class='gallery' href='".e_PLUGIN."jquery/image1.jpg'><img src='".e_PLUGIN."jquery/image1.jpg' style='height:100px;width:100px;' alt=''  />Photo_1</a>
<a class='gallery' href='".e_PLUGIN."jquery/image2.jpg'>Photo_2</a>
<a class='gallery' href='".e_PLUGIN."jquery/image3.jpg'>Photo_3</a>
	<script type='text/javascript'>
	jQuery(document).ready(function(){
	jQuery('a.gallery').colorbox({ opacity:0.5 , rel:'group1' });
	jQuery(document).ready(function(){
    jQuery('.autosize').autosize();
});
	});
</script><br /><br />
<input type='button' class='opener' name='opener' id='opener' value='Dialogue' />".$jquery_obj->jquery_date($date,$calendar_options);
$flexi_text.='
<div id="accordion">
	<h3><a href="#">Section 1</a></h3>
	<div>
	<p>
	Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
	ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
	amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
	odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
	</p>
	</div>
	<h3><a href="#">Section 2</a></h3>
	<div>
	<p>
	Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
	purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
	velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
	suscipit faucibus urna.
	</p>
	</div>
	<h3><a href="#">Section 3</a></h3>
	<div>
	<p>
	Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
	Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
	ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
	lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
	</p>
	<ul>
	<li>List item one</li>
	<li>List item two</li>
	<li>List item three</li>
	</ul>
	</div>
	<h3><a href="#">Section 4</a></h3>
	<div>
	<p>
	Cras dictum. Pellentesque habitant morbi tristique senectus et netus
	et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in
	faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia
mauris vel est.
</p>
<p>
Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus.
Class aptent taciti sociosqu ad litora torquent per conubia nostra, per
inceptos himenaeos.
</p>
	</div>
	</div>
	<script>
	jQuery(document).ready(function(){

	jQuery(function() {
		jQuery( "#accordion" ).accordion({
		collapsible:false,
			change: function(event,ui) {
				var active = jQuery("#accordion").accordion("option", "active");
				jQuery.cookie("menustate", active, { expires: 2 ,path:"/"});
			} // end function change
		});
	});
	if(jQuery.cookie("menustate")!=null) {
		var jindex=Number(jQuery.cookie("menustate"));
	//	alert(jindex);
		//jQuery("#accordion").accordion("option", "animated", false);
		jQuery("#accordion").accordion("activate", 2);
	//	jQuery("#accordion").accordion("option", "animated", "slide");
	}
	});
	</script>';

$ns->tablerender( "JQuery", $flexi_text, 'flexi' );
require_once( FOOTERF );