<html>

<?php require ("header.php");?>

<?php
session_start();
require_once 'sql.php';
$conn = mysqli_connect($host, $user, $ps, $project);
if (!$conn) {
echo "<script>alert(\"Database error retry after some time !\")</script>";
} 
else {
    $staffid = $_SESSION["staffid"];
    $sql = "select *  from staff where staffid='{$staffid}'";
    $res =   mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($res)) {
        $dbname = $row['name'];
    }
}


if (isset($_POST['submit1'])) {
    
    $op2 = $_POST["op2"]; //min
    $op3 = $_POST["op3"]; //max
    $op4 = $_POST["op4"]; //quiz name

    $sql2 = "select *  from quiz where quizname='{$op4}'";
    $res2 = mysqli_query($conn, $sql2);
    while ($row2 = mysqli_fetch_array($res2)) {
        $quizid = $row2['quizid'];
    }



    $sql = "SELECT *
        FROM score,student
        WHERE score BETWEEN '$op2' AND '$op3' AND quizid='$quizid' AND student.usn=score.usn 
        ORDER BY score DESC";
    //     $sql = "SELECT DISTINCT q.quizname, s.score,s.totalscore,st.usn,st.name,s.usn
// FROM score s, student st, quiz q
// WHERE s.usn=st.usn AND q.quizid=s.quizid AND s.score >='$op2'  AND s.score <='$op3'
// ORDER BY score DESC";
    $res = mysqli_query($conn, $sql);
    ?>
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
     <!-- <div class="row" style="display: flex; justify-content: center;">
            <div class="col-sm-9 mb-4">  
              <div class="card card-body bg-gradient-white text-white mt-3"> -->
              <center><div class="col-sm-9 mb-4"> 
              <span class="text-white nav-link-inner--text font-weight-bold">             
    <strong><center>Score Details of the Quiz "<?php echo $op4; ?>" with scores between <?php echo $op2; ?> and <?php echo $op3; ?></center></strong></span>
    <br>
  
    
    <?php
    
    if ($res) {
        echo "<table id=\"sc\" class=\" table table- table-hover table-bordered text-center text-primary\">
            <thead>
            <tr class=\" text-center text-white\">
            
            <td>Quiz Title</td>
            <td>USN</td>
            <td>Name</td>
            <td>Score Obtained</td>
            
            </tr>
            </thead>";
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr  class=\" text-center text-white\"><td>" . $op4 . "</td><td>" . $row["name"] . "</td><td>" . $row["usn"] . "</td><td>" . $row["score"] . "</tr>";
        }
        echo "</table>";
        ?>
<?php
        $sql4  = "SELECT score,COUNT(score) as count
        FROM score
        WHERE score >='$op2'  AND score <='$op3' AND quizid='$quizid' 
        GROUP BY score ORDER BY score DESC";
        ?>
        <br>
      <br>
        <?php
          echo "<table class=\" table table- table-hover table-bordered text-center text-primary\">
            <thead class=\" text-center text-white\">
            <tr>
            <td>Score</td>
            <td>Count </td>
            
            
            </tr>
            </thead>";
            ?>
            

        <tbody>
          <?php
            $result4 = $conn->query($sql4);
            if ($result4->num_rows > 0) {
             // echo "Score Details of the Quiz "$op4" with Score between $op2 and $op3";
              while($row4 = $result4->fetch_assoc()) {
                  
                  echo "<tr  class=\" text-center text-white\"><td>" . $row4["score"]  . "</td><td>" . $row4["count"] . "</td></tr>";
               
                  
                  
              }
            }
          ?>
        </tbody>
      </table>
      
          </div>
          </div>
          </center>

      
<?php

    } elseif ($res != true) {
        echo '<script>alert("Error");</script>';
    }
}   

?>

