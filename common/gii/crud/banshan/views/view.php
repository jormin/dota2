<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator doc\gii\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString($generator->modelName) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="col-md-12 <?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">
    <div class="block-flat">
        <div class="header">
            <h3>
                <?= "<?= " ?>Html::encode($this->title) ?>
                <span class="pull-right">
                    <?= "<?= " ?>Html::a(<?= $generator->generateString('列表') ?>, ['index', <?= $urlParams ?>], ['class' => 'btn btn-primary btn-xs', 'data-original-title' => "查看列表", 'data-toggle' => "tooltip"]) ?>
                    <?= "<?= " ?>Html::a(<?= $generator->generateString('编辑') ?>, ['update', <?= $urlParams ?>], ['class' => 'btn btn-primary btn-xs','data-original-title' => "编辑数据", 'data-toggle' => "tooltip"]) ?>
                    <?= "<?= " ?>Html::a(<?= $generator->generateString('删除') ?>, ['delete', <?= $urlParams ?>], [
                        'class' => 'btn btn-danger btn-xs btn-delete',
                        'data-original-title' => "删除数据", 'data-toggle' => "tooltip",
                        'data' => [
                            'confirm' => <?= $generator->generateString('确定删除这条数据吗?') ?>,
                            'method' => 'post',
                        ],
                    ]) ?>
                </span>
            </h3>
        </div>
        <div class="content">
            <?= "<?= " ?>
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        <?php
                            if (($tableSchema = $generator->getTableSchema()) === false) {
                                foreach ($generator->getColumnNames() as $name) {
                                    echo "            '" . $name . "',\n";
                                }
                            } else {
                                foreach ($generator->getTableSchema()->columns as $column) {
                                    $format = $generator->generateColumnFormat($column);
                                    echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                }
                            }
                        ?>
                    ],
                ])
            ?>
        </div>
    </div>
</div>
