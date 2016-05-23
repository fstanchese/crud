<?php
include_once 'filme.class.php';
$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "123456";
$DB_name = "crud";
try {
	$DB_con = new PDO ( "mysql:host={$DB_host};dbname={$DB_name}", $DB_user, $DB_pass );
	$DB_con->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch ( PDOException $e ) {
	echo $e->getMessage ();
}
$filme = new filme ( $DB_con );

if (isset ( $_POST ['btn-update'] )) {
	$id = $_GET ['edit_id'];

	$descricao = $_POST ['descricao'];
	$categoria = $_POST ['categoria_id'];
	
	if ($filme->alterar ( $id, $descricao, $categoria )) {
		$msg = "<div class='alert alert-info'>Filme alterado com sucesso!</div>";
	} else {
		$msg = "<div class='alert alert-warning'>Erro ao alterar o Filme !</div>";
	}
}

if (isset ( $_GET ['edit_id'] )) {
	$id = $_GET ['edit_id'];
	extract ( $filme->getID ( $id ) );
}

?>
<?php include_once 'index.php'; ?>

<div class="clearfix"></div>

<div class="container">
<?php
if (isset ( $msg )) {
	echo $msg;
}
?>
</div>

<div class="clearfix"></div>
<br />

<div class="container">

	<form method='post'>

		<table class='table table-bordered'>

			<tr>
				<td>Titulo</td>
				<td><input type='text' name='descricao' class='form-control'
					value="<?php echo $descricao; ?>" required></td>
			</tr>
			<tr>
				<td>Categoria</td>
				<td><select name="categoria_id" class="form-control">
			<?php
			$stmt = $DB_con->prepare ( "SELECT * FROM categoria ORDER BY descricao" );
			$stmt->execute ();
			while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {
				echo '<option value=' . $row ['id'] . ($row ['id']==$categoria_id ? ' selected' : '').'>';
				echo $row ['descricao'];
				echo '</option>';
			}
			?>
			</select>
			</td>
			</tr>
			<tr>
				<td colspan="2">
					<button type="submit" class="btn btn-primary" name="btn-update">
						<span class="glyphicon glyphicon-edit"></span> Alterar
					</button> <a href="view-filme.php"
					class="btn btn-large btn-success"><i
						class="glyphicon glyphicon-backward"></i> &nbsp; Voltar</a>
				</td>
			</tr>
		</table>
	</form>
</div>

<?php include_once 'footer.php'; ?>