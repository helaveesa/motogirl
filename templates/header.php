<?php
require("config.php");
if($_POST[ok_auth])
{
	$sql="SELECT * FROM users WHERE email='$_POST[email]'";
	$rez=mysql_query($sql);
	if(mysql_num_rows($rez)>0)
	{
		$user=mysql_fetch_array($rez);
		if($user[pwd]==md5($_POST[pwd].SALT))
		{
			$_SESSION[id]=$user[id];
			if($user[id]==1) 
			{
				$_SESSION[admin]=true;
				echo "<script>location.replace('admin/index.php');</script>";
			}
		} else $error_auth="Неверный пароль!";
	} else $error_auth="Юзер не найден!";
}
if($_GET[quit])
{
	unset($_SESSION[id]);
	unset($_SESSION[admin]);
	session_destroy();
	header("location:index.php");
}
if(!$_SESSION[id_tov])	// инициализация корзины
{
	$_SESSION[id_tov]=array();
	$_SESSION[kol_tov]=array();
}
if($_GET[add_cart])
{
	$_SESSION[id_tov][]=$_GET[id];
	$_SESSION[kol_tov][]=$_GET[kol];
}
if(isset($_GET[del]))
{
	for($i=0;$i<count($_SESSION[id_tov]);$i++)
	{
		if($i!=$_GET[del])
		{
			$mas[]=$_SESSION[id_tov][$i];
			$mas2[]=$_SESSION[kol_tov][$i];
		}
	}
	$_SESSION[id_tov]=$mas;
	$_SESSION[kol_tov]=$mas2;
}
if($_GET[clear_cart])
{
	$_SESSION[id_tov]=array();
	$_SESSION[kol_tov]=array();
}
?>
<!doctype html>
<html>
<head>
<meta charset="windows-1251">
<title>Документ без названия</title>
<style>
#page {width:1000px; margin:0 auto;}
#header {float:left; border:solid 2px #999; width:1000px;}
.phone {float:right; width:100px;}
#left {float:left; border:solid 2px #999; width:286px; margin:5px;}
#content {float:left; border:solid 2px #999; width:676px; margin:5px; padding:5px;}
#left form {border:solid 2px #999; border-radius:5px; padding:5px;}
.tovar {float:left; width:200px; height:200px;border:solid 2px #999; border-radius:5px; padding:5px;}
</style>
</head>

<body>
<div id="page">
	<div id="header">
    	<div class="phone">123-45-98</div>
    	<a href="index.php"><img src="#" alt="ЛОГО" width="150" height="150" align="left"></a>
        <h1>Название</h1>
        <div align="right">У вас в <a href="cart.php">корзине</a><br> 
        <?php echo count($_SESSION[kol_tov]); ?> товаров</div>
    </div>
    <div id="left">
    	<?php
		$sql="SELECT * FROM category";
		$rez=mysql_query($sql);
		while($cat=mysql_fetch_array($rez))
		{
			echo "<a href='category.php?id=$cat[id]'>$cat[nazv]</a><br>";
		}
		?>
    	
        <hr>
        <?php
		if($_SESSION[id])
		{
			echo "Здравствуйте! <a href='?quit=ok'>выход</a>";	
		} else
		{
			?>
			<form method="post">
				E-Mail: <input type="text" name="email"><br>
				Пароль: <input type="password" name="pwd"><br>
				<input type="submit" name="ok_auth" value="Вход"><br>
				<a href="reg.php">Регистрация</a>
				<?php echo $error_auth; ?>
			</form>
			<?php
		}
		?>
    </div>
    <div id="content">