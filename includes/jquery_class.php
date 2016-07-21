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
if ( !defined( 'e107_INIT' ) ) {
    exit;
}

/**
* * Get the main requires out of the way
*/
include_lan( e_PLUGIN . "jquery/languages/" . e_LANGUAGE . "_jquery.php" );

class jquery {
    var $jquery_active = false; // is user an admin
    function __construct()
    {
        $this->load_prefs();
        $this->jquery_active = $this->prefs['jquery_active'] == 1;
        $this->jquery_fbtools = true;
        $this->jquery_qtip = $this->prefs['jquery_qtip'] == 1;
        $this->jquery_cookies = $this->prefs['jquery_cookies'] == 1;
        $this->jquery_autosize = $this->prefs['jquery_autosize'] == 1;
        $this->jquery_supertext = $this->prefs['jquery_supertext'] == 1;
        $this->jquery_uiactive = $this->prefs['jquery_uiactive'] == 1;
        $this->jquery_uiusetheme = $this->prefs['jquery_uiusetheme'] == 1;
        $this->jquery_s3slider_active = $this->prefs['jquery_s3slider_active'] == 1;
        $this->jquery_newsactive = $this->prefs['jquery_newsactive'] == 1;
        $this->jquery_cbox_active = $this->prefs['jquery_cbox_active'] == 1;
        $this->jquery_superfishactive = $this->prefs['jquery_superfishactive'] == 1;
        $this->jquery_colorpicker = $this->prefs['jquery_colorpicker'] == 1;
        $this->jquery_easyconfirm = $this->prefs['jquery_easyconfirm'] == 1;
        $this->jquery_fredsel = $this->prefs['jquery_fredsel'] == 1;
    }
    /**
    * jquery::getdefaultprefs()
    *
    * @params void
    * @return void
    * @author Barry Keal
    * @since 1.1
    */
    function getdefaultprefs()
    {
        $this->prefs = array(
            "jquery_active" => 0,
            "jquery_qtip" => 0,
            "jquery_cookies" => 0,
            "jquery_autosize" => 0,
            "jquery_supertext" => 0,
            "jquery_uiactive" => 0,
            "jquery_uiusetheme" => 0,
            "jquery_s3slider_active" => 0,
            "jquery_cbox_active" => 0,
            "jquery_superfishactive" => 0,
            "jquery_easyconfirm" => 0,
            "jquery_fredsel" => 0,
            "jquery_colorpicker" => 0,
            "jquery_newsactive" => 0,
            "jquery_newsrandom" => 0,
            "jquery_newsnumnews" => 5,
            "jquery_newsfeed" => 0,
            "jquery_newsnumfeed" => 0,
            "jquery_static_content" => '',
            "jquery_newscontent" => 0,
            "jquery_speed" => 0.1,
            "jquery_showcontrols" => 1,
            "jquery_reveal" => 0,
            "jquery_direction" => 0,
            "jquery_outspeed" => 300,
            "jquery_inspeed" => 600,
            "jquery_pause" => 2000,
            "jquery_title" => 'Default Title',
            );
    }
    /**
    * jquery::load_prefs()
    *
    * @params void
    * @return void
    * @author Barry Keal
    * @since 1.1
    */
    function load_prefs()
    {
        global $sql, $eArrayStorage;
        // get preferences from database
        if ( !is_object( $sql ) ) {
            $sql = new db;
        }
        $num_rows = $sql->db_Select( "core", "*", "e107_name='jquery' " );
        $row = $sql->db_Fetch();

        if ( empty( $row['e107_value'] ) ) {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray( $this->prefs );
            $sql->db_Insert( "core", "'jquery', '$tmp' " );
            $sql->db_Select( "core", "*", "e107_name='jquery' " );
        } else {
            $this->prefs = $eArrayStorage->ReadArray( $row['e107_value'] );
        }
        return;
    }
    /**
    * jquery::save_prefs()
    *
    * @params void
    * @return void
    * @author Barry Keal
    * @since 1.1
    */
    function save_prefs()
    {
        global $sql, $eArrayStorage;
        // save preferences to database
        if ( !is_object( $sql ) ) {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray( $this->prefs );
        $sql->db_Update( "core", "e107_value='$tmp' where e107_name='jquery'", false );
        return ;
    }
    function message_box( $mode = 'blank', $message = '' )
    {
        if ( !isset( $mode ) || empty( $mode ) || $mode == 'blank' ) {
            $vis = 'none';
        } else {
            $vis = 'block';
        }
        if ( !empty( $message ) && strpos( $message, '<ul>' ) === false ) {
            $message = "<ul>" . $message ;
        }
        if ( !empty( $message ) && strpos( $message, '</ul>' ) === false ) {
            $message .= "</ul>";
        }
        $retval = "<div id='fbj_wrapper' style='display:$vis;'>";
        switch ( $mode ) {
            case 'error':
                $retval .= "<div id='fbj_message' class='fbj_error'>$message</div>";
                break;
            case 'warning':
                $retval .= "<div id='fbj_message' class='fbj_warning'>$message</div>";
                break;
            case 'validation':
                $retval .= "<div id='fbj_message' class='fbj_validation'>$message</div>";
                break;
            case 'success':
                $retval .= "<div id='fbj_message' class='fbj_success'>$message</div>";
                break;
            case 'info':
                $retval .= "<div id='fbj_message' class='fbj_info'>$message</div>";
                break;
            case 'blank':
            default:
                $retval .= "<div id='fbj_message' class='fbj_blank'>$message</div>";
                break;
        } // switch
        $retval .= "</div>";
        return $retval;
    }
    function help_area( $id, $content, $visible = false )
    {
        $help_box = "
<div class='' ><img src='images/help.png' /></div>";
    }
    /**
    *
    * @param $
    * @return
    * @author
    * @version
    */
    function news_ticker()
    {
        global $sql, $tp, $jquery_obj, $footer_js, $eplug_css;
        if ( $this->prefs['jquery_newsactive'] == 1 ) {
            if ( $this->prefs['jquery_newscontent'] == 0 ) {
                // Site News
                // date where
                $now = time();
                // get it if start date is before now
                // and end date is 0 or after now
                $myclasses = explode( ',', USERCLASS_LIST );
                $where = "where news_start<{$now} and (news_end>{$now} or news_end=0) and not find_in_set('255',news_class)";
                if ( $sql->db_Select( 'news', 'news_id,news_title,news_summary,news_class,news_extended', "$where order by news_sticky desc, news_datestamp", 'nowhere', false ) ) {
                    $count = 0;
                    $url = array();

                    while ( $row = $sql->db_Fetch() ) {
                        if ( $count < $this->prefs['jquery_newsnumnews'] ) {
                            // check each news item
                            $found = false;
                            $jquery_allowed = explode( ',', $row['news_class'] );
                            foreach( $myclasses as $check_class ) {
                                // check through the allowed classes
                                if ( in_array( $check_class, $jquery_allowed ) ) {
                                    // we are permitted to see it so add it to the list of items
                                    if ( empty( $row['news_extended'] ) ) {
                                        $destiny = 'item';
                                    } else {
                                        $destiny = 'extend';
                                    }
                                    $url[] = "<li><a href='news.php?$destiny." . $row['news_id'] . "'>" . $row['news_title'] . '</a></li>';
                                    $count++;
                                    break;
                                }
                            }
                        }
                    }
                    if ( count( $url ) == 0 ) {
                        $retval .= "<li>" . JQUERY_C19 . "</li>";
                    } else {
                        if ( $this->prefs['jquery_newsrandom'] == 1 ) {
                            // if randomize then shuffle the array
                            shuffle( $url );
                        }
                        foreach( $url as $line ) {
                            $retval .= $line;
                        }
                    }
                } else {
                    // no news items
                    $retval .= '<li>' . JQUERY_C19 . '</li>';
                }
            } elseif ( $this->prefs['jquery_newscontent'] == 1 ) {
                // news feed
                $jquery_news_obj = new fb_jnewsfeed;
                $data = $jquery_news_obj->newsfeed_info( $this->prefs['jquery_newsfeed'] );
                $output = $data['text'];
                if ( $this->prefs['jquery_newsrandom'] == 1 ) {
                    shuffle( $output );
                }
                if ( count( $output > 0 ) ) {
                    foreach( $output as $line ) {
                        $retval .= '<li>' . $line . '</li>';
                    }
                } else {
                    $retval .= '<li>' . JQUERY_C19 . '</li>';
                }
            } else {
                // static file
                $search = array( '<br />' );
                $replace = array( '*' );
                $res = $tp->toHTML( $this->prefs['jquery_static_content'], true );
                $jquery_lines = explode( '<br />', $res );
                if ( $this->prefs['jquery_newsrandom'] == 1 ) {
                    shuffle( $jquery_lines );
                }

                foreach( $jquery_lines as $line ) {
                    $retval .= '<li>' . $line . '</li>';
                }
            }
            /*
    	$retval='<ul id="js-news" class="js-hidden">
    <li class="news-item"><a href="#">This is the 1st latest news item by Baz.</a></li>
    <li class="news-item"><a href="#">This is the 2nd latest news item.</a></li>
    <li class="news-item"><a href="#">This is the 3rd latest news item.</a></li>
    <li class="news-item"><a href="#">This is the 4th latest news item.</a></li>
</ul>
<script type="text/javascript">
    jQuery(function () {
        jQuery("#js-news").ticker();
    });
</script>';
*/
            if ( $this->prefs['jquery_speed'] > 0 ) {
                $speed = "speed:{$this->prefs['jquery_speed']},";
            } else {
                $speed = "speed:0.10,";
            }
            if ( $this->prefs['jquery_showcontrols'] == 1 ) {
                $controls = "controls:true,";
            } else {
                $controls = "controls:false,";
            }
            if ( $this->prefs['jquery_reveal'] == 1 ) {
                $fade = "displayType:'fade',";
            } else {
                $fade = "displayType:'reveal',";
            }
            if ( $this->prefs['jquery_direction'] == 1 ) {
                $direction = "direction:'rtl',";
            } else {
                $direction = "direction:'ltr',";
            }
            if ( $this->prefs['jquery_inspeed'] > 0 ) {
                $fadein = "fadeInSpeed:{$this->prefs['jquery_inspeed']},";
            } else {
                $fadein = "fadeInSpeed:600,";
            }
            if ( $this->prefs['jquery_outspeed'] > 0 ) {
                $fadeout = "fadeOutSpeed:{$this->prefs['jquery_outspeed']},";
            } else {
                $fadeout = "fadeOutSpeed:300,";
            }
            if ( $this->prefs['jquery_pause'] > 500 ) {
                $pause = "pauseOnItems:{$this->prefs['jquery_pause']},";
            } else {
                $pause = "pauseOnItems:2000,";
            }
            if ( $this->prefs['jquery_title'] != '' ) {
                $title = "titleText:'{$this->prefs['jquery_title']}'";
            } else {
                $title = "titleText:'Default'";
            }
            $output = "
	<div id='fb_jnewsticker'>
		<ul id='js-news' class='js-hidden'>";
            $output .= $retval;
            $output .= "
		</ul>
	</div>
	<script type='text/javascript'>
   		jQuery(function () {
        	jQuery('#js-news').ticker({
        	{$speed}
        	{$controls}
        	{$fade}
        	{$direction}
        	{$fadein}
        	{$fadeout}
        	{$pause}
        	{$title}
			});
    	});
	</script>";
        } else {
            $output = '';
        }
        return $output;
    }
    /**
    *
    * @param $
    * @return
    * @author
    * @version
    */
    function superfish()
    {
        if ( $this->prefs['jquery_superfishactive'] == 1 ) {
            global $e107cache, $sql, $tp;
            $cache_tag = 'nq_superfish';
            // test for cached menu
            if ( $cacheData = $e107cache->retrieve( $cache_tag, 1440 ) ) {
                return $cacheData;
            } else {
                $this->menu_text = '';

                $link_total = $sql->db_Select( "links", "*", "WHERE link_class IN (" . USERCLASS_LIST . ") AND link_category=1 ORDER BY link_order ASC", 'nowhere', false );
                while ( $row = $sql->db_Fetch() ) {
                    $linkid = $row['link_id'];
                    // $array[$linkid] = $row['link_parent'];
                    $name = $tp->toHTML( $row['link_name'], "", "defs, no_hook" );
                    $this->linklist['id'] = $linkid;
                    $this->linklist['link_parent'] = $row['link_parent'];
                    $this->linklist['name'] = $name;
                    $link = $row['link_url'];
                    if ( strpos( $link, '://' ) === false && $link != '' ) {
                        $url = e_HTTP . $link ;
                    } else {
                        $url = $link;
                    }
                    $link_replaced = $tp->replaceConstants( $url, true, true );

                    if ( $row['link_open'] == 4 || $row['link_open'] == 5 ) {
                        $dimen = ( $row['link_open'] == 4 ) ? "600,400" : "800,600";
                        $href = " href=\"javascript:open_window('" . $link_replaced . "',{$dimen})\"";
                    } else {
                        $href = " href='" . $link_replaced . "'";
                    }
                    // Open link in a new window.  (equivalent of target='_blank' )
                    $href .= ( $row['link_open'] == 1 ) ? " rel='external'" : "";
                    $this->linklist['url'] = $href;
                    $this->linklist['open'] = $row['link_open'];
                    $this->linklist['link_description'] = $tp->toHTML( $row['link_description'], false );
                    $this->link_obj[] = (object)$this->linklist;
                }
                // convert to an array
                $hash = array();
                foreach( $this->link_obj as $object ) {
                    $hash[$object->id] = array( 'object' => $object );
                }
                $tree = array();
                foreach( $hash as $id => &$node ) {
                    if ( $parent = $node['object']->link_parent )
                        $hash[$parent]['children'][] = &$node;
                    else
                        $tree[] = &$node;
                }
                unset( $node, $hash );
                $this->menu_text .= "" ;
                $this->render_tree( $tree );
                $this->menu_text .= "";
                $cache_data = $this->menu_text;
                $e107cache->set( $cache_tag, $cache_data ); // Save to cache
                return $this->menu_text;
            }
        } else {
            return '';
        }
    }

    function render_tree( $tree )
    {
        $this->menu_text .= '<ul style="position:relative;z-index:10" class="sf-menu" >';
        foreach( $tree as $node ) {
            $this->render_node( $node );
        }
        $this->menu_text .= '</ul>';
    }
    // render tree node
    function render_node( $node, $level = 0 )
    {
        global $pref;
        // $inset = str_repeat( '    ', $level ) . '  ';
        if ( isset( $node['children'] ) ) {
            $class = 'class="current"';
        } else {
            $class = '';
        }
        if ( isset( $pref['linkpage_screentip'] ) && $pref['linkpage_screentip'] && $node['object']->link_description != '' ) {
            $title = " title='" . $node['object']->link_description . "' " ;
        }
        $this->menu_text .= $inset . "<li {$class} {$title}><a " . $node['object']->url . " {$title} >" . $node['object']->name . "</a>";
        if ( isset( $node['children'] ) ) {
            $this->menu_text .= '  <ul>' ;
            foreach( $node['children'] as $node ) {
                $this->render_node( $node, $level + 1 );
            }
            $this->menu_text .= '  </ul>' ;
        }
        $this->menu_text .= '</li>';
    }
    /**
    *
    * @param $
    * @return
    * @author
    * @version
    */
    function jquery_date( $date, $options )
    {
        // * $options array
        // * unixTime true for date in unixtime false for string
        // * dateFormat = date format
        // * readonly boolean the text field
        // * fieldname
        // * fieldid
        // * appendText eg date format
        // * autoSize boolean
        // * default date
        // * class for styling
        // * style
        // * firstDay Sunday 0, Monday 1 etc
        // * minDate
        // * maxDate
        // * changeMonth boolean
        // * changeYear boolean
        // * navigationAsDateFormat boolean
        // * yearRange
        // * showAnim string with the animation type show,slideDown,fadeIn,blind,bounce,clip,Drop,fold,slide,None
        // * showOn both, focus, button
        extract( $options, EXTR_OVERWRITE );
        if ( $showAnim != '' || $showAnim == 'None' ) {
            $showAnim = "showAnim:'{$showAnim}',";
        }
        if ( $unixTime ) {
            $dateval = date( 'd/m/Y', $date );
        } else {
            $dateval = $date;
        }
        $changeMonth = "changeMonth:" . ( $changeMonth?'true':'false' ) . ',';
        $changeYear = "changeYear:" . ( $changeYear?'true':'false' ) . ',';
        $autoSize = "autoSize:" . ( $autoSize?'true':'false' ) . ',';
        $showWeek = "showWeek:" . ( $showWeek?'true':'false' ) . ',';
        $showButtonPanel = "showButtonPanel:" . ( $showButtonPanel?'true':'false' ) . ',';
        $navigationAsDateFormat = "navigationAsDateFormat:" . ( $navigationAsDateFormat?'true':'false' ) . ',';
        $dateFormat = ( $dateFormat?"dateFormat:'{$dateFormat}',":"dateFormat:'d MM yy'," );
        if ( $readonly == true ) {
            $readonly = "readonly='readonly'";
        }
        $yearRange = ( $yearRange?"yearRange:'{$yearRange}',":"" );
        $firstDay = ( $firstDay?"firstDay:'{$firstDay}',":"" );
        $appendText = ( $appendText?"appendText:'{$appendText}',":"" );
        $yearSuffix = ( $yearSuffix?"yearSuffix:'{$yearSuffix}',":"" );
        $closeText = ( $closeText?"closeText:'{$closeText}',":"" );
        $minDate = ( $minDate?"minDate:'{$minDate}',":"" );
        $maxDate = ( $maxDate?"maxDate:'{$maxDate}',":"" );
        $showOn = ( $showOn?"showOn:'{$showOn}',":"" );
    	        $buttonImageOnly = "buttonImageOnly:" . ( $buttonImageOnly?'true':'false' ) . ',';
        $retval = "<input type='text' class='{$class}' {$readonly} name='{$fieldname}' id='{$fieldid}' style='{$style}' value='{$dateval}' />";
        $retval .= "
		<script type='text/javascript'>
		jQuery(document).ready(function(){
			jQuery(function(){
				jQuery( '#{$fieldid}' ).datepicker({
					{$showAnim}
					{$autoSize}
					{$changeMonth}
					{$changeYear}
					{$dateFormat}
					{$yearRange}
					{$appendText}
					{$navigationAsDateFormat}
					{$firstDay}
					{$maxDate}
					{$minDate}
					{$showOn}
					{$showButtonPanel}
					{$closeText}
					{$showWeek}
					{$yearSuffix}
					buttonImage: '" . e_PLUGIN . "jquery/images/calendar.gif',
showOn:'both',
					{$buttonImageOnly}
				});
			});
		});
		</script>";

        return $retval;
    }
    /**
    *
    * @param $
    * @return
    * @author
    * @version
    */
    function get_user( $field, $value )
    {
    	global $sql,$tp;
    	$retval.='
<script>
jQuery(document).ready(function(){
	jQuery(function() {
		jQuery( "#'.$field.'" ).combobox();
		jQuery( "#toggle" ).click(function() {
			jQuery( "#'.$field.'" ).toggle();
		});
	});
});
</script>';
        $arg = "SELECT user_id,user_name,concat(user_id,'.',user_name) as selname from #user WHERE  user_name like '{$term}%' ORDER BY user_name";
        $sql->db_Select_gen( $arg, false );
        $retval = "
<div class='ui-widget'>
	<select class='tbox' name='{$field}' id='{$field}' >
			<option value='0.'>Select...</option>";
        while ( $row = $sql->db_Fetch() ) {
            $retval .="<option value='{$row['selname']}'>".$tp->toFORM( $row['user_name'] )."</option>";
        }
        $retval .= "</select>
</div>";
    	$retval='




<div class="demo">

<div class="ui-widget">
	<label>Your preferred programming language: </label>
	<select id="combobox" class="tbox">
		<option value="">Select one...</option>
		<option value="ActionScript">ActionScript</option>
		<option value="AppleScript">AppleScript</option>
		<option value="Asp">Asp</option>
		<option value="BASIC">BASIC</option>
		<option value="C">C</option>
		<option value="C++">C++</option>
		<option value="Clojure">Clojure</option>
		<option value="COBOL">COBOL</option>
		<option value="ColdFusion">ColdFusion</option>
		<option value="Erlang">Erlang</option>
		<option value="Fortran">Fortran</option>
		<option value="Groovy">Groovy</option>
		<option value="Haskell">Haskell</option>
		<option value="Java">Java</option>
		<option value="JavaScript" selected="selected" >JavaScript</option>
		<option value="Lisp">Lisp</option>
		<option value="Perl">Perl</option>
		<option value="PHP">PHP</option>
		<option value="Python">Python</option>
		<option value="Ruby">Ruby</option>
		<option value="Scala">Scala</option>
		<option value="Scheme">Scheme</option>
	</select>
</div>
';
        return $retval;
    }
}

/**
*/
class fb_jnewsfeed {
    /**
    * Constructor
    */
    function __construct()
    {
    }
    function newsfeed_info( $which )
    {
        global $tp, $sql, $jquery_obj;
        $qry = "newsfeed_id = " . intval( $which );

        $text = "";
        $this->checkUpdate( $qry );

        /* get template */
        if ( file_exists( THEME . "newsfeed_menu_template.php" ) ) {
            include( THEME . "newsfeed_menu_template.php" );
        } else {
            include( e_PLUGIN . "newsfeed/templates/newsfeed_menu_template.php" );
        }

        if ( $feeds = $sql->db_Select( "newsfeed", "*", $qry ) ) {
            while ( $row = $sql->db_Fetch() ) {
                extract ( $row );
                list( $newsfeed_image, $newsfeed_showmenu, $newsfeed_showmain ) = explode( "::", $newsfeed_image );
                $numtoshow = ( $where == 'main' ? $newsfeed_showmain : $newsfeed_showmenu );
                $numtoshow = ( intval( $numtoshow ) > 0 ? $numtoshow : 999 );
                $rss = unserialize( $newsfeed_data );
                // *
                $numtoshow = $jquery_obj->prefs['jquery_newsnumfeed'];
                // *
                // print_a($rss);
                $FEEDNAME = "<a href='" . e_SELF . "?show.$newsfeed_id'>$newsfeed_name</a>";
                $FEEDDESCRIPTION = $newsfeed_description;
                if ( $newsfeed_image == "default" ) {
                    if ( $file = fopen ( $rss->image['url'], "r" ) ) {
                        /* remote image exists - use it! */
                        $FEEDIMAGE = "<a href='" . $rss->image['link'] . "' rel='external'><img src='" . $rss->image['url'] . "' alt='" . $rss->image['title'] . "' style='border: 0; vertical-align: middle;' /></a>";
                    } else {
                        /* remote image doesn't exist - ghah! */
                        $FEEDIMAGE = "";
                    }
                } else {
                    $FEEDIMAGE = "";
                }
                $FEEDLANGUAGE = $rss->channel['language'];

                if ( $rss->channel['lastbuilddate'] ) {
                    $pubbed = $rss->channel['lastbuilddate'];
                } else if ( $rss->channel['dc']['date'] ) {
                    $pubbed = $rss->channel['dc']['date'];
                } else {
                    $pubbed = NFLAN_34;
                }
                $newsfeed_active = 3; // make it active
                $FEEDLASTBUILDDATE = NFLAN_33 . $pubbed;
                $FEEDCOPYRIGHT = $tp->toHTML( $rss->channel['copyright'], true );
                $FEEDTITLE = "<a href='" . $rss->channel['link'] . "' rel='external'>" . $rss->channel['title'] . "</a>";
                $FEEDLINK = $rss->channel['link'];
                if ( $newsfeed_active == 2 or $newsfeed_active == 3 ) {
                    $LINKTOMAIN = "<a  href='" . e_PLUGIN . "newsfeed/newsfeed.php?show.$newsfeed_id'>" . NFLAN_39 . "</a>";
                } else {
                    $LINKTOMAIN = "";
                }

                $data = "";

                $amount = ( $items ) ? $items : $numtoshow;

                $item_total = array_slice( $rss->items, 0, $amount );

                $i = 0;
                while ( $i < $numtoshow && $item_total[$i] ) {
                    $item = $item_total[$i];
                    $FEEDITEMLINK = "<a href='" . $item['link'] . "' rel='external'>" . $tp->toHTML( $item['title'], true ) . "</a>\n";
                    $FEEDITEMLINK = str_replace( '&', '&amp;', $FEEDITEMLINK );
                    $feeditemtext = preg_replace( "#\[[a-z0-9=]+\]|\[\/[a-z]+\]|\{[A-Z_]+\}#si", "", strip_tags( $item['description'] ) );
                    $FEEDITEMTEXT = $tp->text_truncate( $feeditemtext, $truncate, $truncate_string );

                    $FEEDITEMCREATOR = $tp->toHTML( $item['author'], true );
                    if ( empty( $NEWSFEED_MAIN_CAPTION ) ) {
                        // $NEWSFEED_MAIN_CAPTION = $newsfeed_name;
                    }
                    $data[] = $NEWSFEED_MAIN_CAPTION . ' <b>' . $rss->image['title'] . ':</b> ' . $FEEDITEMLINK ;
                    $i++;
                }

                $BACKLINK = "<a href='" . e_SELF . "'>" . NFLAN_31 . "</a>";
            }
        }
        $ret['title'] = $NEWSFEED_MAIN_CAPTION;
        $ret['text'] = $data;
        return $ret;
    }

