<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="vuejs.png"><title>PHP Vuejs Live Data Search</title>
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
<body class="bg-secondary text-light">
	<div id="SearchApp" class="container mt-4">
		  <div class="card">
        <div class="card-header bg-dark text-center">
          <h1 class="card-title">Live Data Search with PHP Vuejs</h1><br>  
        </div>  
        <div class="card-body bg-success">
          <div class="form-group" align="right">
            <input class="px-4 py-1" type="text" placeholder="Search here..." v-model="search" @keyup="getData()">
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-striped bg-info text-light text-center">
              <thead class="bg-secondary">
                <tr>
                  <th>Serial</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                </tr>
              </thead>
              <tbody align="center">
                <tr v-for="(row, i) in allData">
                  <td>{{i+1}}</td>
                  <td>{{row.first_name}}</td>
                  <td>{{row.last_name}}</td>
                </tr>
              </tbody>
              </div>
            </table>
             <div align="center" v-if="nodata">
                <h1>No Data Found!</h1>
          </div>
        </div>  
      </div>
	</div>
	<script type="text/javascript">
		var app = new Vue({
      el : '#SearchApp',
      data : {
        search : '',
        allData : '',
        nodata : false
      },
      methods : {
        getData : function(){
          axios.post('action.php', {
            search : this.search
          }).then(function(res){
            if (res.data.length > 0) {
              app.allData = res.data;
              app.nodata = false
            }else{
               app.allData ='';
              app.nodata = true
            }
          });
        }
      },
      created : function(){
        this.getData();
      }
    });
	</script>
</body>
</html>