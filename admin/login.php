<?php session_start();
 include('./header.php'); ?>
	<?php include('../db/db_connet.php')?>
    <?php 
    if(isset($_SESSION['login_id']))
    	header("location:index.php?page=home");
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Doctor's Appointment System</title>	
</head>
<body>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%);
		background:white;
	}
	#login-right{
		position: absolute;
		right:0;
		width:40%;
		height: calc(100%);
		background:white;
		display: flex;
		align-items: center;
	}
	#login-left{
		position: absolute;
		left:0;
		width:60%;
		height: calc(100%);
		background:#59b6ec61;
		display: flex;
		align-items: center;
		background: url(../images/phonglogin.jpg),300px;
	    background-repeat: no-repeat;
	    background-size: 100% 100%;
	}
    #login-right{
        background-color: #f3f7f8;
    }
	#login-right .card{
		margin: auto;
        
	}
	.logo {
    margin: auto;
    font-size: 8rem;
    background: #90ffff87;
    padding: .5em 0.7em;
    border-radius: 50% 50%;
    color: #000000b3;
}

</style>
<body>
  <main id="main" class=" bg-dark">
  		<div id="login-left">
  			
  		</div>
  		<div id="login-right">
  			<div class="card col-md-8">
  				<div class="card-body">
					<center><h1>Đăng nhập</h1></center>
  					<form id="login-form" >
  						<div class="form-group">
  							<label for="username" class="control-label">Tên đăng nhập</label>
  							<input type="text" id="username" name="username" class="form-control">
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label">Mật khẩu</label>
  							<input type="password" id="password" name="password" class="form-control">
  						</div>
  						<center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Đăng nhập</button></center>
  					</form>
  				</div>
  			</div>
  		</div>
  </main>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else if(resp == 2){
					location.href ='voting.php';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>	
</html>