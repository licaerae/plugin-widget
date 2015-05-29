<?php
if (!isConnect('admin')) {
    throw new Exception('{{401 - Accès non autorisé}}');
}
include_file('3rdparty', 'codemirror/lib/codemirror', 'js');
include_file('3rdparty', 'codemirror/lib/codemirror', 'css');
include_file('3rdparty', 'codemirror/addon/edit/matchbrackets', 'js');
include_file('3rdparty', 'codemirror/mode/htmlmixed/htmlmixed', 'js');
include_file('3rdparty', 'codemirror/mode/xml/xml', 'js');
include_file('3rdparty', 'codemirror/mode/javascript/javascript', 'js');
include_file('3rdparty', 'codemirror/mode/css/css', 'js');
include_file('3rdparty', 'jquery.fileupload/jquery.ui.widget', 'js');
include_file('3rdparty', 'jquery.fileupload/jquery.iframe-transport', 'js');
include_file('3rdparty', 'jquery.fileupload/jquery.fileupload', 'js');
include_file('3rdparty', 'jquery.lazyload/jquery.lazyload', 'js');
include_file('3rdparty', 'jquery.packery/jquery.packery', 'js');
?>
<!--script src="3rdparty/snap.svg/snap.svg-min.js"></script-->
<?php
$mobileWidget = widget::listWidget('mobile');
$dashboardWidget = widget::listWidget('dashboard');
$pathfile = dirname(__FILE__);
sendVarToJS('pathFile', $pathfile);
?>
<style>
    .divIconSel{
        height: 80px;
        border: 1px solid #fff;
        box-sizing: border-box;
        cursor: pointer;
    }
    .iconSel{
        line-height: 1.4;
        font-size: 1.5em;
    }
    .iconSelected{
        background-color: #563d7c;
        color: white;
    }
    .iconDesc{
        font-size: 0.8em;
    }
    #bsInfoNumeric .slider-selection {
        background: #428041;
    }
    .noPaddingLeft { padding-left: 0;}
    .noPaddingRight { padding-right: 0;}
    .noMarginBottom { margin-bottom: 0;}
    .noPaddingWell {
        padding-bottom: 0;
        padding-top: 0;
    }
    .CodeMirror {
        border: 1px solid #eee;
        height: auto;
    }
    .CodeMirror-scroll {
        overflow-y: hidden;
        overflow-x: auto;
    }
    .market:hover{
        background-color : #F2F1EF !important;
    }
    .fileinput-button input {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        opacity: 0;
        -ms-filter: 'alpha(opacity=0)';
        font-size: 200px;
        direction: ltr;
        cursor: pointer;
    }
