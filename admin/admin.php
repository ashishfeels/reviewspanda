<?php
ob_start();
session_start();
require("connection.php");
// echo("{$_SESSION['u_name']}"."<br />");
	if (isset($_POST['submit'])) {
$movname= $_POST['movie'];
$release_d= $_POST['release'];
$director= $_POST['director'];
$starcast= $_POST['starcast'];
$gtags=	$_POST['gtags'];
$type=	$_POST['revtype'];
$topic= $_POST['edtopic'];
$content = $_POST['content'];
$postedby= $_POST['admin'];
$image = $_FILES['image'];
$imgname = $_FILES['image']['name'];
$temp_dest = $_FILES['image']['tmp_name'];
$file_dest = 'uploads/'.$imgname;
move_uploaded_file($temp_dest, $file_dest);
date_default_timezone_set("Asia/Calcutta");
$time = date("d-M-y");
$sql = "INSERT INTO  editorial (movname,release_d,director,starcast,edtopic,file_dest,edarticle,updated_by,updatetime,revtype,gtags) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
$stmt= $pdo->prepare($sql);
$x = $stmt->execute([$movname,$release_d,$director,$starcast,$topic,$file_dest,$content,$postedby,$time,$type,$gtags]);
if ($x) {
	echo 'Posted';
	header( 'Location:admin.php?post_successful');
}
else {
	echo 'Sorry';
}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>ReviewzPanda | Admin </title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
		<link rel="stylesheet" type="text/css" media="screen" href="css/adminstyle.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script src="/resources/ckeditor/ckeditor.js"></script>
		<script src="/js/script.js"></script>
	</head>
	<body>
		<!--------------------------------NAVIGATION BAR STARTS------------------------------------>
		
		<!--------------------------------NAVIGATION BAR ENDS------------------------------------>
		<div class="container content">
			<h3 class="text-center "> <strong> <em>ReviewsPanda Admin</em> </strong> </h3>
			<div class="text-right"><a class="btn btn-danger" href="logout.php" >Logout</a></div>
			<div class="row">
				<div class="col-md-2 admin-menu">
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link text-center active " id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Add Review</a>
						<a class="nav-link text-center" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Add XYZ</a>
						<a class="nav-link text-center" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Add XYZ</a>
						<a class="nav-link text-center" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">ADD XYZ</a>
					</div>
				</div>
				<div class="col-md-10 edit-content ">
					<div class="tab-content" id="v-pills-tabContent">
						<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
							<form action="admin.php" method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<label for="exampleFormControlInput1">Movie Name</label>
									<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Movie Name" name="movie" required>
								</div>
								<div class="form-group">
									<label for="exampleFormControlInput1">Release Date</label>
									<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Release Date" name="release" required>
								</div>
								<div class="form-group">
									<label for="exampleFormControlInput1">Director</label>
									<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Director" name="director" required>
								</div>
								<div class="form-group">
									<label for="exampleFormControlTextarea1">Star Cast</label>
									<textarea class="form-control" row='8' name="starcast"></textarea>
								</div>
								<div class="form-group">
									<label for="exampleFormControlInput1">Review Title</label>
									<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Keep it Cool" name="edtopic" required>
								</div>
								<div class="custom-file">
									
									<input type="file" class="custom-file-input" id="inputFile" name="image"/>
									<label class="custom-file-label" for="inputFile">Choose Poster</label>
									
								</div>
								<script>
								$('#inputFile').on('change',function(){
								//get the file name
								var fileName = $(this).val();
								//replace the "Choose a file" label
								$(this).next('.custom-file-label').html(fileName);
								})
								</script>
								<div class="form-group">
									<label for="exampleFormControlTextarea1">Review</label>
									<textarea class="ckeditor form-control " id="editor" row='8' name="content" ></textarea>
									<script>
									ClassicEditor
										.create( document.querySelector( '#editor' ) )
										.then( editor => {
										console.log( editor );
										} )
										.catch( error => {
										console.error( error );
										} );
										
									</script>
								</div>
								<div class="form-group">
									<label for="exampleFormControlTextarea1">Google tags</label>
									<textarea class="form-control" row='5' name="gtags"></textarea>
								</div>
								<div class="form-group">
									<label for="exampleFormControlInput1">Reviewed By</label>
									<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Added by" name="admin" required>
								</div>
								<!-- selector for no spoiler and full review -->
								<div><p>Is it a ?</p></div>
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<label class="btn btn-secondary active"> 
										<input type="radio" name="revtype" value="full"> Full Review.
									</label>
									<label class="btn btn-secondary">
										<input type="radio" name="revtype"  value="nospoiler"> No Spoiler !
									</label>
								</div>
								<div class="text-center">
									<button type="submit" class="btn btn-success btn-post" name='submit'>Post This</button>
								</div>
							</form>
						</div>
						<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">Dom </div>
						<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
						<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
					</div>
				</div>
				
			</div>
		</div>
		<!-----------------------------------------FOOTER ---------------------------------------->
		<footer >
			<div class=" container text-center">
				<p> Created with Curiosity |&nbsp;&copy; All Rights Reserved</p>
			</div>
		</footer>
		<!------------------------------------Bootsrap JS--------------------------------------->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>