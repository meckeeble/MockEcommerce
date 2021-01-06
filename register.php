<style>
.container {
  margin:auto;
  padding:10px;
  width: 350px;
  clear: both;
}

.container input {
  width: 100%;
  clear: both;
}


</style>

<?php # DISPLAY COMPLETE REGISTRATION PAGE.

# Set page title and display header section.
$page_title = 'Register' ;
include ( 'includes/header.html' ) ;

# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Connect to the database.
  require ('connect_db.php'); 
  
  # Initialize an error array.
  $errors = array();

  # Check for a first name and validate.
  if ( empty( $_POST[ 'first_name' ] ) )
  { $errors[] = 'Enter your first name.' ; }
  elseif (!preg_match("/^[a-zA-Z ]*$/",( $_POST[ 'first_name' ])) 
      or (!preg_match("/^[a-zA-Z ]*$/",( $_POST[ 'last_name' ] )) 
      or (!preg_match("/^[a-zA-Z ]*$/",( $_POST[ 'title' ] ))))) {
      $errors[] = "Letters and spaces only for names and titles";
  }
  else
  { $fn = mysqli_real_escape_string( $dbc, trim( $_POST[ 'first_name' ] ) ) ; }
  

  # Check for a last name.
  if (empty( $_POST[ 'last_name' ] ) )
  { $errors[] = 'Enter your last name.' ; }

  else
  { $ln = mysqli_real_escape_string( $dbc, trim( $_POST[ 'last_name' ] ) ) ; }

  # Check for an email address:
  if ( empty( $_POST[ 'email' ] ) )
  { $errors[] = 'Enter your email address.'; }
  elseif (!filter_var(( $_POST[ 'email' ] ), FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid email format";
  }
  else
  { $e = mysqli_real_escape_string( $dbc, trim( $_POST[ 'email' ] ) ) ; }
 

  # Check for a password and matching input passwords.
  if ( !empty($_POST[ 'pass1' ] ) )
  {
    if ( $_POST[ 'pass1' ] != $_POST[ 'pass2' ] )
    { $errors[] = 'Passwords do not match.' ; }
    else
    { $p = mysqli_real_escape_string( $dbc, trim( $_POST[ 'pass1' ] ) ) ; }
  }
  else { $errors[] = 'Enter your password.' ; }
  
  # Check if email address already registered.
  if ( empty( $errors ) )
  {
    $q = "SELECT user_id FROM users WHERE email='$e'" ;
    $r = @mysqli_query ( $dbc, $q ) ;
    if ( mysqli_num_rows( $r ) != 0 ) $errors[] = 'Email address already registered. <a href="login.php">Login</a>' ; }
    
   #Check for a title.
   if ( empty( $_POST[ 'title' ] ) )
   { $errors[] = 'Enter your title.'; }
    else
    { $e = mysqli_real_escape_string( $dbc, trim( $_POST[ 'title' ] ) ) ; }
    
    #Check for an address.
    if ( empty( $_POST[ 'address1' ] ) )
    { $errors[] = 'Enter your address.'; }
    elseif (!preg_match("/^[a-zA-Z0-9 ]*$/",( $_POST[ 'address1' ])))
    { $errors[] = 'Invalid address (first line). Numbers and letters only.'; }
    else
    { $e = mysqli_real_escape_string( $dbc, trim( $_POST[ 'address1' ] ) ) ; }
    
    #Check for an address.
    if ( empty( $_POST[ 'address2' ] ) )
    { $errors[] = 'Enter your address.'; }
    elseif (!preg_match("/^[a-zA-Z0-9 ]*$/",( $_POST[ 'address2' ])))
    { $errors[] = 'Invalid address (second line). Numbers and letters only.'; }
    else
    { $e = mysqli_real_escape_string( $dbc, trim( $_POST[ 'address2' ] ) ) ; }
    
    #Check for a town.
    if ( empty( $_POST[ 'town' ] ) )
    { $errors[] = 'Enter your town.'; }
    else
    { $e = mysqli_real_escape_string( $dbc, trim( $_POST[ 'town' ] ) ) ; }
    
    #Check for an county.
    if ( empty( $_POST[ 'county' ] ) )
    { $errors[] = 'Enter your county.'; }
    elseif (!preg_match("/^[a-zA-Z ]*$/",( $_POST[ 'county' ])))
    { $errors[] = 'Invalid county. Letters only.'; }
    else
    { $e = mysqli_real_escape_string( $dbc, trim( $_POST[ 'county' ] ) ) ; }
    
    #Check for an postcode.
    if ( empty( $_POST[ 'postcode' ] ) )
    { $errors[] = 'Enter your postcode.'; }
    elseif (!preg_match("/^[a-zA-Z0-9 ]*$/",( $_POST[ 'postcode' ])))
    { $errors[] = 'Invalid postcode. Letters and numbers only.'; }
    else
    { $e = mysqli_real_escape_string( $dbc, trim( $_POST[ 'postcode' ] ) ) ; }
    
    #Check for a mobile number and validate
    if ( empty( $_POST[ 'mobile_number' ] ) )
    { $errors[] = 'Enter your mobile number.'; }
    elseif (!preg_match('/^\d{10}$/',( $_POST[ 'mobile_number' ])))
    { $errors[] = 'Invalid mobile number.'; }
    else
    { $e = mysqli_real_escape_string( $dbc, trim( $_POST[ 'mobile_number' ] ) ) ; }
    
    #Check for a date of birth.
    if ( empty( $_POST[ 'date_of_birth' ] ) )
    { $errors[] = 'Enter your date of birth.'; }
    else
    { $e = mysqli_real_escape_string( $dbc, trim( $_POST[ 'date_of_birth' ] ) ) ; }
  
  # On success register user inserting into 'users' database table.
  if ( empty( $errors ) ) 
  {
    $q = "INSERT INTO users (first_name, last_name, email, pass, reg_date) VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW() )";
    $r = @mysqli_query ( $dbc, $q ) ;
    if ($r)
    { echo '<h1>Registered!</h1><label>Welcome to Len\'s motors You are now registered.</p><label><a href="login.php">Login</a></p>'; }
  
    # Close database connection.
    mysqli_close($dbc); 

    # Display footer section and quit script:
    include ('includes/footer.html'); 
    exit();
  }
  # Or report errors.
  else 
  {
    echo '<h1>Error!</h1><p id="err_msg">The following error(s) occurred:<br>' ;
    foreach ( $errors as $msg )
    { echo " - $msg<br>" ; }
    echo 'Please try again.</p>';
    # Close database connection.
    mysqli_close( $dbc );
  }  
}
?> 
  
 
  
