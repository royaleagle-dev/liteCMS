
<?php 
define('root', '/liteCMS/');
 ?>
<!DOCTYPE html>
<html>
	<head>
		<title>
New Post
</title>
		<link rel = "stylesheet" href = "<?php  echo root  ?>static/css/">
		<link rel = "stylesheet" href = "<?php  echo root  ?>static/css/theme.css">
		<link rel = "stylesheet" href = "<?php  echo root  ?>static/trumbowyg/dist/ui/trumbowyg.min.css">
		<!--<meta name = "viewport" content = "width=device-width, initial-scale=1.0">-->
	</head>
	<body>
		<div class = "container-fluid">

			<section class = "sidebar">
				<div>
					<p class = "brand text-center">LiteCMS</p>
				</div>
				<ul>
					<li class = "nav" id = "nav1" data-dest = "<?php echo root; ?>admin" onclick = "navigate('nav1')">Dashboard</li>
					<li class = "nav" id = "nav4" data-dest = "<?php echo root; ?>admin/posts" onclick = "navigate('nav4')">Blog Posts</li>
					<li class = "nav" id = "nav2" data-dest = "<?php echo root; ?>admin/users" onclick = "navigate('nav2')">Users</li>
					<li class = "nav" id = "nav3" data-dest = "<?php echo root; ?>admin/others" onclick = "navigate('nav3')">Others</li>
				</ul>
			</section>
			<section class = "other-nav">

			</section>
			<section class = "main-area" style = "margin-left:15%;padding:5px;">
				<div class = "container">
					<div style = "background-color:var(--light_blue_1);padding:15px;position:fixed;right:0;width:100%;top:0;" align = "right">
						<a class = "top-item" href = "<?php echo root; ?>admin/new_post" style = "background-image:url('<?php echo root; ?>static/img/add.png')">New Post</a>
						<a class = "top-item" href = "" style = "background-image:url('<?php echo root; ?>static/img/settings.png')">Settings</a>
						
					</div>
					
<div class = "new-post" style = "margin-top:60px;">

	<div contenteditable="true" class = "post-title">Title Here</div>
	<hr style = "width:100%" align = "left">

	<div id = "editor" style = "font-size:1.5rem;">
	</div>

	<div style = "display:grid;grid-template-columns:1fr 1fr;grid-gap:10px;">
		<div>
			<select name = "tags[]" style = "height:100px;width:100%;overflow-y:scroll" multiple>
				<option value = '1'>--Select Tags</option>
				<option value = '2'>Okay 1</option>
				<option value = '3'>Okay 2</option>
				<option value = '4'>Okay 3</option>
				<option value = '5'>Okay 4</option>
				<option value = '6'>Okay 5</option>
			</select>
		</div>

		<div style = "display:grid;grid-template-rows:1fr 1fr 1fr;grid-row-gap:10px;align-items:right;">
			<div>
				<button disabled>Author: Ayotunde</button>
			</div>
			<div>
				<button>Save as Draft</button>
			</div>
			<div>
				<button>Publish</button>
			</div>

		</div>

	</div>

	
</div>

				</div>						
			</section>

			<section class = "footer">

			</section>

			<script src = "<?php echo root; ?>static/js/jquery-3.5.1.js"></script>
			<script>
				const navItems = document.querySelectorAll(".nav");
				
				current_location = window.location.hash;
				console.log(current_location);

				current_id = current_location.replace('#', '');
				console.log(current_id);
				current_element = document.getElementById(current_id);
				current_element.classList.add("addBlue");

				function navigate(id){
					const element = document.getElementById(id);
					const dest = element.dataset['dest'];
					//console.log(dest);
					let newUrl = dest+"#"+id
					window.location = newUrl;
				}
			</script>
			
<script src = "<?php echo root ?>static/trumbowyg/dist/trumbowyg.min.js"></script>
<script src = "<?php echo root ?>static/editor.js"></script>

		</div>
	</body>
</html>





