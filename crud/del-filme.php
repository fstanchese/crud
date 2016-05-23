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

if (isset ( $_POST ['btn-del'] )) {
	$id = $_GET ['delete_id'];
	$filme->excluir ( $id );
	header ( "Location: del-filme.php?deleted" );
}
?>

<?php include_once 'index.php'; ?>

<div class="clearfix"></div>
<div class="container">

	<?php
	if (isset ( $_GET ['deleted'] )) {
		?>
        <div class="alert alert-success">Filme excluido com sucesso</div>
        <?php
	} else {
		?>
        <div class="alert alert-danger">Confirma exclusão do Filme ?</div>
        <?php
	}
	?>	
</div>
<div class="clearfix"></div>
<div class="container">
	 <?php
		if (isset ( $_GET ['delete_id'] )) {
			?>
         <table class='table table-bordered'>
		<tr>
			<th>#</th>
			<th>Titulo</th>
			<th>Categoria</th>
		</tr>
         <?php
			$stmt = $DB_con->prepare ( "SELECT filme.id,filme.descricao,categoria.descricao as categoria FROM filme INNER JOIN categoria ON filme.categoria_id=categoria.id WHERE filme.id=:id" );
			$stmt->execute ( array (
					":id" => $_GET ['delete_id'] 
			) );
			while ( $row = $stmt->fetch ( PDO::FETCH_BOTH ) ) {
				?>
             <tr>
			<td><?php print($row['id']); ?></td>
			<td><?php print($row['descricao']); ?></td>
			<td><?php print($row['categoria']); ?></td>
		</tr>
             <?php
			}
			?>
         </table>
         <?php
		}
		?>
</div>
<div class="container">
	<p>
<?php
if (isset ( $_GET ['delete_id'] )) {
?>
  	
	
	
	
	
	
	
	
	
	
	
	
	<form method="post">
		<input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
		<button class="btn btn-large btn-primary" type="submit" name="btn-del">
			<i class="glyphicon glyphicon-trash"></i> &nbsp; SIM
		</button>
		<a href="view-filme.php" class="btn btn-large btn-success"><i
			class="glyphicon glyphicon-backward"></i> &nbsp; NÃO</a>
	</form>  
	<?php
} else {
	?>
    <a href="view-filme.php" class="btn btn-large btn-success"><i
		class="glyphicon glyphicon-backward"></i> &nbsp; Voltar</a>
    <?php
}
?>
</p>
</div>
<?php include_once 'footer.php'; ?>