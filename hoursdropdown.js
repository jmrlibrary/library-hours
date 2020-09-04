var shortnames = ['','Central','Crozet','Gordon','Greene','Louisa','Nelson','Northside','Scottsville'];
var links = ['','/central','/crozet','/gordon','/greene','/louisa','/nelson','/northside','/scottsville'];
if (testdate == null) {
		testdate = "";
	}
$.ajax({
	url: "/hours/hoursdisplay.php?json=1&daycount=1&name=1&testdate=" + testdate,
	jsonp: "callback",
	dataType: "jsonp",
	success: function( response ) {
		var hourstodaylist = '';
		var hourstodaylistholiday = '';
		var universalholiday = 1;
		var holidayname = '';
		var holidayphrase;
		var datetoday;
		$.each(response, function(key,library) {
			if (library[0].holidayname == 'Regular Hours') {
				universalholiday = 0;
				holidayphrase = '';
			}
			else {
				holidayname = library[0].holidayname;
				holidayphrase = " for " + library[0].holidayname;
			}
			datetoday = library[0].date;
			hourstodaylist += "<li><a href='" + links[key] + "'><i>" + shortnames[key] + "</i>: " + library[0].hours + "</a></li>";
			hourstodaylistholiday += "<li><a href='" + links[key] + "'><i>" + shortnames[key] + "</i>: " + library[0].hours + holidayphrase + "</a></li>";
		});
		if (universalholiday == 0) {
			hourstodaylistholiday = "<li><b>" + datetoday + "</b></li>" + hourstodaylistholiday;				
			$('.dropdown-menu.livehoursdropdown').prepend(hourstodaylistholiday);
		}
		else {
			hourstodaylist = "<li><b>" + holidayname + "</b></li>" + hourstodaylist;
			$('.dropdown-menu.livehoursdropdown').prepend(hourstodaylist);
		}
	}
});