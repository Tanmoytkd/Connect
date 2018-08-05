
<!DOCTYPE html>
<html>

<head>
<title>Connect|message</title>
    <?php include "Common/header.blade.php";?>


</head>


<body>
	

	<div class="wrapper">
        <?php include "Common/navbar.blade.php";?>



		<section class="messages-page">
			<div class="container">
				<div class="messages-sec">
					<div class="row">
						<div class="col-lg-4 col-md-12 no-pdd">
							<div class="msgs-list">
                                <?php include "Message/messageHead.blade.php";?>

								<div class="messages-list">
									<ul>

                                        <?php include "Message/active.blade.php";?>
                                        <?php include "Message/inactive.blade.php";?>



									</ul>
								</div><!--messages-list end-->
							</div><!--msgs-list end-->
						</div>
						<div class="col-lg-8 col-md-12 pd-right-none pd-left-none">

                            <?php include "Message/messagebody.blade.php";?>

						</div>
					</div>
				</div><!--messages-sec end-->
			</div>
		</section><!--messages-page end-->



        <?php include "Message/footer.blade.php";?>

	</div><!--theme-layout end-->


    <?php include "Common/script.blade.php";?>


</body>


</html>