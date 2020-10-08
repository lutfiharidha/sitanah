@extends('layouts.appAuth')
@section('content')
<h3>Masukan Letak Spesifikasi Lahan</h3>
<div class="uk-margin-top" id="map" style="clear:both; height:400px;"></div> 
<form class="uk-align-center" method="POST" action="{{ route('storeOverlay', $tanah->id) }}">
  <div id="inputlat">

  </div>
  <input id="button" type="submit" class="uk-button uk-button-primary uk-align-right" value="Save">
@csrf
</form>  
@endsection
@section('script')


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD5BFabnl0V1G4W-PBoEKpNC5xNISuZ2xE&libraries=drawing"></script>
<script src="https://cdn.jsdelivr.net/npm/js-map-label@1.0.1/src/maplabel.js"></script>

<script>
var labels = [];
var allOverlays = [];
var theDiv = document.getElementById("inputlat");
function setSelection(shape) {
  selectedShape = shape;
  shape.setEditable(true);
}

function initMap() {
  var options = {
    zoom: 18,
    center: {lat: {{ $tanah->lat }}, lng: {{ $tanah->lng }}},
    mapTypeId: 'satellite'
  };

  var map = new google.maps.Map(document.getElementById("map"), options);
  var drawingManager = new google.maps.drawing.DrawingManager({
      drawingMode: google.maps.drawing.OverlayType.POLYGON,
      drawingControl: false,
      drawingControlOptions: {
        position: google.maps.ControlPosition.TOP_LEFT,
        drawingModes: ["polygon"]
      },
      polygonOptions: {
        draggable: false,
        fillColor: 'rgba(255, 0, 0, 0.2)',
        fillOpacity: 1,
        strokeWeight: 2,
        editable: true,
        zIndex: 1
      },    
      map: map,
    });
  function attachPolygonInfoWindow(polygon) {
    if (!polygon.labels) polygon.labels = [];
    for (var i = 0; i < polygon.labels.length; i++) {
      polygon.labels[i].setMap(null);
    }
    polygon.labels = [];
    var path = polygon.getPath();
    var points = path.getArray();
    var area = google.maps.geometry.spherical
      .computeArea(path.getArray())
      .toFixed(0);
    var bounds = new google.maps.LatLngBounds();
    var i;

    for (i = 0; i < points.length; i++) {
      bounds.extend(points[i]);
    }

    var boundsCenter = bounds.getCenter();
    var centerLabel = new MapLabel({
      map: map,
      fontSize: 20,
      align: "left"
    });

    polygon.labels.push(centerLabel);

    centerLabel.set("position", bounds.getCenter());
    centerLabel.set("text", area + "m2");
    if (path.getLength() < 2) return;
    for (var i = 0; i < polygon.getPath().getLength(); i++) {
      // for each side in path, compute center and length
      var start = polygon.getPath().getAt(i);
      var end = polygon.getPath().getAt(i < polygon.getPath().getLength() - 1 ? i + 1 : 0);
      var sideLength = google.maps.geometry.spherical.computeDistanceBetween(start, end);
      var sideCenter = google.maps.geometry.spherical.interpolate(start, end, 0.5);
      var sideLabel = new MapLabel({
        map: map,
        fontSize: 20,
        align: "center"
      });
      sideLabel.set("position", sideCenter);
      sideLabel.set("text", sideLength.toFixed(2) + "m");
      polygon.labels.push(sideLabel);

    }
  }

  function removePolygonInfoWindow() {
    for (var i = 0; i < labels.length; i++) {
      labels[i].setMap(null);
    }
    labels = [];

  }

  google.maps.event.addListener(drawingManager, "overlaycomplete", function(e) {
    allOverlays.push(e);

    if (e.type != google.maps.drawing.OverlayType.MARKER) {
      drawingManager.setDrawingMode(null);

      var newShape = e.overlay;
      newShape.type = e.type;
      var verticles = newShape.getPaths().getArray();
      verticles.forEach(function(verticle, ind){
          verticle.forEach(function(v, i){
            theDiv.innerHTML += '<input id="latlng" type="hidden" name="overlay[]" value="'+verticle.getAt(i).lat()+', '+verticle.getAt(i).lng()+'">'; 
          });
        });
      google.maps.event.addListener(newShape, "click", function() {
        setSelection(newShape);
      });

      if (newShape.type == "polygon") {
        var path = newShape.getPath();

        google.maps.event.addListener(path, "insert_at", function() {
          attachPolygonInfoWindow(newShape);
        });

        google.maps.event.addListener(path, "set_at", function() {

          var verticles = newShape.getPaths().getArray();
          verticles.forEach(function(verticle, ind){
              verticle.forEach(function(v, i){
                $('#latlng').remove();
                theDiv.innerHTML += '<input id="latlng" type="hidden" name="overlay[]" value="'+verticle.getAt(i).lat()+', '+verticle.getAt(i).lng()+'">'; 
              });
            });

          attachPolygonInfoWindow(newShape);
        });
        attachPolygonInfoWindow(newShape);
      }

      setSelection(newShape);
    }
  });
}

initMap();
</script>
@endsection