<html>
	<head>
		<meta content='noindex,nofollow' name='robots'>
		<link rel="stylesheet" type="text/css"
			href="http://wenchen.cs.und.edu/css/1.css" />
		<title>Login</title>
	</head>
	<font size='0'><br /></font>
	<?php
		include("conn.php");//import database connection
		$isFailed ="";
		if(!empty($_POST['sub'])){
				if(!empty($_POST['name'])&&!empty($_POST['password'])){
				
					$sql = "select * from customer where name ='".$_POST['name']."' and password = '".$_POST['password']."'";
					$query = mysql_query($sql) or die(mysql_error());
					
					$rs = mysql_fetch_array($query);
					$q = $rs['id'];
					
					if(empty($q)){
						$isFailed = "Incorrect username and password";
					}
					
					else{
						echo "<script>location.href='a3_main.php'</script>";
					}
				
				}else{
					$isFailed = 'Cannot be empty';
				}
		}
		
	?>

	<body text='#000000' vLink='#3366CC' link='#3366CC' bgColor='#ffffff' alink='#3366CC' background='http://wenchen.cs.und.edu/figure/bg4.png'>

		<table width='100%' height='80%'>
			<tr>
				<td align='center' valign='middle'>

					<table width="75%" cellspacing="0" cellpadding="15" border="0" class="shadow">
						<form method="post" action="">
							<tr bgcolor="#336699">
								<th id="header" align="left" colspan="3">
									<font face="Verdana, Arial, Helvetica" color="white" size="2"> &nbsp; Start Using the Bookstore.</font>
								</th>
							</tr>
							<tr bgcolor="#CCEEFF">
								<td width="100%" valign="middle">
									<font face="Verdana, Arial, Helvetica" size="2">
									<font size="0"><br /></font>
									&nbsp; &nbsp; &nbsp; Name:
									<input type="text" name="name" size="32" value="">
									<?php echo $isFailed; ?>

									<br /><font size="0"><br /></font>
									&nbsp; &nbsp; &nbsp; Password:
									<input type="password" name="password" size="12" maxlength="12" value="">
									</font>
									<p align="center">
									
									<input type="submit" name="sub" value="Enter">
									&nbsp; &nbsp; &nbsp; &nbsp;
									<input type="button" name="act" value="Register" onclick="location.href='a3_register.php?act='">
									&nbsp; &nbsp; &nbsp; &nbsp;
								
									
									<br /><font size="0"><br /></font>
									</p>
								</td>
							</tr>
						</form>

					</table>

				</td>
			</tr>
		</table>
	</body>
</html>
