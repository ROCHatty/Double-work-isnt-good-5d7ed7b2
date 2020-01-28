<style>
	tbody tr {
		border-bottom-style: solid;
		border-bottom-width: 3px;
		border-bottom-color: yellow !important;
	}
	tbody tr td {
		border-bottom-style: solid;
		border-bottom-width: 3px;
		border-bottom-color: black !important;
	}
</style>
<h1>Welkom op het netland beheerderspaneel</h1>
<h3>Films + series</h3>
<?php
$host = 'localhost';
$db = 'netland';
$user = 'root';
$pass = '';
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
	PDO::ATTR_ERRMODE				=>	PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE	=>	PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES		=>	false,
];
try {
	$pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
	throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
$stmt = $pdo->query('SELECT * FROM media');
$head = $pdo->query('SELECT * FROM media LIMIT 1');
?>
<table>
	<thead>
		<tr>
<?php
while ($row = $head->fetch()) {
	foreach ($row as $key => $value) {
?>
			<th><?php echo ucfirst(str_replace('_', ' ', $key)); ?></th>
<?php } } ?>
			<th><a href="create.php">Add</a></th>
		</tr>
	</thead>
	<tbody>
<?php
while ($row = $stmt->fetch()) {
?>
		<tr>
		<?php
			foreach ($row as $key => $value) {
		?>
			<td><?php echo $value; ?></td>
		<?php
			}
		?>
			<td><a href="edit.php?id=<?php echo $row['id']; ?>" target="_blank">Edit</a></td>
		</tr>
<?php
}
?>
	</tbody>
</table>