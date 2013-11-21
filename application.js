// with reference to http://www.w3schools.com/js/js_cookies.asp
function setCookie(cookieName,value,exdays) {
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value = escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie = cookieName + "=" + c_value;
}

$(function () {
	$( "button" ).click(function( event ) {
		var eventId = event.target.id;
	  	setCookie("zooname", eventId, 1);
	  	window.location.replace("zoo.php");
	});
});

$(function() {
	$('#logout').on("click", function() {
		setCookie("zooname","deleted",(-1));
		window.location.replace("index.php");
	});
});

