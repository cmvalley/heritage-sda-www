<!--PHP page variables and include head.php for HTML head, header and navigation-->
<?php 
	$pagename='Home'; 
	$pageurl='index.php';
	include('head.php');
?>
	

			<div class="hero">
				<div class="slides">
					<li data-bg-image="images/Gods_word_love.png">
						<div class="container">
							<div class="slide-content">
								<small class="slide-subtitle">Heritage Douglasville</small>
								<h2 class="slide-title">God is Love</h2>

								
							</div>
						</div>
					</li>

					<li data-bg-image="images/tn-head-dh2.jpg">
						<div class="container">
							<div class="slide-content">
								<small class="slide-subtitle">Heritage Douglasville </small>
								<h2 class="slide-title">Love lives here</h2>

								
							</div>
						</div>
					</li>
				</div>
			</div>

			<main class="main-content">
				<div class="fullwidth-block">
					<div class="container">
						<h2 class="section-title">Daily Bread</h2>

						<?php include('back/load_daily_bread_index.php'); ?>
						</div> <!-- .row -->
					</div> <!-- .container -->
				</div> <!-- section -->
			

				<div class="fullwidth-block">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<h2 class="section-title">Upcoming events</h2>
								<ul class="event-list">
									<?php include ('back/load_events_index.php'); ?>
								</ul>

								<div class="text-center">
									<a href="events.php" class="button">See all events</a>
								</div>
							</div>
							<div class="col-md-6">
								<h2 class="section-title">Latest sermons</h2>
								<ul class="seremon-list large">
								<li>
<img src="images/tn-lg-IMG-0284.JPG" class="family-image" alt="">
										<div class="seremon-detail">
											<h3 class="seremon-title">The Dangers of Division</h3>
											<div class="seremon-meta">
												<div class="pastor"><i class="fa fa-user"></i> Sam Ball</div>
												<div class="date"><i class="fa fa-calendar"></i> 07 Jul 2018</div>
											</div>
											<p><audio controls>
  													<source src="audio/s-ball-the-dangers-of-division.mp3" type="audio/mpeg">
  												</audio></p>
										</div>
									</li>
								<li>
<img src="images/tn-lg-IMG-0284.JPG" class="family-image" alt="">
										<div class="seremon-detail">
											<h3 class="seremon-title">I Need A Refuge</h3>
											<div class="seremon-meta">
												<div class="pastor"><i class="fa fa-user"></i> Ronnie Gooch</div>
												<div class="date"><i class="fa fa-calendar"></i> 30 Jun 2018</div>
											</div>
											<p><audio controls>
  													<source src="audio/r-gooch-i-need-a-refuge.mp3" type="audio/mpeg">
  												</audio></p>
										</div>
									</li>
									
									
								
									
								</ul>

								<div class="text-center">
									<a href="sermons.php" class="button">See all sermons</a>
								</div>

							</div>
						</div> <!-- .row -->
					</div> <!-- .container -->
				</div> <!-- section -->
			</main> <!-- .main-content -->

<?php include('footer.php'); ?><!-- Site Footer contained in external file -->


</html>