<!--PHP page variables and include head.php for HTML head, header and navigation-->
<?php 
	$pagename='Events'; 
	$pageurl='events.php';
	include('head.php'); 
?>


			<main class="main-content">
				<div class="fullwidth-block">
					<div class="container">
						<div class="row">
							<div class="content col-md-8">
								<h2 class="section-title">Featured Events</h2>
								<ul class="event-list large">
									<?php $eventtype="Featured"; include('back/load_events_events.php'); ?>
								</ul> 
								<p></p>
								<h2 class="section-title">Upcoming Events</h2>
								<ul class="event-list large">
									<?php $eventtype="Upcoming"; include('back/load_events_events.php');  ?>
								</ul>
							</div>
							
							<div class="sidebar col-md-3 col-md-offset-1">
								<div class="widget">
									<h3 class="widget-title">Signup</h3>
									<p>See all of our upcoming event registration and volunteer signups by clicking below.</p>
									<ul class="event-list large">
										<li>
									<a href="http://signup.com/go/wSFjuoS" class="button">Register/Volunteer</a>
										</li>
									</ul>
								</div>
								<!--
								<div class="widget">
									<h3 class="widget-title">Categories</h3>
									<ul class="arrow">
										<li><a href="#">Perspiciatis unde</a></li>
										<li><a href="#">Omnis iste natus</a></li>
										<li><a href="#">Voluptatem accusantium</a></li>
										<li><a href="#">Doloremque eaque</a></li>
										<li><a href="#">Totam rem aperiam</a></li>
									</ul>
								</div>

								<div class="widget">
									<h3 class="widget-title">Donations</h3>
									<p>Distinctio unde consequuntur delectus, repudiandae, impedit atque earum adipisci, explicabo perferendis.</p>
									<a href="#" class="button">Make a donation</a>
								</div>

								<div class="widget">
									<h3 class="widget-title">Gallery updates</h3>

									<div class="galery-thumb">
										<a href="#"><img src="images/gallery-thumb-1.jpg" alt=""></a>
										<a href="#"><img src="images/gallery-thumb-2.jpg" alt=""></a>
										<a href="#"><img src="images/gallery-thumb-3.jpg" alt=""></a>
										<a href="#"><img src="images/gallery-thumb-4.jpg" alt=""></a>
										<a href="#"><img src="images/gallery-thumb-5.jpg" alt=""></a>
										<a href="#"><img src="images/gallery-thumb-6.jpg" alt=""></a>
									</div>
								</div>
								-->
								
							</div>
							
						</div>
						
					</div>
				</div>
			</main> <!-- .main-content -->
<?php include('footer.php'); ?> <!-- Site Footer contained in external file -->
</html>