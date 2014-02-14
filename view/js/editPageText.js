var editing  = false;


function catchIt(e) {
  if (editing) return;
  if (!document.getElementById || !document.createElement) return;
  if (!e) var obj = window.event.srcElement;
  else var obj = e.target;
  while (obj.nodeType != 1) {
    obj = obj.parentNode;
  }
  if (obj.tagName == 'SELECT' || obj.tagName == 'A') return;
  while (obj.nodeName != 'SPAN' && obj.nodeName != 'HTML') {
    obj = obj.parentNode;
  }
  if (obj.nodeName == 'HTML') return;
  var x = obj.innerHTML;
  var y = document.createElement('SELECT');
  var z = obj.parentNode;
  z.insertBefore(y,obj);
  z.removeChild(obj);

  populateSelect(y);

  y.value = x;
  y.focus();
  y.onblur=saveEdit;    // Perte de focus
  editing = true;
}

function saveEdit() {
  var select = document.getElementsByTagName('SELECT')[0];
  var y = document.createElement('SPAN');
  var z = select.parentNode;
  y.innerHTML = select.value;
  z.insertBefore(y,select);
  z.removeChild(select);
  editing = false;
}

function populateSelect(inSelect) {
  // ENglish hours display
  for (var i=0; i<24; i++){
    var option = document.createElement("option");

    if(i<10) option.text = "0" + i;
    else option.text = i;

    if(i<13) option.text += " am";
    else option.text += " pm";
    
    option.value = option.text;
    inSelect.appendChild(option);
  }



  /*
  // French hours display
  for (var i=0; i<24; i++){
    var option = document.createElement("option");
    if(i<10) option.text = "0" + i +" h";
    else option.text = i +" h";
    inSelect.appendChild(option);
  }*/
}

document.onclick = catchIt;