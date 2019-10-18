<?php
include("../connection/connect.php");
include("session/session.php");

// // Retrieve Users Data

$retr = "Select student.student_ID,student.student_Fname,student.student_Lname,student_Intake,reg_Num,
department.dep_Name,department.dep_ID 
FROM student INNER JOIN department ON student.dep_ID = department.dep_ID 
AND student.student_ID = '$session_Id'";
$run_retr = mysqli_query($con, $retr);
$row_retr = mysqli_fetch_array($run_retr);
$studId = $row_retr['student_ID'];
$fname = $row_retr['student_Fname'];
$lname = $row_retr['student_Lname'];
$depart = $row_retr['dep_Name'];
$departID = $row_retr['dep_ID'];
$intake = $row_retr['student_Intake'];
$regNum = $row_retr['reg_Num'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $fname;?> | My Transcript</title>

<!-- META TAGS, Website SEO, Author, Keywords, Responsiveness -->

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- LINKS OF THE WEBSITE, STYLING FILES, AND THE WEBSITE HEADER ICON-->

<link rel="icon" href="../img/logo.png">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/all.min.css">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/print.css" media="print">
<link rel="stylesheet" href="../css/animate.css">


<script src="../js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/all.min.js"></script>
<script src="../js/main-script.js"></script>
<script src="../js/wow.min.js"></script>
<style>

</style>
</head>

<body> 
<div class="dash-section">
    <div class="container-fluid">
        <div class="dash-output-section" style="margin-top: 15px !important;"> 
            <div class="container">
            <a href="#"  class="btn btn-primary back-btn mt-3" style="margin-bottom: 30px; margin-left: 10%;" onclick="printTranscript()" id="printPage">
          <span>Print Transcript</span></a>  
                <div class="transcript" style="" id="report">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="top-transcript">
                                <b>W.D.A</b>
                                <b>KIGALI INTERNATIONAL ART COLLEGE</b>
                                <b>P.O BOX: 55 KIGALI</b>
                                <b>WEBSITE: kiac.ac.rw</b>
                            </div>
                        </div>    
                        <div class="col-md-6 text-right">
                            <div class="top-transcript">
                                <b>DATE: <?php echo date("d / M / Y")?></b>
                                <b>Done At: Kigali,Rwanda</b>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-3">
                        <h4 class="head">TRANSCRIPT</h4>
                        </div>
                    </div>
                        <div class="student-profile">
                            <p><label style="width:;">INTAKE:</label> 
                            <span class="text"> <?php echo $intake;?></span></p> 

                            <p><label style="width:;">DEPARTMENT:</label> 
                            <span class="text"> <?php echo strtoupper($depart);?></span></p>  

                            <p><label style="width:;">REG. N0:</label> 
                            <span class="text"> <?php echo $regNum;?></span></p>  

                            <p><label style="width:;">STUDENT'S NAMES:</label> 
                            <span class="text" style="font-family: Papyrus !important; font-weight: bold !important;"> 
                            <?php echo strtoupper($lname) . "&nbsp;&nbsp;&nbsp;" . "&nbsp;" . $fname;?></span></p>
                        </div>
                        <table class="table table-bordered transcript-table">
                            <tr>
                                <th rowspan="2" class="">BRANCHES</th>
                                <th colspan="3">OVERALL MARKS</th>
                                <th colspan="3">SCORED MARKS</th>
                            </tr>

                            <tr>
                                <th>OV. TEST</th>
                                <th>OV. EXAM</th>
                                <th>OV. TOTAL</th>                   
                                <th>TEST</th>
                                <th>EXAM</th>
                                <th>TOTAL</th>
                            </tr>	

                            <tr>
                                <th>COURSE NAMES</th>
                                <th colspan="7"></th>
                            </tr>

                            <!-- align courses -->
                             <?php
                             $select_total = "Select SUM(courses.total_Marks) AS sumOfMarks 
                             FROM courses
                             WHERE courses.dep_ID= '$departID'";
                             $run_select_total = mysqli_query($con, $select_total);
                             $row_select_total = mysqli_fetch_array($run_select_total);
                             $ovTotal = $row_select_total['sumOfMarks'];

                             $select_course = "Select courses.course_Name,courses.course_ID,
                             courses.total_Marks,department.dep_Name 
                             FROM courses INNER JOIN department 
                             ON courses.dep_ID = department.dep_ID 
                             WHERE department.dep_ID = '$departID' and courses.status='on' 
                             ORDER BY courses.course_Name ";
                             
                             $run_select_course = mysqli_query($con, $select_course);
                             while($row_select_course = mysqli_fetch_array($run_select_course)){
                             $cname = $row_select_course['course_Name'];
                             $cID = $row_select_course['course_ID'];
                             $totMarks = $row_select_course['total_Marks'];
                             ?>
                            <tr>
                                <td><?php echo $cname;?></td>
                                <th><?php echo $totMarks;?></th>
                                <th><?php echo $totMarks;?></th>
                                <th><?php echo ($totMarks) * 2;?></th>
                                <?php
                                $select_marks = "Select courses.course_Name,marks.marks_Test,
                                marks.marks_Exam,marks.total FROM courses LEFT JOIN marks 
                                ON marks.course_ID = courses.course_ID 
                                INNER JOIN department ON department.dep_ID = courses.dep_ID 
                                WHERE department.dep_ID = '$departID' AND marks.student_ID = '$studId' 
                                AND courses.course_ID = '$cID'";
                                $run_select_marks = mysqli_query($con, $select_marks);
                                $row_select_marks = mysqli_fetch_array($run_select_marks);
                                $tMarks = $row_select_marks['marks_Test'];
                                $eMarks = $row_select_marks['marks_Exam'];
                                $total= $row_select_marks['total'];
                                ?>
                                <td><?php echo $tMarks;?></td>
                                <td><?php echo $eMarks;?></td>
                                <td><?php echo $total;?></td>
                            </tr>	
                            <?php 
                             }
                            ?>				
                            <tr>
                                <?php
                                    $select_Ttotal = "Select SUM(marks.marks_Test) AS sumOfTests 
                                    FROM courses LEFT JOIN marks 
                                    ON marks.course_ID = courses.course_ID 
                                    INNER JOIN department ON department.dep_ID = courses.dep_ID 
                                    WHERE department.dep_ID = '$departID' 
                                    AND marks.student_ID = '$studId'";

                                    $run_select_Ttotal = mysqli_query($con, $select_Ttotal);
                                    $row_select_Ttotal = mysqli_fetch_array($run_select_Ttotal);
                                    $testTotal = $row_select_Ttotal['sumOfTests'];                                    
                                    $select_Etotal = "Select SUM(marks.marks_Exam) AS sumOfExams 
                                    FROM courses LEFT JOIN marks 
                                    ON marks.course_ID = courses.course_ID 
                                    INNER JOIN department ON department.dep_ID = courses.dep_ID 
                                    WHERE department.dep_ID = '$departID' 
                                    AND marks.student_ID = '$studId'";

                                    $run_select_Etotal = mysqli_query($con, $select_Etotal);
                                    $row_select_Etotal = mysqli_fetch_array($run_select_Etotal);
                                    $examTotal = $row_select_Etotal['sumOfExams'];
                                    $maxTotal = $testTotal + $examTotal;
                                ?>
                                <th>TOTAL</th>
                                <th><?php echo $ovTotal;?></th>
                                <th><?php echo $ovTotal;?></th>
                                <th><?php $maxTot = ($ovTotal) * 2;
                                echo $maxTot;?></th>
                                <th><?php echo $testTotal;?></th>
                                <th><?php echo $examTotal;?></th>
                                <th><?php echo $maxTotal;?></th>
                            </tr>

                            <tr>
                                <th>PERCENTAGE</th>
                                <td colspan="6" class="text-center">
                                  <?php
                             $select_verdict = "Select student.student_Fname,marks.marks_Test,marks.marks_Exam,marks.total FROM marks INNER JOIN student ON marks.student_ID = student.student_ID WHERE marks.marks_Test='' OR marks.marks_Exam='' AND student.student_ID = '$studId'";
                             $run_verdict = mysqli_query($con, $select_verdict);
                             $check_verdict = mysqli_num_rows($run_verdict);   
                                  
                                  if($check_verdict > 0){
                                  $perc = ($maxTotal * 100) / $maxTot;
                                  echo substr($perc, 0,5)." %" . " (Provisional)";
                                  }                                   

                                  else{
                                  $perc = ($maxTotal * 100) / $maxTot;
                                  echo substr($perc, 0,5)." %" ;
                                  }                               
                                  ?>
                                </td>
                            </tr>					  

                            <tr>
                            <th>CLASS TEACHER'S NAME</th>
                            <td colspan="6" class="text-center" 
                            style="font-family: Papyrus !important; font-weight: bold !important;">
                            <?php 
                            $select_prof = "Select * FROM teacher WHERE dep_ID = '$departID'";
                            $run_select_prof = mysqli_query($con, $select_prof);
                            $row_select_prof = mysqli_fetch_array($run_select_prof);
                            $tFname = $row_select_prof['teacher_Fname'];
                            $tLname = $row_select_prof['teacher_Lname'];
                            echo strtoupper($tLname) . "&nbsp;&nbsp;&nbsp;" . "&nbsp;" . $tFname;
                            ?>
                            </td>
                            </tr>					  
                            <tr>
                            <th>VERDICT OF JURY</th>
                            <td colspan="6" class="text-center"><h4>
                            <?php
                             if($check_verdict > 0){
                              if($perc > 50){
                               echo "PASS (Provisional)";
                              }
                              else{
                               echo "FAILURE (Provisional)"; 
                              }
                             }                             

                             else{
                              if($perc > 50){
                               echo "PASS";
                              }
                              else{
                               echo "FAILURE"; 
                              }
                             }

                            ?>
                            </h4></td>
                            </tr>			  
                        </table>
                        <div class="headmaster">
                            <h5 class="text-right">The School Principal, Signature & STAMP</h5>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // function printTranscript(el){
        // const restorePage = document.body.innerHTML;
        // const printPage = document.getElementById(el).innerHTML;
        // printPage.style.display = "none";
        // document.body.innerHTML = printPage; 
        // window.print();
        // document.body.innerHTML = restorePage;
    // }

    function printTranscript(){
        const printPage = document.getElementById("printPage");
        printPage.style.display = "none";
        window.print();
    }
</script>
</body>
</html>
