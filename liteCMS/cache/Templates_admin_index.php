
<?php 
define('root', '/liteCMS/');
 ?>
<!DOCTYPE html>
<html>
	<head>
		<title>
Dashboard
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
					
<div class = "info-row text-center" style = "padding-top:60px;">
	<div class = "d_top" id = "post_count">
		<img src = "static/img/users.png">
		<p>Users</p>
	</div>

	<div class = "d_top" id = "users_count">
		<img src = "static/img/posts.png">
		<p>Blog Posts</p>
	</div>

	<div class = "d_top" id = "other_count">
		<img src = "static/img/uploads.png">
		<p>Uploads</p>
	</div>
</div>

<div class = "main-row text-center">
	<div>
		<h4>Recent Activities</h4>
		<hr>
	</div>

	<h5 align = "left">New Blog Posts</h5>

	<?php foreach ($post_list as $post): ?>
	<div align = "left" class = "box">
		<h3 style = "display:inline"><?php echo $post->title ?></h3>
		<section style = "display:inline;float:right;">
			<a class = "" href = "" style = ""><img src = "<?php echo root; ?>static/img/edit.png" style = "height:4vh"></a>
			<a class = "" href = "" style = ""><img src = "<?php echo root; ?>static/img/trash.png" style = "height:4vh"></a>
		</section>
	</div>
	<?php endforeach; ?>

	<hr>

	<h5 align = "left">Media Uploads</h5>

	<div align = "left" class = "box">
		<input type = "checkbox" value = "1" checked style = "display:inline;width:inherit;margin-bottom:0;">
		<h3 style = "display:inline">Media Title Goes Here</h3>
		<section style = "display:inline;float:right;">
			<button>View</button>
			<button>Delete</button>
		</section>
	</div>

	<hr>

	<h5 align = "left">Notifications</h5>

	<div align = "left" class = "box">
		<input type = "checkbox" value = "1" checked style = "display:inline;width:inherit;margin-bottom:0;">
		<h3 style = "display:inline">Notification goes here</h3>
		<section style = "display:inline;float:right;">
			<button>Read More</button>
			<button>Delete</button>
		</section>
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
			

		</div>
	</body>
</html>






