<!--PHP page variables and include head.php for HTML head, header and navigation-->
<?php 
	$pagename='Sermons'; 
	$pageurl='sermons.php';
	$featured='';
	include('head.php'); 
?>


			

			<main class="main-content">
				<div class="fullwidth-block">
					<div class="container">
						<div class="row">
							<div class="content col-md-12">
								<h2 class="section-title">Featured sermons</h2>
									<div class="row">
									<ul class="seremon-list large">
										
									<?php $featured=1; include('back/load_sermons_sermons.php'); ?>
								</ul>
						
										</div>
									</div>
											<div class="content col-md-12">				
								<br><h2 class="section-title">Latest sermons</h2>
								<div class="row">
							<ul class="seremon-list large">
							<?php $featured=0; include('back/load_sermons_sermons.php'); ?>
								</ul>
								
								</div></div>
							</div>
							
								
							</div>
						</div>
					</div>
				</div>
			</main> <!-- .main-content -->

			<?php include('footer.php'); ?> <!-- Site Footer contained in external file -->

</html>