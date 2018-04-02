<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator doc\gii\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= $generator->generateString('新建' . $generator->modelName) ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString($generator->modelName) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12 <?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-create">
    <div class="block-flat">
        <div class="header">
            <h3>
                <?= "<?= " ?>Html::encode($this->title) ?>
                <span class="pull-right">
                    <?= "<?= " ?>Html::a('列表', ['index'], ['class' => 'btn btn-primary btn-xs','data-original-title' => <?= $generator->generateString('查看' . $generator->modelName.'列表') ?>, 'data-toggle' => 'tooltip']) ?>
                </span>
            </h3>
        </div>
        <div class="content">
            <?= "<?= " ?>$this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
