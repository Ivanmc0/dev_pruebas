var Platform = {

	Climate : function( ){

		let fecha = new Date();
		let month = fecha.getMonth();
		let day   = fecha.getDate();
		let hour  = fecha.getHours();
		let min   = (fecha.getMinutes() < 10) ? "0"+fecha.getMinutes() : fecha.getMinutes();
		let sec   = fecha.getSeconds() < 10 ? "0"+fecha.getSeconds() : fecha.getSeconds();
		let zone  = (hour > 12) ? "pm" : "am";
		let icono = this.GetClimateIcon(hour);
		    hour  = (hour > 12) ? hour-12 : hour;
		    hour  = (hour == 0) ? 12 : hour;
		    hour  = (hour < 10) ? "0"+hour : hour;

		$("#clime-time").html(hour+":"+min);
		$("#clime-sec").html(sec);
		$("#clime-date").html(day+" de "+this.GetMonth(month));
		$("#clime-day").html(this.GetDay(fecha));
		$("#clime-zone").html(zone);
		$("#clime-image").css("background-image","url('"+dominion+"resources/img/clima/"+icono+".png')");

		setTimeout(function(){ Platform.Climate(); }, 1000);
	},

	GetClimateIcon : function( hour ){
		let iconos = [
			'moon','moon','moon','moon','moon',
			'moon2','moon2','moon2',
			'sunny2','sunny2','sunny2',
			'sunny','sunny','sunny','sunny','sunny',
			'sunny2','sunny2','sunny2',
			'moon2','moon2','moon2',
			'moon','moon',
			'cloud'
		];
		return iconos[hour];
	},

	GetMonth : function( month ){
		let meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre", "Noviembre","Diciembre"];
		return meses[month-1];
	},

	GetDay : function( fecha ){
		let dias = ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"];
		return dias[fecha.getDay()];
	},

	RefreshCo : function(Coo,Ses ){

		$.post(dominion+"models/transversales/refreshCo.php", {Coo,Ses},
		function(data){
			$(".rtn-transversal").html(data);
		});
	},

 

};