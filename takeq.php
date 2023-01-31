<html>


<?php require ("header.php");?>

<?php
session_start();
require_once 'sql.php';
                $conn = mysqli_connect($host, $user, $ps, $project);if (!$conn) {
    echo "<script>alert(\"Database error retry after some time !\")</script>";
} else {
    $usn = $_SESSION["usn"];
    $sql = "select * from student where usn='{$usn}'";
    $res =   mysqli_query($conn, $sql);
    if ($res == true) {
        global $dbusn, $dbpw;
        while ($row = mysqli_fetch_array($res)) {
            $dbusn = $row['usn'];
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
              <a href="homestud.php" class="nav-link">
                <span class="text-success nav-link-inner--text font-weight-bold"
                  ><i class="text-success fad fa-home"></i> DashBoard</span
                >
              </a>
            </li>
			
			 <li class="nav-item">
              <a href="studscorecard.php" class="nav-link">
                <span class="text-white nav-link-inner--text font-weight-bold"
                  ><i class="text-white fad fa-poll"></i> ScoreCard</span
                >
              </a>
            </li>
			
			 <li class="nav-item">
              <a href="studleaderboard.php" class="nav-link">
                <span class="text-white nav-link-inner--text font-weight-bold"
                  ><i class="text-white fad fa-award"></i> LeaderBoard</span
                >
              </a>
            </li>
			
			
			 <li class="nav-item">
              <a href="studprofile.php" class="nav-link">
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
if (isset($_GET["qid"])) {
  $qid = $_GET["qid"];
  $sql = "select * from questions where quizid='{$qid}'";
  $res = mysqli_query($conn, $sql);
  if ($res) {
    $count = mysqli_num_rows($res);
    if (mysqli_num_rows($res) == 0) {
      echo "No questions found under this quiz please come later";
    } else {
      $i = 1;
      $j = 0;
      echo "<form method=\"POST\" class=\" form-group\">";
      while ($row = mysqli_fetch_assoc($res)) {
        echo $i . ". " . $row["qs"] . "<br>";
        echo "<input class=\" \" type=\"radio\" value=\"" .$row["op1"] . "\" name=\"ans" . $i . $j . "\">" . $row["op1"] . "<br>";
        echo "<input type=\"radio\" value=\"" . $row["op2"] . "\" name=\"ans" . $i . $j . "\">" . $row["op2"] . "<br>";
        echo "<input type=\"radio\" value=\"" . $row["op3"] . "\"name=\"ans" . $i . $j . "\">" . $row["op3"] . "<br>";
        echo "<input type=\"radio\"value=\"" . $row["op4"] . "\" name=\"ans" . $i . $j . "\">" . $row["op4"] . "<br><br>";
        $i++;

      }
      echo "<input id=\"btn\" type=\"submit\" name=\"submit\" value=\"submit\"  class=\" btn btn-success \">";
      echo "</form>";
    }
  } else {
    echo "error" . mysqli_error($conn) . ".";
  }
  if (isset($_POST["submit"])) {
    $score = 0;
    //for($i=1;$i<=$count;$i++)
    // {
    //   //$temp ="select answer from questions where quizid='{$qid}'";
    //     if(isset($_POST["ans".$i.$j]) && $_POST["ans".$i.$j]==3){
    //         $score++;
    //     }
    // }

    // for ($i = 1; $i <= $count; $i++) {
    //   // Retrieve the correct answer for the current question
    //   //$res = mysqli_query($conn, $sql);
    //   //$question_id = mysqli_real_escape_string($conn, $_POST['question_id'.$i]);
    //   //$query = "SELECT answers FROM questions WHERE question_id = $question_id";
    //   //$qid = $_GET["qid"];
    //   $sql = "select question_id from questions where quizid='{$qid}'";
    //   $res = mysqli_query($conn, $sql);

    //   //$sql = "select answers questions where quizid='{$qid}'";
    //   //$result = mysqli_query($conn, $sql);
    //   $row = mysqli_fetch_assoc($res);
    //   $correct_answer = $row['answers'];

    //   // Check if the user's answer is correct
    //   if (isset($_POST["ans".$i.$j]) && $_POST["ans".$i.$j] == $correct_answer) {
    //     // The user's answer is correct
    //     // You can update their score or do something else here
    //     $score++;
    //   }
    // }




    $query = "SELECT question_id FROM questions WHERE quizid='{$qid}'";
    $result = mysqli_query($conn, $query);
    
    // Iterate over the questions
    $i = 1;
    $j = 0;
    while ($row = mysqli_fetch_assoc($result)) {
      // Retrieve the correct answer for the current question
      $question_id = $row['question_id'];
      $query1 = "SELECT answers FROM questions WHERE question_id = '{$question_id}'";
      $result2 = mysqli_query($conn, $query1);
      $row2 = mysqli_fetch_assoc($result2);
      $correct_answer = $row2['answers'];

      // Check if the user's answer is correct
      if (isset($_POST["ans".$i.$j]) && $_POST["ans". $i .$j] == $correct_answer) {
        // The user's answer is
        $score++;
      }
      $i++;
      $j = 0;
    }














    echo "<script>alert(\"You scored " . $score . " out of " . $count . "\");</script>";
    $sql = "insert into score(score,usn,quizid,totalscore) values('$score','$dbusn','$qid','$count');";
    $res = mysqli_query($conn, $sql);
    if ($res) {
      echo '<script>history.pushState({}, "", "");</script>';
      echo "<script>window.location.replace(\"studscorecard.php\");</script>";
    } else {
      echo "<script>alert(\"error occured updating score in database" . mysqli_error($conn) . "\");</script>";
    }
  }
} ?>
                  </div>
                </div>
              </div>		
		

 </div>
 </section>
 
    <?php require("footer.php");?>

</body>

</html>