</style>
<div id="bsHaloCreate" style="display: none; z-index: 1020; border-radius: 350px; background: transparent; border: 1px solid; width: 200px; height: 100px;"></div>
<div class="row" id="bsContentWidget">
    <div id="bsListWidgets" data-name="Widgets" style="display: none">
        <ul id="" class="nav nav-list bs-sidenav" style="height: auto; margin-bottom: 10px;">
            <a class="btn btn-default tooltips" id="bt_getFromMarket" title="{{Récuperer du market}}" style="width : 100%"><i class="fa fa-shopping-cart"></i> {{Market}}</a>
            <a class="btn btn-primary widgetAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="addGDI"><i class="fa fa-plus-circle"></i> {{Ajouter un widget}}</a>
            <a class="btn btn-success widgetAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="createGDI"><i class="fa fa-picture-o"></i> {{Mode création facile}}</a>
            <a class="btn btn-success widgetAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="fontsGDI"><i class="icon divers-numbers"></i> {{Fonts}}</a>
            <div class="panel panel-default expertModeVisible">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><strong>Filtre</strong></h3>
                </div>
                <div class="panel-body" style="padding : 0px 5px;">
                    <div class="btn-group  btn-group-justified" data-toggle="buttons" style="margin-top : 5px;margin-bottom: 5px;">
                        <label class="btn btn-xs btn-default">
                            <input type="checkbox" autocomplete="off" class="filterAcionWidget" id="filterDesktop" ><i class="fa fa-desktop fa-fw"></i>
                        </label>
                        <label class="btn btn-xs btn-default">
                            <input type="checkbox" autocomplete="off" class="filterAcionWidget" id="filterMobile"><i class="fa fa-mobile fa-fw"></i>
                        </label>
                        <label class="btn btn-xs btn-default">
                            <input type="checkbox" autocomplete="off" class="filterAcionWidget" id="filterNbUsed"><span class="badge">X</span> > 0
                        </label>
                    </div>    
                    <div class="btn-group  btn-group-justified" data-toggle="buttons" style="margin-top : 5px;margin-bottom: 5px;">
                        <label class="btn btn-xs btn-default">
                            <input type="checkbox" autocomplete="off" class="filterAcionWidget" id="filterAction"><i class="fa fa-exclamation-circle fa-fw"></i>
                        </label>
                        <label class="btn btn-xs btn-default">
                            <input type="checkbox" autocomplete="off" class="filterAcionWidget" id="filterOther"><span class="label label-warning" style="text-shadow: none;">other</span>
                        </label>
                        <label class="btn btn-xs btn-default">
                            <input type="checkbox" autocomplete="off" class="filterAcionWidget" id="filterSlider"><span class="label label-primary" style="text-shadow: none;">slider</span>
                        </label>
                    </div>    
                    <div class="btn-group  btn-group-justified" data-toggle="buttons" style="margin-top : 5px;margin-bottom: 5px;">
                        <label class="btn btn-xs btn-default">
                            <input type="checkbox" autocomplete="off" class="filterAcionWidget" id="filterInfo"><i class="fa fa-eye fa-fw"></i>
                        </label>
                        <label class="btn btn-xs btn-default">
                            <input type="checkbox" autocomplete="off" class="filterAcionWidget" id="filterBinary"><span class="label label-info" style="text-shadow: none;">binary</span>
                        </label>
                        <label class="btn btn-xs btn-default">
                            <input type="checkbox" autocomplete="off" class="filterAcionWidget" id="filterNumeric"><span class="label label-danger" style="text-shadow: none;">numeric</span>
                        </label>
                        <label class="btn btn-xs btn-default">
                            <input type="checkbox" autocomplete="off" class="filterAcionWidget" id="filterString"><span class="label label-default" style="text-shadow: none;">string</span>
                        </label>
                    </div>                
                </div>
            </div>      
            <li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
        </ul>
        <ul id="ul_widget" class="nav nav-pills nav-stacked" style="max-height: 350px;overflow: auto"></ul>
        <br>
    </div>
    <div id="bsOtherActionCategory" data-name="Other" style="display: none">
        <div class="row">
            <div class="col-sm-12">
                <div class="well col-sm-12">
                    <div class="form-group form-group-sm">
                        <label class="col-sm-2 control-label" for="bsOtherActionName">{{Nom}}</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control actionOtherAttr" data-l1key="name" id="bsOtherActionName" placeholder="{{Nom}}..."/>
                        </div>
                        <label class="col-sm-2 control-label" for="bsOtherActionDash">{{Interfaces}}</label>
                        <div class="col-sm-2">
                            <select class="form-control actionOtherAttr" data-l1key="version" id="bsOtherActionDash">
                                <option value="1">Dashboard</option>
                                <option value="0">Mobile</option>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label" for="bsOtherActionDash">{{Biblithèques}}</label>
                        <div class="col-sm-2">
                            <select class="form-control actionOtherAttr" data-l1key="type" id="bsOtherActionType">
                                <option value="0">Jeedom</option>
                                <option value="1">Widgets</option>
                                <option value="2">Spécial</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="min-width: 260px">
                <div class="well col-sm-6 noPaddingLeft noPaddingRight">
                    <h4 class="col-sm-12 text-center"><strong>Off</strong></h4>
                    <div class="col-sm-12 noPaddingLeft noPaddingRight" style="text-align: center; vertical-align: middle;">
                        <div class="eqLogic eqLogic-widget" style="display: none;">
                            <div class="verticalAlign">
                                <center id="bsOtherWidgetOff">
                                </center>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="well col-sm-6 noPaddingLeft noPaddingRight">
                    <h4 class="col-sm-12 text-center"><strong>On</strong></h4>
                    <div class="col-sm-12 noPaddingLeft noPaddingRight" style="text-align: center; vertical-align: middle;">
                        <div class="eqLogic eqLogic-widget" style="display: none;">
                            <div class="verticalAlign">
                                <center id="bsOtherWidgetOn">
                                </center>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: center;" class="col-sm-4">Image</th>
                            <th style="text-align: center;" class="col-sm-4">Taille</th>
                            <th style="text-align: center;" class="col-sm-4">Aperçu
                                <input type="number" value="" class="pull-right col-sm-3 btn-xs specialView svgSpecView" id="bsOtherSvgSpecSize" min="32" max="128" step="16" disabled title="Modifier la Taille">
                                <input type="color" value="" class="pull-right btn btn-xs btn-warning specialView svgSpecView" id="bsOtherSvgSpecColor" disabled title="Changer la Couleur">
                            </th>
                        </tr>
                    </thead>
                    <tbody id="bodyOtherAction">
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">
                                <a class="btn btn-default btn-xs JeedomView" id="bsOtherActionInsertIcon1" style=display:none"><i class="fa fa-flag"></i> Rechercher une icone</a>
                                <select class="form-control widgetsView actionOtherAttr" data-l1key="image1" value="" id="bsOtherImage1" ></select>
                                <select class="form-control specialView actionOtherAttr" data-l1key="list1" value="" id="bsOtherSpecialCat1" ><option value="">{{Aucune}}</option></select>
                                <select class="form-control specialView actionOtherAttr" data-l1key="special1" value="" id="bsOtherSpecial1" ><option value="">{{Aucune}}</option></select>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="number" class="form-control JeedomView actionOtherAttr" data-l1key="size" style=display:none" value="2.5" min="1" max="5" step="0.2" id="bsOtherActionIconSize1"/>
                                <label class="col-sm-12 control-label widgetsView" id="bsOtherLabel1"></label>
                                <label class="col-sm-12 control-label specialView" id="bsOtherLabelSpec1"></label>
                            </td>
                            <td style="text-align: center; vertical-align: middle;" id="bsOtherSvgPreview1">
                                <span style="font-size: 2.5em;font-weight: bold;margin-top: 5px;" class="JeedomView actionOtherAttr" data-l1key="icon1" id="bsOtherActionIconCmd1"></span>
                                <img src="" id="bsOtherPreview1" class="img-responsive widgetsView" style="margin: 0px auto;">
                                <img src="" id="bsOtherPreviewSpec1" class="img-responsive specialView" style="margin: 0px auto;">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">
                                <a class="btn btn-default btn-xs JeedomView" id="bsOtherActionInsertIcon2" style=display:none"><i class="fa fa-flag"></i> Rechercher une icone</a>
                                <select class="form-control widgetsView actionOtherAttr" data-l1key="image2" value="" id="bsOtherImage2" ></select>
                                <select class="form-control specialView actionOtherAttr" data-l1key="list2" value="" id="bsOtherSpecialCat2" ><option value="">{{Aucune}}</option></select>
                                <select class="form-control specialView actionOtherAttr" data-l1key="special2" value="" id="bsOtherSpecial2" ><option value="">{{Aucune}}</option></select>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="number" class="form-control JeedomView" disabled style=display:none" value="2.5" min="1" max="5" step="0.2" id="bsOtherActionIconSize2"/>
                                <label class="col-sm-12 control-label widgetsView" id="bsOtherLabel2"></label>
                                <label class="col-sm-12 control-label specialView" id="bsOtherLabelSpec2"></label>
                            </td>
                            <td style="text-align: center; vertical-align: middle;" id="bsOtherSvgPreview2">
                                <span style="font-size: 2.5em;font-weight: bold;margin-top: 5px;" class=" JeedomView actionOtherAttr" data-l1key="icon2" id="bsOtherActionIconCmd2"></span>
                                <img src="" id="bsOtherPreview2" class="img-responsive widgetsView" style="margin: 0px auto;">
                                <img src="" id="bsOtherPreviewSpec2" class="img-responsive specialView" style="margin: 0px auto;">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-12">
                <textarea class="form-control" id="bsViewOther" style='height: 600px;display: none;'></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12" style="padding-bottom: 20px">
                <br>
                <button type="button" class="btn btn-danger pull-right" id="modalOtherActionCancelGDI">{{Annuler}}</button>
                <button type="button" class="btn btn-success pull-right" id="modalOtherActionSaveGDI">{{Valider}}</button>
            </div>
        </div>
    </div> 
    <div id="bsInfoBinaryCategory" data-name="Binary" style="display: none">
        <div class="row">
            <div class="col-sm-12">
                <div class="well col-sm-12">
                    <div class="form-group form-group-sm">
                        <label class="col-sm-2 control-label" for="bsInfoBinaryName">{{Nom}}</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control infoBinaryAttr" data-l1key="name" id="bsInfoBinaryName" placeholder="{{Nom}}..."/>
                        </div>
                        <label class="col-sm-2 control-label" for="bsInfoBinaryDash">{{Interfaces}}</label>
                        <div class="col-sm-2">
                            <select class="form-control infoBinaryAttr" data-l1key="version" id="bsInfoBinaryDash">
                                <option value="1">Dashboard</option>
                                <option value="0">Mobile</option>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label" for="bsInfoBinaryDash">{{Biblithèques}}</label>
                        <div class="col-sm-2">
                            <select class="form-control infoBinaryAttr" data-l1key="type" id="bsInfoBinaryType">
                                <option value="0">Jeedom</option>
                                <option value="1">Widgets</option>
                                <option value="2">Spécial</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="min-width: 260px">
                <div class="well col-sm-6 noPaddingLeft noPaddingRight">
                    <h4 class="col-sm-12 noPaddingLeft noPaddingRight text-center"><strong>Etat: 0</strong></h4>
                    <div class="col-sm-12 noPaddingLeft noPaddingRight" style="text-align: center; vertical-align: middle;">
                        <div class="eqLogic eqLogic-widget" style="display: none;">
                            <div class="verticalAlign">
                                <center id="bsInfoBinaryWidgetOff">
                                </center>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="well col-sm-6 noPaddingLeft noPaddingRight">
                    <h4 class="col-sm-12  noPaddingLeft noPaddingRight text-center"><strong>Etat: 1</strong></h4>
                    <div class="col-sm-12 noPaddingLeft noPaddingRight" style="text-align: center; vertical-align: middle;">
                        <div class="eqLogic eqLogic-widget" style="display: none;">
                            <div class="verticalAlign">
                                <center id="bsInfoBinaryWidgetOn">
                                </center>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: center;" class="col-sm-4">Image</th>
                            <th style="text-align: center;" class="col-sm-4">Taille</th>
                            <th style="text-align: center;" class="col-sm-4">Aperçu
                                <input type="number" value="" class="pull-right col-sm-3 btn-xs specialView svgSpecView" id="bsInfoBinarySvgSpecSize" min="32" max="128" step="16" disabled title="Modifier la Taille">
                                <input type="color" value="" class="pull-right btn btn-xs btn-warning specialView svgSpecView" id="bsInfoBinarySvgSpecColor" disabled title="Changer la Couleur">
                            </th>
                        </tr>
                    </thead>
                    <tbody id="bodyInfoBinary">
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">
                                <a class="btn btn-default btn-xs JeedomView" id="bsInfoBinaryInsertIcon1" style=display:none"><i class="fa fa-flag"></i> Rechercher une icone</a>
                                <select class="form-control widgetsView infoBinaryAttr" data-l1key="image1" value="" id="bsInfoBinaryImage1" ></select>
                                <select class="form-control specialView infoBinaryAttr" data-l1key="list1" value="" id="bsInfoBinarySpecialCat1" ><option value="">{{Aucune}}</option></select>
                                <select class="form-control specialView infoBinaryAttr" data-l1key="special1" value="" id="bsInfoBinarySpecial1" ><option value="">{{Aucune}}</option></select>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="number" class="form-control JeedomView infoBinaryAttr" data-l1key="size" style=display:none" value="2.5" min="1" max="5" step="0.2" id="bsInfoBinaryIconSize1"/>
                                <label class="col-sm-12 control-label widgetsView " id="bsInfoBinaryLabel1"></label>
                                <label class="col-sm-12 control-label specialView " id="bsInfoBinaryLabelSpec1"></label>
                            </td>
                            <td style="text-align: center; vertical-align: middle;" id="bsInfoBinarySvgPreview1">
                                <span style="font-size: 2.5em;font-weight: bold;margin-top: 5px;" class="JeedomView infoBinaryAttr" data-l1key="icon1" id="bsInfoBinaryIconCmd1"></span>
                                <img src="" id="bsInfoBinaryPreview1" class="img-responsive widgetsView" style="margin: 0px auto;">
                                <img src="" id="bsInfoBinaryPreviewSpec1" class="img-responsive specialView" style="margin: 0px auto;">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">
                                <a class="btn btn-default btn-xs JeedomView" id="bsInfoBinaryInsertIcon2" style=display:none"><i class="fa fa-flag"></i> Rechercher une icone</a>
                                <select class="form-control widgetsView infoBinaryAttr" data-l1key="image2" value="" id="bsInfoBinaryImage2" ></select>
                                <select class="form-control specialView infoBinaryAttr" data-l1key="list2" value="" id="bsInfoBinarySpecialCat2" ><option value="">{{Aucune}}</option></select>
                                <select class="form-control specialView infoBinaryAttr" data-l1key="special2" value="" id="bsInfoBinarySpecial2" ><option value="">{{Aucune}}</option></select>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="number" class="form-control JeedomView" disabled style=display:none" value="2.5" min="1" max="5" step="0.2" id="bsInfoBinaryIconSize1"/>
                                <label class="col-sm-12 control-label widgetsView" id="bsInfoBinaryLabel2"></label>
                                <label class="col-sm-12 control-label specialView" id="bsInfoBinaryLabelSpec2"></label>
                            </td>
                            <td style="text-align: center; vertical-align: middle;" id="bsInfoBinarySvgPreview2">
                                <span style="font-size: 2.5em;font-weight: bold;margin-top: 5px;" class="JeedomView infoBinaryAttr" data-l1key="icon2" id="bsInfoBinaryIconCmd2"></span>
                                <img src="" id="bsInfoBinaryPreview2" class="img-responsive widgetsView" style="margin: 0px auto;">
                                <img src="" id="bsInfoBinaryPreviewSpec2" class="img-responsive specialView" style="margin: 0px auto;">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-12">
                <textarea class="form-control" id="bsViewInfoBinary" style='height: 600px;display: none;'></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12" style="padding-bottom: 20px">
                <br>
                <button type="button" class="btn btn-danger pull-right" id="modalInfoBinaryCancelGDI">{{Annuler}}</button>
                <button type="button" class="btn btn-success pull-right" id="modalInfoBinarySaveGDI">{{Valider}}</button>
            </div>
        </div>
    </div> 
    <div id="bsInfoNumericCategory" data-name="Numeric" style="display: none">
        <div class="row">
            <div class="col-sm-12">
                <div class="well col-sm-12">
                    <div class="form-group form-group-sm">
                        <label class="col-sm-1 control-label" for="bsInfoNumericName">{{Nom}}</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control infoNumericAttr" data-l1key="name" id="bsInfoNumericName" placeholder="{{Nom}}..."/>
                        </div>
                        <label class="col-sm-1 control-label" for="bsInfoNumericDash">{{Interfaces}}</label>
                        <div class="col-sm-2">
                            <select class="form-control infoNumericAttr" data-l1key="version" id="bsInfoNumericDash">
                                <option value="1">Dashboard</option>
                                <option value="0">Mobile</option>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label" for="bsInfoNumericDash">{{Biblithèques}}</label>
                        <div class="col-sm-2">
                            <select class="form-control infoNumericAttr" data-l1key="type" id="bsInfoNumericType">
                                <option value="0">Jeedom</option>
                                <option value="1">Widgets</option>
                                <option value="2">Spécial</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-sm btn-block btn-primary" id="bsInfoNumericAddEntry" title="{{Ajouter une entrée}}"><i class="fa fa-plus-circle"></i> {{Ajouter}}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: center;" class="col-sm-2">Image</th>
                            <th style="text-align: center;" class="col-sm-2">Taille</th>
                            <th style="text-align: center;" class="col-sm-2">de</th>
                            <th style="text-align: center;" class="col-sm-2">à</th>
                            <th style="text-align: center;" class="col-sm-3">Aperçu
                                <input type="number" value="" class="pull-right col-sm-3 btn-xs specialView svgSpecView" id="bsInfoNumericSvgSpecSize" min="32" max="128" step="16" disabled title="Modifier la Taille">
                                <input type="color" value="" class="pull-right btn btn-xs btn-warning specialView svgSpecView" id="bsInfoNumericSvgSpecColor" disabled title="Changer la Couleur">
                            </th>
                            <th style="text-align: center;" class="col-sm-1"></th>
                        </tr>
                    </thead>
                    <tbody id="bodyInfoNumeric">
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">
                                <a class="btn btn-default btn-xs JeedomView" data-index="0" name="bsInfoNumericInsertIcon0" id="bsInfoNumericInsertIcon0" style=display:none"><i class="fa fa-flag"></i> Rechercher une icone</a>
                                <select class="form-control widgetsView" value="" data-index="0" name="bsInfoNumericImage0" id="bsInfoNumericImage0"></select>
                                <select class="form-control specialView" value="" data-index="0" name="bsInfoNumericSpecialCat0" id="bsInfoNumericSpecialCat0" ><option value="">{{Aucune}}</option></select>
                                <select class="form-control specialView" value="" data-index="0" name="bsInfoNumericSpecialIcon0" id="bsInfoNumericSpecialIcon0" ><option value="">{{Aucune}}</option></select>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="number" class="form-control JeedomView infoNumericAttr" data-l1key="size" data-index="0" style=display:none" value="2.5" min="1" max="5" step="0.2" name="bsInfoNumericIconSize0" id="bsInfoNumericIconSize0"/>
                                <label class="col-sm-12 control-label widgetsView" id="bsInfoNumericLabel0"></label>
                                <label class="col-sm-12 control-label specialView" id="bsInfoNumericLabelSpec0"></label>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="number" class="form-control" value="0" max="100" data-index="0" name="" id="bsInfoNumericEcartMin0" disabled/>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="number" class="form-control" value="100" max="100" data-index="0" name="bsInfoNumericEcartMax0" id="bsInfoNumericEcartMax0"/>
                            </td>
                            <td style="text-align: center; vertical-align: middle;" id="bsInfoNumericSvgPreview0">
                                <span style="font-size: 2.5em;font-weight: bold;margin-top: 5px;" class=" JeedomView" data-index="0" name="bsInfoNumericIconCmd0" id="bsInfoNumericIconCmd0"></span>
                                <img src="" id="bsInfoNumericPreview0" class="img-responsive widgetsView" style="margin: 0px auto;">
                                <img src="" id="bsInfoNumericPreviewSpec0" class="img-responsive specialView" style="margin: 0px auto;">
                            </td>
                            <td style=" vertical-align: middle;">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-3 noPaddingLeft noPaddingRight" style="min-width:190px">
                <div class="well col-sm-12">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10 noPaddingLeft noPaddingRight" style="min-width: 150px;margin: 0px auto;text-align: center; vertical-align: middle;">
                        <input id="bsInfoNumeric" style="width:150px;" data-slider-id='bsInfoNumericSlider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0"/>
                    </div>
                    <div class="col-sm-12 noPaddingLeft noPaddingRight" style="text-align: center; vertical-align: middle;">
                        <div class="eqLogic eqLogic-widget" style="display: none;">
                            <div class="verticalAlign">
                                <center id="bsInfoNumericWidgetOff"></center>
                            </div>
                        </div> 
                    </div>
                </div>       
            </div>       
            <div class="col-sm-9">
                <textarea class="form-control" id="bsViewInfoNumeric"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12" style="padding-bottom: 20px">
                <br>
                <button type="button" class="btn btn-danger pull-right" id="modalInfoNumericCancelGDI">{{Annuler}}</button>
                <button type="button" class="btn btn-success pull-right" id="modalInfoNumericSaveGDI">{{Valider}}</button>
            </div>
        </div>
    </div> 
    <div id="bsEasyModeView" data-name="EasyMode" style="display: none">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="well col-sm-12">
            <strong class="col-sm-12 noPaddingLeft noPaddingRight" style="border-bottom: 1px groove; margin-bottom: 8px;">{{Images}}</strong>    
            <div class="form-group form-group-sm">
                <div class="col-sm-12">
                    <span class="form-control btn-info fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span> {{Ajouter ses images...}}</span>
                        <input class="form-control" type="file" id="bsImagesFileload" name="images"/>
                    </span>
                </div>    
            </div>
        </div>
        <div class="well col-sm-12">
            <strong class="col-sm-12 noPaddingLeft noPaddingRight" style="border-bottom: 1px groove; margin-bottom: 8px;">{{Choisir son Widget}}</strong>
            <div class="form-group form-group-sm">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-block btn-warning " id="bt_OtherActionAddGDI" title="{{other.action}}"><i class="fa fa-square"></i> {{Widget On/Off}}</button>
                    <button type="button" class="btn btn-block btn-warning " id="bt_InfoBinaryAddGDI" title="{{info.binary}}"><i class="fa fa-square"></i> {{Widget Simple Etat}}</button>
                    <button type="button" class="btn btn-block btn-warning " id="bt_InfoNumericAddGDI" title="{{info.numeric}}"><i class="fa fa-square"></i> {{Widget Numérique}}</abutton>
                    <button type="button" class="btn btn-block btn-warning " id="bt_HaloAddGDI" title="{{info.binary}}"><i class="icon jeedom-lumiere-on"></i> {{Widget Halo On/off}}</abutton>
                </div>
            </div>
        </div>
        </form>
    </div> 
    <div id="bsHaloCategory" data-name="Halo" style="display: none">
 <!--       
