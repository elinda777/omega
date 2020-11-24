<?php
  session_Start();
  session_destroy();

  echo "<script> alert('Anda telah logout')</script>";
  echo "<script> location='login.php'</script>";
?>
