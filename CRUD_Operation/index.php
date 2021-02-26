<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="vuejs.png"><title>PHP Vuejs CRUD Operation</title>
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
   		.modal-mask{
   			position: fixed;
   			z-index: 9998;
   			top: 0;
   			left: 0;
   			width: 100%;
   			height: 100%;
   			background-color: rgba(0, 0, 0, .5);
   			display: table;
   			transition: opacity .3s ease;
   		}
   		.modal-wrapper{
   			display: table-cell;
   			vertical-align: middle;
   		}
   	</style>
</head>
<body class="bg-secondary text-light">
	<div id="crudApp" class="container mt-4">
		<div class="card">
			<div class="card-header bg-info text-center">
				<h2 class="card-title">PHP Vuejs CRUD Operation</h2>
			</div>
			<div class="card-body">
				<div align="right">
					<input type="button" class="btn btn-success mb-2" @click="openModel" value="Add">
				</div>
				
				<table class="table table-bordered table-striped">
					<thead class="bg-dark text-center text-light">
						<tr>
							<th>Serial</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(row, i) in allData">
							<td>{{i+1}}</td>
							<td>{{row.first_name}}</td>
							<td>{{row.last_name}}</td>
							<td class="text-center"><button class="btn btn-info" @click="ReadyById(row.id)">Edit</button> | <button class="btn btn-danger" @click="DeleteById(row.id)">Delete</button></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div v-if="myModel">
			<transition name="model">
				<div class="modal-mask">
			  		<div class="modal-wrapper">
					    <div class="modal-dialog">
						    <div class="modal-content">
						        <div class="modal-header text-dark">
						          <h4 class="modal-title"><strong>{{dynamicTitle}}</strong></h4><br><br>
						          <div id="message" class="ml-3" style="font-size: 18px">
						          	
						          </div><br>
						          <button type="button" class="close" @click="myModel = false" title="Close"><span aria-hidden="true">&times;</span></button>
						        </div>
						        <div class="modal-body text-dark">
						          <div class="form-group">
						          	<strong><label>Enter First Name</label><span class="text-danger"> * </span></strong>
						          	<input type="text" v-model="first_name" class="form-control">
						          </div>
						          <div class="form-group">
						          	<strong><label>Enter Last Name</label><span class="text-danger"> * </span></strong>
						          	<input type="text" v-model="last_name" class="form-control">
						          </div>
						          <br>
						          <div align="center">
						         	<input type="hidden" v-model="hiddenId">
						         	<input type="button" class="btn btn-success btn-xs" v-model="actionButton" @click="submitData">
						          </div>
						        </div>
						        
						    </div>
					    </div>
					</div>
				</div>
			</transition>

  		</div>
	</div>
	<script type="text/javascript">
		var application = new Vue({
			el : '#crudApp',
			data : {
				allData      : '',
				myModel		 : false,
				dynamicTitle : 'Add Data',
				actionButton : 'Insert',
				hiddenId     : '',
			},
			methods : {
				fetchAllData : function(){
					axios.post('action.php', {
						action : 'fetchall'
					}).then(function(response){
						application.allData = response.data;
					});
				},
				ReadyById : function(id){
					axios.post("action.php", {
						action : 'ReadyById',
						id     : id
					}).then(function(response){
						application.myModel = true;
						application.first_name = response.data.first_name;
						application.last_name = response.data.last_name;
						application.dynamicTitle = 'Edit Data';
						application.hiddenId = response.data.id;
						application.actionButton = 'Update';
					});
				},
				DeleteById : function(id){
					if (confirm('Do you want to delete this user?')) {
						axios.post("action.php", {
							action   : 'delete',
							id : id
						}).then(function(response){
							application.fetchAllData();
							alert(response.data.message);
						});
					}
				},
				openModel : function(){
					application.first_name   = '';
					application.last_name    = '';
					application.actionButton = 'Insert';
					application.dynamicTitle = 'Add Data';
					application.myModel      = true;

				},
				submitData : function(){
					if(application.first_name!='' && application.last_name!=''){
						if (application.actionButton=='Insert') {
							axios.post("action.php", {
							action    : 'insert',
							firstName : application.first_name,
							lastName  : application.last_name
						}).then(function(response){
							application.myModel    = false;
							application.first_name = '';
							application.last_name  = '';	
							application.fetchAllData();
							alert(response.data.message);
						});
						}
						if(application.actionButton == 'Update'){
							axios.post("action.php", {
								action    : 'update',
								firstName : application.first_name,
								lastName  : application.last_name,
								hiddenId  : application.hiddenId
							}).then(function(response){
								application.myModel    = false;
								application.first_name = '';
								application.last_name  = '';	
								application.fetchAllData();
								alert(response.data.message);
							});
						}
					}
					else{
						$("#message").html("<span class='text-danger'>***Field must not be empty***</span>");
					}
				},

			},
			created : function(){
				this.fetchAllData();
			}
		});

	</script>
</body>
</html>