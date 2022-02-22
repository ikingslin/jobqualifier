<?php
   session_start();
   $status=unlink("admin/".$_SESSION['cid'].$_SESSION['qid'].".mp4");    
   if(session_destroy()) {
      header("Location:/jobqualifier/index.php");
   }
?>