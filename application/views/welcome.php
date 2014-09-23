<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?php $this->load->view('includes/import');?>
	<script type="text/javascript">
		$(document).ready(function() 
		{
			$('.home_tab').attr('id', 'current');
		});
		
	</script>
	<style type="text/css">
	.index_list a:hover h3
	{
		color: #169fe6;
	}
	</style>
</head>
<body>
<!-- Wrapper / Start -->
<div id="wrapper">
<?php $this->load->view('includes/header');?>
<div id="content">
<div style="text-align:center;background:rgb(41,41,41)">
	 <iframe width="560" height="315" src="//www.youtube.com/embed/ttXsSuDvBqM" frameborder="0" allowfullscreen></iframe>
</div>
<!-- LayerSlider  -->
<section id="layerslider-container">
	<div id="layerslider" style="width: 1020px; height: 300px; margin: 0 auto;">
	<?php $this->load->view('includes/slides');?>
	</div>
</section>
<!-- LayerSlider / End -->


<!-- 960 Container -->
<div class="container">
<?php 
	//echo $this->session->userdata('users_firstname');
	if($this->session->userdata('users_id') != null && $this->session->userdata('users_firstname') == 'member')
	{
?>
	<br/>
	<div class="notification closeable warning">
		<p> Hey! Update your information and tell us you're not from Mars. (It won't show up any more after your inforamtion updated) <a href="<?php echo base_url(); ?>manage/user">Goooo</a> </p>
		<a class="close" href="#"><i class="icon-remove"></i></a>
	</div>
<?php }?>	
	<!-- Icon Boxes -->
	<section class="icon-box-container">

		<!-- Icon Box Start -->
		<div class="one-third column">
			<article class="icon-box">
				<i class="icon-bullhorn"></i>
				<h3>Our Goal</h3>
				<p>WPILIFE is a platform, on which you can share information with others. Its goal is to make life easier in WPI.
				<br/><a href="<?php echo base_url();?>manual">Manual</a> </p>
			</article>
		</div>
		<!-- Icon Box End -->

		<!-- Icon Box Start -->
		<div class="one-third column">
			<article class="icon-box">
				<i class="icon-group"></i>
				<h3>We are listening</h3>
				<p>Your wish is my demand. You can give any advice and we will take care to implement it!</p>
			</article>
		</div>
		<!-- Icon Box End -->

		<!-- Icon Box Start -->
		<div class="one-third column">
			<article class="icon-box">
				<i class="icon-user"></i>
				<h3>Sign Up</h3>
				<p>Want to join us and share your life with other? Take 13 seconds to <a href="<?php echo base_url();?>signup">sign up</a> now</p>
			</article>
		</div>
		<!-- Icon Box End -->

	</section>
	<!-- Icon Boxes / End -->

</div>
<!-- 960 Container / End -->


<!-- 960 Container -->
<div class="container floated">
	<div class="blank floated">

		<!-- Recent Work Entire -->
		<div class="four columns carousel-intro">

			<section class="entire">
				<h3>Shop <i class="icon-arrow-right"></i></h3>
				<p>These are the items you can buy from others. And you can also publish your items which you want to sell here after your registration. </p>
			</section>

			<div class="carousel-navi">
				<div id="work-prev" class="arl jcarousel-prev"><i class="icon-chevron-left"></i></div>
				<div id="work-next" class="arr jcarousel-next"><i class="icon-chevron-right"></i></div>
			</div>
			<div class="clearfix"></div>

		</div>

		<!-- jCarousel -->
		<section class="jcarousel recent-work-jc">
			<ul>
			<?php
				if($items)
				{
					foreach($items as $row) 
					{
			?>
				<!-- Recent Item -->
				<li class="four columns">
					<a href="<?php echo base_url().'wpilife/shop/product/'.$row->shop_id;?>" class="portfolio-item">
						<figure>
							<img src="<?php echo base_url().'images/shop/'.substr_replace($row->shop_image_cover, '_small', -4, 0);?>" alt=""/>
							<figcaption class="item-description">
								<h5><?php echo $row->shop_title; ?></h5>
								<span><?php echo $row->shop_price; ?></span>
							</figcaption>
						</figure>
					</a>
				</li>
			<?php
						
					}
				}
				else
				{
			?>
				<li class="four columns">
					<a class="portfolio-item">
						<figure>
							<img src="images/shop/noItem.jpg" alt=""/>
							<figcaption class="item-description">
								<h5>Ohhhh, no items are available now</h5>
								<span>$0</span>
							</figcaption>
						</figure>
					</a>
				</li>
			<?php
				}
			
			
			?>

			</ul>
		</section>
		<!-- jCarousel / End -->

	</div>
</div>
<!-- 960 Container / End -->


<!-- 960 Container -->
<div class="container">
	<div class="sixteen columns index_list">
		<a href="<?php echo base_url();?>cssa/blog_list"><h3 class="margin-1">Recent Blogs / CSSA <span>more</span></h3></a>
		<?php
		if($blog_list)
		{
			foreach($blog_list as $row)
			{
		?>
		<div class="four columns alpha">
			<article class="recent-blog">
				<section class="date">
					<span class="day"><?php echo $row->blogs_day; ?></span>
					<span class="month"><?php echo substr($row->blogs_month, 0, 3); ?></span>
				</section>
				<h4><a href="<?php echo base_url()?>cssa/blog/<?php echo $row->blogs_id; ?>"><?php echo $row->blogs_title; ?></a></h4>
				<p><?php echo mb_substr(strip_tags($row->blogs_content), 0, 80); ?>...</p>
			</article>
		</div>
		<?php
			}
		}
		?>


	</div>

</div>
<!-- 960 Container / End -->

</div>
</div>
<?php $this->load->view('includes/footer');?>
</body>
</html>
