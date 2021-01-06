<?php # DISPLAY COMPLETE LOGGED IN PAGE.

# Access session.
session_start() ; 

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

include ( 'includes/header.html' ) ;
?>

<html>
<head>

<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
<link rel="stylesheet" href="Styleproducts.css">
<style>

div.border{ border-top: 5px solid #000000;

            }

      
.column {
    float: left;
    width: 33.33%;
    padding: 5px;

}

.row::after {
    content: "";
    clear: both;
    display: table;
    

}
</style>
</style>
</head>
<body>
<title>Products</title>
    
    <Form action = "products.php" method = "Post">
    	<input type= "text" name="search" placeholder= "Find your car...">
    	<input type= "submit" value="search" /> 

    	
</Form>
 <?php
$dbc = mysqli_connect("localhost","root","","site_db")
OR die(mysqli_connect_error());

//collect
if(isset($_POST['search'])) {
    $searchq = $_POST['search'];
    $searchq = preg_replace("#[^0-9a-z]#i","", $searchq);
    
    $query = mysqli_query($dbc,"SELECT * FROM products WHERE Name LIKE '%$searchq%' OR Brand LIKE '%$searchq%' OR Model LIKE '%$searchq%' OR Type LIKE '%$searchq%'
    OR Colour LIKE '%$searchq%' OR Year LIKE '%$searchq%' OR Price LIKE '%$searchq%'")
    or die ("could not search...");
    $count = mysqli_num_rows($query);
    if($count == 0) {
         $output = 'There was no search results!';
    }
    else{
        while($row= mysqli_fetch_array($query)) {
            $Name = $row['Name'];
            $Brand = $row ['Brand'];  
            $Model = $row ['Model'];
            $Type = $row ['Type'];
            $Colour = $row ['Colour'];
            $Year = $row ['Year'];
            $Price = $row ['Price'];
            $Item_id = $row ['Item_id'];
            
           
            
            $output = "<a href = \"detail.php?Item_id=$Item_id\">".$Name."</a> ".$Type." ".$Colour." ".$Year." ".$Price."<br>";
            echo("$output");
            }
            
    }}
?>
 
<?php
mysqli_set_charset($dbc, "utf-8");

$q = "SELECT * FROM products";
$r = mysqli_query($dbc, $q);

if($r){
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
        $thisID = $row['Item_id'];
        $thisImage = $row['Imageloc'];
        $thisProduct = $row['Name'];
        $thisPrice = number_format((float)$row['Price']);
        echo '<div class= "border">';
        echo '<div class = "row">';
        echo '<div class = "column">';
        echo "<a href=\"detail.php?Item_id=$thisID\" style=\"text-decoration:none\"><img class=\"thumb\" src=\"$thisImage\"/>$thisProduct</a><br>£$thisPrice<br clear=\"all\"><br><br></div>";
        echo '<div class = "column">';
        echo "<a href=\"added.php?id=$thisID\"><img src = \"images/cart.png\" style=\"width:80px;height:20px; vertical-align: super; float:left; \"></div>";
        echo '</div></div>';
        
      }
      }
?>