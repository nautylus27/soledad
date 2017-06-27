<div ng-controller="saveRegister" class="md-whiteframe-6dp">
    <div layout="row" class="md-whiteframe-6dp" layout-xs="column" style="padding-top: 10px; position: static; margin-top: 65px; padding-right: 10px; padding-left: 10px; height: 300px; margin-right: 2px; background-color:#FFFFFF">
        <div flex layout="column" style="margin-left:10px;" >
            <div style="height: 91px; margin-top: 10px;">
                <form ng-submit="save()" name="myForm" id="myForm" >
                    <div layout="row" layout-xs="column">
                        <div flex>
                            <span style="font-size: 26px; color:#5d5f60"> <i class="material-icons" style="color:#FFC107">assignment_ind</i>Formulario para el pago y asignación de registro</span>
                        </div>
                    </div>
                    <div layout="row" layout-xs="column">
                        <div flex>
                            <span style="color: #BDBDBD; font-size: 13px;">Ingrese los siguentes campos para realizar el registro</span>
                        </div>
                    </div>
                    <div layout="row" layout-xs="column" style="margin-top: 25px;">
                        <div flex>
                            <div layout="row" layout-xs="column">
                                <div flex style="padding-right: 147px;">
                                    <div>
                                        <md-input-container class="md-block" flex-gt-sm>
                                            <label>Nombre Completo</label>
                                            <input ng-model="data.name" ng-required="true" >
                                        </md-input-container>
                                    </div>
                                    <div style="margin-top: -20px">
                                        <md-input-container class="md-block" flex-gt-sm>
                                            <label>Documento de Identidad</label>
                                            <input ng-model="data.dni" type="number" ng-required="true">
                                        </md-input-container>
                                    </div>
                                    <div style="margin-top: -20px">
                                        <md-input-container class="md-block" flex-gt-sm>
                                            <label>Asignacion de codigo Interno </label>
                                            <input ng-model="data.code" maxlength="5" ng-required="true">
                                        </md-input-container>
                                    </div>
                                    <div style="margin-top: -40px">
                                       <span style="color: #BDBDBD">Último codigo asignado <span style="color: #FFCC80">{{lastCodeQr}}</span></span>
                                    </div>
                                </div>
                                <div flex style="margin-top: 27px;">
                                    <div>
                                        <div class="text-center" style="margin-bottom: 15px; color: #BDBDBD">Conceptos a pagar</div>
                                        <div layout="row" layout-xs="column">
                                            <div flex>
                                                <md-checkbox ng-model="data.cb1" ng-change="getCheckedFalse()" aria-label="Checkbox 1" ng-true-value="498.000" ng-false-value="0">
                                                    $498 mil (SOA + AP)
                                                </md-checkbox>
                                            </div>
                                            <div flex>
                                                <md-checkbox ng-model="data.cb2" ng-change="getCheckedFalse()"  aria-label="Checkbox 2" ng-true-value="28.000" ng-false-value="0">
                                                    $28 mil (AP)
                                            </div>
                                            <div flex>
                                                <md-checkbox ng-model="data.cb3" ng-change="getCheckedFalse()" aria-label="Checkbox 3" ng-true-value="10.000" ng-false-value="0">
                                                    $10 mil (RIFA)
                                                </md-checkbox>
                                            </div>
                                        </div>
                                        <div><span style="color:#9b9b9b;">Total a pagar:</span> {{totalSummary}}</div>
                                    </div>
                                      <div  class="text-center">
                                    <button class="btn" style="background-color: #00BCD4; color: #FFFFFF; position: inherit !important"  role="menuitem"> Registrar</span></button>
                                </div>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                </form>
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
                        <th style="text-align: center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="person in register">
                        <td style="text-align: center">{{person.register_name_user}}</td>
                        <td style="text-align: center">{{person.register_dni}}</td>
                        <td style="text-align: center; color: #00ACC1"><b>{{person.register_code_qr}}</b></td>
                        <td style="text-align: center">{{person.name_status| uppercase}}</td>
                        <td style="text-align: center">{{person.date_create}}</td>
                        <td style="text-align: center">
                            <a href="javascript:;" ng-click="export(person)"><md-tooltip>Generar PDF</md-tooltip><i class="material-icons" style="color:#FF9800">assignment_returned</i></a>
                            <a href="javascript:;" ng-click="showAdvanced($event, ['/payment/modelnew'], person)"><md-tooltip>Eliminar Registro</md-tooltip><i class="material-icons" style="color:#D32F2F">delete_forever</i></a>
                        </td>
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


