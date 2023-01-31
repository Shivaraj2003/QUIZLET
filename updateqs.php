<html>

<?php require ("header.php");?>

<?php
session_start();
require_once 'sql.php';
$conn = mysqli_connect($host, $user, $ps, $project);
if (!$conn) {
echo "<script>alert(\"Database error retry after some time !\")</script>";
} else {
    $staffid = $_SESSION["staffid"];
    $sql = "select * from staff where staffid='{$staffid}'";
    $res =   mysqli_query($conn, $sql);
    if ($res == true) {
        global $dbstaffid, $dbpw,$dbname,$dbmail,$dbphno;
        while ($row = mysqli_fetch_array($res)) {
            $dbstaffid = $row['staffid'];
            $dbname = $row['name'];
			      $dbmail = $row['mail'];
            $dbphno = $row['phno'];
            $dbgender = $row['gender'];
            $dbdob = $row['DOB'];
            $dbdept = $row['dept'];
        }
    }
    // $qid=$_GET["qid"];
   // $qid = 1;

    if (isset($_POST['submit1'])) {
        //$qs = $_POST["qs"];
        //$op1 = $_POST["op1"];
        $op2 = $_POST["op2"];
        $op3 = $_POST["op3"];
        $op4 = $_POST["op4"];
        $ans = $_POST["ans"];
        $sql = "update staff set name='$op2',mail='$op3', dept='$op4',phno='$ans' where staffid='{$staffid}'";
        $res =   mysqli_query($conn, $sql);
        //$res =   mysqli_query($conn, $sql);
        if ($res == true) {
            echo '<script>alert("Successfully updated");</script>';
            echo "<script>window.location.replace(\"staffprofile.php?staffid=".$staffid."\")</script>";
          
        } 
        elseif ($res != true) {
            echo '<script>alert("Error");</script>';
        }
    }
    if (isset($_POST['submit'])) {
        
        
        if ($res == true) {
          echo "<script>alert('Question inserted successfully');</script>";
          header("Location: quizlist.php");
          }
        elseif ($res != true) {
            echo '<script>alert("Question already exsits");</script>';
        }
    }
}
?>

<body class="bg-white" id="top">
    <!-- Navbar -->
    <nav
      id="navbar-main"
      class="
        navbar navbar-main navbar-expand-lg
        bg-default
        navbar-light
        position-sticky
        top-0
        shadow
        py-0
      "
    >
      <div class="container">
        <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
          <li class="nav-item dropdown">
            <a href="index.php" class="navbar-brand mr-lg-5 text-white">
                               <img src="assets/img/navbar.jpg" />
            </a>
          </li>
        </ul>

        <button
          class="navbar-toggler bg-white"
          type="button"
          data-toggle="collapse"
          data-target="#navbar_global"
          aria-controls="navbar_global"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon text-white"></span>
        </button>
        <div class="navbar-collapse collapse bg-default" id="navbar_global">
          <div class="navbar-collapse-header">
            <div class="row">
              <div class="col-10 collapse-brand">
                <a href="index.html">
                  <img src="assets/img/navbar.jpg" />
                </a>
              </div>
              <div class="col-2 collapse-close bg-danger">
                <button
                  type="button"
                  class="navbar-toggler"
                  data-toggle="collapse"
                  data-target="#navbar_global"
                  aria-controls="navbar_global"
                  aria-expanded="false"
                  aria-label="Toggle navigation"
                >
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>

          <ul class="navbar-nav align-items-lg-center ml-auto">
		  
				
				 <li class="nav-item">
              <a href="homestaff.php" class="nav-link">
                <span class="text-white nav-link-inner--text font-weight-bold"
                  ><i class="text-white fad fa-poll"></i> DashBoard</span
                >
              </a>
            </li>
			
			 <li class="nav-item">
              <a href="quizlist.php" class="nav-link">
                <span class="text-white nav-link-inner--text font-weight-bold"
                  ><i class="text-white fad fa-poll"></i> QuizList</span
                >
              </a>
            </li>
			
			 <li class="nav-item">
              <a href="staffleaderboard.php" class="nav-link">
                <span class="text-white nav-link-inner--text font-weight-bold"
                  ><i class="text-white fad fa-award"></i> LeaderBoard</span
                >
              </a>
            </li>
			
			
			 <li class="nav-item">
              <a href="staffprofile.php" class="nav-link">
                <span class="text-white nav-link-inner--text font-weight-bold"
                  ><i class="text-white fas fa-user-circle"></i> <?php echo $dbname ?></span
                >
              </a>
            </li>
      <!-- <li class="nav-item">
              <a href="staffprofile.php" class="nav-link">
                <span class="text-success nav-link-inner--text font-weight-bold"
                  ><i class="text-success fad fa-edit"></i> Update</span
                >
              </a>
            </li> -->

		   <li class="nav-item">
              <a href="logout.php" class="nav-link">
                <span class="text-white nav-link-inner--text font-weight-bold"
                  ><i class="text-danger fas fa-power-off"></i> Logout</span
                >
              </a>
            </li>

            
		  

          
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

	
  <section class="section section-shaped section-lg">
    <div class="shape shape-style-1 shape-primary">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>

		
