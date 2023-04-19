<?php
include 'lib/session.php';
Session::init();
?>
<?php
include 'lib/database.php';
include 'helpers/format.php';


spl_autoload_register(function ($className) {
	include_once "classes/" . $className . ".php";
});
$db = new Database();
$fm = new Format();
$cart = new cart();
$user = new user();
$cat = new category();
$product = new product();
$customer = new customer();
$compare = new compare();
$wishlist = new wishlist();
$comment = new comment();

?>

<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>

<head>
	<title>Store Website</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<script src="js/jquerymain.js"></script>
	<script src="js/script.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/nav.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript" src="js/nav-hover.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).ready(function($) {
			$('#dc_mega-menu-orange').dcMegaMenu({
				rowItems: '4',
				speed: 'fast',
				effect: 'fade'
			});
		});
	</script>
</head>

<body>
	<div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			<div class="header_top_right">
				<div class="search_box">
					<form action="search.php" method="post">
						<input type="text" placeholder="Tim kiem san pham" name="tukhoa">
						<input type="submit" name="search_product" value="Tìm kiếm">
					</form>
				</div>
				<div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
							<span class="no_product">
								<?php
								$check_cart = $cart->check_cart();
								if ($check_cart) {
									$sum = Session::get("sum");
									$qty = Session::get("qty");
									echo $fm->format_currency($sum) . " đ" . '-' . 'Qty:' . $qty;
								} else {
									echo 'Empty';
								}

								?>
							</span>
						</a>
					</div>
				</div>
				<?php
				if (isset($_GET['customerId'])) {
					$customerId = $_GET['customerId'];
					$delCart = $cart->del_all_data_cart();
					$delCompare = $cart->del_in_compare($customerId);
					Session::destroy();
				}
				?>
				<div class="login">
					<?php
					$login_check = Session::get('customer_login');
					if ($login_check == false) {
						echo '<a href="login.php">Login</a></div>';
					} else {
						echo '<a href="?customerId=' . Session::get('customer_id') . '">Logout</a></div>';
					}
					?>

					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="menu">
				<ul id="dc_mega-menu-orange" class="dc_mm-orange">
					<li><a href="index.php">Home</a></li>
					<li><a href="products.php">Categories</a> </li>
					<li><a href="topbrands.php">Brands</a></li>
					<?php
					$check_cart = $cart->check_cart();
					if ($check_cart) {
						echo '<li><a href="cart.php">Cart</a></li>';
					} else {
						echo '';
					}
					?>
					<?php
					$login_check = Session::get('customer_login');
					if ($login_check == false) {
						echo null;
					} else {
						echo '<li><a href="profile.php">Profile</a> </li>';
					}
					?>
					<?php
					$customerId = Session::get('customer_id');
					$check_order = $cart->check_order($customerId);
					if ($check_order) {
						echo '<li><a href="orderdetails.php">Ordered</a></li>';
					} else {
						echo '';
					}
					?>
					<?php
					$login_check = Session::get('customer_login');
					if ($login_check == false) {
						echo null;
					} else {
						echo '<li><a href="compare.php">Compare</a> </li>';
					}
					?>
					<?php
					$login_check = Session::get('customer_login');
					if ($login_check == false) {
						echo null;
					} else {
						echo '<li><a href="wishlist.php">Wish List</a> </li>';
					}
					?>
					<li><a href="news.php">NEWS</a></li>
					<div class="clear"></div>
				</ul>
			</div>