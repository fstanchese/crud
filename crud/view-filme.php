<?php
include_once 'index.php';
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
?>

<div class="clearfix"></div>
<div class="container">
	<a href="add-filme.php" class="btn btn-large btn-info"><i
		class="glyphicon glyphicon-plus"></i> &nbsp; Adicionar</a>
</div>

<div class="clearfix"></div>
<br />
<div class="container">
	<table class='table table-bordered table-responsive'>
		<tr>
			<th width="10%">#</th>
			<th width="50%">Título</th>
			<th width="20%">Categoria</th>
			<th width="20%" colspan="2" align="center">Ação</th>
		</tr>
    	 <?php
			$query = "SELECT filme.id,filme.descricao,categoria.descricao as categoria FROM filme INNER JOIN categoria ON filme.categoria_id=categoria.id order by filme.descricao";
			$records_per_page = 10;
			$newquery = $filme->paging ( $query, $records_per_page );
			$filme->dataview ( $newquery );
		?>
    	<tr>
			<td colspan="5" align="center">
			<div class="pagination-wrap">
            	<?php $filme->paginglink($query,$records_per_page); ?>
        	</div>
			</td>
		</tr>
	</table>
</div>

<?php include_once 'footer.php'; ?>