width: 32px;
height: 70px;
position: relative;
top: -526px;
left: 834px;

box-shadow: rgba(255, 255, 0, 0.4) 0px -20px 330px 205px;
background: rgba(255, 255, 0, 0.4);
-->
        <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="bsHaloColor">{{Couleur}}</label>
                                    <div class="col-sm-8">
                                        <div class="input-group bsHaloColor" name="bsHaloColor" id="bsHaloColor" ><input type="text" value="#fff" class="form-control"/><span class="input-group-addon"><i></i></span></div>
                                        <input type="text" style="display: none" class="haloGenAttr" data-l1key="bsGenColor">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="bsHaloWidth">{{Largeur}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="bsHaloWidth" class="col-sm-12 bsHaloSlider" data-slider-min="10" data-slider-max="250" data-slider-step="1" data-slider-value="20">
                                        <input type="text" style="display: none" class="haloGenAttr" data-l1key="bsHaloWidth">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="bsHaloHeight">{{Hauteur}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="bsHaloHeight" class="col-sm-12 bsHaloSlider" data-slider-min="10" data-slider-max="250" data-slider-step="1" data-slider-value="20">
                                        <input type="text" style="display: none" class="haloGenAttr" data-l1key="bsHaloHeight">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="bsHaloAxeX">{{Axe X}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="bsHaloAxeX" class="col-sm-12 bsHaloSlider" data-slider-min="-250" data-slider-max="250" data-slider-step="1" data-slider-value="0">
                                        <input type="text" style="display: none" class="haloGenAttr" data-l1key="bsHaloAxeX">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="bsHaloAxeY">{{Axe Y}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="bsHaloAxeY" class="col-sm-12 bsHaloSlider" data-slider-min="-150" data-slider-max="150" data-slider-step="1" data-slider-value="0">
                                        <input type="text" style="display: none" class="haloGenAttr" data-l1key="bsHaloAxeY">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="bsHaloSize">{{Hauteur}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="bsHaloSize" class="col-sm-12 bsHaloSlider" data-slider-min="10" data-slider-max="250" data-slider-step="1" data-slider-value="20">
                                        <input type="text" style="display: none" class="haloGenAttr" data-l1key="bsHaloSize">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="bsHaloSizeShadow">{{Hauteur}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="bsHaloSizeShadow" class="col-sm-12 bsHaloSlider" data-slider-min="10" data-slider-max="250" data-slider-step="1" data-slider-value="20">
                                        <input type="text" style="display: none" class="haloGenAttr" data-l1key="bsHaloSizeShadow">
                                    </div>
                                </div>
        </form>
    </div> 
    <div id="bsPanelWidgetImages" data-name="EasyModeView" style="display: none">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            {{Bibliothèque d'images : Jeedom}}<small><em><bold> - {{Les divers icônes de Jeedom disponibles}}</bold></em></small>
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body" style="height: 250px; overflow: auto">
                        <div class="col-sm-12" id="bsIconView">
                            <?php
                            foreach (ls('core/css/icon', '*') as $dir) {
                                if (is_dir('core/css/icon/' . $dir) && file_exists('core/css/icon/' . $dir . '/style.css')) {
                                    $css = file_get_contents('core/css/icon/' . $dir . '/style.css');
                                    $research = strtolower(str_replace('/', '', $dir));
                                    preg_match_all("/\." . $research . "-(.*?):/", $css, $matches, PREG_SET_ORDER);
                                    $height = (ceil(count($matches) / 12) * 80) + 80;
                                    echo '<div style="height : ' . $height . 'px;"><legend>{{' . str_replace('/', '', $dir) . '}}</legend>';
                                    $number = 1;
                                    foreach ($matches as $match) {
                                        if (isset($match[0])) {
                                            if ($number == 1) {
                                                echo '<div class="row">';
                                            }
                                            echo '<div class="col-sm-1 divIconSel">';
                                            $icon = str_replace(array(':', '.'), '', $match[0]);
                                            echo '<center><span class="iconSel"><i class=\'icon ' . $icon . '\'></i></span><br/><span class="iconDesc">' . $icon . '</span></center>';
                                            echo '</div>';
                                            if ($number == 12) {
                                                echo '</div>';
                                                $number = 0;
                                            }
                                            $number++;
                                        }
                                    }
                                    if ($number != 1) {
                                        echo '</div>';
                                    }
                                    echo "</div><br/>";
                                }
                            }
                            ?>
                            <div style="height: 650px;">
                                <legend>{{Générale}}</legend>
                                <div class="row">
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-glass'></i></span><br/><span class="iconDesc">fa-glass</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-music'></i></span><br/><span class="iconDesc">fa-music</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-search'></i></span><br/><span class="iconDesc">fa-search</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-envelope-o'></i></span><br/><span class="iconDesc">fa-envelope-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-heart'></i></span><br/><span class="iconDesc">fa-heart</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-star'></i></span><br/><span class="iconDesc">fa-star</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-star-o'></i></span><br/><span class="iconDesc">fa-star-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-user'></i></span><br/><span class="iconDesc">fa-user</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-film'></i></span><br/><span class="iconDesc">fa-film</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-th-large'></i></span><br/><span class="iconDesc">fa-th-large</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-check'></i></span><br/><span class="iconDesc">fa-check</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-times'></i></span><br/><span class="iconDesc">fa-times</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-power-off'></i></span><br/><span class="iconDesc">fa-power-off</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-signal'></i></span><br/><span class="iconDesc">fa-signal</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-cog'></i></span><br/><span class="iconDesc">fa-cog</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-trash-o'></i></span><br/><span class="iconDesc">fa-trash-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-home'></i></span><br/><span class="iconDesc">fa-home</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-file-o'></i></span><br/><span class="iconDesc">fa-file-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-clock-o'></i></span><br/><span class="iconDesc">fa-clock-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-road'></i></span><br/><span class="iconDesc">fa-road</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-download'></i></span><br/><span class="iconDesc">fa-download</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-inbox'></i></span><br/><span class="iconDesc">fa-inbox</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-play-circle-o'></i></span><br/><span class="iconDesc">fa-play-circle-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-refresh'></i></span><br/><span class="iconDesc">fa-refresh</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-list-alt'></i></span><br/><span class="iconDesc">fa-list-alt</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-lock'></i></span><br/><span class="iconDesc">fa-lock</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-flag'></i></span><br/><span class="iconDesc">fa-flag</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-headphones'></i></span><br/><span class="iconDesc">fa-headphones</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-volume-down'></i></span><br/><span class="iconDesc">fa-volume-down</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-qrcode'></i></span><br/><span class="iconDesc">fa-qrcode</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-barcode'></i></span><br/><span class="iconDesc">fa-barcode</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-tag'></i></span><br/><span class="iconDesc">fa-tag</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-book'></i></span><br/><span class="iconDesc">fa-book</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-print'></i></span><br/><span class="iconDesc">fa-print</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-camera'></i></span><br/><span class="iconDesc">fa-camera</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-video-camera'></i></span><br/><span class="iconDesc">fa-video-camera</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-picture-o'></i></span><br/><span class="iconDesc">fa-picture-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-pencil'></i></span><br/><span class="iconDesc">fa-pencil</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-map-marker'></i></span><br/><span class="iconDesc">fa-map-marker</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-tint'></i></span><br/><span class="iconDesc">fa-tint</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-pencil-square-o'></i></span><br/><span class="iconDesc">fa-pencil-square-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-check-square-o'></i></span><br/><span class="iconDesc">fa-check-square-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-arrows'></i></span><br/><span class="iconDesc">fa-arrows</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-step-backward'></i></span><br/><span class="iconDesc">fa-step-backward</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-fast-backward'></i></span><br/><span class="iconDesc">fa-fast-backward</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-backward'></i></span><br/><span class="iconDesc">fa-backward</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-play'></i></span><br/><span class="iconDesc">fa-play</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-pause'></i></span><br/><span class="iconDesc">fa-pause</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-stop'></i></span><br/><span class="iconDesc">fa-stop</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-forward'></i></span><br/><span class="iconDesc">fa-forward</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-fast-forward'></i></span><br/><span class="iconDesc">fa-fast-forward</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-step-forward'></i></span><br/><span class="iconDesc">fa-step-forward</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-eject'></i></span><br/><span class="iconDesc">fa-eject</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-chevron-left'></i></span><br/><span class="iconDesc">fa-chevron-left</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-chevron-right'></i></span><br/><span class="iconDesc">fa-chevron-right</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-plus-circle'></i></span><br/><span class="iconDesc">fa-plus-circle</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-minus-circle'></i></span><br/><span class="iconDesc">fa-minus-circle</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-times-circle'></i></span><br/><span class="iconDesc">fa-times-circle</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-check-circle'></i></span><br/><span class="iconDesc">fa-check-circle</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-question-circle'></i></span><br/><span class="iconDesc">fa-question-circle</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-info-circle'></i></span><br/><span class="iconDesc">fa-info-circle</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-crosshairs'></i></span><br/><span class="iconDesc">fa-crosshairs</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-times-circle-o'></i></span><br/><span class="iconDesc">fa-times-circle-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-check-circle-o'></i></span><br/><span class="iconDesc">fa-check-circle-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-ban'></i></span><br/><span class="iconDesc">fa-ban</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-arrow-left'></i></span><br/><span class="iconDesc">fa-arrow-left</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-arrow-right'></i></span><br/><span class="iconDesc">fa-arrow-right</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-arrow-up'></i></span><br/><span class="iconDesc">fa-arrow-up</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-arrow-down'></i></span><br/><span class="iconDesc">fa-arrow-down</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-plus'></i></span><br/><span class="iconDesc">fa-plus</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-minus'></i></span><br/><span class="iconDesc">fa-minus</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-asterisk'></i></span><br/><span class="iconDesc">fa-asterisk</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-exclamation-circle'></i></span><br/><span class="iconDesc">fa-exclamation-circle</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-gift'></i></span><br/><span class="iconDesc">fa-gift</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-leaf'></i></span><br/><span class="iconDesc">fa-leaf</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-fire'></i></span><br/><span class="iconDesc">fa-fire</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-eye'></i></span><br/><span class="iconDesc">fa-eye</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-eye-slash'></i></span><br/><span class="iconDesc">fa-slash</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-exclamation-triangle'></i></span><br/><span class="iconDesc">fa-exclamation-triangle</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-plane'></i></span><br/><span class="iconDesc">fa-plane</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-calendar'></i></span><br/><span class="iconDesc">fa-calendar</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-random'></i></span><br/><span class="iconDesc">fa-random</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-comment'></i></span><br/><span class="iconDesc">fa-comment</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-magnet'></i></span><br/><span class="iconDesc">fa-magnet</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-chevron-up'></i></span><br/><span class="iconDesc">fa-chevron-up</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-chevron-down'></i></span><br/><span class="iconDesc">fa-chevron-down</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-shopping-cart'></i></span><br/><span class="iconDesc">fa-shopping-cart</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-folder'></i></span><br/><span class="iconDesc">fa-folder</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-folder-open'></i></span><br/><span class="iconDesc">fa-folder-open</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-bar-chart-o'></i></span><br/><span class="iconDesc">fa-bar-chart-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-key'></i></span><br/><span class="iconDesc">fa-key</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-heart-o'></i></span><br/><span class="iconDesc">fa-heart-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-sign-out'></i></span><br/><span class="iconDesc">fa-sign-out</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-thumb-tack'></i></span><br/><span class="iconDesc">fa-thumb-tack</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-sign-in'></i></span><br/><span class="iconDesc">fa-sign-in</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-phone'></i></span><br/><span class="iconDesc">fa-phone</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-unlock'></i></span><br/><span class="iconDesc">fa-unlock</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-credit-card'></i></span><br/><span class="iconDesc">fa-credit-card</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-rss'></i></span><br/><span class="iconDesc">fa-rss</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-hdd-o'></i></span><br/><span class="iconDesc">fa-hdd-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-bullhorn'></i></span><br/><span class="iconDesc">fa-bullhorn</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-bell'></i></span><br/><span class="iconDesc">fa-bell</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-globe'></i></span><br/><span class="iconDesc">fa-globe</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-wrench'></i></span><br/><span class="iconDesc">fa-wrench</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-filter'></i></span><br/><span class="iconDesc">fa-filter</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-briefcase'></i></span><br/><span class="iconDesc">fa-briefcase</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-cloud'></i></span><br/><span class="iconDesc">fa-cloud</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-flask'></i></span><br/><span class="iconDesc">fa-flask</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-scissors'></i></span><br/><span class="iconDesc">fa-scissors</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-paperclip'></i></span><br/><span class="iconDesc">fa-paperclip</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-floppy-o'></i></span><br/><span class="iconDesc">fa-floppy-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-table'></i></span><br/><span class="iconDesc">fa-table</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-magic'></i></span><br/><span class="iconDesc">fa-magic</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-truck'></i></span><br/><span class="iconDesc">fa-truck</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-money'></i></span><br/><span class="iconDesc">fa-money</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-columns'></i></span><br/><span class="iconDesc">fa-columns</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-envelope'></i></span><br/><span class="iconDesc">fa-envelope</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-gavel'></i></span><br/><span class="iconDesc">fa-gavel</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-tachometer'></i></span><br/><span class="iconDesc">fa-tachometer</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-bolt'></i></span><br/><span class="iconDesc">fa-bolt</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-sitemap'></i></span><br/><span class="iconDesc">fa-sitemap</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-umbrella'></i></span><br/><span class="iconDesc">fa-umbrella</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-lightbulb-o'></i></span><br/><span class="iconDesc">fa-lightbulb-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-stethoscope'></i></span><br/><span class="iconDesc">fa-stethoscope</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-suitcase'></i></span><br/><span class="iconDesc">fa-suitcase</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-coffee'></i></span><br/><span class="iconDesc">fa-coffee</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-cutlery'></i></span><br/><span class="iconDesc">fa-cutlery</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-building-o'></i></span><br/><span class="iconDesc">fa-building-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-medkit'></i></span><br/><span class="iconDesc">fa-medkit</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-beer'></i></span><br/><span class="iconDesc">fa-beer</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-h-square'></i></span><br/><span class="iconDesc">fa-square</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-desktop'></i></span><br/><span class="iconDesc">fa-desktop</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-laptop'></i></span><br/><span class="iconDesc">fa-laptop</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-tablet'></i></span><br/><span class="iconDesc">fa-tablet</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-mobile'></i></span><br/><span class="iconDesc">fa-mobile</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-circle-o'></i></span><br/><span class="iconDesc">fa-circle-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-spinner'></i></span><br/><span class="iconDesc">fa-spinner</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-circle'></i></span><br/><span class="iconDesc">fa-circle</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-smile-o'></i></span><br/><span class="iconDesc">fa-smile-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-frown-o'></i></span><br/><span class="iconDesc">fa-frown-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-meh-o'></i></span><br/><span class="iconDesc">fa-meh-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-gamepad'></i></span><br/><span class="iconDesc">fa-gamepad</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-keyboard-o'></i></span><br/><span class="iconDesc">fa-keyboard-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-terminal'></i></span><br/><span class="iconDesc">fa-terminal</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-location-arrow'></i></span><br/><span class="iconDesc">fa-location-arrow</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-microphone'></i></span><br/><span class="iconDesc">fa-microphone</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-microphone-slash'></i></span><br/><span class="iconDesc">fa-microphone-slash</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-shield'></i></span><br/><span class="iconDesc">fa-shield</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-calendar-o'></i></span><br/><span class="iconDesc">fa-calendar-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-fire-extinguisher'></i></span><br/><span class="iconDesc">fa-fire-extinguisher</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-rocket'></i></span><br/><span class="iconDesc">fa-rocket</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-anchor'></i></span><br/><span class="iconDesc">fa-anchor</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-unlock-alt'></i></span><br/><span class="iconDesc">fa-unlock-alt</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-compass'></i></span><br/><span class="iconDesc">fa-compass</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-apple'></i></span><br/><span class="iconDesc">fa-apple</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-windows'></i></span><br/><span class="iconDesc">fa-windows</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-android'></i></span><br/><span class="iconDesc">fa-android</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-linux'></i></span><br/><span class="iconDesc">fa-linux</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-dribbble'></i></span><br/><span class="iconDesc">fa-dribbble</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-trello'></i></span><br/><span class="iconDesc">fa-trello</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-female'></i></span><br/><span class="iconDesc">fa-female</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-male'></i></span><br/><span class="iconDesc">fa-male</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-gittip'></i></span><br/><span class="iconDesc">fa-sun-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-sun-o'></i></span><br/><span class="iconDesc">fa-glass</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-moon-o'></i></span><br/><span class="iconDesc">fa-moon-o</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-archive'></i></span><br/><span class="iconDesc">fa-archive</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-pagelines'></i></span><br/><span class="iconDesc">fa-pagelines</span></div>
                                    <div class="col-sm-1 divIconSel"><center><span class="iconSel"><i class='fa fa-wheelchair'></i></span><br/><span class="iconDesc">fa-wheelchair</span></div>
                                </div>
                            </div>
                            <script>
                                $('#in_iconSelectorSearch').on('keyup', function () {
                                    $('.divIconSel').show();
                                    var search = $(this).value();
                                    if (search !== '') {
                                        $('.iconDesc').each(function () {
                                            if ($(this).text().indexOf(search) === -1) {
                                                $(this).closest('.divIconSel').hide();
                                            }
                                        });
                                    }
                                });
                                $('.divIconSel').on('click', function () {
                                    $('.divIconSel').removeClass('iconSelected');
                                    $(this).closest('.divIconSel').addClass('iconSelected');
                                 });
                                $('.divIconSel').on('dblclick', function () {
                                    $('.divIconSel').removeClass('iconSelected');
                                    $(this).closest('.divIconSel').addClass('iconSelected');
                                    $('#mod_selectIcon').dialog("option", "buttons")['Valider'].apply($('#mod_selectIcon'));
                                });
                            </script>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="panel panel-warning">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Bibliothèque d'images : Widgets<small><em><bold> - {{Vos images personnelles}}</bold></em></small>
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body" id="bsImagesPanel">
                        <div class="col-sm-12" id="bsImagesView" style="min-height: 50px"></div>
                    </div>
                </div>
            </div>
            <div class="panel panel-success" id="bsSpecialPanel">
                <input class="form-control" type="file" id="bsSpecialFileload" name="special" style="display: none;" data-url="plugins/widget/core/ajax/widget.ajax.php?action=specialUpload"/>
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Bibliothèque d'images : Spécial<small><em><bold> - {{Pack d'icônes}}</bold></em></small>
                        </a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        <div id="bsSpecialSvgLoad" style=""></div>
                        <div class="col-sm-12" id="bsSpecialView" style="min-height: 50px"></div>
                    </div>
                </div>
            </div>
        </div> 
    </div> 
    <div id="bsPanelWidgetFonts" data-name="Liste" style="display: none">
        <div class="col-sm-12" id="bsFontsView"></div> 
    </div> 
    <div id="widgetFontsView" data-name="Fonts" style="display: none">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="well col-sm-12">
                <strong class="col-sm-12 noPaddingLeft noPaddingRight" style="border-bottom: 1px groove; margin-bottom: 8px;">{{Fonts}}</strong>    
                <div class="form-group form-group-sm">
                    <div class="col-sm-12">
                        <span class="form-control btn-info fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span> {{Ajouter une font...}}</span>
                            <input class="form-control" type="file" id="bt_WidgetFont" name="fonts" data-url="plugins/widget/core/ajax/widget.ajax.php?action=fontUpload"/>
                        </span>
                    </div>    
                </div>
            </div>
            <div class="well col-sm-12">
                <strong class="col-sm-12 noPaddingLeft noPaddingRight" style="border-bottom: 1px groove; margin-bottom: 8px;">{{Expert}}</strong>    
                <div class="form-group form-group-sm">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-block btn-danger expertModeVisible" id="bt_WidgetFontInit" title="{{ré-initialiser les Fonts}}"><i class="fa fa-square"></i> {{Reset}}</button>                                    
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="widgetDetailsView" class="widget" data-name="Details" style="display: none">
        <form class="form-horizontal" style="">
            <div class="col-sm-4">
            <div class="form-group form-group-sm">
                <label class="col-sm-6 control-label">{{Nom du widget}}</label>
                <div class="col-sm-6">
                    <input type="text" class="widgetAttr form-control" data-l1key="path" style="display : none;" />
                    <input type="text" class="widgetAttr form-control" data-l1key="logicalId" style="display : none;" />
                    <input type="text" class="widgetAttr form-control" data-l1key="name" placeholder="{{Nom du widget}}"/>
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label class="col-sm-6 control-label">{{Version}}</label>
                <div class="col-sm-6">
                    <select class="widgetAttr form-control" data-l1key='version'>
                        <option value='dashboard'>{{Dashboard}}</option>
                        <option value='mobile'>{{Mobile}}</option>
                    </select>
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label class="col-sm-6 control-label">{{Type}}</label>
                <div class="col-sm-6">
                    <select class="widgetAttr form-control" data-l1key='type'>
                        <option value='none'>{{Aucun}}</option>
                        <?php
                        foreach (cmd::allType() as $type) {
                            echo '<option value="' . $type['type'] . '">' . $type['type'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-6 control-label">{{Sous-type}}</label>
                <div class="col-sm-6">
                    <select class="widgetAttr form-control" data-l1key='subtype'>
                        <option value='none'>{{Aucun}}</option>
                        <?php
                        foreach (cmd::allSubType() as $subtype) {
                            echo '<option value="' . $subtype['subtype'] . '">' . $subtype['subtype'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label class="col-sm-6 control-label">{{Utilisé par }}</label>
                <div class="col-sm-6">
                    <span class="label label-primary">
                        <span class="widgetAttr" data-l1key="nbUsedBy"></span> commande(s)
                    </span>
                </div>
            </div>
            <div class="form-group form-group-sm">
                <div class="col-sm-12">
                    <a class="btn btn-sm btn-success pull-right widgetAction" data-action="saveGDI"><i class="fa fa-check-circle"></i> {{Sauvegarder}}</a>
                    <a class="btn btn-sm btn-danger pull-right widgetAction" data-action="removeGDI"><i class="fa fa-minus-circle"></i> {{Supprimer}}</a>
                </div>
            </div>
            <strong class="col-sm-12 noPaddingLeft noPaddingRight" style="border-bottom: 1px groove; margin-bottom: 8px;">{{Actions}}</strong>
            <div class="form-group form-group-sm">
                <div class="col-sm-6">
                    <a class="btn btn-default btn-sm btn-block" id="bt_manageFiles"><i class="fa fa-file"></i> {{Fichiers}}</a>
                    <a class="btn btn-default btn-sm btn-block widgetAction expertModeVisible" data-action="copyGDI"><i class="fa fa-files-o"></i> {{Dupliquer}}</a>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-sm btn-default btn-block" id="bt_applyWidget"><i class="fa fa-fire"></i> {{Appliquer}}</a>
                    <a class="btn btn-sm btn-warning btn-block" id="bt_shareOnMarket"><i class="fa fa-cloud-upload"></i> {{Partager}}</a>
                    <a class="btn btn-sm btn-success btn-block" id="bt_editWidgetGDI" style="display:none"><i class="fa fa-cloud-upload"></i> {{Editer}}</a>
                </div>
            </div>
            <strong class="col-sm-12 noPaddingLeft noPaddingRight" style="border-bottom: 1px groove; margin-bottom: 8px;">{{Aperçu}}</strong>
            <div class="form-group form-group-sm">
                <div class="col-sm-12" id='div_widgetResult'></div>
            </div>
            <br>
            </div>
            <div class="col-sm-8">
                <textarea class='form-control widgetAttr' data-l1key='content' id='ta_widgetContent'></textarea>
            </div>
        </form>
        <br>
    </div>
</div>
<?php
//include_file('desktop', 'gdi', 'js', 'themes');
include_file('desktop', 'fonts.widget', 'js', 'widget');
include_file('desktop', 'other.widget', 'js', 'widget');
include_file('desktop', 'binary.widget', 'js', 'widget');
include_file('desktop', 'numeric.widget', 'js', 'widget');
include_file('desktop', 'widget', 'js', 'widget');
include_file('desktop', 'widgetGDI', 'js', 'widget');