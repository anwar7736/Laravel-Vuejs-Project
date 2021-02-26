<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="vuejs.png"><title>Dynamic Dependent Select Box</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"></head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="vue.js"></script>
    <script type="text/javascript" src="axios.js"></script>
   	<style type="text/css">
   		.card{
   			width: 60%;
   			margin: 0 auto;
   		}
   	</style>
</head>
<body class="bg-secondary text-light">
	<div id="dynamicApp" class="container mt-4">
		<div class="card">
			<div class="card-header bg-info text-center">
				<h1 class="card-title"><strong>Dynamic Dependent Select Box with PHP Vuejs</strong></h1>
			</div>
			<div class="card-body bg-success text-dark">
				<div class="form-group">
					<label><strong>Select Division</strong></label>
					<select class="form-control" v-model="select_division" @change="fetchDistrict">
						<option value="">Select Division</option>
						<option v-for="data in division_data" :value="data.division_id">{{data.division_name}}</option>	
					</select>
				</div>
				<div class="form-group">
					<label><strong>Select District</strong></label>
					<select class="form-control" v-model="select_district" @change="fetchState">
						<option value="">Select District</option>
						<option v-for="data in district_data" :value="data.district_id">{{data.district_name}}</option>	
					</select>
				</div>
				<div class="form-group">
					<label><strong>Select State</strong></label>
					<select class="form-control" v-model="select_state">
						<option value="">Select State</option>
						<option v-for="data in state_data" :value="data.state_id">{{data.state_name}}</option>	
					</select>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var app = new Vue({
			el : '#dynamicApp',
			data : {
				select_division : '',
				division_data   : '',
				select_district : '',
				district_data   : '',
				select_state 	: '',
				state_data  	: '',
			},
			methods : {
				fetchDivision : function(){
					axios.post('action.php', {
						request_for : 'Division'
					}).then(function(res){
						app.division_data 	= res.data;
						app.select_district = '';
						app.district_data   = '';
						app.select_state  	= '';
						app.state_data 		= '';
					})
				},
				fetchDistrict : function(){
					axios.post('action.php', {
						request_for : 'District',
						division_id : this.select_division
					}).then(function(res){
						app.district_data 	= res.data;
						app.select_state 	= '';
						app.select_state  	= '';
						app.state_data 		= '';
					})
				},
				fetchState : function(){
					axios.post('action.php', {
						request_for : 'State',
						district_id : this.select_district
					}).then(function(res){
						app.state_data 	= res.data;
						app.select_state  	= '';
					})
				}

			},
			created : function(){
				this.fetchDivision();
			}
		});

	</script>
</body>
</html>