<div class="container-fluid"> 
      
<div class="row">
            <div class="col-sm-12 mb-3">  
              <div class="card card-body bg-gradient-default text-white mt-3">
			  
			   <div class="col-12 mx-auto text-center">
            <span class="badge badge-warning badge-pill mb-3">updation</span>
          </div>
		  
		  
		 <section id="ans">			
                <form  method="post">
                 <div id="QS">
						
				<div class="form-group row">
                    <label for="qs" class="col-md-2 col-form-label"
                      ><h6 class="text-white font-weight-bold">Update your details</h6>
                    </label>
                    <!-- <div class="col-md-10">
                      <input
                        type="text"
                        class="form-control"
                        required
                        id="quizid"
                        name="qs"
                        placeholder="Enter Question"
						required"
                      />
                    </div>-->
                </div> 
				
				<!-- <div class="form-group row">
                    <label for="op1" class="col-md-2 col-form-label"
                      ><h6 class="text-white font-weight-bold">Option 1</h6>
                    </label>
                    <div class="col-md-10">
                      <input
                        type="text"
                        class="form-control"
                        required
                        id="quizid"
                        name="op1"
                        placeholder="<?= $dbname?>"
						required"
                      />
                    </div>
                </div> -->
				
				<div class="form-group row">
                    <label for="op2" class="col-md-2 col-form-label"
                      ><h6 class="text-white font-weight-bold">Name</h6>
                    </label>
                    <div class="col-md-10">
                      <input
                        type="text"
                        class="form-control"
                        required
                        id="quizid"
                        name="op2"
                        value="<?= $dbname?>"
						
                      />
                    </div>
                </div>
				
				<div class="form-group row">
                    <label for="op3" class="col-md-2 col-form-label"
                      ><h6 class="text-white font-weight-bold">Mail</h6>
                    </label>
                    <div class="col-md-10">
                      <input
                        type="text"
                        class="form-control"
                        required
                        id="quizid"
                        name="op3"
                        value="<?= $dbmail?>"
						
                      />
                    </div>
                </div>
				
				<!-- <div class="form-group row">
                    <label for="op4" class="col-md-2 col-form-label"
                      ><h6 class="text-white font-weight-bold">Option 4</h6>
                    </label>
                    <div class="col-md-10">
                      <input
                        type="text"
                        class="form-control"
                        required
                        id="quizid"
                        name="op4"
                        placeholder="Option 4"
						required"
                      />
                    </div>
                </div> -->

                <div class="form-group row">
                    <label for="op4" class="col-md-2 col-form-label"
                      ><h6 class="text-white font-weight-bold">Phone Number</h6>
                    </label>
                    <div class="col-md-10">
                      <input
                        type="text"
                        class="form-control"
                        required
                        id="quizid"
                        name="ans"
                        value="<?= $dbphno?>"
						
                      />
                    </div>
                </div>
                <div class="form-group row">
                <label
                  for="firstname"
                  class="col-md-2 col-form-label text-white"
                  for="dept">
                  Department
                </label>
                <div class="col-md-10">
                <select
                name="op4"
                id="blood"
                class="validate form-control"
                required>
                  <option value="CSE" <?= ($dbdept == 'CSE') ? 'selected' : '' ?>>CSE</option>
                  <option value="ISE" <?= ($dbdept == 'ISE') ? 'selected' : '' ?>>ISE</option>
                  <option value="ECE" <?= ($dbdept == 'ECE') ? 'selected' : '' ?>>ECE</option>
                  <option value="EEE" <?= ($dbdept == 'EEE') ? 'selected' : '' ?>>EEE</option>
                </select>

                  
                </div>
              </div>
			</div>
			
					<!-- <div class="form-group row">
                    <div class="offset-md-2 col-md-2">
                      <button
                        type="submit"
                        class="btn btn-info text-dark"
						name="submit" id="submit" value="Add 1 More Question"
                      >
                        Add 1 More Question
                      </button>
                    </div> -->
					
					 <div class="offset-md-7 col-md-">
                      <button
                        type="submit"
                        class="btn btn-success text-white"
						            name="submit1" id="submit1" value="Done"
                      >
                        Update
                      </button>
                    </div>
					</div>

	
			</form>
					
          </section>


                  </div>
                </div>
              </div>		
		
 </div>
 </section>
 
    <?php require("footer.php");?>

</body>

</html>