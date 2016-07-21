
function fbj_message_box(mode,message){
	if(jQuery('#fbj_wrapper').is(':visible') ){
		if( mode =='blank'){
			jQuery('#fbj_wrapper').slideUp(800);
		}
	}else{
		if(mode!='blank'){
			fb_mod(mode,message);
			jQuery('#fbj_wrapper').slideDown(800);
		}
	}
}

/**
 *
 * @access public
 * @return void
 **/
function fb_mod(mode,message){
	jQuery('#fbj_message').removeClass(); // remove classes
	jQuery('#fbj_message').html(message);
	// add the class appropriate to the mode
	switch (mode){
		case 'success':
			jQuery('#fbj_message').addClass('fbj_success');
			break;
		case 'error':
			jQuery('#fbj_message').addClass('fbj_error');
			break;
		case 'warning':
			jQuery('#fbj_message').addClass('fbj_warning');
			break;
		case 'validation':
			jQuery('#fbj_message').addClass('fbj_validation');
			break;
		case 'info':
			jQuery('#fbj_message').addClass('fbj_info');
			break;
		case 'blank':
			jQuery('#fbj_message').addClass('fbj_blank');
			break;
		default :
			message='';
			mode='blank';
			jQuery('#fbj_message').addClass('fbj_blank');
			break;
	}// end switch
}

(function($){
    $.fn.extend({
        //pass the options variable to the function
		fb_fader: function(options) {
            //Set the default values, use comma to separate the settings, example:
            var defaults = {
                overlayClass : 'fb_overlay',
                animateSpeed : 800
            }

            var options =  $.extend(defaults, options);
            return this.each(function() {
                var allids={};
            	$this=$(this);
                var o = options;
				var $textitem;
				var overlaydiv;
				var height;
				var width;
				var $expandmin;
				var temp;
				var innerheight;
				var item;
				var counter=0;
				// get all the ids and other info of items selected
				item=$this;
				$id=item.attr('id');
				if($id==undefined || $id==''){
					$id='fb_temp_'+counter;
					item.attr({'id':$id});
					counter++;
				}
				allids[$id]={
				'textitemhight':item.outerHeight(),
				'textitemwidth':item.outerWidth(),
				'textitemIhight':item.height()
				};
			//		alert(allids[$id]['textitemhight']);
				for (itemid in allids){
					$textitem=$('#'+itemid); // jquery object to the item
					height=allids[itemid]['textitemhight']; // get the original height
					innerheight=allids[itemid]['textitemIhight']; // get the original height
					width=allids[itemid]['textitemwidth']; // get the original width
					if(height>=300){
						// if the height is greater than 300 px we need to overlay
						$textitem.height(300);
						// append a div to the item which has the image as a background
						// to create the overlay
						overlaydiv='<div id="fb_overlaydiv-'+itemid+'" class="'+o.overlayClass+' fb_overlayH" >&nbsp;</div>';
						$textitem.append(overlaydiv); // add the overlay to the text div
						$overid="fb_overlaydiv-"+itemid;
						$overlay=$('#'+$overid); // jquery object to the image div
						$overlay.width(width);
						nh=300+(height-innerheight);
						$overlay.height(nh);
						$overlay.position({
							my:'left bottom',
							at:'left bottom',
							of:$textitem
						});

						// append a div to contain the expand/minimise
						$expandmin='<div id="fb_expmin-'+itemid+'" >Expand Item</div>';
						// then insert after the text div - not inside it.
						$($expandmin).insertAfter($textitem);
						// Set up the click funtions on each one
						$('#fb_expmin-'+itemid).click(function(){
							var $eachtextitem;
							var $img_overlay;
							var t2;
							var x2;
							// get the index value for the item
							temp=$(this).attr('id');
							t2=temp.split("-");

							x2=t2[1]; // the id to use

							x2obj=$('#'+t2[1]);
							$eachtextitem=$('#'+x2); // jquery object to the item
							$img_overlay=$('#fb_overlaydiv-'+x2); // jquery object to the image div
							$img_overlay.position({
								my:'left bottom',
								at:'left bottom',
								of:$eachtextitem
							});
							if($img_overlay.hasClass('fb_overlayH')){
								$('#fb_expmin-'+x2).html('&nbsp;');
								$img_overlay.hide();

								newheight=allids[x2]['textitemhight'];
								$eachtextitem.animate({height:allids[x2]['textitemhight']},o.animateSpeed,function(){
									$('#fb_expmin-'+x2).html('Minimise Item');
									$img_overlay.removeClass('fb_overlayH');
								});
							}else{
								$('#fb_expmin-'+x2).html('&nbsp;');
									$img_overlay.show();
								$eachtextitem.animate({height:300},o.animateSpeed,function(){
									$('#fb_expmin-'+x2).html('Expand Item');
									$img_overlay.addClass('fb_overlayH');

									$img_overlay.width(allids[x2]['textitemwidth']);
									$img_overlay.position({
										my:'left bottom',
										at:'left bottom',
										of:$eachtextitem
									});
								});
							} // end if/else
						}); // end the click()function
						$overlay.position({
							my:'left bottom',
							at:'left bottom',
							of:$textitem
						});
					}
				}
			});
		}
	});
})(jQuery);

