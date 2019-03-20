<?php	

function htmlheader(&$title){
?>
    
    
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php 	print($title); ?></title>
<link href="styly.css" rel="stylesheet" type="text/css" media="screen" />

<meta http-equiv="cache-control" content="no-cache, must-revalidate" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="Content-Language" content="en-us" />
<meta name="author" content="CHIEF Developments" />
<meta http-equiv="Expires" content="-1" />
<meta name="keywords" lang="en-us" content="" />
<meta name="description" lang="en-us" content="" />


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        

<link href="style_sheet.css" rel="stylesheet" type="text/css" media="screen" />

</head>

<?php
}


function menu($section){
?>	
<ul id="menu">
    <li <?php if($section=="parentalresources"){print(" class=\"current\"");} ?>><a href="index.php?section=parentalresources">Parental Resources</a></li>
    <li <?php if($section=="handbooks"){print(" class=\"current\"");} ?>><a href="index.php?section=handbooks">Handbooks</a></li>
    <li <?php if($section=="lindenwoodathletics"){print(" class=\"current\"");} ?>><a href="index.php?section=lindenwoodathletics">Lindenwood Athletics</a></li>
    <li <?php if($section=="staff"){print(" class=\"current\"");} ?>><a href="index.php?section=staff">Staff</a></li>
    <li <?php if($section=="faq"){print(" class=\"current\"");} ?>><a href="index.php?section=faq">FAQ</a></li>  
    <li <?php if($section=="askanything"){print(" class=\"current\"");} ?>><a href="index.php?section=askanything">Ask Anything</a></li>
</ul>	


<?php
}


function db_connect() {
    //connect to database
    
    static $connection;
 
    //connect to the database, if a connection has not been established yet
    if(!isset($connection)) {
         //load config file
        $config = parse_ini_file('private/config.ini');
        $connection = mysqli_connect($config['host'],$config['username'],$config['password'],$config['dbname']);
        
    }
 
    // If connection was not successful, handle the error
    if($connection === false) {
        echo '<script language="javascript">';
        echo 'alert("Server is out of service. Sorry for the inconvenience")';
        echo '</script>';
        return mysqli_connect_error();
    }
    return $connection;
}

function askForm()
{
    //Ask Form for asking a question
  ?>

<form action="index.php?section=askanything" method="post" id="askform">
<label>First Name:</label>
<input name="fname" type="text" size="50" value="<?php if(isset($_REQUEST["fname"])){print($_REQUEST["fname"]);}?>" maxlength="255" id="fname" required />
<br />
<br />

<label>Last Name:</label>
<input name="lname" type="text" size="50" value="<?php if(isset($_REQUEST["lname"])){print($_REQUEST["lname"]);}?>" maxlength="255" id="lname" required />
<br />
<br />

<label>E-mail: </label>
<input name="email" type="text" size="50" value="<?php if(isset($_REQUEST["email"])){print($_REQUEST["email"]);}?>" maxlength="255" id="email" required/>
<br />
<br />
<label>Category: </label>
  <input  type="radio" name="category" value="Admissions" required> Admissions
  <input  type="radio" name="category" value="Life On Campus" > Life On Campus
  <input  type="radio" name="category" value="Athletic Teams" > Athletic Teams
  <input  type="radio" name="category" value="Other"> Other
<br />
<br />
<label>Question:</label>
<textarea name="question" cols="50" rows="6" id="question" required><?php if(isset($_REQUEST["question"])){print($_REQUEST["question"]);}?></textarea>
<br />
<br />
<input name="sendquestion" class="sendquestion" type="submit" value="Ask Question" />	

</form>
    
<?php
}