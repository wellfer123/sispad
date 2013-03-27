/**
 * uGallery jQuery plugin
 * Author: Miro Zoricak (zoricak at udesign.sk)
 * Website: http://zori.udesign.sk
 * v 1.0 beta
 */
(function($){
	var settings = {
		width: 420,
		height: 320,
		thumbWidth: 60,
		thumbHeight: 45,
		thumbOpacity: 0.5,
		thumbHoverOpacity: 1,
		displayAlt: true
	}
	
	$.uGallery = function(userSettings){
		var images = [];
		$.extend(settings, userSettings);
		// parse input structure to images
		$("ul.gal>li>img").each(function(index, element){
			images[index] = $(element)
				.css({width: element.width+"px", height: element.height+"px"})
				.attr("src", $(element).attr("src"))
				.attr("alt", $(element).attr("alt"));
		});
		// recreate gallery structure using divs
		$("ul.gal").replaceWith("<div class='gal'><div class='gal-main-viewer'></div><div class='gal-thumbs-wrapper'><div class='gal-thumbs'></div></div></div>");
		for(var i = 0; i < images.length; i++){ // fill it with images
			$("div.gal-thumbs").append(makeThumb(images[i]));
		}
		$("div.gal-thumbs>img").wrap("<div class='gal-thumb'></div>");
		// display the first thumb image in main viewer
		$("div.gal-thumbs>div.gal-thumb:first>img").trigger('click');
		// style the gallery
		setupCSS(images);
		// create thub strip moving behaviour on mousemove
		$("div.gal-thumbs").bind("mousemove", function(e){
			var thumbs = $("div.gal-thumbs");
			viewWidth = settings.width - 20;
			contentWidth = parseInt(thumbs.css('width'));
			movableWidth = contentWidth - viewWidth;
			var margin = -Math.round((e.clientX / viewWidth) * movableWidth) + 20;
			thumbs.css({"margin-left": margin+"px"});
		});
		// fade thumbs to the initial state
		$("div.gal-thumb>img").fadeTo("slow", settings.thumbOpacity);
		// add thumb highlight onmouseover behaviour
		$("div.gal-thumb>img").hover(
			function(){ $(this).fadeTo("fast", settings.thumbHoverOpacity); }, 
			function(){ $(this).fadeTo("slow", settings.thumbOpacity); }
		);
	}
	
	/**
	 * crates proportionally resized image with onclick showing full image in image viewer
	 */
	makeThumb = function(img){
		var image = $("<img src='"+$(img).attr("src")+"' alt='"+$(img).attr("alt")+"' />");
		image.css(proportionalDimensions(img, {x: settings.thumbWidth, y: settings.thumbHeight}));
		image.css({msInterpolationMode: "bicubic"}); // smooth out thumbs in IE7
		image.bind("click", img, function(e){
			var image = $("<img src='"+$(img).attr("src")+"' alt='"+$(img).attr("alt")+"' />");
			image.css(proportionalDimensions(img, {x: settings.width - 20, y: settings.height - 20}));
			var alt = $("<div class='gal-alt'>"+$(img).attr("alt")+"</div>");
			alt.css({
				clear: "both", 
				width: settings.width-40+"px", 
				padding: "10px", 
				"background-color": "black", 
				"margin": "auto",
				color: "white"
			});
			alt.fadeTo("fast", 0.6);
			$("div.gal-main-viewer").fadeOut("slow", function(){
				$(this).html(image).hide().fadeIn("slow").append(alt);
				if(settings.displayAlt){
					$("div.gal-alt").animate({marginTop: "-39px"}, 600);
				}
			});
		});
		return image;
	}
	
	/**
	 * proportionally recalculates width and height of an image to fit the fitInto parameter
	 */
	proportionalDimensions = function(img, fitInto){
		if(typeof fitInto != "object"){
			fitInto.x = settings.thumbWidth;
			fitInto.y = settings.thumbHeight;
		}
		var _old = {x: parseInt($(img).css("width")), y: parseInt($(img).css("height"))};
		var _new = {x:0,y:0};
		var ratio = _old.x / _old.y;
		if(_old.x > _old.y){
			_new.x = fitInto.x;
			_new.y = fitInto.x/ratio;
		}
		else{
			_new.x = fitInto.y*ratio;
			_new.y = fitInto.y;
  		}
  		// center image vertically
  		var marginTop = 0;
  		if(_new.y < fitInto.y){
  			marginTop = Math.round((fitInto.y - _new.y)/2);
  		}
		return {width: _new.x+"px", height: _new.y+"px", "margin-top": marginTop+"px"};
	}
	
	/**
	 * style the gallery
	 */
	setupCSS = function(images){
		$("div.gal-thumb").css({
			float: "left", 
			width: settings.thumbWidth+"px", 
			height: settings.thumbHeight+"px", 
			"text-align": "center", 
			"margin-left": "3px",
			border: "1px solid #CCC",
			padding: "3px",
			overflow: "hidden"
		});
		
		$("div.gal").css({
			width: settings.width+"px",
			overflow: "hidden"
		});
		
		$("div.gal-main-viewer").css({
			width: settings.width-20+"px", 
			height: settings.height-20+"px", 
			"text-align": "center",
			overflow: "hidden",
			margin: "auto"
		});
		
		$("div.gal-thumbs-wrapper").css({
			width: settings.width-20+"px", 
			margin: "auto", 
			overflow: "hidden",
			"padding-top": "5px",
			"padding-bottom": "10px"
		});
		
		$("div.gal-thumbs").css({
			height: settings.thumbHeight+"px", 
			width: images.length*(settings.thumbWidth + 11)+20+"px"
		});
		
		$("div.gal-thumb>img").css("background-color", "black");
	}
})(jQuery)