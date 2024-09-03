var GraphFunctions = {

	init : function(){
		$(document).ready(function() {
			console.log ("RUN GraphFunctions");
		});
	},


	generateReport : function(report, id, cond = "", cond2 = "", duo = 1){
		$("#rsp_generateReport").html('<div class="taC"><img src="'+dominion+'resources/olc-loading.gif" /></div>');
		$.post(dominion+"models/reportes/"+report+".php",{
			id, cond, cond2, duo
		},function(data){
			$("#rsp_generateReport").html(data);
		});
	},

	generateGraph : function(report, id, cond = "", cond2 = "", duo = 1, conditions = ""){
		$("#rsp_modalGraph").html('<div class="taC"><img src="'+dominion+'resources/olc-loading.gif" /></div>');
		$.post(dominion+"models/reportes/"+report+".php",{
			id, cond, cond2, duo, conditions
		},function(data){
			$("#rsp_modalGraph").html(data);
		});
	},

	modalGraph : function(report, id, cond = "", cond2 = "", duo = 1, conditions = ""){
		$("#rsp_modalGraph").html('<div class="taC"><img src="'+dominion+'resources/olc-loading.gif" /></div>');
		$('#modalGraph').modal();
		GraphFunctions.generateGraph(report, id, cond, cond2, duo, conditions);
	},





};

GraphFunctions.init();