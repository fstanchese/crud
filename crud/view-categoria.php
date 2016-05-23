<?php
include_once 'index.php';
include_once 'categoria.class.php';

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
$categoria = new categoria ( $DB_con );
?>

<div class="clearfix"></div>
<div class="container">
	<a href="add-categoria.php" class="btn btn-large btn-info"><i
		class="glyphicon glyphicon-plus"></i> &nbsp; Adicionar</a>
</div>

<div class="clearfix"></div>
<br />
<div class="container">
	<table class='table table-bordered table-responsive'>
		<tr>
			<th width="10%">#</th>
			<th width="70%">Descrição</th>
			<th width="20%" colspan="2" align="center">Ação</th>
		</tr>
     <?php
					$query = "SELECT * FROM categoria order by descricao";
					$records_per_page = 10;
					$newquery = $categoria->paging ( $query, $records_per_page );
					$categoria->dataview ( $newquery );
					?>
    <tr>
			<td colspan="4" align="center">
				<div class="pagination-wrap">
            <?php $categoria->paginglink($query,$records_per_page); ?>
        	</div>
			</td>
		</tr>
	</table>
</div>

<?php include_once 'footer.php'; ?>