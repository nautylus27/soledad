<div ng-controller="facturacion"  class="md-whiteframe-6dp">
	<div layout="row" class="md-whiteframe-6dp" layout-xs="column" style="padding-top: 10px; position: static; margin-top: 65px; padding-right: 10px; padding-left: 10px; height: 80px; margin-right: 2px; background-color:#FFFFFF">
		<div flex layout="column" style="margin-left:10px;" >
			<div style="height: 20px; margin-top: 10px;">
				<div layout="row" layout-xs="column">
					<div flex>
					   <span style="font-size: 26px; color:#5d5f60"><i class="material-icons" style="color:#FFC107">description</i>Facturación</span>
					</div>
				</div>
				<div layout="row" layout-xs="column">
					<div flex>
					   <span style="color: #BDBDBD; font-size: 13px;">Muestra el listado de los registros con enlace a las facturas</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div layout="row"  style="height:540px;" ng-cloak>
	
    <div flex layout="column" style="margin-left: 10px; margin-top: 60px;" ng-cloak="" ng-hide="loadtable"  >
        <table datatable="ng" class="row-border hover" >
            <thead>
                <tr>
                    <th style="text-align: center">Nombre completo</th>
                    <th style="text-align: center">Cédula</th>
                    <th style="text-align: center">Número de Factura</th>
					<th style="text-align: center">SubTotal</th>
                    <th style="text-align: center">IVA</th>
					<th style="text-align: center">Total + IVA</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="person in register" ng-init='presenters=getPresenters(person.monto_iva, person.total_iva )'>
                    <td style="text-align: center">{{person.register_name_user}}</td>
					<td style="text-align: center">{{person.register_dni}}</td>
					<td style="text-align: center; color: #00ACC1"><b>{{person.id_facturacion}}</b></td>
					<td style="text-align: center">{{person.total}}</td>
					<td style="text-align: center">{{person.monto_iva}}</td>
					<td style="text-align: center">{{person.total_iva}}</td>
                </tr>
            </tbody>
        </table>
    </div> 
	 <div ng-show="loadtable" style="margin-left: 25%;margin-right: 25%;width: 735px; margin-top: 176px;">
        <div style="margin-left: 44%; margin-right: 50%; margin-bottom: 30px;"><md-progress-circular md-mode="indeterminate"></md-progress-circular></div>
        <hr>
        <div class="text-center"><span style="font-size: 20px; color:#FFC107">Cargando Data...</span></div>
     </div>
   
</div>

</div>

