$(document).ready(function() {
	
	// Expand Panel
	$("#open").click(function(){
		$("div#panel").slideDown("fast");
	
	});	
	
	// Collapse Panel
	$("#close").click(function(){
		$("div#panel").slideUp("fast");	
	});		
	
	// Switch buttons from "Log In | Register" to "Close Panel" on click
	$("#toggleHeader").click(function () {
		$("#header-intro").toggle("fast");
		$("#toggleHeader").toggleClass("closed");
		var iconNode = $("#toggleHeader i");
		if(iconNode.hasClass("icon-upload")){
			iconNode.removeClass("icon-upload");
			iconNode.addClass("icon-download");
		}else{
			iconNode.removeClass("icon-download");
			iconNode.addClass("icon-upload");
		}
	});		
		
	// Switch buttons from "Log In | Register" to "Close Panel" on click
	$("header.navbar-inner").click(function () {
		$(this.parentNode).find("div.section-list").toggle("fast");
		var iconNode = $(this.parentNode).find("i");
		if(iconNode.hasClass("icon-plus")){
			iconNode.removeClass("icon-plus");
			iconNode.addClass("icon-minus");
		}else{
			iconNode.removeClass("icon-minus");
			iconNode.addClass("icon-plus");
		}
	});		
	
});