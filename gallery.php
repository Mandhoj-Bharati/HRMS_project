<?php
  session_start();
  include('admin/vendor/inc/config.php');
  //include('vendor/inc/checklogin.php');
  //check_login();
  //$aid=$_SESSION['a_id'];
?>
<!DOCTYPE html>
<html lang="en">

<!--Head-->
<?php include("vendor/inc/head.php");?>
<!--End Head-->

<body>

  <!-- Navigation -->
  <?php include("vendor/inc/nav.php");?>

  <!-- Page Content -->
  <div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">View House
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Home</a>
      </li>
      <li class="breadcrumb-item active">View</li>
    </ol>

    


    <?php

      $ret="SELECT * FROM tms_house  ORDER BY RAND() LIMIT 10 "; //get all feedbacks
      $stmt= $mysqli->prepare($ret) ;
      $stmt->execute() ;//ok
      $res=$stmt->get_result();
      $cnt=1;
      while($row=$res->fetch_object())
      {
    ?>
    <!-- Project One -->
    <div class="row">
      <div class="col-md-7">
        <a href="#">
          <img class="img-fluid rounded mb-3 mb-md-0" src="vendor/img/<?php echo $row->h_dpic;?>" alt="">
        </a>
      </div>
      <div class="col-md-5">
        <h3><?php echo $row->h_category;?></h3>
        <ul class="list-group list-group-horizontal">
        <li class="list-group-item"><b>Address:</b> <?php echo $row->h_address;?></li>
          <li class="list-group-item"><b>House No.: </b><?php echo $row->h_house_no ;?></li>
          <li class="list-group-item"><b>Status: </b><span class="badge badge-success">Available</span></li>
          <li class="list-group-item"><b>Amount(monthly): </b> <?php echo $row->h_price;?></li>
        </ul><br>
        <a class="btn btn-success" href="usr/">View
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
      </div>
    </div>
    <!-- /.row -->

    <hr>
      <?php }?>
    
  <hr>
  
</div>  

  <?php include("vendor/inc/footer.php");?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
