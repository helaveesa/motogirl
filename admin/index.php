<?php
require("../config.php");
if(!$_SESSION[admin]) die("Доступ запрещен!");
if($_GET[quit])
{
	unset($_SESSION[id]);
	unset($_SESSION[admin]);
	session_destroy();
	header("location:../index.php");
}
if(isset($_GET[stat]))
{
	$sql="UPDATE zakaz SET status='$_GET[stat]' WHERE id=$_GET[id]";
	mysql_query($sql);
}
?>
<!doctype html>
<html>
<head>
<meta charset="windows-1251">
<title>Документ без названия</title>
</head>

<body>
<a href="index.php">ЗАКАЗЫ</a> 
<a href="category.php">Категории</a>
<a href="tovary.php">Товары</a>
<a href="?quit=ok">Выход</a>
<table border="1" width="100%">
<tr>
	<th>#</th>
    <th>Клиент</th>
    <th>Товар</th>
    <th>Кол-во</th>
    <th>Сумма</th>
    <th>Статус</th>
</tr>
<?php
$sql="SELECT zakaz.*, tovary.nazv, tovary.cena FROM zakaz,tovary 
WHERE zakaz.id_tovar=tovary.id
ORDER BY id DESC";
$rez=mysql_query($sql);
while($zakaz=mysql_fetch_array($rez))
{
	$sum=$zakaz[cena]*$zakaz[kol];
	echo "<tr>
			<td>$zakaz[id]</td>
			<td>$zakaz[fio] <br> ($zakaz[phone]) <br> $zakaz[adres]</td>
			<td>$zakaz[nazv]</td>
			<td>$zakaz[kol] шт.</td>
			<td>$sum р.</td>
			<td>";
	switch($zakaz[status])
	{
		case 0: echo "новый"; break;
		case 1: echo "в обработке"; break;
		case 2: echo "доставлен"; break;
	}
	echo "<br>
	<a href='?stat=0&id=$zakaz[id]'>новый</a><br>
	<a href='?stat=1&id=$zakaz[id]'>в обработке</a><br>
	<a href='?stat=2&id=$zakaz[id]'>доставлен</a></td>
	      </tr>";	
}
?>
</table>
</body>
</html>