function branchlibraryalert(libraryname,testdate) {
	if (testdate == null) {
		testdate = "";
	}
	jQuery.ajax({
		url: "https://hestia.jmrl.org/hours/checkclosing.php?testdate=" + testdate,
	 
		// The name of the callback parameter
		jsonp: "callback",
	 
		// Tell jQuery we're expecting JSONP
		dataType: "jsonp",

		// Work with the response
		success: function( response ) {
			var offsetheight;
			if (response[libraryname]["today"]["name"] !== "None") {
				var name = response[libraryname]["today"]["name"];
				var hours = response[libraryname]["today"]["hours"];
				var date = response[libraryname]["today"]["date"];
				var alertmessage = libraryname + " is " + hours + " today (" + date + ") for " + name + ".";
				jQuery("#alertmessage span").append(alertmessage);
				jQuery("#alertmessage").show();
				offsetheight = jQuery("#alertmessage").height();
				jQuery("#logo a").css("top", (offsetheight + 36) + "px");
			}
			else if (response[libraryname]["tomorrow"]["name"] !== "None") {
				var name = response[libraryname]["tomorrow"]["name"];
				var hours = response[libraryname]["tomorrow"]["hours"];
				var date = response[libraryname]["tomorrow"]["date"];
				var alertmessage = libraryname + " will be " + hours + " tomorrow (" + date + ") for " + name + ".";
				jQuery("#alertmessage span").append(alertmessage);
				jQuery("#alertmessage").css('background-color','#f9bf3b').show();
				offsetheight = jQuery("#alertmessage").height();
				jQuery("#logo a").css("top", (offsetheight + 36) + "px");
			}
		}
	});
} 
function getParameterByName(name) {
	  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		  results = regex.exec(location.search);
	  return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
if (jQuery("#alertmessage").length > 0 && jQuery("#alertmessage").attr('data-branchname').length > 0) {
	var alertbox = jQuery("#alertmessage");
	alertbox.prependTo('body');
	var testdate = getParameterByName("testdate");
	var branchname = jQuery("#alertmessage").attr('data-branchname');
	branchlibraryalert(branchname, testdate);
}