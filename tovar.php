<?php
require("templates/header.php");

$sql="SELECT * FROM tovary WHERE id=$_GET[id]";
$rez=mysql_query($sql);
$tov=mysql_fetch_array($rez);
echo "<h2>$tov[nazv]</h2>
<img src='photos/$tov[photo]' width=300 align=left>";
if($tov[spec]) echo "<font color=green>$tov[cena] ð.</font>";
else echo "$tov[cena] ð.";
?>
<form>
	<input type="text" name="kol" value="1" size="4">
    <input type="hidden" name="id" value="<?php echo $tov[id]; ?>">
    <input type="submit" name="add_cart" value="V korzinu">
</form>
<?php
echo $tov[opis];
require("templates/footer.php");
?>    