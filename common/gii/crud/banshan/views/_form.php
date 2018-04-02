<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator doc\gii\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<?= "<?php " ?>
$form = ActiveForm::begin([
    'id' => "<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form",
    'options'=>['class' => 'form-horizontal group-border-dashed <?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form'],
    'method' => 'post',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-sm-6\">{input}</div>\n<div class=\"col-sm-6 col-sm-offset-3\">{error}</div>",
        'labelOptions' => ['class' => 'col-sm-3 control-label'],
    ],
    ]);
?>
<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
    }
} ?>
<div class="form-group">
    <div class="col-sm-6 col-sm-offset-3">
        <?= "<?= " ?>Html::submitButton($model->isNewRecord ? <?= $generator->generateString('新建') ?> : <?= $generator->generateString('更新') ?>, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>

<?= "<?php " ?>ActiveForm::end(); ?>