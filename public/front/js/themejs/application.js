function display(e){$(".products-list").removeClass("list grid").addClass(e),$(".list-view .btn").removeClass("active"),"list"==e?($(".products-list .product-layout .item-desc").removeClass("hidden"),$(".products-list .product-layout .list-block").removeClass("hidden"),$(".products-list .product-layout .button-group").addClass("hidden"),$(".list-view ."+e).addClass("active"),$.cookie("display","list")):($(".products-list .product-layout .item-desc").addClass("hidden"),$(".products-list .product-layout .list-block").addClass("hidden"),$(".products-list .product-layout .button-group").removeClass("hidden"),$(".list-view ."+e).addClass("active"),$.cookie("display","grid"))}$(document).ready(function(){if($(window).load(function(){$("body").addClass("loaded")}),$("[data-toggle='tooltip']").tooltip().on("click",function(){$(this).tooltip("hide")}),$(".header-top-right .top-link > li").mouseenter(function(){$(".header-top-right .top-link > li.account").addClass("inactive")}),$(".header-top-right .top-link > li").mouseleave(function(){$(".header-top-right .top-link > li.account").removeClass("inactive")}),$(".header-top-right .top-link > li.account").mouseenter(function(){$(".header-top-right .top-link > li.account").removeClass("inactive")}),$(".collapsed-block .expander").click(function(e){var t=$(this).attr("href"),i=$(this);$(t).hasClass("open")?i.removeClass("open").html("<i class='fa fa-angle-down'></i>"):i.addClass("open").html("<i class='fa fa-angle-up'></i>"),$(t).hasClass("open")?$(t).removeClass("open").slideUp("normal"):$(t).addClass("open").slideDown("normal"),e.preventDefault()}),$("ul.yt-accordion li").each(function(){$(this).index()>0?$(this).children(".accordion-inner").css("display","none"):$(this).find(".accordion-heading").addClass("active");var e=navigator.userAgent.match(/iPad/i)?"touchstart":"click";$(this).children(".accordion-heading").bind(e,function(){$(this).addClass(function(){return $(this).hasClass("active")?"":"active"}),$(this).siblings(".accordion-inner").slideDown(350),$(this).parent().siblings("li").children(".accordion-inner").slideUp(350),$(this).parent().siblings("li").find(".active").removeClass("active")})}),$(".image-popup").magnificPopup({type:"image",closeOnContentClick:!0,image:{verticalFit:!1}}),$(".blog-listitem").magnificPopup({delegate:".popup-gallery",type:"image",tLoading:"Loading image #%curr%...",mainClass:"mfp-img-mobile",gallery:{enabled:!0,navigateByImgClick:!0,preload:[0,1]},image:{tError:'<a href="%url%">The image #%curr%</a> could not be loaded.',titleSrc:function(e){return e.el.attr("title")}}}),$(".iframe-link").magnificPopup({type:"iframe",fixedContentPos:!0,fixedBgPos:!0,overflowY:"auto",closeBtnInside:!0,closeOnContentClick:!0,preloader:!0,midClick:!0,removalDelay:300,mainClass:"my-mfp-zoom-in"}),jQuery(function(e){"use strict";var t=0;e(".social-widgets .items .item").each(function(){var i="item-0"+ ++t;e(this).addClass(i)})}),jQuery(function(e){"use strict";e(".social-widgets .item").each(function(){var t;e(this).on("mouseenter",function(){var i=e(this);t&&clearTimeout(t),t=setTimeout(function(){i.addClass("active")},200)}).on("mouseleave",function(){var i=e(this);t&&clearTimeout(t),t=setTimeout(function(){i.removeClass("active")},100)}).on("click",function(e){e.preventDefault()})})}),jQuery(function(e){"use strict";var t=e(".social-widgets .item a");t.click(function(e){e.preventDefault()}),t.hover(function(t){if(!e(this).parent().hasClass("load")){var i=e(this).parent().find(".loading");e.ajax({url:e(this).attr("href"),cache:!1,success:function(e){setTimeout(function(){i.html(e)},1e3)}}),e(this).parent().addClass("load")}})}),$(".back-to-top").addClass("hidden-top"),$(window).scroll(function(){0===$(this).scrollTop()?$(".back-to-top").addClass("hidden-top"):$(".back-to-top").removeClass("hidden-top")}),$(".back-to-top").click(function(){return $("body,html").animate({scrollTop:0},1200),!1}),$("#slider").length&&(window.startRangeValues=[28,562],$("#slider").slider({range:!0,min:10,max:580,values:window.startRangeValues,step:.01,slide:function(e,t){var i=t.values[0].toFixed(2),a=t.values[1].toFixed(2),n=$(this).siblings(".range");n.children(".min_value").val(i).next().val(a),n.children(".min_val").text("$"+i).next().text("$"+a)},create:function(e,t){var i=$(this),a=i.slider("values",0).toFixed(2),n=i.slider("values",1).toFixed(2),o=i.siblings(".range");o.children(".min_value").val(a).next().val(n),o.children(".min_val").text("$"+a).next().text("$"+n)}})),window.startRangeValues){var e=window.startRangeValues,t=e[0].toFixed(2),i=e[1].toFixed(2);$(".filter_reset").on("click",function(){var a=$(this).closest("form"),n=a.find(".range");console.log(e),a.find("#slider").slider("values",0,t),a.find("#slider").slider("values",1,i),a.find(".options_list").children().eq(0).children().trigger("click"),n.children(".min_value").val(t).next().val(i),n.children(".min_val").text("$"+t).next().text("$"+i)})}}),$(function(e){"use strict";if(e.initQuantity=function(t){t.each(function(){var i=e(this),a=i.data("inited-control"),n=e(".input-group-addon:last",i),o=e(".input-group-addon:first",i),s=e(".form-control",i);a||(t.attr("unselectable","on").css({"-moz-user-select":"none","-o-user-select":"none","-khtml-user-select":"none","-webkit-user-select":"none","-ms-user-select":"none","user-select":"none"}).bind("selectstart",function(){return!1}),n.click(function(){var e=parseInt(s.val())+1;return s.val(e),!1}),o.click(function(){var e=parseInt(s.val())-1;return s.val(e>0?e:1),!1}),s.blur(function(){var e=parseInt(s.val());s.val(e>0?e:1)}))})},e.initQuantity(e(".quantity-control")),e.initSelect=function(t){t.each(function(){var t=e(this),i=t.data("inited-select"),a=e(".value",t),n=e(".input-hidden",t),o=e(".dropdown-menu li > a",t);i||(o.click(function(i){e(this).closest(".sort-isotope").length>0&&i.preventDefault();var o=e(this).attr("data-value"),s=e(this).html();t.trigger("change",{value:o,html:s}),a.html(s),n.length&&n.val(o)}),t.data("inited-select",!0))})},e.initSelect(e(".btn-select")),window.startRangeValues){var t=window.startRangeValues,i=t[0].toFixed(2),a=t[1].toFixed(2);e(".filter_reset").on("click",function(){var n=e(this).closest("form"),o=n.find(".range");console.log(t),n.find("#slider").slider("values",0,i),n.find("#slider").slider("values",1,a),n.find(".options_list").children().eq(0).children().trigger("click"),o.children(".min_value").val(i).next().val(a),o.children(".min_val").text("$"+i).next().text("$"+a)})}}),$(document).ready(function(e){e(".date").datetimepicker({pickTime:!1})}),$(document).ready(function(){$("#cat_accordion").cutomAccordion({eventType:"click",autoClose:!0,saveState:!0,disableLink:!0,speed:"slow",showCount:!1,autoExpand:!0,cookie:"dcjq-accordion-1",classExpand:"button-view"})}),$(function(){var e=new Date(2018,2,28);$(".defaultCountdown-30").countdown(e,function(e){$(this).html(e.strftime('<div class="time-item time-day"><div class="num-time">%D</div><div class="name-time">Day </div></div><div class="time-item time-hour"><div class="num-time">%H</div><div class="name-time">Hour </div></div><div class="time-item time-min"><div class="num-time">%M</div><div class="name-time">Min </div></div><div class="time-item time-sec"><div class="num-time">%S</div><div class="name-time">Sec </div></div>'))})}),$(document).ready(function(){$(".list-view .btn").each(function(){var e=navigator.userAgent.match(/iPad/i)?"touchstart":"click";$(this).bind(e,function(){$(this).addClass(function(){return $(this).hasClass("active")?"":"active"}),$(this).siblings(".btn").removeClass("active"),$catalog_mode=$(this).data("view"),display($catalog_mode)})})}),$(document).ready(function(){$(".large-image img").elevateZoom({zoomType:"inner",lensSize:"200",easing:!0,gallery:"thumb-slider",cursor:"pointer",loadingIcon:"image/theme/lazy-loader.gif",galleryActiveClass:"active"}),$(".large-image").magnificPopup({items:[{src:"image/catalog/demo/product/funiture/1.jpg"},{src:"image/catalog/demo/product/funiture/2.jpg"},{src:"image/catalog/demo/product/funiture/3.jpg"},{src:"image/catalog/demo/product/funiture/4.jpg"},{src:"image/catalog/demo/product/funiture/5.jpg"}],gallery:{enabled:!0,preload:[0,2]},type:"image",mainClass:"mfp-fade",callbacks:{open:function(){var e=parseInt($("#thumb-slider .img.active").attr("data-index"));$.magnificPopup.instance.goTo(e)}}}),$("#thumb-slider .owl2-item").each(function(){$(this).find("[data-index='0']").addClass("active")}),$(".thumb-video").magnificPopup({type:"iframe",iframe:{patterns:{youtube:{index:"youtube.com/",id:"v=",src:"//www.youtube.com/embed/%id%?autoplay=1"}}}}),$(".product-options li.radio").click(function(){$(this).addClass(function(){return $(this).hasClass("active")?"":"active"}),$(this).siblings("li").removeClass("active"),$(this).parent().find(".selected-option").html('<span class="label label-success">'+$(this).find("img").data("original-title")+"</span>")}),$(".reviews_button,.write_review_button").click(function(){var e=$(".producttab").offset().top;$("html, body").animate({scrollTop:e},1e3)})}),$(document).ready(function(){$(".large-image img").elevateZoom({zoomType:"inner",lensSize:"200",easing:!0,gallery:"thumb-slider-vertical",cursor:"pointer",galleryActiveClass:"active"}),$(".large-image").magnificPopup({items:[{src:"image/catalog/demo/product/funiture/1.jpg"},{src:"image/catalog/demo/product/funiture/2.jpg"},{src:"image/catalog/demo/product/funiture/3.jpg"},{src:"image/catalog/demo/product/funiture/4.jpg"},{src:"image/catalog/demo/product/funiture/5.jpg"}],gallery:{enabled:!0,preload:[0,2]},type:"image",mainClass:"mfp-fade",callbacks:{open:function(){var e=parseInt($("#thumb-slider-vertical .img.active").attr("data-index"));$.magnificPopup.instance.goTo(e)}}}),$("#thumb-slider-vertical .owl2-item").each(function(){$(this).find("[data-index='0']").addClass("active")}),$(".thumb-video").magnificPopup({type:"iframe",iframe:{patterns:{youtube:{index:"youtube.com/",id:"v=",src:"//www.youtube.com/embed/%id%?autoplay=1"}}}}),$(".product-options li.radio").click(function(){$(this).addClass(function(){return $(this).hasClass("active")?"":"active"}),$(this).siblings("li").removeClass("active"),$(this).parent().find(".selected-option").html('<span class="label label-success">'+$(this).find("img").data("original-title")+"</span>")});$(".thumb-vertical-outer .next-thumb").click(function(){$(".thumb-vertical-outer .lSNext").trigger("click")}),$(".thumb-vertical-outer .prev-thumb").click(function(){$(".thumb-vertical-outer .lSPrev").trigger("click")}),$(".reviews_button,.write_review_button").click(function(){var e=$(".producttab").offset().top;$("html, body").animate({scrollTop:e},1e3)})});