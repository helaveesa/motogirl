<?php
require("templates/header.php");
?>
<h2>Zagolovok</h2>
<?php
$sql="SELECT * FROM tovary WHERE spec=1 ORDER BY RAND() LIMIT 0,3";
$rez=mysql_query($sql);
while($tov=mysql_fetch_array($rez))
{
	?>
	<div class="tovar">
		<a href="tovar.php?id=<?php echo $tov[id]; ?>">
			<img src="photos/<?php echo $tov[photo]; ?>" alt="kupit <?php echo $tov[nazv]; ?>" width="150"><br>
			<?php echo $tov[nazv]; ?>
		</a><br>
			<?php echo $tov[cena]; ?> rub.
	</div>
	<?php
}
require("templates/footer.php");
?>    