<?php
require("../config.php");
if(!$_SESSION[admin]) die("������ ��������!");
if($_GET[quit])
{
	unset($_SESSION[id]);
	unset($_SESSION[admin]);
	session_destroy();
	header("location:../index.php");
}
if($_GET[ok_add])
{
	$sql="INSERT INTO category(nazv) VALUES('$_GET[nazv]')";
	mysql_query($sql);
	header("location:category.php");
}
if($_GET[del])
{
	$sql="DELETE FROM category WHERE id=$_GET[del]";
	mysql_query($sql);
	header("location:category.php");
}
if($_GET[ok_edit])
{
	$sql="UPDATE category SET nazv='$_GET[nazv]' WHERE id=$_GET[id]";
	mysql_query($sql);
	header("location:category.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="windows-1251">
<title>���������</title>
</head>

<body>
<a href="index.php">������</a> 
<a href="category.php">���������</a>
<a href="tovary.php">������</a>
<a href="?quit=ok">�����</a>
<hr>
<?php
if($_GET[edit])
{
	$sql="SELECT * FROM category WHERE id=$_GET[edit]";
	$rez=mysql_query($sql);
	$cat=mysql_fetch_array($rez);
	?>
    <form>
    <input type="text" name="nazv" value="<?php echo $cat[nazv]; ?>">
    <input type="hidden" name="id" value="<?php echo $cat[id]; ?>">
    <input type="submit" name="ok_edit" value="���������">
    </form>
    <?php
} else
{
	?>
    <form>
    <input type="text" name="nazv">
    <input type="submit" name="ok_add" value="��������">
    </form>
	<?php
}
?>
<hr>
<ul>
	<?php
	$sql="SELECT * FROM category ORDER BY nazv";
	$rez=mysql_query($sql);
	while($cat=mysql_fetch_array($rez))
	{
		echo "<li>$cat[nazv] <a href='?edit=$cat[id]'>���.</a> <a href='?del=$cat[id]'>�������</a></li>";
	}
	?>
</ul>
</body>
</html>