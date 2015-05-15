var lstStations = new Array();
var lstPlots = new Array() ;

function makehttpr(){
	var xmlhttp;
	if(window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	return xmlhttp;
}

function choixStation(objSelect){
	var oStation = objSelect.value;
	appelAjaxListePlot(oStation);
}

function appelAjaxListePlot(v) {
	var xmlhttp = makehttpr();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			remplirListePlots(xmlhttp.responseText);
		}
	}
	xmlhttp.open("GET", "../rep/listeDesPlots.php?station="+v, true);
	xmlhttp.send();
}

function Plot (lePlot) {
	var tb = lePlot.split("$");
	this.numP = tb[0];
    this.numS = tb[1];
    this.etatP = tb[2];
    this.numV = tb[3];
	this.getTableRow = function() {
		var tmp="<tr>";
		tmp += "<td>" + this.numP + "</td>";
		tmp += "<td>" + this.numS + "</td>";
		tmp += "<td>" + this.etatP + "</td>";
        if(this.numV != null) {
            tmp += "<td>" + this.numV + "</td>";
        }else{
            tmp += "<td>" + "Pas de velo" + "</td>";
        }
		tmp += "</tr>";
		return tmp;
	}
}

function remplirListePlots(chainePlots){
    lstPlots.length=0;
    var lesPlots = chainePlots.toString();
	if (lesPlots != ""){
		var tbp = lesPlots.split("#");
		for (var i=0; i<tbp.length+1; i++){
			var oPlot = new Plot(tbp[i]);
			lstPlots.push(oPlot);
		}
	}
	afficherListePlots();
}

function afficherListePlots(){
	var oStation = document.getElementById("listePlots");
	var tmp = "<table>";
	for (var i=0; i < lstPlots.length; i++){
		var oPlot = lstPlots[i];
		tmp += oPlot.getTableRow();
	}
	tmp += "</table>";
	oStation.innerHTML = tmp;
}
