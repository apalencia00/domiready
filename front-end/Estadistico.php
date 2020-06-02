<!DOCTYPE html>
<html>
<head>

<script type="text/javascript" src="js/jquery.js"></script>

<script>

$(document).ready(function(){

  document.body.style.zoom = "75%";

});



</script>

<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script src="js/morris/raphael-min.js"></script>
<script src="js/morris/jquery-1.8.2.min.js"></script>
  <script src="js/morris/morris-0.4.1.min.js"></script>
<meta charset=utf-8 />
<title>Morris.js Line Chart Example</title>

<style type="text/css">
  
  .tab-box .panel-heading > .nav-tabs {
  float: right;
  margin-top: -2px;
  display: inline-block;
  border-bottom: 0;
}
.tab-box .panel-heading > .nav-tabs > li > a {
  border: 0;
  padding: 6px 7px;
}
@media (min-width: 444px) {
  .tab-box .panel-heading > .nav-tabs > li > a {
    padding: 6px 15px;
  }
}
.tab-box .panel-heading > .nav-tabs > li.active > a {
  border-left: 1px solid #dddddd;
  border-right: 1px solid #dddddd;
  border-bottom: 0;
  border-top: 1px solid #7c1c1d;
  background: #fff;
}
.panel.panel-default > .panel-heading h3 {
  display: inline-block;
}


</style>

</head>

<script type="text/javascript">

var arrc;
var arrd;

$(document).ready(function(){

  $.ajax({
  
        url : "../back-end/Source/Estadistico.php",
        type : "GET",
        dataType : "json",
        contentType : "application/json",
        data : {"method" : 1},
  
        success : function(json){
            console.log(json);
            bar.setData(json);
            arrc = json[0].A;
            arrd = json[0].B;
            arrtotal = parseInt(arrc) + parseInt(arrd);
            console.log(arrtotal);
            document.getElementById("resultado").innerHTML = arrtotal;
            
  
        }
  
      });
  
  
  
  bar = Morris.Bar  ({
  element: 'line-example',
  hideHover: 'auto',
   barRatio: 0.4,
      xLabelAngle: 35,
  data: [{'ANNO' : 2017, 'A' : 0, 'B' : 0}],
  xkey: 'ANNO',
  ykeys: ['A', 'B'],
  labels: ['Servicio Centro', 'Servicio Norte'],
  resize: true,
      lineColors: ['#A52A2A','#72A0C1']
});



    });

</script>

<body>
<div class="panel-body">
<div id="monitor" class="panel panel-default tab-box">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="fa fa-signal"></i>
            Monitoring report
        </h3>
       
    </div>
<!--  <div id="line-example"></div> -->

   <div class="panel-body">
        <div class="tab-content">
            
            <div id="co2-tab" class="tab-pane">
                <div class="row">
                    <div class="col-xs-12 chart">
                        <div id="line-example"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" > 
  
  <div class="form-group">
      <label for="pwd">Total Servicios:</label> <div id="resultado" ></div>
       
    </div>

</div>

  </div>

</body>
</html>
