<?php require 'inc/header.php';
//require 'inc/slider.php';
?>

<?php
	// $login_check=Session::get('customer_login');
	// if($login_check){
	// 	header('location:order.php');
	// }
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$insertCustomer = $customer->insert_customer($_POST);
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
	$login_customer = $customer->login_customer($_POST);
}
?>
<div class="main">
	<div class="content">
		<div class="login_panel">
			<h3>Login</h3>
			<?php
			if (isset($login_customer)) {
				echo $login_customer;
			}
			?>
			<form action="" method="post">
				<input  type="text" name="email" class="field" placeholder="enter email">
				<input  type="password" name="password" class="field" placeholder="enter password">
		
			<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
			<div class="buttons">
				<div><input type="submit" class="grey" name="login" value="Sign In"></div>
			</div>
			</form>
		</div>

		<div class="register_account">
			<h3>Register New Account</h3>
			<?php
			if (isset($insertCustomer)) {
				echo $insertCustomer;
			}
			?>
			<form action="" method="post">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="enter name">
								</div>

								<div>
									<input type="text" name="city" placeholder="enter city">
								</div>

								<div>
									<input type="text" name="zipcode" placeholder="enter zipcode">
								</div>
								<div>
									<input type="text" name="email" placeholder="enter email">
								</div>
							</td>
							<td>
								<div>
									<input type="text" name="address" placeholder="enter address">
								</div>
								<div>
									<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
										<option value="null">Select a Country</option>
										<option value="vietnam">Việt Nam</option>
										<option value="campuchia">CamPuChia</option>
										<option value="lao">Lào</option>
										<option value="thailan">Thái Lan</option>
										<option value="trungquoc">Trung Quốc</option>
									</select>
								</div>

								<div>
									<input type="text" name="phone" placeholder="enter phone">
								</div>

								<div>
									<input type="text" name="password" placeholder="enter password">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<div><input type="submit" name="submit" class="grey" value="Create Account"></button></div>
				</div>
				<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.
				</p>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php require 'inc/footer.php' ?>