var g;
var ngauges=0;
    
function set_gauge(value, label, color_code) {
    
  var color = ["#f5fcff","#c2eaff","#6dceff","#29b7ff","#0081c2","#003d5c"];
    
  g = new JustGage({
    id: "gauge2", 
    value: value - 0, 
    min: 0,
    max: 100,
    title: " ",
    levelColors: color,
    label: label
  });
}

$(document).ready(function (){
    Shadowbox.init();
});