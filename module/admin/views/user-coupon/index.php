<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserCouponSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Coupons');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-coupon-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user',
                'format' => 'raw',
                'value' => function ($model) {
                    /** @var \app\models\UserCoupon $model */
                    /** @var \app\models\User $user */
                    $user = $model->getUser()->one();

                    return $user->name;
                },
            ],
            'title',
            'code'
        ],
    ]); ?>
</div>
