<?php

use mdm\admin\AutocompleteAsset;
use yiiexttbq\adminlte\models\Menu;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model yiiexttbq\adminlte\models\Menu */
/* @var $form yii\widgets\ActiveForm */
AutocompleteAsset::register($this);
$opts = Json::htmlEncode([
    'menus' => Menu::getMenuSource(),
    'routes' => Menu::getSavedRoutes(),
]);
$this->registerJs("var _opts = $opts;");
$this->registerJs($this->render('_script.js'));
?>
<style type="text/css">
.ui-autocomplete{position: static;}
</style>
<div class="menu-form">
    <?php $form = ActiveForm::begin();?>
    <?=Html::activeHiddenInput($model, 'parent', ['id' => 'parent_id']);?>
    <div class="row">
        <div class="col-sm-6">
            <?=$form->field($model, 'name')->textInput(['maxlength' => 128]);?>
            <?=$form->field($model, 'parent_name')->textInput(['id' => 'parent_name']);?>
            <div id="cp_parent_name"></div>
            <?=$form->field($model, 'route')->textInput(['id' => 'route']);?>
            <div id="cp_route"></div>
            <?=$form->field($model, 'visible')->textInput(['id' => 'visible']);?>
        </div>
        <div class="col-sm-6">
            <?=$form->field($model, 'order')->input('number');?>
            <?=$form->field($model, 'data')->textarea(['rows' => 4]);?>
        </div>
    </div>

    <div class="form-group">
        <?=
Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), ['class' => $model->isNewRecord
    ? 'btn btn-success' : 'btn btn-primary'])
;?>
    </div>
    <?php ActiveForm::end();?>
</div>
