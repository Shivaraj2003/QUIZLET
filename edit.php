<?php
    if(isset($_POST['update'])){
        $question_id = $_POST['question_id'];
        $question = $_POST['qs'];
        $option1 = $_POST['op1'];
        $option2 = $_POST['op2'];
        $option3 = $_POST['op3'];
        $option4 = $_POST['op4'];
        $answer = $_POST['answer'];

        $connection = mysqli_connect("host","user","ps","project");
        $query = "UPDATE questions SET qs='$question', op1='$option1', op2='$option2', op3='$option3', op4='$option4', answers='$answer' WHERE id='$question_id'";
        $result = mysqli_query($connection, $query);

        if($result){
            echo "Question updated successfully!";
        }else{
            echo "Error updating question: " . mysqli_error($connection);
        }
        mysqli_close($connection);
    }
?>
