<?php
include('back/db_connect_read.php');
    try 
    {
        $sql ='SELECT s_author, s_date, s_title, s_audio_url, s_featured FROM sermons WHERE s_featured=? ORDER BY s_date DESC';
        $stmt = $conn->prepare($sql); 
        $param_featured=$featured;
        $stmt->execute([$param_featured]);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
        {
            $speaker = $row['s_author'];
            $sermontitle = $row['s_title'];
            $audiopath = $row['s_audio_url'];
            $section = $row['s_featured'];
            $sermondate = $row['s_date'];
            $phpdate = strtotime( $sermondate );
            $sermondate = date( 'm-d-Y', $phpdate );
            $li='<li>
            <img src="images/tn-lg-IMG-0284.JPG" class="family-image" alt="" >
            <div class="seremon-detail">
            <h2 class="seremon-title">' . $sermontitle . '</h2>
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
