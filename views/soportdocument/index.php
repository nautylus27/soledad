<div ng-controller="soport" class="md-whiteframe-6dp">
	<div layout="row" class="md-whiteframe-6dp" layout-xs="column" style="padding-top: 10px; position: static; margin-top: 65px; padding-right: 10px; padding-left: 10px; height: 80px; margin-right: 2px; background-color:#FFFFFF">
		<div flex layout="column" style="margin-left:10px;" >
			<div style="height: 20px; margin-top: 10px;">
				<div layout="row" layout-xs="column">
					<div flex>
					   <span style="font-size: 26px; color:#5d5f60"><i class="material-icons" style="color:#FFC107">assignment_turned_in</i>Soporte y documentación</span>
					</div>
				</div>
				<div layout="row" layout-xs="column">
					<div flex>
					   <span style="color: #BDBDBD; font-size: 13px;">Valide la información y cambie el estatus</span>
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
                    <th style="text-align: center">Codigo interno asignado</th>
					<th style="text-align: center">Status</th>
                    <th style="text-align: center">Fecha de Registro</th>
					 <th style="text-align: center">Verificar</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="person in register">
                    <td style="text-align: center">{{person.register_name_user}}</td>
					<td style="text-align: center">{{person.register_dni}}</td>
					<td style="text-align: center; color: #00ACC1"><b>{{person.register_code_qr}}</b></td>
					<td style="text-align: center">{{person.name_status | uppercase}}</td>
					<td style="text-align: center">{{person.date_create}}</td>
					<td style="text-align: center"><a href="javascript:;" ng-click="showAdvanced($event, ['/photo/modelnew'],person)"><i class="material-icons" ng-if="person.id_status_request== 3" style="color:#FFEB3B">verified_user</i> <i class="material-icons" ng-if="person.id_status_request== 2" style="color:#AEEA00">done_all</i></a></td>
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