<!-- Display body section with sticky form. -->
<h1>Register</h1>
<div class = "container">
    <form action="register.php" method="post">
        <label style="width: 40%;">Title:</label> <input type="text" name="title" size="10" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>"></p>        
        <label>First Name:</label> <input type="text" name="first_name" size="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>"> 
        <label>Last Name:</label> <input type="text" name="last_name" size="20" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>"></p>
		
        <label>Date Of Birth:</label> <input type="date" name="date_of_birth" size="10" value="<?php if (isset($_POST['date_of_birth'])) echo $_POST['date_of_birth']; ?>"></p>
        <br>
        <label>Address 1:</label> <input type="text" name="address1" size="50" value="<?php if (isset($_POST['address1'])) echo $_POST['address1']; ?>"></p>
        <label>Address 2:</label> <input type="text" name="address2" size="50" value="<?php if (isset($_POST['address2'])) echo $_POST['address2']; ?>"></p>
        <label>Town:</label> <input type="text" name="town" size="20" value="<?php if (isset($_POST['town'])) echo $_POST['town']; ?>"></p>
        <label>County:</label> <input type="text" name="county" size="20" value="<?php if (isset($_POST['county'])) echo $_POST['county']; ?>"></p>
        <label>Postcode:</label> <input type="varchar" name="postcode" size="10" value="<?php if (isset($_POST['postcode'])) echo $_POST['postcode']; ?>"></p>
        <br>
        <label>Mobile Number:</label> <input type="int" name="mobile_number" size="20" value="<?php if (isset($_POST['mobile_number'])) echo $_POST['mobile_number']; ?>"></p>
		-
        <label>Email Address:</label> <input type="text" name="email" size="50" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></p>
        <br>
        <label>Password:</label> <input type="password" name="pass1" size="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" >
        <label>Confirm Password:</label> <input type="password" name="pass2" size="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"></p>
        <input type="submit" value="Register"></p>
	</form>
</div>