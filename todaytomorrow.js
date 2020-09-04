function todaytomorrow(lib) {
	if (testdate == null) {
		testdate = "";
	}
	$.ajax({
		url: "/hours/hoursdisplay.php?json=1&daycount=2&name=1&lib=" + lib + "&testdate=" + testdate,
		jsonp: "callback",
		dataType: "jsonp",
		success: function( response ) {
			var hourstodaylist = '';
			var hourstodaylistholiday = '';
			var universalholiday1 = 1;
			var universalholiday2 = 1;
			var holidayname1 = '';
			var holidayname2 = '';
			var holidayphrase1;
			var holidayphrase2;
			var datetoday;
			$.each(response, function(key,library) {
				if (library[0].holidayname == 'Regular Hours') {
					universalholiday1 = 0;
					holidayphrase1 = '';
				}
				else {
					holidayname1 = library[0].holidayname;
					holidayphrase1 = " for " + library[0].holidayname;
				}
				datetoday = library[0].date;
				hourstodaylist += "<li><b>Today</b>: " + library[0].hours + "</a></li>";
				hourstodaylistholiday += "<li><b>Today</b>: " + library[0].hours + holidayphrase1 + "</a></li>";
				//Tomorrow
				if (library[1].holidayname == 'Regular Hours') {
					universalholiday2 = 0;
					holidayphrase2 = '';
				}
				else {
					holidayname2 = library[1].holidayname;
					holidayphrase2 = " for " + library[1].holidayname;
				}
				datetoday = library[1].date;
				hourstodaylist += "<li><b>Tomorrow</b>: " + library[1].hours + "</a></li>";
				hourstodaylistholiday += "<li><b>Tomorrow</b>: " + library[1].hours + holidayphrase2 + "</a></li>";
			});
			$('#hourstodaytomorrow').prepend(hourstodaylistholiday);
		}
	});
}