<?php
require("templates/header.php");
$sql="SELECT * FROM category WHERE id=$_GET[id]";
$rez=mysql_query($sql);
$cat=mysql_fetch_array($rez);
echo "<h2>$cat[nazv]</h2>";

$sql="SELECT * FROM tovary WHERE id_cat=$cat[id]";
$rez=mysql_query($sql);
while($tov=mysql_fetch_array($rez))
{
	?>
	<div class="tovar">
		<a href="tovar.php?id=<?php echo $tov[id]; ?>">
			<img src="photos/<?php echo $tov[photo]; ?>" alt="kupit <?php echo $tov[nazv]; ?>" width="150"><br>
			<?php echo $tov[nazv]; ?>
		</a><br>
			<?php echo $tov[cena]; ?> ð.
	</div>
	<?php
}
require("templates/footer.php");
?>    