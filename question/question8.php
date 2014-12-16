<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Survey</title>
<link href="layout.css" rel="stylesheet" type="text/css">
<?php
	session_start();
	if (!isset($_SESSION['username'])){
	header("Location:login.php");
	}
?>
</head>
<body>

<div class="container">
  
<div table class="menubar">
     <tr style="background-color:blue">
      <tb width="300"><a href="home.php">Home</a></tb>
      <tb width="300"><a href="survey.php">Take a Survey</a></tb>
      <tb width="300"><a href="data-analysis.php">Results</a></tb>     
      <tb width="300"><a href="logout.php">Logout Here</a></tb>  
     </tr>
    </table>
   </div>
   
  <div class="content">
    <h1>Questionnaire</h1>
    <p>&nbsp</p>
    <h2>Welcome:<?php echo $_SESSION['username']; ?></h2>
    <p class>There are several questions, each from strongly agree to strong disagree, choose one most suit you 
    according to your own circumstance.</p>
    <p>&nbsp</p>
    
  <?php
	$connect= mysql_connect("127.0.0.1","surveyee","123") or die ("Couldn't connect to database".mysql_error());
		mysql_select_db("comp7100", $connect);
		
		$sql = "select question from questions";
		$res=mysql_query($sql, $connect);
		$quests = mysql_fetch_array($res);  
		// echo "Quest0=$quests[0]";
	  	$scores=array();
	?>
<form method="post" action="q1_copy.php"> 
  <table> 
  <th>
  <td width=100>Artificial Intelligence</td>
  <td width=100>Applied Computer Science</td>
  <td width=100>Computer Vision</td>
  <td width=100>Multimedia</td>
  <td width=100>Network and Security</td>
  <td width=100>Information System</td>
  <td width=100>Software Engineering</td>
  <td width=100>Technology Entrepreneurship</td>
  <td width=100>Do not have any yet</td>
  </th>
<?php 
   	$i=1;
	while($row = mysql_fetch_array($res))
  	{
  	 echo "<tr> <td width=500>".$i.". ".$row['Do you have any interest field(s)?']."</td>";
	 echo '<td width=100> <input type="checkbox" name="score'.$i.'"  value=1 '; if (score."$i"==1) {echo ' selected ';}; echo '> </td>';
	 echo '<td width=100> <input type="checkbox" name="score'.$i.'"  value=2 '; if (score."$i"==2) {echo ' selected ';}; echo '> </td>';
	 echo '<td width=100> <input type="checkbox" name="score'.$i.'"  value=3 '; if (score."$i"==2) {echo ' selected ';}; echo '> </td>';
	 echo '<td width=100> <input type="checkbox" name="score'.$i.'"  value=4 '; if (score."$i"==4) {echo ' selected ';}; echo '> </td>';
	 echo '<td width=100> <input type="checkbox" name="score'.$i.'"  value=5 '; if (score."$i"==5) {echo ' selected ';}; echo '> </td>';
	 echo '<td width=100> <input type="checkbox" name="score'.$i.'"  value=6 '; if (score."$i"==6) {echo ' selected ';}; echo '> </td>';
	 echo '<td width=100> <input type="checkbox" name="score'.$i.'"  value=7 '; if (score."$i"==7) {echo ' selected ';}; echo '> </td>';
	 echo '<td width=100> <input type="checkbox" name="score'.$i.'"  value=8 '; if (score."$i"==8) {echo ' selected ';}; echo '> </td>';
	 echo '<td width=100> <input type="checkbox" name="score'.$i.'"  value=9 '; if (score."$i"==9) {echo ' selected ';}; echo '> </td>';
  	 // if (score."$i") {echo "score$i";}
	 echo "</tr>"; 
	 // echo $scores[$i];
	 //$scores[$i]=$_POST['score'.$i];
	 $i++;
  	}
 	//echo '<pre>'; print_r($scores); echo '</pre>';
	?> 
  </table>
  <h1>&nbsp</h1>
  <h3>Add your comments here.</h3>
  <textarea name="comment" cols="80" rows="5"></textarea>

  <h3>&nbsp;</h3>
  <input type="submit" value="Submit">
</form>  		
  		     
<?php
	$username = $_SESSION['username'];
	$connect= mysql_connect("127.0.0.1","surveyee","123") or die ("Couldn't connect to database".mysql_error());
	mysql_select_db("comp7100", $connect);
		
		for($j=1;$j<=8;$j++){
		$answer = $_POST['score'.$j];
		
		$sql = "insert into answers (question_id, username, answer) 
		values ($j,$username,$answer) ";
		mysql_query($sql);
		//echo"<h2 align='center'>"."question$j updated."."</h2";
		echo"<br>";
		}
		$comment = $_POST['comment'];
		mysql_query("insert into answers (comments) values ($comment)");
?>

<form method ="link" action="data-analysis.php">    
<input type="submit" value="See the result">
</form>
        
<p>&nbsp;</p>
<h3>&nbsp;</h3>
	</div>
</div>
</body>
</html>
