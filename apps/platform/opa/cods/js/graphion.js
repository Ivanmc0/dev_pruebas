var Graphion = {

	init : function(){

		$(document).ready(function() {

			console.log ("GRAPHION");

			window.addEventListener('beforeprint', () => {
				myChart.resize(600, 600);
			});
			window.addEventListener('afterprint', () => {
				myChart.resize();
			});

		});

	},


	ggg : function(lienzo, dation, design = 'default'){

		dation = JSON.stringify(dation);
		dation = JSON.parse(dation);
		// console.log(dation);

		let lbls = [];
		dation.labels.forEach(element => {
			lbls.push(element);
		});
		// console.log(lbls);

		let dtsts = [];
		Object.values(dation.datasety).forEach(element => {
			let datt2 = [];
			element.data.forEach(element3 => { datt2.push(parseFloat(element3).toFixed(2)); });
			dtsts.push({label : element.label, data : datt2 });
		});
		console.log(dtsts);


		const chart = new Chart(lienzo, {

			type: dation.graph,
			data: {
			  labels: lbls,
			  datasets: dtsts,
			},
			options: {
			  maintainAspectRatio: false,
			  scales: {
				y: {
				  //beginAtZero: true
				}
			  },
			//   indexAxis: 'y',

			}
		  });

		//   {
		// 	label: 'Criterio 2',
		// 	data: [19, 3, 5, 2, 3, 10],
		// 	// borderWidth: 1,
		// 	// borderColor: '#00c337',
		// 	  // backgroundColor: 'red',
		// 	//   borderRadius: 50,
		// 	//   type: 'bar',
		//   }

	},


};

Graphion.init();