<body class="bg-white" id="top">


	
  <!-- <section class="section section-shaped section-lg">
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
     -->
     <!-- <section class="section section-shaped section-lg">
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
    </div> -->
     <div class="row" style="display: flex; justify-content: center;">
            <div class="col-sm-9 mb-4">  
              <div class="card card-body bg-gradient-default text-white mt-3">
			   <div class="col-5 mx-auto text-center">
            <span class="badge badge-warning badge-pill mb-5"><center>Report</center></span>
            
          </div>
		  
          
		 <section id="ans">			
                <form method="post">
                 <div id="QS">
						
				<div class="col-5 mx-auto text-center ">
                    <!-- <label for="qs" class="col-md-2 col-form-label"> -->
                     <h6 class="text-white font-weight-bold ">
                      Enter the Quiz Name and the Range:
                       <br>
                       <br>
                    </h6>
                    <!-- </label> -->
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
                <div class="col-5 mx-auto text-center">
                <!-- <label
                  for="firstname"
                  class="col-md-2 col-form-label text-white"
                  for="dept1"> -->
                  <h6 class="text-white font-weight-bold">
                  Quiz Name
                  </h6>
                  <!-- </label -->
                <!-- > -->
                <div class="col-5 mx-auto text-center">
                  <select
                    name="op4"
                    id="blood"
                    class="validate form-control"
                    required
                    
                  >
                  
                  <?php
                    $staffid = $_SESSION["staffid"];
                  $sql = "select quizname from quiz where staffid='{$staffid}'";
                  $res =   mysqli_query($conn, $sql);
                  if ($res->num_rows > 0) {
                    while($row = $res->fetch_assoc()) {
                        echo '<center>'. '<option value="' . $row["quizname"] . '">' . $row["quizname"] . '</option>'.'</center>';
                    }
                }
                else{
                    echo "<script>alert('You have not created any Quiz.So you cannot get the report');</script>";
                    echo "<script>window.location.replace(\"homestaff.php\")</script>";
                }
                  ?>
                      <!-- <option value="CSE">CSE</option>
                        <option value="ISE">ISE</option>
                        <option value="ECE">ECE</option>
                        <option value="EEE">EEE</option> -->
                  </select>
                </div>
              </div>
			  
				
				<div class="col-5 mx-auto text-center">
                    <!-- <label for="op2" class="col-md-2 col-form-label"> -->
                    <h6 class="text-white font-weight-bold">Min Score</h6>
                    <!-- </label> -->
                    <div class="col-5 mx-auto text-center">
                      <input
                        type="number"
                        min="0"
                        class="form-control"
                        required
                        id="quizid"
                        name="op2"
                     
						
                      />
                    </div>
                </div>
				
				<div class="col-5 mx-auto text-center">
                    <!-- <label for="op3" class="col-md-2 col-form-label"> -->
                      <h6 class="text-white font-weight-bold"><center>Max Score</center></h6>
                    <!-- </label> -->
                    <div class="col-5 mx-auto text-center">
                      <input
                        type="number"
                        min="0"
                        class="form-control"
                        required
                        id="quizid"
                        name="op3"
                        
						
                      />
                    </div>
                </div>
                <br>
                <br>
               
				
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

                <!-- <div class="form-group row">
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
                  
						
                      />
                    </div>
                </div> -->
                <!-- <div class="form-group row">
                    <label for="op3" class="col-md-2 col-form-label"
                      ><h6 class="text-white font-weight-bold">Department</h6>
                    </label>
                    <div class="col-md-10">
                      <input
                        type="text"
                        class="form-control"
                        required
                        id="quizid"
                        name="op4"
                        value="<?= $dbdept?>"
						
                      />
                    </div>
                </div> -->
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
					<form >
					 <!-- <div class="offset-md-5 col-md-"> -->
           <center><button
                        type="submit"
                        class="btn btn-success text-white"
						            name="submit1" id="submit1" value="Done"
                        <li class="nav-item">
              <!-- <a href=".php" class="nav-link"> -->
                <span class="text-white nav-link-inner--text font-weight-bold"
                  ></i>Submit</span
                >
              </a>
            </li>
                        
                        
                      </button>
                      </center>

                    </div>
                    </form>
					</div>

	
			
					
          </section>


                  </div>
                </div>
              </div>		
		
 </div>
 </section>
 
    <?php require("footer.php");?>

</body>

</html>