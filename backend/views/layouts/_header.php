
    <?php

    use yii\bootstrap4\Nav;
    use yii\bootstrap4\NavBar;
    use yii\helpers\Html;

    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,

    ]);
    $menuItems = [
        ['label' => 'Create', 'url' => ['/video/create']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => 'logout ('.yii::$app->user->identity->username.')',
            'url' => ['/site/logout'],
            'linkOptions' => [
                'data-method' => 'post'
            ]
        ];

    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
        ]);
        NavBar::end();
    ?>