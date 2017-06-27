<div layout="row">
	<div flex class="text-center">
	      <div style="font-size: 22px; margin-top: 10px;">¿Esta seguro que desea eliminar este registro?</div>
	</div>
</div>
<div layout="row" style="margin-top:10px">
	<div flex class="text-center">
		<div>
			<span>Nombre Completo: {{array.register_name_user}}</span>
		</div>
		<div>
			<span>Documento de Identidad: {{array.register_dni}}</span>
		</div>
		<div>
			<span>Estado del registro: {{array.name_status}}</span>
		</div>
		<div>
			<span>Asginación de Codigo:<span style="color: #00BCD4"> {{array.register_code_qr}}</span></span>
		</div>
	</div>
</div>

 <md-dialog-actions layout="row" layout-margin >
            <span flex></span>
		   <md-button class="md-raised" style="background-color: #00BCD4; color:#FFFFFF" ng-click="deleteRegister(array.id_register_user)">Aceptar</md-button>
		   <md-button class="md-raised" style="background-color: #BDBDBD; color:#EEEEEE" ng-click="cancel()">Cerrar</md-button>
        </md-dialog-actions>
 

