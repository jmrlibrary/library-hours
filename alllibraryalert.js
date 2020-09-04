//For main page:
function alllibraryalert(testdate) {
	if (testdate == null) {
		testdate = "";
	}
$.ajax({
			url: "https://jmrl.org/hours/checkclosing.php?testdate=" + testdate,
		 
			// The name of the callback parameter
			jsonp: "callback",
		 
			// Tell jQuery we're expecting JSONP
			dataType: "jsonp",

			// Work with the response
			success: function( response ) {
				var offsetheight;
				if ((response["openspecial"] && response["openspecial"]["today"]) || (response["closed"] && response["closed"]["today"])) {
					var alertmessage = '<b>TODAY:</b> ';
					var holidayname;
					if (response["closed"] && response["closed"]["today"]) {
						var countclosed = response["closed"]["today"].length;
						if (countclosed >= 8) { 
							alertmessage += "All libraries are closed for " + response["Central Library"]["today"]["name"] + " (" + response["Central Library"]["today"]["date"] + ").";
						} else {
							$.each(response["closed"]["today"], function (i , value) {
								if (i == 0) {
									holidayname = response[value]["today"]["name"] + " (" + response[value]["today"]["date"] + ")";
								}
								if (countclosed > 1 && i === (countclosed - 1)) {
									alertmessage += " and <i>" + value + "</i>";
								}
								else if (countclosed > 1) {
									alertmessage += " <i>" + value + "</i>, ";
								}
								else {
									alertmessage += " <i>" + value + "</i> ";
								}
							});
							if (countclosed > 1) {
								alertmessage += " are closed for " + holidayname + ". ";
							}
							else {
								alertmessage += " is closed for " + holidayname + ". ";
							}
						}
					}
					if (response["openspecial"] && response["openspecial"]["today"]) {
						var countopen = response["openspecial"]["today"].length;
						$.each(response["openspecial"]["today"], function (i , value) {
							if (countopen > 1 && i === (countopen - 1)) {
								alertmessage += " and <i>" + value + "</i>";
							}
							else if (countopen > 1) {
								alertmessage += " <i>" + value + "</i>, ";
							}
							else {
								alertmessage += " <i>" + value + "</i> ";
							}
						});
						if (countopen > 1) {
							alertmessage += " have special hours today.  Check branch pages for details. ";
						}
						else {
							alertmessage += " has special hours today.  Check branch pages for details. ";
						}
					}
					$("#alertmessage2 span").append(alertmessage);
					$("#alertmessage2").show();
					offsetheight = $("#alertmessage2").height();
					$("#logo a").css("top", (offsetheight + 36) + "px");
				}
				if ((response["openspecial"] && response["openspecial"]["tomorrow"]) || (response["closed"] && response["closed"]["tomorrow"])) {
					var alertmessage = '<b>TOMORROW:</b> ';
					if (response["closed"] && response["closed"]["tomorrow"]) {
						var countclosed = response["closed"]["tomorrow"].length;
						if (countclosed >= 8) { 
							alertmessage += "All libraries will be closed for " + response["Central Library"]["tomorrow"]["name"] + " (" + response["Central Library"]["tomorrow"]["date"] + ").";
						} else {
							$.each(response["closed"]["tomorrow"], function (i , value) {
								if (i == 0) {
									holidayname = response[value]["tomorrow"]["name"] + " (" + response[value]["tomorrow"]["date"] + ")";
								}
								if (countclosed > 1 && i === (countclosed - 1)) {
									alertmessage += " and <i>" + value + "</i>";
								}
								else if (countclosed > 1) {
									alertmessage += " <i>" + value + "</i>, ";
								}
								else {
									alertmessage += " <i>" + value + "</i> ";
								}
							});
							alertmessage += " will be closed for " + holidayname + ". ";
						}
					}
					if (response["openspecial"] && response["openspecial"]["tomorrow"]) {
						var countopen = response["openspecial"]["tomorrow"].length;
						$.each(response["openspecial"]["tomorrow"], function (i , value) {
							if (countopen > 1 && i === (countopen - 1)) {
								alertmessage += " and <i>" + value + "</i>";
							}
							else if (countopen > 1) {
								alertmessage += " <i>" + value + "</i>, ";
							}
							else {
								alertmessage += " <i>" + value + "</i> ";
							}
						});
						alertmessage += " will have special hours.  Check branch pages for details. ";
					}
					$("#alertmessage2 span").append(alertmessage);
					$("#alertmessage2").css('background-color','#f9bf3b').show();
					offsetheight = $("#alertmessage2").height();
					$("#logo a").css("top", (offsetheight + 36) + "px");
				}
			}
		});
}