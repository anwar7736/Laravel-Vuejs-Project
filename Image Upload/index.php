<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="vuejs.png"><title>PHP Vuejs - Image Upload</title>
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
        width: 70%;
        margin: 0 auto;
      }
   	</style>
</head>
<body class="bg-secondary">
	<div id="uploadApp" class="container mt-4">
		  <div class="card">
        <div class="card-header bg-info text-center text-light">
          <h1 class="card-title">Image Upload with PHP Vuejs</h1><br>  
        </div>  
        <div class="card-body bg-light">
          <div v-if="successAlert" class="alert alert-success alert-dismissible">
            <button class="close" @click="successAlert=false" title="Close">&times;</button>
            {{successMessage}}
          </div> 
          <div v-if="errorAlert" class="alert alert-danger alert-dismissible">
            <button class="close" @click="errorAlert=false" title="Close">&times;</button>
            {{errorMessage}}
          </div>
          <div class="col-md-4">
            <label>Select Image : </label>
            <input type="file" ref="file">
          </div><br>
          <div class="col-md-4">
            <button class="btn btn-success" @click="uploadImage">Upload</button>
          </div>
          <div v-html="uploadedImage" align="center"></div>
      </div>
	 </div>
  </div>
	<script type="text/javascript">
		var app = new Vue({
      el : '#uploadApp',
      data : {
          file            : '',
          successAlert    : false,
          successMessage  : '',
          errorAlert      : false,
          errorMessage    : '',
          uploadedImage   : '',
        
      },
      methods : {
        uploadImage : function(){
         app.file = app.$refs.file.files[0];
          var formData = new FormData();
          formData.append('file', app.file);
          axios.post('upload.php', formData, {
            header : {
              'Content-Type' : 'multipart/form-data'
            }

          }).then(function(res){
            if (res.data.image == '') {
              app.errorAlert      = true;
              app.errorMessage    = res.data.message;
              app.successAlert    = false;
              app.successMessage  = '';
              app.uploadedImage   = '';
            }else{
              app.successAlert    = true;
              app.successMessage  = res.data.message;
              app.errorAlert      = false;
              app.errorMessage    = '';
              app.uploadedImage   = "<img src='"+res.data.image+"' class='img-thumbnail' width='300'>";
              app.$refs.file.value = '';
            }
          });
        }
        }
    })
	</script>
</body>
</html>