jQuery.fn.pulse = function( properties, duration, numTimes, interval) {

   if (duration === undefined || duration < 0) duration = 500;
   if (duration < 0) duration = 500;

   if (numTimes === undefined) numTimes = 1;
   if (numTimes < 0) numTimes = 0;

   if (interval === undefined || interval < 0) interval = 0;

   return this.each(function() {
      var $this = jQuery(this);
      var origProperties = {};
      for (property in properties) {
         origProperties[property] = $this.css(property);
      }

      var subsequentTimeout = 0;
      for (var i = 0; i < numTimes; i++) {
         window.setTimeout(function() {
            $this.animate(
               properties,
               {
                  duration:duration / 2,
                  complete:function(){
                     $this.animate(origProperties, duration / 2)}
               }
            );
         }, (duration + interval)* i);
      }
   });

};

jQuery(document).ready(function(){
	jQuery('.jquery_fade').fb_fader({'animateSpeed':900});

	if(jquery_sfishactive && jQuery(".sf-menu").length){
        jQuery("ul.sf-menu").supersubs({
            minWidth:    15,   // minimum width of sub-menus in em units
            maxWidth:    27,   // maximum width of sub-menus in em units
            extraWidth:  1     // extra width can ensure lines dont sometimes turn over
								// due to slight rounding differences and font-family
		}).superfish({
		dropShadows:   true,
		delay:1200,
		animation:   {opacity:'show',height:'show'}
		});  // call supersubs first, then superfish, so that subs are
		// not display:none when measuring. Call before initialising
		// containing tabs for same reason.
	}
	if(jquery_s3slider && jQuery('#slider').length){
			var image=jQuery(".sliderImage img:first ");
			var iheight=image.height();
			var iwidth=image.width();
			image.width(iwidth);
			if(iheight>0 && iwidth>0){
				var thediv=jQuery('#slider');
				thediv.height(iheight)
				thediv.width(iwidth)
				jQuery('#sliderContent').width(iwidth);
				var nw=iwidth-26;
				jQuery('.sliderImage span').width(nw)
			}
	        jQuery('#slider').s3Slider({
            timeOut: 4000
        	});
        }
/*
	var $dialog = jQuery('<div></div>')
		.html('This dialog will show every time!')
		.dialog({
			autoOpen: false,
			position:['center','top'],
			title: 'Basic Dialog',
			resizable:false,
			modal:true,
			show: { effect: 'drop', direction: "up" },
			hide: { effect: 'drop', direction: "up" },
		});
		jQuery('.ui-dialog').css('position','fixed');
		jQuery('#opener').click(function() {
		$dialog.dialog('open');
		// prevent the default action, e.g., following a link
		return false;
	});
*/
});



(function($) {
    $.widget("ui.combobox", {
        _create: function() {
            var input,
            self = this,
            select = this.element.hide(),
            selected = select.children(":selected"),
            value = selected.val() ? selected.text() : "",
            wrapper = this.wrapper = $("<span>").addClass("ui-combobox").insertAfter(select);
            input = $("<input>").appendTo(wrapper).val(value).addClass("ui-state-default ui-combobox-input").autocomplete({
                delay: 0,
                minLength: 0,
                source: function(request, response) {
                    var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
                    response(select.children("option").map(function() {
                        var text = $(this).text();
                        if (this.value && (!request.term || matcher.test(text)))
                            return {
                            	label: text.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + $.ui.autocomplete.escapeRegex(request.term) + ")(?![^<>]*>)(?![^&;]+;)", "gi"), "<strong>$1</strong>"),
                            	value: text,
                            	option: this
                        	};
                        }));
                },
                select: function(event, ui) {
                    ui.item.option.selected = true;
                    self._trigger("selected", event, {
                        item: ui.item.option
                    });
                },
                change: function(event, ui) {
                    if (!ui.item) {
                        var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex($(this).val()) + "$", "i"),
                        valid = false;
                        select.children("option").each(function() {
                            if ($(this).text().match(matcher)) {
                                this.selected = valid = true;
                                return false;
                            }
                        });
                        if (!valid) {
                            // remove invalid value, as it didnt match anything
                            $(this).val("");
                            select.val("");
                            input.data("autocomplete").term = "";
                            return false;
                        }
                    }
                }
            }).addClass("ui-widget ui-widget-content ui-corner-left");

            input.data("autocomplete")._renderItem = function(ul, item) {
                return $("<li></li>").data("item.autocomplete", item).append("<a>" + item.label + "</a>").appendTo(ul);
            };

            $("<a>").attr("tabIndex", -1).attr("title", "Show All Items").appendTo(wrapper).button({
                icons: {
                    primary: "ui-icon-triangle-1-s"
                },
                text: false
            }).removeClass("ui-corner-all").addClass("ui-corner-right ui-combobox-toggle").click(function() {
                // close if already visible
                if (input.autocomplete("widget").is(":visible")) {
                    input.autocomplete("close");
                    return;
                }

                // work around a bug (likely same cause as #5265)
                $(this).blur();

                // pass empty string as value to search for, displaying all results
                input.autocomplete("search", "");
                input.focus();
            });
        },

        destroy: function() {
            this.wrapper.remove();
            this.element.show();
            $.Widget.prototype.destroy.call(this);
        }
    });
})(jQuery);

jQuery(function() {
    jQuery("#combobox").combobox();
    jQuery("#toggle").click(function() {
        jQuery("#combobox").toggle();
    });
});