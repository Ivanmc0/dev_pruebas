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

	openTable : function(table){
		$("#"+table).slideToggle();
	},


	ggg : function(lienzo, dation, design = '#ffffff', focus = false){

		var titleColor 	= (design == '#ffffff') ? "black": "white";
		var textColor 	= (design == '#ffffff') ? "#666": "#ccc";
		var gridColor 	= (design == '#ffffff') ? "rgba(0,0,0,0.1)": "rgba(255,255,255,0.5)";

		dation = JSON.stringify(dation);
		dation = JSON.parse(dation);
		// console.log(dation);

		let lbls = [];
		dation.labels.forEach(element => {
			lbls.push(element);
		});
		// console.log(lbls);

		let backgroundColor = [
			'rgb(154, 102, 254)',
			'rgb(252, 206, 87)',
			'rgb(29, 196, 255)',
			'rgb(255, 100, 132)',
			'rgb(76, 192, 191)',
			'rgb(255, 159, 64)',
			'rgb(146, 208, 80)',
			'rgb(185, 123, 61)',
			'rgb(71, 71, 255)',
			'rgb(242, 0, 179)'
		];

		let borderWidth = [ 1, 1, 1, 1, 1, 1, 1, 1, 1, 1 ];
		if(focus) borderWidth[0] = 4;

		let dtsts = [];
		Object.values(dation.datasety).forEach((element, index) => {
			// console.log(index);
			let datt2 = [];
			element.data.forEach(element3 => { datt2.push(parseFloat(element3).toFixed(2)); });
			dtsts.push(
				{
					label : element.label,
					data : datt2,
					backgroundColor : backgroundColor[index],
					borderColor: backgroundColor[index],
					color: backgroundColor[index],
					borderWidth: borderWidth[index],
				}
			);
		});
		// console.log(dtsts);


		const plugin = {
			id: 'customCanvasBackgroundColor',
			beforeDraw: (chart, args, options) => {
			  const {ctx} = chart;
			  ctx.save();
			  ctx.globalCompositeOperation = 'destination-over';
			  ctx.fillStyle = options.color || '#99ffff';
			  ctx.fillRect(0, 0, chart.width, chart.height);
			  ctx.restore();
			}
		  };


		Chart.register(ChartDataLabels);

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
				  beginAtZero: false,
				  grace: 0.1,
				  ticks: {
					color: textColor,
				  },
				  grid: {
					  color: gridColor,
				  }

				},
				x: {
					ticks: {
						color: textColor,
					},
					grid: {
						color: gridColor,
					}
				},
			  },
			  plugins: {
				datalabels: {
					anchor: 'end',
					align: 'top',
					color: textColor,
					// formatter: Math.round,
					font: {
						weight: 'bold',
						size: 12
					}
				},
				// legend: true,
				legend: {
					labels: {
						color: titleColor
					}
				},
				customCanvasBackgroundColor: {
					color: design,
				}
			  },
			//   indexAxis: 'y',


			},
			plugins: [plugin],

		  });

		// // var url_base64jp = document.getElementById(lienzo).toDataURL("image/jpg");
		// var image = chart.toBase64Image();
		// console.log(image);


		// document.getElementById('link29').setAttribute('href', image);







		//   {
		// 	label: 'Criterio 2',
		// 	data: [19, 3, 5, 2, 3, 10],
		// 	// borderWidth: 1,
		// 	// borderColor: '#00c337',
		// 	  // backgroundColor: 'red',
		// 	//   borderRadius: 50,
		// 	//   type: 'bar',
		//   }

		console.log(lienzo);
		document.getElementById(lienzo+"-info-graph").addEventListener('click', function(){
			var url_base64jp = document.getElementById(lienzo).toDataURL("image/jpg");
			var a =  document.getElementById(lienzo+"-info-graph");
			a.href = url_base64jp;
		});


		// var a = document.createElement('a');
		// a.href = chart.toBase64Image();
		// a.download = 'my_file_name.png';

		// // Trigger the download
		// a.click();



	},




};

Graphion.init();