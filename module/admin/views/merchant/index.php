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

    <p>
        <?= Html::a(Yii::t('app', 'Delete all'), ['delete-all'], [
            'class' => 'btn btn-danger',
            'data-confirm' => Yii::t('app', 'Are you sure you want to delete all items?'),
        ]) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'description:ntext',
            [
                'attribute' => 'merchantCoupons',
                'format' => 'raw',
                'value' => function ($model) {
                    $response = '';

                    /** @var \app\models\Merchant $model */
                    /** @var \app\models\MerchantCoupon $item */
                    foreach ($model->merchantCoupons as $item) {
                        $response .= "$item->title<br>";
                    }

                    return $response;
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{delete}',
            ],
        ],
    ]); ?>
</div>
