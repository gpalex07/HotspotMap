function updateTimetableBackground(){ 
	var scaleStep = 10;
	var timetable = document.getElementById("timetable");
	var row = timetable.getElementsByTagName("div");

	for(var i=0; i<row.length; i++){
		var spans = row[i].getElementsByTagName("span");
		if(spans.length == 2){ // 2 pair of span tags, 1 for opening hour, the other one for closing hour.
			var open = spans[0].innerHTML.replace(/\D+/, '');
			var end = spans[1].innerHTML.replace(/\D+/, '');
			if(!isNaN(open) && !isNaN(end)){
				row[i].style.marginLeft = open*scaleStep+"px";
				row[i].style.marginRight = (24-end)*scaleStep+"px";
				row[i].style.width = (end-open)*scaleStep+"px";
				row[i].style.backgroundColor = "red";
				row[i].style.textAlign = "center";
			}
		}
	}
}