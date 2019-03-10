<?php
	include __DIR__ . "/elements/header.php";	
?>

<section>
	<ul>
		<?php foreach($moduleData as $key => $value) : ?>
			<li><?= ucfirst($key) . " : " . $value ?>
		<?php endforeach; ?>
	</ul>
</section>


<?php
	include __DIR__ . "/elements/footer.php";
?>