var is_mobile = false;
$(document).ready(function() {

    if( $('#mobile-check').css('display')=='none') {
        is_mobile = true;       
    }

    initialize();
});


function initialize(){

    var zoom_cond = (is_mobile) ? 3:4;

    var cdb_options = {
        center: [52.5260, 10.551],
        zoom: zoom_cond,
        scrollWheelZoom: false,
        minZoom: 3,
        maxZoom: 18
    };
    //var vizjson='https://marciuz.carto.com/api/v2/viz/3cb638ac-ba9e-11e6-887d-0ecd1babdde5/viz.json';
    var vizjson='https://mverona.carto.com/api/v2/viz/5a7534c0-1097-11e7-ae3c-0ecd1babdde5/viz.json';
    var dom_id = 'map_canvas';

    // Instantiate map on specified DOM element
    map_object = new L.Map(dom_id, cdb_options);

    /* retina display */
    if (window.devicePixelRatio >= 2) {
      var baseMap='http://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}@2x.png';
    }
    else{
      var baseMap='http://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}.png';
    }

    L.tileLayer(baseMap, {
        "subdomains": "abcd",
        "attribution": "&copy; <a href=\"http://www.openstreetmap.org/copyright\">OpenStreetMap</a> contributors &copy; <a href=\"http://cartodb.com/attributions\">CartoDB</a>",
        "urlTemplate": baseMap, // "http://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}.png",
    }).addTo(map_object);

    // add to cartodb
    var cdb_layer = cartodb.createLayer(map_object, vizjson);
    cdb_layer.addTo(map_object).on('done', function(e) {

    });
    
    if (window.devicePixelRatio >= 2) {
        var labelsmap = 'http://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}@2x.png';
    }
    else{
        var labelsmap = 'http://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}.png';
    }

    L.tileLayer(labelsmap, {
        "subdomains": "abcd",
    }).addTo(map_object).bringToFront();

}
