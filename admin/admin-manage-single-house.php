<?php
  session_start();
  include('vendor/inc/config.php');
  include('vendor/inc/checklogin.php');
  check_login();
  $aid=$_SESSION['a_id'];
  //Add USer
  if(isset($_POST['upate_veh']))
    {
            $h_id = $_GET['v_id'];
            $h_address=$_POST['h_address'];
            $h_price = $_POST['h_price'];
            $h_category=$_POST['h_category'];
            //$h_dpic=$_POST['h_dpic'];
            $h_status=$_POST['h_status'];
            $h_no_of_room=$_POST['h_no_of_room'];
            $h_dpic=$_FILES["h_dpic"]["name"];
            move_uploaded_file($_FILES["h_dpic"]["tmp_name"],"../vendor/img/".$_FILES["h_dpic"]["name"]);
            $query="update tms_house set h_address=?, h_price=?, h_no_of_room=?, h_category=?, h_dpic=?, h_status=? where h_id = ?";
            $stmt = $mysqli->prepare($query);
            $rc=$stmt->bind_param('ssssssi', $h_address, $h_price, $h_no_of_room, $h_category, $h_dpic, $h_status, $h_id);
            $stmt->execute();
                if($stmt)
                {
                    $succ = "House Updated";
                }
                else 
                {
                    $err = "Please Try Again Later";
                }
            }
?>
<!DOCTYPE html>
<html lang="en">

<?php include('vendor/inc/head.php');?>

<body id="page-top">
 <!--Start Navigation Bar-->
  <?php include("vendor/inc/nav.php");?>
  <!--Navigation Bar-->

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include("vendor/inc/sidebar.php");?>
    <!--End Sidebar-->
    <div id="content-wrapper">

      <div class="container-fluid">
      <?php if(isset($succ)) {?>
                        <!--This code for injecting an alert-->
        <script>
                    setTimeout(function () 
                    { 
                        swal("Success!","<?php echo $succ;?>!","success");
                    },
                        100);
        </script>

        <?php } ?>
        <?php if(isset($err)) {?>
        <!--This code for injecting an alert-->
        <script>
                    setTimeout(function () 
                    { 
                        swal("Failed!","<?php echo $err;?>!","Failed");
                    },
                        100);
        </script>

        <?php } ?>

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">houses</a>
          </li>
          <li class="breadcrumb-item active">Update House</li>
        </ol>
        <hr>
        <div class="card">
        <div class="card-header">
            Update House
        </div>
        <div class="card-body">
          <!--Add User Form-->
          <?php
            $aid=$_GET['v_id'];
            $ret="select * from tms_house where h_id=?";
            $stmt= $mysqli->prepare($ret) ;
            $stmt->bind_param('i',$aid);
            $stmt->execute() ;//ok
            $res=$stmt->get_result();
            //$cnt=1;
            while($row=$res->fetch_object())
        {
        ?>
          <form method ="POST" enctype="multipart/form-data"> 
            <div class="form-group">
                <label for="exampleInputEmail1">House Address</label>
                <input type="text" value="<?php echo $row->h_address;?>" required class="form-control" id="exampleInputEmail1" name="h_address">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"> Rent per month</label>
                <input type="text" value="<?php echo $row->h_price;?>" class="form-control" id="exampleInputEmail1" name="h_price">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">No Of Room</label>
                <input type="text" value="<?php echo $row->h_no_of_room;?>" class="form-control" id="exampleInputEmail1" name="h_no_of_room">
            </div>
            
            <div class="form-group">
              <label for="exampleFormControlSelect1">House Category</label>
              <select class="form-control" name="h_category" id="exampleFormControlSelect1">
                <option>Full House Rent</option>
                <option>Flat Rent</option>
                <option>Room Rent</option>

              </select>
            </div>

            <div class="form-group">
              <label for="exampleFormControlSelect1">Vehicle Status</label>
              <select class="form-control" name="h_status" id="exampleFormControlSelect1">
                <option>Booked</option>
                <option>Available</option>
              </select>
            </div>

            <div class="card form-group" style="width: 30rem">
            <img src="../vendor/img/<?php echo $row->h_dpic;?>" class="card-img-top" >
            <div class="card-body">
                <h5 class="card-title">House Picture</h5>
                <input type="file" class="btn btn-success" id="exampleInputEmail1" name="h_dpic">
            </div>
            </div>
            <hr>
            <button type="submit" name="upate_veh" class="btn btn-success">Update House</button>
          </form>
          <!-- End Form-->
          <?php }?>
        </div>
      </div>
       
      <hr>
     

      <!-- Sticky Footer -->
      <?php include("vendor/inc/footer.php");?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger" href="admin-logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="vendor/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="vendor/js/demo/datatables-demo.js"></script>
  <script src="vendor/js/demo/chart-area-demo.js"></script>
 <!--INject Sweet alert js-->
 <script src="vendor/js/swal.js"></script>

</body>

</html>
