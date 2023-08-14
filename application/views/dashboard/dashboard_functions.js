var map, infoWindow;
var markers = [];
var prioritycode = allcrimes = 'priority-code-all';
var previoussidebarmenu=sidebarmenu="sidebar-priority-code-all";
var markerOpacity = markerOpacityIncrement = 0.05;
var customLabel = {
      murder            : {label: 'Mu'},
      kidnapping        : {label: 'Ki'},
      carnapping        : {label: 'Ca'},
      burglary          : {label: 'Bu'},
      robbery           : {label: 'Ro'},
      rape              : {label: 'Ra'},
      homicide          : {label: 'Ho'},
      arson             : {label: 'Ar'},
      theft             : {label: 'Th'},
      nuisancecomplaint : {label: 'Nu'},
      lostproperty      : {label: 'Lo'}
  };

function setMarkers(data) {
  var object = data.response;
  //console.log(object);
  object.data.forEach(function(dataItem) {
    var id = dataItem.id;
    var name = dataItem.name;
    var details = dataItem.details;
    var type = dataItem.type;
    var point = new google.maps.LatLng(
      parseFloat(dataItem.lat),
      parseFloat(dataItem.lng));

    var infowincontent = document.createElement('div');
    var strong = document.createElement('strong');
    strong.textContent = name
    infowincontent.appendChild(strong);
    infowincontent.appendChild(document.createElement('br'));

    var text = document.createElement('text');
    text.textContent = details
    infowincontent.appendChild(text);
    infowincontent.appendChild(document.createElement('br'));
    
    var button = document.createElement('div');

    button.innerHTML = '<button type="submit" class="btn btn-primary btn-fill btn-xs dropdown-toggle" data-toggle="dropdown">Set Status <span class="caret"></span></button><button type="submit" class="btn btn-danger btn-fill btn-xs pull-right">Respond</button>';

    infowincontent.appendChild(button);

    var icon = customLabel[type] || {};
    var marker = new google.maps.Marker({
      map: map,
      position: point,
      label: icon.label
    });
    marker.addListener('click', function(){
      infoWindow.maxWidth = 200;
      infoWindow.setContent(infowincontent);
      infoWindow.open(map, marker);
    });
    marker.setOpacity(0);
    markers.push(marker);
  })
  fadeMarkers();
}

function reloadMarkers() {
  // loop through markers and set map to null for each
  for(var i = 0; i < markers.length; i++){
    markers[i].setMap(null);
  }
  // reset the markers array
  markers = [];
  // call set markers to read markers
  fetchData('dashboard/generatecrimelist/'+prioritycode, setMarkers);
}

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 11.791655, lng: 38.143882},
    zoom: 8
  });
  infoWindow = new google.maps.InfoWindow;
  fetchData('dashboard/generatecrimelist/'+prioritycode, setMarkers);
  autorefreshallmarkers();
}

function fetchData(url, callback) {
  var request = window.ActiveXObject ?
      new ActiveXObject('Microsoft.XMLHTTP') :
      new XMLHttpRequest;

  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      request.onreadystatechange = doNothing;
      callback(request, request.status);
    }
  };

  request.open('POST', url, true);
  request.responseType = "json";
  request.send(null);
}

function doNothing() {}

function autorefreshallmarkers() {
  setInterval(reloadMarkers, 30000);
}

function fadeMarkers() {
  setTimeout(fadeInMarkers(markers), 1000);
}
  
var fadeInMarkers = function(markers) {
  if (markerOpacity <= 1) {
    for (var i = 0, len = markers.length; i < len; ++i) {
      markers[i].setOpacity(markerOpacity);
    }

    // increment opacity
    markerOpacity += markerOpacityIncrement;

    // call this method again
    setTimeout(function() {
      fadeInMarkers(markers);
    }, 25);

  } else {
    markerOpacity = markerOpacityIncrement; // reset for next use
  }
}

document.getElementById("navbardropdown").addEventListener("click", function(e) {
  // e.target is the clicked element
  if(e.target && e.target.nodeName == "A") {
    console.log(e.target.id);
    prioritycode = e.target.id;
    priorityname = e.target.textContent + '<span><b class="caret"></b></span>';
    document.getElementById("navbarpriorityname").innerHTML = priorityname;
    document.getElementById("sidebarpriorityname").innerHTML = priorityname;

    var start,count;
    if(prioritycode == 'priority-code-1'){
      start = 0;
      count = 6;
    }
    else if(prioritycode == 'priority-code-2') {
      start = 6;
      count = 3;
    }
    else if(prioritycode == 'priority-code-3') {
      start = 9;
      count = 2;
    }
    setsidebarmenu(start, count);
    reloadMarkers();
  }
});

var sidebarpriorityname = document.getElementById("crimeslist");
sidebarpriorityname.addEventListener("click", function(e) {
  prioritycode = document.getElementById("sidebarpriorityname").textContent;
  if(prioritycode == 'All Crimes'){
    prioritycode = allcrimes;
  }
  else{
    prioritycode = prioritycode.split(' ').join('-');
  }
  console.log(prioritycode);
  reloadMarkers();
});

function setsidebarmenu(start, count){
  var sb = document.getElementById("sidebardropdown");
  var c = document.getElementById("sidebardropdown").childElementCount;
  for(var i=0; i<c; i++){
    if((i < start) || (i >= (start + count))){
      sb.children[i].style.display = "none";
    }
    else {
      sb.children[i].style.display = "list-item";
    }
  }
}

var sidebar = document.getElementById("sidebardropdown");
sidebar.addEventListener("click", sidebareventlistener);

function sidebareventlistener(e) {
  // e.target is the clicked element
  if(e.target && e.target.nodeName == "A") {
    prioritycode = e.target.id;
    reloadMarkers();
  }
  else if(e.target && e.target.nodeName == "P") {
    prioritycode = e.target.textContent;
    prioritycode = prioritycode.split(' ').join('-');
    reloadMarkers();
  }
  console.log(prioritycode);
}