<?php
//start --or resume-- a session
session_start();

//check for a $_SESSION user_id variable and set it to 0 if it does not exist
if(!isset($_SESSION["user_id"])){
    $_SESSION["user_id"] = 0;
}

//Note the "include" URL  -- this PHP file runs from the php directory
include("connect.php");

//if the user is submitting the credentials...
if($_SESSION["user_id"] < 1){
    if((isset($_REQUEST["username"]))&&(isset($_REQUEST["password"]))){

        // To protect MySQL injection
        $myusername = trim($_REQUEST['username']);						//removes leading and trailing spaces
        $myusername = html_entity_decode($myusername);					//decodes html entity encoding ($_REQUEST decodes URL encoding)
        $myusername = stripslashes($myusername);						//removes any escape slashes
        $myusername = mysqli_real_escape_string($link, $myusername); 	//provides escape for MySQL, protects from MySQL injection

        $mypassword = trim($_REQUEST['password']);
        $mypassword = html_entity_decode($mypassword);
        $mypassword = stripslashes($mypassword);
        $mypassword = mysqli_real_escape_string($link, $mypassword);
        //$mypassword = SHA1($mypassword);//password encryption --for simple login, we will not encrypt the PW

        $query = "SELECT * FROM music_users WHERE user='".$myusername."' and pass='".$mypassword."'";
        $result = mysqli_query($link, $query);

        // Mysql_num_rows contains the number of rows selected
        if(mysqli_num_rows($result) == 1){
            $_SESSION["username"] = $myusername;
            $row = mysqli_fetch_array($result, MYSQLI_BOTH);
            $user_id = $row["id"];
            $_SESSION["user_id"] = $user_id;

            //-----------------------------Log-in is Successful-------------------------
            $html = '<div id="close_btn" style="clear:both;float:right;margin-right:0.5em;margin-top:0.5em;font-weight:bold">
			<button onclick="javascript:close_login_window();">X</button>
				</div>
				<h4>Log-In</h4>
				<p id="account_instructions" class="error" style="text-align:center;font-size=2em;font-weight:bold;">Success!</p>
						<p id="account_instructions" style="text-align:center;font-size=1.75em;">You are now Logged In.<br/><br/>
				<div style="text-align:center"><button onclick="javascript:window.location=window.location.href;">Continue</button></div><br/><br/>';


            $html .= '<script type="text/javascript">
					$("#log-in").html("Log Out");
				</script>';

        }else{
            //------------------------------------Log-in FAILED-----------------------------

            //echo "Wrong Username or Password"." user:".$myusername." pwd:".$mypassword;
            $html = '<div id="close_btn" style="clear:both;float:right;margin-right:0.5em;margin-top:0.5em;font-weight:bold">
			<button onclick="javascript:close_login_window();">X</button>
				</div>
				<h4>Login Error</h4>
				<p style="text-align:center;color:#cc0000">Bad user name and password.<br/><br/>
				<div style="text-align:center"><button onclick="javascript:do_login();">Log-in Again</button></div><br/><br/>';
        }
    }else{  // if((isset($_REQUEST["username"]))&&(isset($_REQUEST["password"])))

        //--------------------------------show the login dialog---------------------------------

        $html = '<div id="close_btn" style="clear:both;float:right;margin-right:0.5em;margin-top:0.5em;font-weight:bold">
			<button onclick="javascript:close_login_window();">X</button>
		</div>';

        $html .= '
		<h4>Log-In</h4>
		<form id="login" name="login" method="post" action="php/login.php">
			<div id="login_panel">
				<label class="login_labels">Username:</label>
				<input class = "login_input" id="username" name="username" type="text" placeholder="Username" autofocus required maxsize="45"><br/>
				<label class="login_labels">Password:</label>
				<input class = "login_input" id="password" name="password" type="password" placeholder="Password" required maxsize="45">
			</div>
			<input type="submit" id="submit" value="Log in" /><br/><br/>	
		</form>
		
		<script type="text/javascript">
			// Attach a submit handler to the form
			$( "#login" ).submit(function( event ) {
			  event.preventDefault();
			  $.post("php/login.php",$("#login").serialize(),function(data){
				$("#login_window").html(data);
				},"text");
			});
		</script>';


        //----------------------------------------------------------------------------------------
    } // else -- if((isset($_REQUEST["username"]))&&(isset($_REQUEST["password"])))

}else{  //  if($_SESSION["user_id"] < 1)
    ////////////////////////////////////////////  --LOG OUT--  ///////////////////////////////////////////////////////
    unset($_SESSION);
    session_destroy();
    //redirect to first page
    $html = '<h4>Log-Out</h4><br/><br/>
		<p id="account_instructions" class="error" style="text-align:center;font-size=2em;font-weight:bold;">You are now logged out.</p><br/><br/>
		<div style="text-align:center"><button onclick="javascript:menu_select(event,\'0\');">Continue</button></div><br/><br/>';
} // end  else  --  if($_SESSION["user_id"] < 1){

session_write_close();

echo $html;
?>

