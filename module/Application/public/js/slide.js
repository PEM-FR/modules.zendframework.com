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
		var iconNode = $("#toggleHeader i.icon-upload");
		if(iconNode.hasClass("icon-upload")){
			iconNode.removeClass("icon-upload");
			iconNode.addClass("icon-download");
		}else{
			iconNode.removeClass("icon-download");
			iconNode.addClass("icon-upload");
		}
	});		
		
});