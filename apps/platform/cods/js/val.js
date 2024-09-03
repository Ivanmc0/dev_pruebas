var val = {

	init: function () {
		$(document).ready(function () {

			console.log("RUN VAL");

			$(".csid").on("click", function () {

				let id      = $(this).attr("id").split("_");
				let pre     = 0;
				let res     = 0;
				let opuesto = 0;

				if(id[4] == 0) opuesto = 1;

				pre = id[0]+'_'+id[1]+'_'+id[2]+'_'+opuesto;
				res = id[0]+'_'+id[1]+'_'+id[2]+'_'+id[3]+'_'+opuesto;

				document.getElementsByName(pre)[0].disabled = false;
				document.getElementsByName(pre)[1].disabled = false;
				document.getElementsByName(pre)[2].disabled = false;
				document.getElementsByName(pre)[3].disabled = false;
				document.getElementById   (res).disabled    = true;

			});

		});

	},

};

val.init();