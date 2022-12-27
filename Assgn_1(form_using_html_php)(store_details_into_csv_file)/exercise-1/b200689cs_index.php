<!DOCTYPE html>
<html>
<head>
  <title>B200689CS</title>
</head>
<body>
  <h2 align=center>
    <font color=red>Enter Student Details</font>
</h2>
  <form method="post">
  <center>
    <b>First Name:</b> &nbsp &nbsp<input type="text" name="fn"><br><br>
    <b>Last Name:</b>&nbsp &nbsp<input type="text" name="ln"><br><br>
    <b>Roll Number:</b><input type="text" name="roll"><br><br>
    <b>Email:</b>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<input type="email" name="email"><br><br>
    <input type="submit" name="insert" value=Insert>
    <input type="submit" name="delete" value=Delete>
    <input type="submit" name="search" value=Search>
    <input type="submit" name="update" value=Update>
    <input type="submit" name="display" value=Display>
    </center>
  </form>
</body>
</html>


<?php
              
if(isset($_POST['insert']))
{
$a=$_POST['fn'];
$b=$_POST['ln'];
$c=$_POST['roll'];
$d=$_POST['email'];
if($a=="" or $b=="" or $c=="" or $d=="" )
  echo"Enter all the details";
else{
$fp = fopen('student.csv', 'r');
$fs = filesize('student.csv');
$seperator=',';
$flag=0;
while($row=fgetcsv($fp,$fs,$seperator)){
  if($row[2]==$c){
    echo "<b><br><font color=red>A student with this roll number already exists.</font>";
    fclose($fp);
    $flag=1;
    break;
  }
}
if($flag==0)
{
    fclose($fp);
    $addtofile="$a,$b,$c,$d\n";

    $fp = fopen('student.csv', 'a');
    
    fwrite($fp, $addtofile);
    fclose($fp);
}
}
}

if(isset($_POST['search']))
{
$r=$_POST['roll'];
$fp = fopen('student.csv', 'r');
$fs = filesize('student.csv');
$seperator=',';
$flag=0;
while($row=fgetcsv($fp,$fs,$seperator)){
  if($row[2]==$r){
    echo "<b>Roll Number:</b>  &nbsp$row[2]<br>";
    echo "<b>First Name: </b> &nbsp$row[0]<br>";
    echo "<b>Last Name:</b> &nbsp $row[1]<br>";
    echo "<b>Email:</b> &nbsp $row[3]<br>";
    $flag=1;
    break;
  }

}
if($flag==0)
{
  echo "<b><font color=red>Student details not found!</font></b>";
}
fclose($fp);
}
if(isset($_POST['display']))
{
$fp = fopen('student.csv', 'r');
$fs = filesize('student.csv');
$seperator=',';
$flag=0;
while($row=fgetcsv($fp,$fs,$seperator)){
  $flag=1;
    echo "<hr><hr>";
    echo "<b>FIRST NAME:</b> $row[0]<br>";
    echo "<b>LAST NAME:</b> $row[1]<br>";
    echo "<b>ROLL NUMBER:</b> $row[2]<br>";
    echo "<b>EMAIL:</b> $row[3]";
   
}
if($flag==0)
  echo"<b><font color=red>No Details to display!!</font></b>";
fclose($fp);
}
if(isset($_POST['update']))
{
  $a=$_POST['fn'];
  $b=$_POST['ln'];
  $c=$_POST['roll'];
  $d=$_POST['email'];
$fp = fopen('student.csv', 'r');
$fp2= fopen('temp.csv', 'w');
$fs = filesize('student.csv');
$seperator=',';
while($row=fgetcsv($fp,$fs,$seperator)){
  if($row[2]==$c){

    $addtofile="$a,$b,$c,$d\n";
    fwrite($fp2, $addtofile);
  }
  else{
    $addtofile="$row[0],$row[1],$row[2],$row[3]\n";
    fwrite($fp2, $addtofile);
  }
}
fclose($fp2);
fclose($fp);
unlink('student.csv');
rename("temp.csv","student.csv");
}
if(isset($_POST['delete']))
{
  $c=$_POST['roll'];
$fp = fopen('student.csv', 'r');
$fp2= fopen('temp.csv', 'w');
$fs = filesize('student.csv');
$seperator=',';
while($row=fgetcsv($fp,$fs,$seperator)){
  if($row[2]!=$c){
    $addtofile="$row[0],$row[1],$row[2],$row[3]\n";
    fwrite($fp2, $addtofile);
  }
}
fclose($fp2);
fclose($fp);
unlink('student.csv');
rename("temp.csv","student.csv");
}
?>
