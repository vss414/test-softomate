<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MerchantCouponSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Merchant Coupons');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchant-coupon-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'merchant',
                'format' => 'raw',
                'value' => function ($model) {
                    /** @var \app\models\MerchantCoupon $model */
                    /** @var \app\models\Merchant $merchant */
                    $merchant = $model->getMerchant()->one();

                    return $merchant->name;
                },
            ],
            'title',
            'code',
        ],
    ]); ?>
</div>
