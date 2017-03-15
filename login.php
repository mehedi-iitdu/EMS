<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<div class="container">
		
	<form id="login_form" class="form-horizontal" role="form">

		<h2>Please Login</h2>
		<div class="form-group">
		    <label for="email" class="col-sm-3 control-label">Email</label>
		    <div class="col-sm-6">
		        <input type="email" id="email" name="email" placeholder="Email" class="form-control" data-required="true">
		    </div>
		</div>
		<div class="form-group">
		    <label for="password" class="col-sm-3 control-label">Password</label>
		    <div class="col-sm-6">
		        <input type="password" id="password" name="password" placeholder="Password" class="form-control" data-required="true">
		    </div>
		</div>

		<div class="form-group">
		    <div class="col-sm-6 col-sm-offset-3">
		        <button type="submit" class="btn btn-primary btn-block">Login</button>
		    </div>
		</div>
		
	</form>

	</div>

</body>

<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<script type="text/javascript">
	
	var border_color = "#C2C2C2";	

	$("#login_form").submit(function(e){

	    e.preventDefault();  
	    proceed = true; 
	    
	    $($(this).find("input[data-required=true], textarea[data-required=true]")).each(function(){
	            if(!$.trim($(this).val())){ 
	                $(this).css('border-color','red');    
	                proceed = false; 
	            }

	            var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
	            if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
	                $(this).css('border-color','red');   
	                proceed = false;              
	            }

	    }).on("input", function(){ 
	         $(this).css('border-color', border_color);
	    });


	    if(proceed){ 

	        $.ajax({

	        		url: "backend/login_helper.php",
	        		type: "POST",
	        		data:  new FormData(this),
	        		contentType: false,
	        		cache: false,
	        		processData:false,
	        		success: function(data){

	        			if(data=="Okay"){
	        				window.location.replace("http://localhost/Project/index.php");
	        			}
	        			else{
	        				alert("Invalid Email or Password");
	        			}
	        		}	        
	        		
	        });
	    }

	});


</script>

</html>