function branchlibraryalert(libraryname,testdate) {
	if (testdate == null) {
		testdate = "";
	}
	$.ajax({
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
				$("#alertmessage span").append(alertmessage);
				$("#alertmessage").show();
				offsetheight = $("#alertmessage").height();
				$("#logo a").css("top", (offsetheight + 36) + "px");
			}
			else if (response[libraryname]["tomorrow"]["name"] !== "None") {
				var name = response[libraryname]["tomorrow"]["name"];
				var hours = response[libraryname]["tomorrow"]["hours"];
				var date = response[libraryname]["tomorrow"]["date"];
				var alertmessage = libraryname + " will be " + hours + " tomorrow (" + date + ") for " + name + ".";
				$("#alertmessage span").append(alertmessage);
				$("#alertmessage").css('background-color','#f9bf3b').show();
				offsetheight = $("#alertmessage").height();
				$("#logo a").css("top", (offsetheight + 36) + "px");
			}
		}
	});
} 