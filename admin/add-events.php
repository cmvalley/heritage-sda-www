<!--PHP page variables and include head.php for HTML head, header and navigation-->
!--<?php 
//page metadata
$pagename='Add Events'; 
$pageurl='/admin/add-events.php';
include('../head.php'); 
include('../back/load_add_events_admin.php');
?>
<main class="main-content">
	<div class="fullwidth-block">
		<div class="container">
			<div class="row">
				<div class="content col-md-10 ">
					<form action="/admin/add-events.php" method="post">
						<input type="text" name="eventname" placeholder="Event Name" style=" border:solid 0.5px gray" /> <br/>
						<input type="text" name="eventurl" placeholder="Event URL" style="border:solid .5px gray" /><br/>
						<input type="text" name="eventloc" placeholder="Event Location" style="border:solid .5px gray" /><br/>
						<input type="date" name="eventdate" style="border:solid .5px gray;" placeholder="Event Date" /> <br/>
						<input type="text" name="eventtime" placeholder="Event Time" style="border:solid .5px gray"/><br/>
						<input type="text" name="volunteerurl" placeholder="Volunteer URL" style="border:solid .5px gray" /><br/>
						<textarea name="eventdesc" rows="10" placeholder="Event Description" cols="40" style="border:solid 1px gray"></textarea>
						<br />
						<p><input type="submit" value="Send it!"></p>
					</form>
				</div>
			</div>
		</div>
	</div>
</main> <!-- .main-content -->
<?php include('../footer.php'); ?> <!-- Site Footer contained in external file -->

</html>
