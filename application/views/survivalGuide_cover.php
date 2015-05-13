<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title ?>  | WPILIFE</title>
	<?php $this->load->view('includes/import');?>
	<script type="text/javascript">
		$(document).ready(function() 
		{
			$('.new_students_tab').attr('id', 'current');
		});
		
	</script>
</head>
<body>
<!-- Wrapper / Start -->
<div id="wrapper">
<?php $this->load->view('includes/header');?>
<div id="content">


<!-- 960 Container -->
<div class="container floated">

	<div class="sixteen floated page-title">

		<h2>Survival Guide</h2>

		<nav id="breadcrumbs">
			<ul>
				<li>You are here:</li>
				<li><a href="<?php echo base_url(); ?>">Home</a></li>
				<li>Survival Guide</li>
			</ul>
		</nav>

	</div>

</div>
<!-- 960 Container / End -->

</head>
<!-- 960 Container -->
<div class="container floated">
	<?php $this->load->view('includes/survivalGuide_left_menu');?>
	<!-- Page Content -->
	<div class="eleven floated right">
		<section class="page-content">
			<!-- Contact Form -->
			<section id="suvivalCover">
				<section id="coverHeader">
					<article>
						2015 - 2016<br/>WPI<br/>CSSA Survival Guide
					</article>
				
				</section>
				<section id="coverBody">
				Chinese Student & Scholars Association
				</section>
				<section id="coverFoot">
					<table width="100%">
						<tr>
							<td>Worcester Polytechnic Institute <br/> 2015 / 05<br/></td>
							<td><img src="<?php echo base_url();?>images/wpilife/wpilife.png" alt="wpilife suvival guide"></td>
						</tr>
					</table>
					<hr/>
				</section>
			</section>
		</section>
	</div>
	<!-- Page Content / End -->

</div>
<!-- 960 Container / End -->


</div>
</div>
<?php $this->load->view('includes/footer');?>
</body>
</html>