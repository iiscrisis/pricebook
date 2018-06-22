<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?>


<?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- #content -->
    <?php get_template_part( 'footer-widget' ); ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
            <div class="site-info">

            </div><!-- close .site-info -->
		</div>
	</footer><!-- #colophon -->
<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>
<div class="body_mask"></div>
<div class="loader"></div>
<script type="text/javascript">
	function spinnerStart() {
		jQuery(".body_mask, .loader").show();
	}
	function spinnerStop() {
		jQuery(".body_mask, .loader").hide();
	}

	jQuery(document).ready(function() {
		jQuery.ajax({
			 type : "post",
			 url : ajaxurl,
			 data : {
				 action	:	'getNewMessagesCount'
			 },
			 success: function(response) {
				 if (jQuery('a[href="/usermessages"]').length == 1) { jQuery('a[href="/usermessages"]').parent('li').find('span').text(response); }
				 if (jQuery('a[href="/sellermessages"]').length == 1) { jQuery('a[href="/sellermessages"]').parent('li').find('span').text(response); }
			 }
		 });
	});
</script>

<?php if (is_user_logged_in()) { ?>
	<script type="text/javascript">
		window.setInterval(function(){
			jQuery.ajax({
				 type : "post",
				 url : ajaxurl,
				 data : {
					 action     : 'getNewMessagesCount'
				 },
				 success: function(response) {
					 jQuery('a[href="/usermessages"]').parent('li').find('span').text(response);
				 }
			 });
		}, 5000);
	</script>
<?php } ?>
<div id="login" class="col-md-6">
	<div id="login-status">
		<div class="row">
			<span></span>
		</div>
		<div class="row">
			<div class="col-12 text-center">
				<button class="btn btn-default" onclick="getElementById('login-status').style.display = 'none'">Close</button>
			</div>
		</div>
	</div>
	<div class="login-inner col-md-12 text-center">
		<div class="col-md-12 nopadding text-right">
			<div class="close-login"><h4>X</h4></div>
		</div>
		<div class="col-md-12 text-left">
			<h4>ΕΧΩ ΛΟΓΑΡΙΑΣΜΟ</h4>
		</div>
		<form name="login_form" action="" method="post">
			<div class="col-md-12">
				<div class="row">
					<input type="email" class="col-md-12" name="user_login" placeholder="ΤΟ EMAIL ΣΟΥ" required />
				</div>
				<div class="row">
					<input type="password" class="col-md-12" name="user_password" placeholder="ΚΩΔΙΚΟΣ ΧΡΗΣΤΗ" required />
				</div>
				<div class="row">
					<input type="submit" class="col-md-12 btn btn-danger" name="submit" value="ΣΥΝΔΕΣΗ" />
				</div>
			</div>
		</form>
		<div class="col-md-12 text-center">
			<a href="#" class="forgotPass">ΞΕΧΑΣΑ ΤΟΝ ΚΩΔΙΚΟ ΜΟΥ</a>
			<div class="row">
				<hr>
			</div>
			<div class="row">
				<h4>ΔΕΝ ΕΧΩ ΛΟΓΑΡΙΑΣΜΟ</h4>
				<p>Lorem Ipsum</p>
			</div>
			<div class="row">
				<div class="col-md-12">
					<a href="<?php get_site_url();?>/pricebook/register-buyer/" class="btn btn-default">ΕΓΓΡΑΦΗ ΑΓΟΡΑΣΤΗ</a>
				</div>
				<div class="col-md-12">
					Lorem Ipsum
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<a href="/register-seller/" class="btn btn-default">ΕΓΓΡΑΦΗ ΕΠΑΓΓΕΛΜΑΤΙΑ</a>
				</div>
				<div class="col-md-12">
					Lorem Ipsum
				</div>
			</div>
		</div>
	</div>
</div>
<div id="forgotPass">
	<div class="forgotPass-inner">
		<form id="forgotPassFrm">
			<h5>Πληκτρολογήστε το email σας για να λάβετε νέο κωδικό</h5>
			<input type="email" name="user_email" required />
			<input type="submit" class="btn btn-primary" value="Recover" />
		</form>
	</div>
</div>
<script type="text/javascript">
	jQuery(".triggerLogin").bind('click',function() {
		if (jQuery("#login:visible").length == 1) {
			jQuery("#login").fadeOut();
			jQuery(".body_mask").fadeOut();
		}
		else {
			jQuery(".body_mask").fadeIn();
			jQuery("#login").fadeIn();
		}
	});
	jQuery('.close-login').bind('click',function() {
		if (jQuery("#login:visible").length == 1) {
			jQuery("#login").fadeOut();
			jQuery(".body_mask").fadeOut();
		}
	});
	jQuery("#login input[type='submit']").click(function(e) {

		e.preventDefault();
		jQuery.post(
			ajaxurl,
			{
				'action':	'loginUser',
				'data':		{
					'user_login': jQuery("input[name='user_login']").val(),
					'user_password': jQuery("input[name='user_password']").val()
				}
			},
			function (response) {
				var response = JSON.parse(response);
				if (response.status == 0) {
					document.write(response.message);
				}
				else if (response.status == 3) {
					jQuery(response.message).appendTo("body");
					jQuery("#login").fadeOut();
					jQuery(".body_mask").show();
					jQuery("#roleForm").show();
				}
				else {
					jQuery('#login-status span').html(response.message).parent().parent().fadeIn();
				}
			}
		);
		return false;
	});
	jQuery("#roleForm input[name='role']").live('click',function(e) {
		e.preventDefault();
		jQuery.post(
			ajaxurl,
			{
				'action':	'changeRole',
				'data':		{
					'role': jQuery(this).val(),
					'user_login': jQuery("input[name='user_login']").val(),
					'user_password': jQuery("input[name='user_password']").val()
				}
			},
			function (response) {
				var response = JSON.parse(response);
				if (response.status == 0) {
					window.location.replace(response.message);
				}
			}
		);
	});

	jQuery(".forgotPass").bind('click',function() {
		if (jQuery("#login:visible").length == 1) {
			jQuery("#login").fadeOut();
			jQuery("#forgotPass").fadeIn();
		}
		else if (jQuery("#login:visible").length == 1 && jQuery("#forgotPass:visible").length == 1) {
			jQuery("#login").fadeOut();
			jQuery("#forgotPass").fadeIn();
			jQuery(".body_mask").fadeOut();
		}
		else {
			jQuery(".body_mask").fadeIn();
			jQuery("#forgotPass").fadeIn();
		}

		jQuery("#forgotPass input[type='submit']").click(function(e) {
			e.preventDefault();
			jQuery.post(
				ajaxurl,
				{
					'action':	'forgotPass',
					'user_email': jQuery("input[name='user_email']").val(),
				},
				function (response) {
					var response = JSON.parse(response);
					alert(response.message);
				}
			);
			return false;
		});
	});
</script>
</body>
</html>
