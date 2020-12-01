<?php 
	if ($con){
?>
    <table cellspacing="0" style="width: 100%;">
        <tr>

            <td style="width: 25%; color: #444444;">
                <img style="width: 100%;" src="../../img/logobat.png" alt="Logo"><br>
                
            </td>
			<td style="width: 50%; color: #34495e;font-size:12px;text-align:center">
                <span style="color: #34495e;font-size:14px;font-weight:bold">BATERIAS ECUADOR</span>
				<br>DIRECCION: QUITO, PICHINCHA, ECUADOR<br> 
				Teléfono: 0983314541<br>
				Email: baterias@bateriasecuador.com
                
            </td>
			<td style="width: 25%;text-align:right;">
			PEDIDO Nº <?php echo $numero_pedido;?>
			</td>
			
        </tr>
    </table>
	<?php }?>	