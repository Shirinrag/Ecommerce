<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
	<meta name="viewport" content="width=device-width" />

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="emailer.css" />
	<title>Email address Confirmed| contortek</title>

</head>

<body bgcolor="#FFFFFF">
	<!-- BODY -->
	<table class="body-wrap">
		<tr>
			<td></td>
			<td class="container" bgcolor="#FFFFFF">
				<div class="content">
					<table>
						<?php if(isset($msg) && $msg=='1'){ ?>
							<tr>
								<td>
									<h3>Hi, <?php echo $email_address; ?></h3>
									
									<p class="lead">Your Email has been confirmed successfully.</p>
									<a class="btn" href="http://www.directfarm.in">Click Here </a> to login on http://www.directfarm.in
									
								</td>
							</tr>
						<?php }else{ ?>
							<tr>
								<td>
									<h3><font color='red'>Your session has been expired!</font></h3>
								</td>
							</tr>
						<?php } ?>
					</table>
					</div>
				</td>
				<td></td>
			</tr>
		</table><!-- /BODY -->

	</body>
	</html>