    function checkUpdate( $query = "newsfeed_active=2 OR newsfeed_active=3" )
    {
        global $sql, $tp;
        require_once( e_HANDLER . "xml_class.php" );
        $xml = new parseXml;
        require_once( e_HANDLER . "magpie_rss.php" );

        if ( $sql->db_Select( "newsfeed", "*", $tp->toDB( $query, false ) ) ) {
            $feedArray = $sql->db_getList();
            foreach( $feedArray as $feed ) {
                extract ( $feed );
                if ( $newsfeed_timestamp + $newsfeed_updateint < time() ) {
                    if ( $rawData = $xml->getRemoteXmlFile( $newsfeed_url ) ) {
                        $rss = new MagpieRSS( $rawData );
                        $serializedArray = addslashes( serialize( $rss ) );

                        $newsfeed_des = false;
                        if ( $newsfeed_description == "default" ) {
                            if ( $rss->channel['description'] ) {
                                $newsfeed_des = $tp->toDB( $rss->channel['description'] );
                            } else if ( $rss->channel['tagline'] ) {
                                $newsfeed_des = $tp->toDB( $rss->channel['tagline'] );
                            }
                        }

                        if ( !$sql->db_Update( 'newsfeed', "newsfeed_data='{$serializedArray}', newsfeed_timestamp=" . time() . ( $newsfeed_des ? ", newsfeed_description='{$newsfeed_des}'": "" ) . " WHERE newsfeed_id=" . intval( $newsfeed_id ) ) ) {
                            echo NFLAN_48 . "<br /><br />" . $serializedArray;
                        }
                    } else {
                        echo $xml->error;
                    }
                }
            }
        }
    }
}