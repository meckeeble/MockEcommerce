<?php # DISPLAY productsPING CART PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Cart' ;
include ( 'includes/header.html' ) ;

# Check if form has been submitted for update.
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
  # Update changed quantity field values.
  foreach ( $_POST['qty'] as $Item_id => $item_qty )
  {
    # Ensure values are integers.
    $id = (int) $Item_id;
    $qty = (int) $item_qty;

    # Change quantity or delete if zero.
    if ( $qty == 0 ) { unset ($_SESSION['cart'][$id]); } 
    elseif ( $qty > 0 ) { $_SESSION['cart'][$id]['quantity'] = $qty; }
  }
}

# Initialize grand total variable.
$total = 0; 

# Display the cart if not empty.
if (!empty($_SESSION['cart']))
{
  # Connect to the database.
  require ('connect_db.php');
  
  # Retrieve all items in the cart from the 'products' database table.
  $q = "SELECT * FROM products WHERE Item_id IN (";
  foreach ($_SESSION['cart'] as $id => $value) { $q .= $id . ','; }
  $q = substr( $q, 0, -1 ) . ') ORDER BY Item_id ASC';
  $r = mysqli_query ($dbc, $q);

  # Display body section with a form and a table.
  echo '<form action="cart.php" method="post"><div class = "divTable"><div class = "divTableRow"><th colspan="5">Items in your cart</div></div><div class = "divTableRow">';
  while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
  {
    # Calculate sub-totals and grand total.
    $subtotal = $_SESSION['cart'][$row['Item_id']]['quantity'] * $_SESSION['cart'][$row['Item_id']]['Price'];
    $total += $subtotal;

    # Display the row/s:
    echo "<div class = \"divTableRow\"> 
          <div class = \"divTableCell\">{$row['Name']}</div> 
          <div class = \"divTableCell\">{$row['Description']}</div>
          <div class = \"divTableCell\"><input type=\"text\" size=\"3\" name=\"qty[{$row['Item_id']}]\" value=\"{$_SESSION['cart'][$row['Item_id']]['quantity']}\"></div>
          <div class = \"divTableCell\"> {$row['Price']} each. = </div> <div class = \"divTableCell\">".number_format ($subtotal, 2)."</div></div>";
  }
  
  # Close the database connection.
  mysqli_close($dbc); 
  
  # Display the total.
  echo ' <div class = "divTableRow">Total = £'.number_format($total,2).'</div></div></div><input type="submit" name="submit" value="Update My Cart"></form>';
}
else
# Or display a message.
{ echo '<p>Your cart is currently empty.</p>' ; }

# Create navigation links.
echo '<p><a href="products.php">Products</a> | <a href="checkout.php?total='.$total.'">Checkout</a> | <a href="forum.php">Forum</a> | <a href="home.php">Home</a> | <a href="goodbye.php">Logout</a></p>' ;

# Display footer section.
include ( 'includes/footer.html' ) ;

?>