<div ng-controller="graficacenso">
    <div layout="row" class="md-whiteframe-6dp " layout-xs="column" style="padding-top: 10px; position: static; margin-top: 65px; padding-right: 10px; padding-left: 10px; background-color: rgba(44, 46, 47, 0.75);height: 186px; margin-right: 2px;">
        <div flex layout="column" style="margin-left:10px;" >
            <div style="height: 91px; margin-top: 10px;">
                <div layout="row" layout-xs="column">
                    <div flex>
                        <span style="font-size: 26px; color:#fafafa">Control y seguimiento</span>
                    </div>
                    <div flex class="text-right">
                        <span style="color: #BDBDBD">Fecha (<?php echo date('Y-m-d'); ?>)</span>
                    </div>
                </div>
                <div><span style="color: #BDBDBD; font-size: 13px;">Resumen y gráficas para el control y seguimiento de los usuarios registrados por día en el censo</span></div>
                <div>
                    <div layout="row" layout-xs="column" style="margin-top: 43px;">

                        <div flex class="text-center" style="margin-top: -26px;">
                            <md-input-container class="md-block" flex-gt-sm>
                                <div><span ng-count-to="{{countTo}}" value="{{countFrom}}" duration="4"   style="color: #FFC107; font-size: 30px" ></span></div>
                                <div><span style="color:#fafafa;">Por día</span></div>
                            </md-input-container>
                        </div>
                        <div flex class="text-center" style="margin-top: -26px;">
                            <md-input-container class="md-block" flex-gt-sm>
                                <div><span ng-count-to="{{countToendtnovencidas}}" value="{{countFromstartnovencidas}}" duration="4"  style="color:#FFC107; font-size: 30px" ></span></div>
                                <div><span style="color:#fafafa;">Por semana</span></div>
                            </md-input-container>
                        </div>
                        <div flex class="text-center" style="margin-top: -26px;">
                            <!--                        <md-input-container class="md-block" flex-gt-sm>
                                                        <div><span ng-count-to="{{countToendtvencidas}}" value="{{countFromstartvencidas}}" duration="4" filter="currency" params="$" style="color: #FFC107; font-size: 30px"></span></div>
                                                        <div><span style="color:#fafafa;">Vencidas</span></div>
                                                    </md-input-container>-->
                        </div>
                        <div flex="10" class="text-right" style="margin-top: 31px;">
                            <md-button class="md-fab md-primary" aria-label="Use Android" style="background-color: #00BCD4" ng-click="showModal($event, ['/collections/modelnew'])">
                                <i class="material-icons" style=" font-size: 30px; padding-top: 10px;">note_add</i>
                            </md-button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  layout="row">
        <div flex="80" style=" height: 90%;padding: 20px;">
            <canvas id="bar" class="chart chart-bar"
                    chart-data="data" chart-labels="labels"> chart-series="series"
            </canvas>
        </div>
    </div>
    <div ng-controller="listController">
        <div id="exportthis" style="display: none">
            <table>
                <tr>
                    <td style="color:#FF0000;">1</td>
                    <td>2</td>
                    <td style="color:#FF0000;">3</td>
                    <td>4</td>
                </tr>
            </table>
        </div>
        <button ng-click="export()">export</button>
    </div>
</div>
