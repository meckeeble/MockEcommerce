<style>

</style>


<?php # DISPLAY COMPLETE FORUM PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Forum' ;
include ( 'includes/header.html' ) ;

# Open database connection.
require ( 'connect_db.php' ) ;

echo '<h2>Welcome to Len\'s Motors forums.</h2>';

echo '<p><a href="post.php">Post New Message</a>';

# Display body section, retrieving from 'forum' database table.
$q = "SELECT * FROM forum" ;
$r = mysqli_query( $dbc, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{
  echo '<div class = "divTable">
        <div class = "divTableRow">
        <div class = "divTableHead">Posted By:</div>    
        <div class = "divTableHead">Subject</div>  
        <div class = "divTableHead">Message</div></div>';
  while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {
    echo '<div class = "divTableRow">
          <div class = "divTableCell">' . $row['first_name'] .' '. $row['last_name'] . '<br>'. $row['post_date'].'</div>
          <div class = "divTableCell">' . $row['subject'] . '</div><div class = "divTableCell">' . $row['message'] . '</div> </div>';
  }
  echo '</div>' ;
}
else { echo '<p>There are currently no messages.</p>' ; }


# Close database connection.
mysqli_close( $dbc ) ;
  
# Display footer section.
include ( 'includes/footer.html' ) ;

?>