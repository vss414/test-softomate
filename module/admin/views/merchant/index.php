<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MerchantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Merchants');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchant-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'description:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{delete}',
            ],
        ],
    ]); ?>
</div>
