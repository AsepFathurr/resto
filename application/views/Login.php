<?php $assets = base_url('assets/');?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login sistem</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo $assets;?>css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="<?php echo $assets;?>css/styles.css" rel="stylesheet">

   	<link href="<?php echo $assets;?>vendors/form-helpers/css/bootstrap-formhelpers.min.css" rel="stylesheet">
    <link href="<?php echo $assets;?>vendors/select/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo $assets;?>vendors/tags/css/bootstrap-tags.css" rel="stylesheet">

    <link href="<?php echo $assets;?>css/forms.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-bg">
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-12">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="">SISTEM INVENTORI RESTORAN</a></h1>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

	<form method="post" action="<?php echo base_url('login/do_login');?>">
	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
			

				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
			                <h6>Login</h6>

			                <?php if(isset($_SESSION['message']['msg'])): ?>
						        <div id="message">
						        <!-- message -->
						        <div class="alert <?php echo $_SESSION['message']['color']?>">
								  <strong><?php echo $_SESSION['message']['title']?></strong> 
								 <?php echo $_SESSION['message']['msg']?>
								</div>
						        <!-- message end -->
						      </div>
					    	<?php endif; ?>
			                <input class="form-control" type="text" placeholder="Username" name="username" required="">
			                <input class="form-control" type="password" placeholder="Password" name="password" required="">

			                <div class="action">
			                    <button class="btn btn-primary signup" type="submit">Login</button>
			                </div>                
			            </div>
			        </div>

			    </div>
			</div>
		</div>
	</div>
	</form>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo $assets;?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $assets;?>js/custom.js"></script>
	<script src="<?php echo $assets;?>js/tables.js"></script>
  </body>
</html>