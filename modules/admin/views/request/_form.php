<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>
<script>
    function funky() {
        
        thingy = document.getElementById('request-status');
        thongy = document.getElementById('request-why_not');
        if (thingy.value == 'Отклонена'){

            thongy.style.opacity = 1;
            if (thongy.value == ''){
                
                document.getElementById('request-Save').disabled = true;
            }else{
                document.getElementById('request-Save').disabled = false;
            }
        }else{
            thongy.style.opacity = 0;
        }
    }
    function fonky() {
        if (document.getElementById('request-why_not') != '') {
            document.getElementById('request-Save').disabled = false;
        }else{
            console.log('rofl');
            document.getElementById('request-Save').disabled = true;
        }
    }
</script>
<div class="request-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php if($lever == 'pull'){
        echo $form->field($model, 'status')->dropDownList(\app\modules\admin\models\Request::ListStatus(), array('onchange'=>'funky()'));
    }?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?= $form->field($model, 'imageFile2')->fileInput() ?>

    <?= $form->field($model, 'why_not')->textInput(['oninput' => 'fonky()','style' => ['opacity' => 0], 'maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\modules\admin\models\Category::find()->all(), 'id', 'name')) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'id' => 'request-Save']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
