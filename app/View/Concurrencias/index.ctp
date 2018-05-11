<div class="row-fluid">
    <span id="mensajes"></span>
    <div class="col-md-8">
        <h2 class="sub-header">Consulta de Concurrencias</h2>
        <div class="table-responsive">
			<table id="miTabla" class="table table-hover tablesorter">
				<thead><tr>
					<th>#</th>
					<th>Pais</th>
					<th>Sede</th>
				</tr></thead>
				<tbody>
				<?php if (isset($datos)) {
					foreach ($datos as $fila) {
						echo "<tr>";
						echo "<td>".$fila['Concurrencia']['id']."</td>";
						echo "<td>".$fila['Concurrencia']['pais']."</td>";
						echo "<td>".$fila['Concurrencia']['sede']."</td>";
					}
				} else {
					echo "<tr><td><h4>No hay resultado que mostrar...</h4></td></tr>";
				} ?>
				</tbody>
        	</table>
        	<div id="pager" class="pager" style="position:relative;">
				<form>
					<img src="/img/first.png" class="first">
					<img src="/img/prev.png" class="prev">
					<input type="text" class="pagedisplay">
					<img src="/img/next.png" class="next">
					<img src="/img/last.png" class="last">
					<select class="pagesize">
						<option value="10">10</option>
						<option selected="selected" value="15">15</option>
						<option value="20">20</option>
						<option value="30">30</option>
						<option value="40">40</option>
					</select>
				</form>
			</div>
			
        </div>
    </div>
</div>
<script type="text/javascript">
$(function () {
	//$('.alert-success, .alert-danger').fadeOut(5000);
	$("#miTabla").tablesorter({sortList: [[1,0]]}).tablesorterPager({positionFixed: false, container: $("#pager"), size: 15});
	
});
</script>