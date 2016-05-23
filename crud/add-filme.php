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

if (isset ( $_POST ['btn-save'] )) {
	$descricao = $_POST ['descricao'];
	$categoria = $_POST ['categoria_id'];
	
	if ($filme->inserir ( $descricao, $categoria )) {
		header ( "Location: add-filme.php?inserted" );
	} else {
		header ( "Location: add-filme.php?failure" );
	}
}
?>
<?php include_once 'index.php'; ?>
<div class="clearfix"></div>

<?php
if (isset ( $_GET ['inserted'] )) {
?>
<div class="container">
	<div class="alert alert-info">Cadastrado com sucesso</div>
</div>
<?php
} else if (isset ( $_GET ['failure'] )) {
?>
<div class="container">
	<div class="alert alert-warning">ERRO no cadastro !</div>
</div>
<?php
}
?>

<div class="clearfix"></div>
<br />

<div class="container">
	<form method='post'>
		<table class='table table-bordered'>

			<tr>
				<td>Descrição</td>
				<td><input type='text' name='descricao' class='form-control'
					required></td>
			</tr>
			<tr>
				<td>Categoria</td>
				<td><select name="categoria_id" class="form-control">
			<?php
			$stmt = $DB_con->prepare ( "SELECT * FROM categoria ORDER BY descricao" );
			$stmt->execute ();
			while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {
				echo '<option value=' . $row ['id'] . '>';
				echo $row ['descricao'];
				echo '</option>';
			}
			?>
			</select>
			</td>
			</tr>
			<tr>
				<td colspan="2">
					<button type="submit" class="btn btn-primary" name="btn-save">
						<span class="glyphicon glyphicon-plus"></span> Incluir
					</button> <a href="view-filme.php"
					class="btn btn-large btn-success"><i
						class="glyphicon glyphicon-backward"></i> Voltar</a>
				</td>
			</tr>

		</table>
	</form>


</div>

<?php include_once 'footer.php'; ?>