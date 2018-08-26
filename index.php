<!--PHP page variables and include head.php for HTML head, header and navigation-->
<?php 
	$pagename='Home'; 
	$pageurl='index.php';
	$pagedesc='Welcome to the Heritage Seventh-Day Adventist (SDA) Church, 
	location: 6969 Highway 5, Douglasville, GA. 5, 15 minutes south from exit 34 on the I-20.
	We are a Christian community and would love to have you join us for Bible study, worship, and prayer,
	Senior Pastor: Sam Ball';
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
									<?php include('back/load_events_index.php'); ?>
								</ul>

								<div class="text-center">
									<a href="events.php" class="button">See all events</a>
								</div>
							</div>
							<div class="col-md-6">
								<h2 class="section-title">Latest sermons</h2>
								<ul class="seremon-list index">
									<?php include('back/load_sermons_index.php'); ?>									
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