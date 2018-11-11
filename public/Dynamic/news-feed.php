
<!DOCTYPE html>
<html>

<head>

<title>Connect | newsfeed</title>
    <?php include "Common/header.blade.php";?>

	 <link rel="shortcut icon" type="image/png" href="images/fav.png"/>
	 <link rel="stylesheet" href="css/ionicons.min.css" />
</head>


<body>
	

	<div class="wrapper">



        <?php include "Common/navbar.blade.php";?>

		<main>
			<div class="main-section" style="margin-top: 20px;">
				<div class="container">
					<div class="main-section-data">
						<div class="row">
							<div class="col-lg-3 col-md-4 pd-left-none no-pd">
								<div class="main-left-sidebar no-margin">
                                    <?php include "Home/userdata.blade.php";?>
                                    <?php include "Home/suggestionsPeople.blade.php";?>
                                    <?php include "Home/tags.blade.php";?>
								</div><!--main-left-sidebar end-->
                            </div>
							<div class="col-lg-6 col-md-8 no-pd">
								<div class="main-ws-sec">

                                    <div class="post-topbar">
                                        <div class="user-picy">
                                            <img src="images/resources/user-pic.png" alt="">
                                        </div>
                                        <div class="post-st">
                                            <ul>
                                                <li><a class="post_project" href="#" title="">Create Project</a></li>
                                                <li><a class="post-jb active" href="#" title="">Write Post</a></li>
                                            </ul>
                                        </div><!--post-st end-->
                                    </div><!--post-topbar end-->

									

									
									
									
									<div class="posts-section">
                                        <?php include "Home/post.blade.php";?>
                                        <?php include "Home/topProfile.blade.php";?>
										<div class="posty">
                                            <?php include "Home/post.blade.php";?>
                                            <?php include "Home/comment.blade.php";?>
										</div><!--posty end-->
                                        <?php include "Common/bounce.blade.php";?>
									</div><!--posts-section end-->
								</div><!--main-ws-sec end-->
							</div>
							<div class="col-lg-3 pd-right-none no-pd">
								<div class="right-sidebar">
                                    <?php include "Home/topProject.blade.php";?>

                                    <?php include "Home/mostviewed.blade.php";?>
								</div><!--right-sidebar end-->
							</div>
						</div>
					</div><!-- main-section-data end-->
				</div> 
			</div>
		</main>



        <?php include "Home/status.blade.php";?>








        <?php include "Home/chatbox.blade.php";?>

	</div><!--theme-layout end-->



    <?php include "Common/script.blade.php";?>
	
	

</body>


</html>