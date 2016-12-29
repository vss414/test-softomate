<?php

/* @var $this yii\web\View */

$this->title = 'Test project';
?>
<div class="site-index">

    <h1><?= \yii\bootstrap\Html::encode('List api methods') ?></h1>

    <?php
    $data = [
        ['url' => \yii\helpers\Url::to('api/v1/users/{token}', true), 'description' => 'List of users'],
        ['url' => \yii\helpers\Url::to('api/v1/merchants/{id}', true), 'description' => 'List of merchants'],
        ['url' => \yii\helpers\Url::to('api/v1/coupons/mid/{merchant_id}', true), 'description' => 'List of user coupons'],
        ['url' => \yii\helpers\Url::to('api/v1/coupons/uid/{user_id}', true), 'description' => 'List of merchant coupons'],
    ];
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $data,
    ]);
    echo \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'url',
                'format' => 'raw',
                'value' => function($item) {
                    return "<a href='{$item['url']}' target='_blank'>{$item['url']}</a>";
                }
            ],
            'description'
        ],
    ]); ?>
</div>
