<?php $assets = base_url('assets/');?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $web['title']?></title>
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
    <style type="text/css">
    	.covers {
		  object-fit: cover;
		  width: 120px;
		  height: 70px;
		}
    </style>
  </head>
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="<?php echo base_url();?>">SISTEM INVENTORI RESTORAN</a></h1>
	              </div>
	           </div>
	           <div class="col-md-4">
	              <div class="row">
	              </div>
	           </div>
	           <div class="col-md-3">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->user_name;?> <b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">
	                          <li><a href="<?php echo base_url('profil'); ?>">Profile</a></li>
	                          <li><a href="<?php echo base_url('login/do_logout'); ?>">Logout</a></li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <?php 
                	$menu = 'Template_menu_'.$_SESSION['user_level'].'.php';
                	require_once($menu); 

                ?>
             </div>
		  </div>
		  <div class="col-md-10">
		  	<?php require_once($web['page']);?>
		  </div>
		</div>
    </div>

    <footer>
         <div class="container">
         
            <div class="copy text-center">
               Copyright 2018 <a href='#'>Asep Faturahman </a>
            </div>
            
         </div>
      </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo $assets;?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $assets;?>js/custom.js"></script>
	<script src="<?php echo $assets;?>js/tables.js"></script>

    <?php if($web['is_table'] == true):?>
    	<script src="<?php echo $assets;?>vendors/datatables/js/jquery.dataTables.min.js"></script>
    	<script src="<?php echo $assets;?>vendors/datatables/dataTables.bootstrap.js"></script>
	<?php endif;?>
    <script>
    	  // activated menu
		  var menu = "<?php echo $web['aktif_menu']?>";
		  $('#'+menu).addClass('current');
		  // activated menu


		  // resep add bahan
		  <?php if(!isset($no)):?>
		  	var number = 1;
		  <?php else: ?>
		  	var number = <?php echo $no;?>;
		  <?php endif; ?>
		  $("#btn_add").click(function () {
		  		
		  		 $.ajax({
				    url: '<?php echo base_url('menu/add_resep');?>',
				    type: "POST",
				    dataType: "json",
				    cache: false,
				    data:{
				        number: number
				    },
				    success: function(data){
				     	$("#resep").append(data.html);
				     	number = number + 1;
				  	}
				});
			  
			});
		  // resep add bahan

		  function imChange($number) {
			   	var id = $('.bahan'+$number).find(':selected').data('satuan');
			    // alert("yes "+id);
			    $(".bahan_satuan_"+$number).html(id);
			    $(".bahan_qty_"+$number).focus();

			}

			$('#tablePesan').dataTable({
			    // display everything
			    "iDisplayLength": -1,
			    "aaSorting": [[ 1, "desc" ]] // Sort by first column descending
			});
    </script>


  </body>
</html>