function hexToRGB(o,l){var i=parseInt(o.slice(1,3),16),t=parseInt(o.slice(3,5),16),r=parseInt(o.slice(5,7),16);return l?"rgba("+i+", "+t+", "+r+", "+l+")":"rgb("+i+", "+t+", "+r+")"}$(document).ready(function(){function l(){var o,l=["#02c0ce"];(o=$("#company-1").data("colors"))&&(l=o.split(",")),$("#company-1").sparkline([0,23,43,35,44,45,56,37,40],{type:"line",width:"100%",height:"80",chartRangeMax:50,lineColor:l[0],fillColor:hexToRGB(l[0],.1),highlightLineColor:"rgba(0,0,0,.1)",highlightSpotColor:"rgba(0,0,0,.2)",maxSpotColor:!1,minSpotColor:!1,spotColor:!1,lineWidth:1}),l=["#02c0ce"],(o=$("#company-2").data("colors"))&&(l=o.split(",")),$("#company-2").sparkline([0,25,48,32,36,20,85,56,36],{type:"line",width:"100%",height:"80",chartRangeMax:50,lineColor:l[0],fillColor:hexToRGB(l[0],.1),highlightLineColor:"rgba(0,0,0,.1)",highlightSpotColor:"rgba(0,0,0,.2)",maxSpotColor:!1,minSpotColor:!1,spotColor:!1,lineWidth:1}),l=["#02c0ce"],(o=$("#company-3").data("colors"))&&(l=o.split(",")),$("#company-3").sparkline([0,36,85,25,24,56,24,28,32],{type:"line",width:"100%",height:"80",chartRangeMax:50,lineColor:l[0],fillColor:hexToRGB(l[0],.1),highlightLineColor:"rgba(0,0,0,.1)",highlightSpotColor:"rgba(0,0,0,.2)",maxSpotColor:!1,minSpotColor:!1,spotColor:!1,lineWidth:1}),l=["#02c0ce"],(o=$("#company-4").data("colors"))&&(l=o.split(",")),$("#company-4").sparkline([21,28,30,35,44,82,30,37,40],{type:"line",width:"100%",height:"80",chartRangeMax:50,lineColor:l[0],fillColor:hexToRGB(l[0],.1),highlightLineColor:"rgba(0,0,0,.1)",highlightSpotColor:"rgba(0,0,0,.2)",maxSpotColor:!1,minSpotColor:!1,spotColor:!1,lineWidth:1}),l=["#02c0ce"],(o=$("#company-5").data("colors"))&&(l=o.split(",")),$("#company-5").sparkline([32,28,35,89,10,15,25,37,45],{type:"line",width:"100%",height:"80",chartRangeMax:50,lineColor:l[0],fillColor:hexToRGB(l[0],.1),highlightLineColor:"rgba(0,0,0,.1)",highlightSpotColor:"rgba(0,0,0,.2)",maxSpotColor:!1,minSpotColor:!1,spotColor:!1,lineWidth:1}),l=["#02c0ce"],(o=$("#company-6").data("colors"))&&(l=o.split(",")),$("#company-6").sparkline([10,25,35,35,65,75,56,37,40],{type:"line",width:"100%",height:"80",chartRangeMax:50,lineColor:l[0],fillColor:hexToRGB(l[0],.1),highlightLineColor:"rgba(0,0,0,.1)",highlightSpotColor:"rgba(0,0,0,.2)",maxSpotColor:!1,minSpotColor:!1,spotColor:!1,lineWidth:1}),l=["#02c0ce"],(o=$("#company-7").data("colors"))&&(l=o.split(",")),$("#company-7").sparkline([0,23,43,35,44,45,56,37,40],{type:"line",width:"100%",height:"80",chartRangeMax:50,lineColor:l[0],fillColor:hexToRGB(l[0],.1),highlightLineColor:"rgba(0,0,0,.1)",highlightSpotColor:"rgba(0,0,0,.2)",maxSpotColor:!1,minSpotColor:!1,spotColor:!1,lineWidth:1}),l=["#02c0ce"],(o=$("#company-8").data("colors"))&&(l=o.split(",")),$("#company-8").sparkline([8,19,31,35,44,50,32,37,40],{type:"line",width:"100%",height:"80",chartRangeMax:50,lineColor:l[0],fillColor:hexToRGB(l[0],.1),highlightLineColor:"rgba(0,0,0,.1)",highlightSpotColor:"rgba(0,0,0,.2)",maxSpotColor:!1,minSpotColor:!1,spotColor:!1,lineWidth:1})}var i;l(),$(window).resize(function(o){clearTimeout(i),i=setTimeout(function(){l()},300)})});