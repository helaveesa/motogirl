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
if($_POST[ok_add])
{
	$sql="INSERT INTO tovary(nazv,cena,id_cat,spec,opis,photo) VALUES('$_POST[nazv]','$_POST[cena]','$_POST[id_cat]','$_POST[spec]','$_POST[opis]','i.jpeg')";
	mysql_query($sql);
	if($_FILES[photo][name])
	{
		$id=mysql_insert_id();
		list($x,$ext)=explode("/",$_FILES[photo][type]);
		if($ext=="pjpeg") $ext="jpeg";
		move_uploaded_file($_FILES[photo][tmp_name],"../photos/$id.$ext");
		$sql="UPDATE tovary SET photo='$id.$ext' WHERE id=$id";
		mysql_query($sql);
	}
	header("location:tovary.php");
}
if($_GET[del])
{
	$sql="DELETE FROM tovary WHERE id=$_GET[del]";
	mysql_query($sql);
	header("location:tovary.php");
}
if($_POST[ok_edit])
{
	$sql="UPDATE tovary SET nazv='$_POST[nazv]', cena='$_POST[cena]', opis='$_POST[opis]', id_cat='$_POST[id_cat]', spec='$_POST[spec]' WHERE id=$_POST[id]";
	mysql_query($sql);
	if($_FILES[photo][name])
	{
		$id=$_POST[id];
		list($x,$ext)=explode("/",$_FILES[photo][type]);
		if($ext=="pjpeg") $ext="jpeg";
		move_uploaded_file($_FILES[photo][tmp_name],"../photos/$id.$ext");
		$sql="UPDATE tovary SET photo='$id.$ext' WHERE id=$id";
		mysql_query($sql);
	}
	header("location:tovary.php");
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
<a href="tovary.php">���������</a>
<a href="tovary.php">������</a>
<a href="?quit=ok">�����</a>
<hr>
<?php
if($_GET[edit])
{
	$sql="SELECT * FROM tovary WHERE id=$_GET[edit]";
	$rez=mysql_query($sql);
	$tov=mysql_fetch_array($rez);
	?>
    <form method="post" enctype="multipart/form-data">
    ��������: <input type="text" name="nazv" value="<?php echo $tov[nazv]; ?>"><br>
    ���������: <select name="id_cat">
    			<?php
				$sql="SELECT * FROM category";
				$rez=mysql_query($sql);
				while($cat=mysql_fetch_array($rez))
				{
					if($cat[id]==$tov[id_cat]) $sl="selected"; else $sl="";
					echo "<option value='$cat[id]' $sl>$cat[nazv]</option>";
				}
				?>
    		   </select><br>
	����: <input type="text" name="cena" value="<?php echo $tov[cena]; ?>"> �.<br>
	��������: <textarea name="opis"><?php echo $tov[opis]; ?></textarea><br>
	����: <input type="file" name="photo"><br>
	<input type="checkbox" name="spec" value="1" <?php if($tov[spec]) echo "checked"; ?>> ���������������<br>
    <input type="hidden" name="id" value="<?php echo $tov[id]; ?>">
    <input type="submit" name="ok_edit" value="�������������">
    </form>
    <?php
} else
{
	?>
    <form method="post" enctype="multipart/form-data">
    ��������: <input type="text" name="nazv"><br>
    ���������: <select name="id_cat">
    			<?php
				$sql="SELECT * FROM category";
				$rez=mysql_query($sql);
				while($cat=mysql_fetch_array($rez))
				{
					echo "<option value='$cat[id]'>$cat[nazv]</option>";
				}
				?>
    		   </select><br>
	����: <input type="text" name="cena"> �.<br>
	��������: <textarea name="opis"></textarea><br>
	����: <input type="file" name="photo"><br>
	<input type="checkbox" name="spec" value="1"> ���������������<br>
    <input type="submit" name="ok_add" value="��������">
    </form>
	<?php
}
?>
<hr>
<ul>
	<?php
	$sql="SELECT * FROM tovary ORDER BY nazv";
	$rez=mysql_query($sql);
	while($cat=mysql_fetch_array($rez))
	{
		echo "<li>$cat[nazv] <a href='?edit=$cat[id]'>���.</a> <a href='?del=$cat[id]'>�������</a></li>";
	}
	?>
</ul>
</body>
</html>