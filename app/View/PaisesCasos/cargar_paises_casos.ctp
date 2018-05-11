<?php 
	echo $this->Html->css('bootstrap-checkbox');
	echo $this->Html->script('bootstrap-checkbox');
	echo $this->Html->css('default');
?>

<table class="table table-hover">
<tr>
	<td>Paises</td>
	<?php if (!empty($casos)) { 
		foreach ($casos as $caso) {
			echo '<td>Caso '.$caso['Caso']['cod_num'].'</td>';	
		}
	}?>
	<td>Convención Haya</td>
</tr>
	<?php if (!empty($paises)) { 
		$i=0;
		foreach ($paises as $pais) {
			echo '<tr id="mifila_'.$i.'" class="mifila">';
			echo '<td>'.$pais['Pais']['pais'].'</td>';
			foreach ($casos as $caso) {
				echo '<td class="fila_'.$i.'">';
				if (isset($filas[$pais['Pais']['id']]['id']) && !empty($filas[$pais['Pais']['id']]['id'])) {
					echo '<input type="hidden" name="paiscaso_'.$i.'" value="'.$filas[$pais['Pais']['id']]['id'].'" />';
				}
				echo '<input type="hidden" name="pais_'.$i.'" value="';
				if (isset($filas[$pais['Pais']['id']]['pais']))
					echo $filas[$pais['Pais']['id']]['pais'];
				else 
					echo $pais['Pais']['id'];
				echo '" />';
				echo '<span class="">';
				echo '<input type="radio" id="fila_'.$i.'" data-color="check-'.$caso['Caso']['color'].'" value="'.$caso['Caso']['id'].'" name="caso_'.$i.'" class="casos"';
				if (isset($filas[$pais['Pais']['id']]['caso']) && ($filas[$pais['Pais']['id']]['caso'] == $caso['Caso']['id'])) 
					echo " checked='checked' class='check-".$caso['Caso']['color']."'";
				echo '/>';
				echo '</span>';
				echo '</td>';
			}
			echo '<td>';
			echo '<input type="checkbox" value="1" name="convencion_'.$i.'"';
			//echo '<input id="convencion" class="switch" data-on-color="success" data-on-text="si" data-off-text="no" data-off-color="danger" dataid="'.$pais['Pais']['id'].'" type="checkbox"';
			if (isset($filas[$pais['Pais']['id']]['convencion']) && ($filas[$pais['Pais']['id']]['convencion'] == 1)) echo " checked ";
			echo '/></td>';
			echo '</tr>';
			$i++;
		}
	}?>
</table>

<script type="text/javascript">
$(function() {
	$('input[type="checkbox"]').checkbox();
	$('input[type="radio"]').each(function() {
		if ($(this).is(':checked')) {
			var color = $(this).attr('data-color');
			//$(this).wrap( "<span></span>" ).parent().addClass(color);
			$(this).parent().addClass(color);
		}
	});
	$('input[type="radio"]').click(function() {
		var aux = $(this);
		var color = $(this).attr('data-color');
		$('td.'+$(this).attr('id')+' input[type="radio"]').each(function() {
			if($(this).not(':checked') && aux != $(this)){
				$(this).parent().removeClass($(this).attr('data-color'));
				//$(this).unwrap( "<span></span>" ).parent();
			}
			
		});
		//aux.wrap( "<span></span>" ).parent().addClass(color);
		aux.parent().addClass(color);
	});
	
    //$('.switch').bootstrapSwitch();    
});
</script>