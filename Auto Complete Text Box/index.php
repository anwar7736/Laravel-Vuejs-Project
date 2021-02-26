<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="vuejs.png"><title>PHP Vuejs Autocomplete Text Box</title>
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
      ul a:hover{
        color:red;
        background-color: darkgray;
      }
   	</style>
</head>
<body class="bg-secondary">
	<div id="autocomplete_app" class="container mt-4">
     <div class="card">
        <div class="card-header bg-info text-center text-light">
          <h1 class="card-title">Autocomplete Textbox with PHP Vuejs</h1><br>  
        </div>  
        <div class="card-body bg-light">
          <div class="row">
            <div class="col-md-3">
              
            </div> 
            <div class="col-md-6">
                <auto-complete></auto-complete>
            </div> 
            <div class="col-md-3">
              
            </div>
          </div>
      </div>
   </div>
  </div>
	<script type="text/javascript">
    Vue.component("auto-complete", {
      template : `
        <div>
          <label><strong>District Name</strong></label>
          <input type="text" class="form-control" placeholder="Enter district name...." v-model="district" @keyup="getData()" autocomplete="off">
          <div class="card-footer" v-if="all_data.length">
            <ul class="list-group">
              <a href="#" v-for="(row, i) in all_data" class="list-group-item" @click="Value(row.i)">{{row.dist_name}}</a>
            </ul>
          </div> 
        </div>
      `,
      data : function(){
        return {
          district : '',
          all_data : []
        }
      },
      methods : {
          getData : function(){
            this.all_data = [];
            axios.post('action.php', {
              district:this.district
            }).then(res => {
              this.all_data = res.data;
            })
          },
      },
      
    });
		var app = new Vue({
      el : '#autocomplete_app'
    });
	</script>
</body>
</html>