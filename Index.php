<?php
	
	require("function.php");
	htmlheader($title);
	
	if(isset($_REQUEST["section"])){
		$section = $_REQUEST["section"];
	}else{
		$section = "parentalresources";
	}
	

	switch($section){
		case "parentalresources" :$title= "Parental Resources"; break;
		case "handbooks" :$title= "Parental Resources - Handbooks"; break;
		case "lindenwoodathletics" :$title= "Parental Resources - Lindenwood Athletics"; break;
		case "staff" :$title= "Parental Resources - Staff"; break;
		case "askanything" :$title= "Parental Resources - Ask Anything"; break;
		case "faq" :$title= "Parental Resources - FAQ"; break;
                case "adminportal" :$title= "Parental Resources: Admin Portal"; break;
	
	}
	
?>

<body>
<div id="header">


<div class="menu">
<?php
menu($section);
?>

</div>
</div>
<div id="content">
<?php

if($section == "parentalresources")
{


}

if($section == "handbooks")
{

    
    
    
}

if ($section == "lindenwoodathletics")
{


	
}

if($section == "staff"){


   
}

if($section == "askanything") {

    if(!isset($_POST["sendquestion"]))
    {
        //if the button 'Ask Question' was NOT clicked -> print form
        ?>
    
        <h3>Ask Us Anything</h3>
        <p>Send us your question about anything you want to know and we will do our best to provide helpful answer.</p>
        <hr />

        <?php
  
        askForm(); //print the Ask Form
    }
    else
    {
        //button 'Ask Question' was clicked
   
        ?>
        <h3>Ask Us Anything</h3>
        <p>Send us your question about anything you want to know and we will do our best to provide helpful answer.</p>
        <hr />
        <?php
            
        //save values from the form    
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $userIP = $_SERVER['REMOTE_ADDR'];
        $question = $_POST['question'];
        $category = $_POST ['category'];
      
        $connection = db_connect(); //establish connection with database
        $stmt = mysqli_prepare($connection, "CALL AskQuestion_sp(?,?,?,?,?,?)"); //call stored procedure
        mysqli_stmt_bind_param($stmt, 'ssssss', $email, $fname, $lname, $userIP, $question, $category); //feed parameters for sp

        mysqli_stmt_execute($stmt);

        print('Your question was sent'); 
    }
   
}
if($section == "faq") {
?>
    
    <p>FAQ</p>   
    


<?php
}

if($section == "adminportal") {

    //admin portal
    
    //login page
    if(!isset($_POST["login"]))
    {
        //button login was NOT clicked
    ?>

    <h3>Admin Portal</h3>

    <p>Log in to with your account to the admin portal.</p>
    
    <form action="index.php?section=adminportal" method="post" id="login">
     
    <label>E-mail: </label>
    <input name="loginemail" type="text" size="50" value="<?php if(isset($_REQUEST["loginemail"])){print($_REQUEST["loginemail"]);}?>" maxlength="255" id="loginemail" required/>
    <br />
    <br />
    <label>Password: </label>
    <input name="loginpassword" type="password" size="50" value="" maxlength="255" id="loginpassword" required/>
    <br />
    <br />
    <input name="login" class="login" type="submit" value="Login" />	
    
    </form>
    
<?php
    }
    else
    {
        //button login was clicked
        //check credentials
        
        $loginemail = $_POST["loginemail"];
        $loginpassword = $_POST["loginpassword"];
        
        //prevent from sql injection!!!
        
        $connection = db_connect(); //establish connection with database
        $result = mysqli_query($connection, "SELECT email, password FROM admin_t WHERE email='$loginemail'");
        $row = mysqli_fetch_array($result);
        
        if(!(($row['email'] == $loginemail ) && ($row['password'] == SHA1($loginpassword))))
        {

            //if credentials not correct -> print form again with message
            
            ?>
    
            <h3>Admin Portal</h3>

            <p>Log in to with your account to the admin portal.</p>
            <br />
            <p>The username or password you have entered is invalid. Please try again.</p>
            
    
   <?php
            
        
            loginForm(); //print login form
            
        }
        else{
            //if correct -> go to homepage adminportal
            print('LOGIN SUCCESFULL - WELCOME TO ADMIN PORTAL');
            
           
            
            
            
            
        }
        
    }



}


?>

</div>
<div id="footer">


<a href="index.php?section=adminportal">Admin Portal</a>

</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
</body>