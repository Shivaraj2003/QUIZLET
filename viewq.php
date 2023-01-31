<html>

<?php require ("header.php");?>

<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
require_once 'sql.php';
     $conn = mysqli_connect($host, $user, $ps, $project);if (!$conn) {
    echo "<script>alert(\"Database error retry after some time !\")</script>";
}
?>
     
<?php
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
        py-0">
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
          aria-label="Toggle navigation">
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
                  aria-label="Toggle navigation">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>

          <ul class="navbar-nav align-items-lg-center ml-auto">
		  
				
				 <li class="nav-item">
              <a href="quizlist.php" class="nav-link">
                <span class="text-success nav-link-inner--text font-weight-bold"
                  ><i class="text-success fad fa-home"></i> DashBoard</span
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

       
		
        <?php 
        if(isset($_GET["qid"])){
        $qid=$_GET["qid"];
            $sql ="select * from questions where quizid='{$qid}'";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                $count=mysqli_num_rows($res);
                if(mysqli_num_rows($res)==0)
                {
                    echo "No questions found under this quiz please come later";
                    echo "<form method=\"POST\">";
                    echo "<input id=\"btn\" type=\"submit\" name=\"submit\" value=\"Add Questions\" class=\" btn btn-success \"><br><br><br>";

                }
                else{
                $i=1;
                $j=0;
                echo "<form method=\"POST\">";
                echo "<input id=\"btn\" type=\"submit\" name=\"submit\" value=\"Add Questions\" class=\" btn btn-success \"><br><br><br>";
                echo "</form><br><br>";
                

                while ($row = mysqli_fetch_assoc($res)) { 
                  echo '<div class="question-block">';
                  echo '<p class="question-text">'.$i.'. '.$row["qs"].'</p>';
                  echo '<div class="options-block">';
                  echo '<p class="option">A: '.$row["op1"].'</p>';
                  echo '<p class="option">B: '.$row["op2"].'</p>';               
                  echo '<p class="option">C: '.$row["op3"].'</p>';               
                  echo '<p class="option">D: '.$row["op4"].'</p>';
                  echo '</div>';
                  echo '<p class="correct-answer">Correct answer: '.$row["answers"].'</p>';
                  echo '<form action="updateqsn.php" method="get">';
                  echo '<input type="hidden" name="qid" value="'.$qid.'">';
                  echo '<input type="hidden" name="question_id" value="'.$row["qs"].'">';
                  echo '<button class="btn btn-info btn-md edit-btn" type="submit">Edit</button>';
                  echo '</form>';
                  echo '</div>';
                  echo '<br><br>';
                  $i++;
                  $j = 0;  
              }
              
              
                 
                echo "</form><br><br>";
                
            }
          
            }
            else
            {
                echo "error".mysqli_error($conn).".";
            }
            if(isset($_POST["submit"])){
                echo "<script>window.location.replace(\"addq.php?qid=".$qid."\")</script>";
            }
     } ?>

<form method="post">
  <input type="submit" name="submit1" value="Submit">
  
</form>
                  </div>
                </div>
              </div>		
		
 </div>
 </section>
 
 <?php
 if (isset($_GET["qid"])) {
   $qid = $_GET["qid"];
 }
if (isset($_POST['submit1'])) {
  $sql ="select * from questions where quizid='{$qid}'";
  $res = mysqli_query($conn, $sql);
  $i = 1;
  $j = 0;
  while ($row = mysqli_fetch_assoc($res)) {
    if (isset($_POST["ans".$i.$j."\">".$row["op1"]])) {
      // The radio button was clicked
      $answer = $_POST["ans".$i.$j."\">".$row["op1"]];
      echo "<script>alert(\"Database error retry after some time !\")</script>";

      // Retrieve the question_id for the current question
      $query1 = "SELECT question_id FROM questions WHERE quizid='{$qid}' AND qs='{$row["qs"]}'";
      $result1 = mysqli_query($conn, $query1);
      $row1 = mysqli_fetch_assoc($result1);
      $question_ids = $row1['question_id'];
      

      // Update the answers column in the questions table
      $query = "UPDATE questions SET answers='{$answer}' WHERE question_id='{$question_ids}'";
      $result = mysqli_query($conn, $query);
      if (!$result) {
        // The query failed
        echo "Error updating answers: " . mysqli_error($conn);
      } else {
        // The query was successful
        $i++;
      }
    }
  }
  echo "<script>window.location.replace(\"quizlist.php?qid=".$qid."\")</script>";
}

?>
 
    <?php require("footer.php");?>

</body>

</html>