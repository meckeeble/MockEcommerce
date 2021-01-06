
<?php # DISPLAY COMPLETE LOGGED IN PAGE.

# Access session.
session_start() ; 

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

include ( 'includes/header.html' ) ;
?>


<title>Len's Motors</title>

<link rel="stylesheet" type="text/css" href="Styledetail.css">
<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

<style>
</style>

<?php 

if (isset($_REQUEST['Item_id'])){
    $theProductID = $_REQUEST['Item_id'];
    $dbc = mysqli_connect("localhost","root","","site_db")
    OR die(mysqli_connect_error());
    
    mysqli_set_charset($dbc, "utf-8");
    
    $q = "SELECT * FROM products WHERE Item_id = $theProductID";
    $r = mysqli_query($dbc, $q);
    if($r){
        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
            $thisID = $row['Item_id'];
            $thisImage = $row['Imageloc'];
            $thisProduct = $row['Name'];
            $thisPrice = number_format((float)$row['Price']);
            $thisDesc = $row['Description'];
            $thisType = $row['Type'];
            $thisColor = $row['Colour'];
            echo "<img class = \"detailView\" src=\"$thisImage\"/>";
            echo "<p style=\"font-size:24px; padding:5px; font-family:'times new roman';\">$thisProduct</p><p style =\"font-size:20px;\">£$thisPrice</p>";
            echo "<a href=\"added.php?id=$thisID\"><img src = \"images/cart.png\" style=\"width:80px;height:20px; vertical-align: super; float:left; \"><a><br></div>";
            echo "<p>Car type: <b>$thisType</b></p>";
            echo "<p>Colour: <b>$thisColor</b><br></p>";
            echo "<p>$thisDesc<br clear=\"all\"></p><br><br>";
        }
        
    }
}

else{
    echo"no Product ID found";
}
?>

</body>
</html>