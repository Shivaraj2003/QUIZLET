  
<html >


<?php require ("header.php");?>

<?php
session_start();
require_once 'sql.php';
                $conn = mysqli_connect($host, $user, $ps, $project);if (!$conn) {
    echo "<script>alert(\"Database error retry after some time !\")</script>";
} else {
    $staffid = $_SESSION["staffid"];
    $sql = "select * from staff where staffid='{$staffid}'";
    $res =   mysqli_query($conn, $sql);
    if ($res == true) {
        global $dbstaffid, $dbpw;
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
      ">
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
                <span class="text-success nav-link-inner--text font-weight-bold"
                  ><i class="text-success fad fa-award"></i> LeaderBoard</span
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
              <a href="sort.php" class="nav-link">
                <span class="text-white nav-link-inner--text font-weight-bold"
                  ><i class="text-danger fas fa-file-alt"></i> More Report</span
                >
              </a>
            </li> -->

      <li class="nav-item">
              <a href="updateqs.php" class="nav-link">
                <span class="text-white nav-link-inner--text font-weight-bold"
                  ><i class="text-danger fad fa-edit"></i> Update</span
                >
              </a>
            </li>
		  
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
  <!-- <section class="section section-shaped section-lg" > -->
    <div class="shape shape-style-1 shape-primary"  >
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


<div class="container"> 
<li class="nav-item">
              <a href="sort.php" class="nav-link">
                <span class="text-white nav-link-inner--text font-weight-bold"
                  ><i class="text-danger fas fa-file-alt"></i> Detailed Report</span
                >
              </a>
            </li>

<div class="row" >
            <div class="col-sm-12 mb-3">  
              <!-- <div class="card card-body bg-gradient-white text-white mt-40" style="overflow-y=auto"> -->
              <div class="card card-body bg-gradient-white text-white mt-40" style="overflow: auto; max-height: 700px;">
			   <div class="col-12 mx-auto text-center">
            <span class="badge badge-primary badge-pill mb-3">Leaderboard</span>
          </div>

            <?php
            $sql="call leaderboard;";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo "<table id=\"le\" class=\"table table-striped table-hover table-bordered  text-center \">
				<thead class=\" font-weight-bold \"><tr>
				<td>Quiz Title</td>
				<td>Student name</td>
				<td>Max Score</td>
				<td>Score obtained</td>
				</tr></thead>";
                while ($row = mysqli_fetch_assoc($res)) {                
                    echo "<tr><td>".$row["quizname"]."</td><td>".$row["name"]."</td><td>".$row["totalscore"]."</td><td>".$row["score"]."</td></tr>"; 
                }
                echo "</table>";
            }
            else{
                echo mysqli_error($conn);
            }
            ?>
     

             </div>
                </div>
              </div>    	
    </div>
    
</section>


    
<?php require("footer.php");?>
</body>

</html>