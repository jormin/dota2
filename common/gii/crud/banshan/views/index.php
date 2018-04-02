<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator doc\gii\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString($generator->modelName) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12 <?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">
    <div class="block-flat">
        <div class="header">
            <h3>
                <?= "<?= " ?>Html::encode($this->title) ?>
                <?php if(!empty($generator->searchModelClass)): ?>
                    <?= "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
                <?php endif; ?>
                <span class="pull-right">
                    <?= "<?= " ?>Html::a(<?= $generator->generateString('新建'.$generator->modelName) ?>, ['create'], ['class' => 'btn btn-success']) ?>
                </span>
            </h3>

        </div>
        <div class="content">
            <div class="table-responsive">
                <div class="row">
                    <div class="col-md-12">
                        <?= $generator->enablePjax ? '<?php Pjax::begin(); ?>' : '' ?>
                        <?php if ($generator->indexWidgetType === 'grid'): ?>
                            <?= "<?= " ?>GridView::widget([
                            'dataProvider' => $dataProvider,
                            <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n        'columns' => [\n" : "'columns' => [\n"; ?>
                            ['class' => 'yii\grid\SerialColumn'],

                            <?php
                            $count = 0;
                            if (($tableSchema = $generator->getTableSchema()) === false) {
                                foreach ($generator->getColumnNames() as $name) {
                                    if (++$count < 6) {
                                        echo "            '" . $name . "',\n";
                                    } else {
                                        echo "            // '" . $name . "',\n";
                                    }
                                }
                            } else {
                                foreach ($tableSchema->columns as $column) {
                                    $format = $generator->generateColumnFormat($column);
                                    if (++$count < 6) {
                                        echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                    } else {
                                        echo "            // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                    }
                                }
                            }
                            ?>

                            ['class' => 'doc\components\ActionColumn'],
                            ],
                            ]); ?>
                        <?php else: ?>
                            <?= "<?= " ?>ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemOptions' => ['class' => 'item'],
                            'itemView' => function ($model, $key, $index, $widget) {
                            return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
                            },
                            ]) ?>
                        <?php endif; ?>
                        <?= $generator->enablePjax ? '<?php Pjax::end(); ?>' : '' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
