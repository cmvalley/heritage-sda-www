<!--PHP page variables and include head.php for HTML head, header and navigation-->
<?php 
	$pagename='Contact Us'; 
	$pageurl='contact.php';
	$pagedesc="We'd love to hear from you! Find out more about our church, seek prayer, bible studies or join our family!";
	include('head.php'); 
	
?>
		
		<main class="main-content">
			<div class="fullwidth-block">
				<div class="container">
					<div class="row">
						<div class="content col-md-10 ">
							<form action="contactus.php" method="post">
								<input type="text" name="yourname" placeholder="Your Name" style=" border:solid 0.5px gray" /><br />
								<input type="text" name="address1" placeholder="Address" style="border:solid .5px gray"  /><br>
								<input type="text" name="address2" placeholder="Address 2" style="border:solid .5px gray" /><br>
								<input type="text" name="city" placeholder="City" style="border:solid .5px gray" /><br>
								<input type="text" name="state" style="border:solid .5px gray;" maxlength="2" placeholder="State" size="2"   /> 
								<input type="text" name="zip" placeholder="Zip Code" style="border:solid .5px gray;" maxlength="9" size="5" /><br>
								<input type="text" name="phone" placeholder="Phone Number" style="border:solid .5px gray"/><br>
								<input type="text" name="email" placeholder="E-mail Address" style="border:solid .5px gray">
								<br /><br>
								<p>I would like...
									<br />
									<input type="checkbox" name="wouldlike[]" value="learning about your church" /> To know more about this church<br />
									<input type="checkbox" name="wouldlike[]" value="special prayer" /> Special prayer (please specify in the comments below if you wish)<br />
									<input type="checkbox" name="wouldlike[]" value="call from pastoral staff" /> A call from the pastoral staff<br />
									<input type="checkbox" name="wouldlike[]" value="visit from pastoral staff" /> A visit from the pastoral staff<br />
									<input type="checkbox" name="wouldlike[]" value="becoming a member" /> To become a part of this church family<br />
									<input type="checkbox" name="wouldlike[]" value="other" /> Other (please specify in the comments below)<br />
									<br />
								</p>
								<p>How did you find us?
									<select name="how" style="border:solid .5px gray">
										<option value="" > -- Please select -- </option>
										<option>Web Search</option>
										<option>Word of mouth</option>
										<option>Link from another website</option>
										<option>Saw our sign</option>
										<option>Other</option>
									</select>
								</p>
								<p>Please add any additional comments in the space provided below <br />
									<b>Your comments:</b><br />
									<textarea name="comments" rows="10" cols="40" style="border:solid 1px gray"></textarea>
								</p>
								<br />
								<div class="g-recaptcha" data-sitekey="6LfHZE0UAAAAAO3IJy27-wXAzdmiRCI6UvxvN_HI"></div>
								<br />
								<p><input type="submit" value="Send it!"></p>

							</form>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/app.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>