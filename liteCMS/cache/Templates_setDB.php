<?php 
define('root', '/liteCMS/');
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>
<?php echo $title ?>
</title>
        <link rel = "stylesheet" href = "<?php echo root; ?>static/css/theme.css">
    </head>
    <body>
    	<div class = "container">
        	<section id = "head">
        		
<div class = "text-right" style = "padding:15px;">
	<button type = "button" class = "btn btn-neut btn-light" id = "next">Next</button>
</div>

        	</section>

        	<section id = "content">
        		
<div style = "margin:0 auto;margin-top:7%;margin-left:30%" class = "main-set-form-div">
	<h2 class = "text-center">Setting Up</h2>
	<form>
		<input type = "text" name = "dbase_name"><br>
		<input type = "email" name = "email"><br>
		<input type = "password" name = "password"><br>
	</form>
</div>
<hr style = "width:70%;align:center">
<p class = "text-center">**Input the name of the database you want to use <br>and your preferred email and password when loggin in</p>
<p class = "text-center">**This Database must have been created beforehand <br>else, it won't work if you just inpu the name.</p>

<?php 
echo file_get_contents('settings.ini');
 ?>


        	</section>

        	<section id = "foot">
        		<p>LiteCMS</p>
        	</section>
        </div>

        <script src = "<?php echo root; ?>static/js/jquery-3.5.1.js"></script>
        
<script>
	const submitBtn = document.querySelector("#next");
	function submitData(){
		const dbase_name = document.querySelector("input[name='dbase_name']");
		const email = document.querySelector("input[name='email']");
		const password = document.querySelector("input[name='password']");
		let testObj = {
			'dbase_name':dbase_name.value,
			'email':email.value,
			'password':password.value,
		}

		$.ajax({
			'url': 'setDB.php',
			'type': 'POST',
			'data': testObj,
			success: function(response){
				//console.log(response);
				let location = JSON.parse(response);
				location = location.referrer;
				console.log(location)
				window.location = location;

			},

		})
		//console.log(testObj);
		//window.location = "setDB/setup";
	}
	submitBtn.addEventListener('click', submitData);
</script>

    </body>
</html>








