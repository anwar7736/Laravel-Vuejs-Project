<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="vuejs.png"><title>PHP Vuejs Email Availability</title>
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
        width: 80%;
        margin: 0 auto;
      }
   	</style>
</head>
<body class="bg-secondary">
	<div id="userApp" class="container mt-4">
		  <div class="card">
        <div class="card-header bg-info text-center text-light">
          <h1 class="card-title">Email Address Availability with PHP Vuejs</h1><br>  
        </div>  
        <div class="card-body bg-light">
          <h2 align="center">User Registration</h2><hr>
          <div class="form-group">
            <label>Email Address </label>
            <input type="email" class="form-control" v-model="email" @keyup="checkEmail()">
            <span :class="className">{{message}}</span>
          </div>
          <div class="form-group">
            <label>Password </label>
            <input type="password" class="form-control" v-model="password">
          </div>
          <div class="form-group" align="center">
            <button class="btn btn-success" :disabled="is_disable">Register</button>
          </div>
      </div>
	 </div>
  </div>
	<script type="text/javascript">
		var app = new Vue({
      el : '#userApp',
      data : {
       email : '',
       password : '',
       className : '',
       message : '',
       is_disable : false
      },
      methods : {
        checkEmail : function(){
          var email = app.email.trim();
          if(email.length > 2){
            axios.post('action.php', {
              email:email
            }).then(function(res){
              if (res.data.is_available=='Yes') {
                app.message = 'Email address is available';
                app.className = 'text-success';
                app.is_disable = false
              }
              else{
                app.message = 'Email address is not available';
                app.className = 'text-danger';
                app.is_disable = true
              }
            })
          }
        }
      },
    });
	</script>
</body>
</html>