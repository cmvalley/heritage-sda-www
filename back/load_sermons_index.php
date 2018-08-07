<!--PHP page variables and include head.php for HTML head, header and navigation-->
<?php 
    include('back/db_connect_read.php');
    try 
    {
        $stmt = $conn->prepare("SELECT s_author, s_date, s_title, s_audio_url FROM `sermons` ORDER BY s_date DESC LIMIT 2"); 
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
        {
            $speaker = $row['s_author'];
            $sermontitle = $row['s_title'];
            $audiopath = $row['s_audio_url'];
            $sermondate = $row['s_date'];
            $phpdate = strtotime( $sermondate );
            $sermondate = date( 'm-d-Y', $phpdate );
    $li='<li>
    <img src="images/tn-lg-IMG-0284.JPG" class="family-image" alt="">
    <div class="seremon-detail">
    <h3 class="seremon-title">' . $sermontitle . '</h3>
    <div class="seremon-meta">
    <div class="pastor"><i class="fa fa-user"></i>' . $speaker . '</div>
    <div class="date"><i class="fa fa-calendar"></i>' . $sermondate . '</div>
    </div>
	<p><audio controls>
    <source src=' . $audiopath . ' type="audio/mpeg">
    </audio></p>
	</div>
    </li>';
    echo $li;
        }
    }
    catch(PDOException $e) 
    {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
?>
