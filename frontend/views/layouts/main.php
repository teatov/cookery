<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <!-- <header>
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
            ],
        ]);
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        } ?>

        <form action="<?php echo Url::to(['/recipe/search']) ?>" class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Поиск..." name="keyword"
                value="<?php echo Yii::$app->request->get('keyword') ?>" />
            <button class="btn btn-outline-success">Search</button>
        </form>

        <?php

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
            'items' => $menuItems,
        ]);
        if (Yii::$app->user->isGuest) {
            echo Html::tag('div', Html::a('Login', ['/site/login'], ['class' => ['btn btn-link login text-decoration-none']]), ['class' => ['d-flex']]);
        } else {
            echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout text-decoration-none']
                )
                . Html::endForm();
        }
        NavBar::end();
        ?>
    </header> -->

    <div class="content">
        <header>
            <div class="logo-container">
                <span class="icon icon--logo"></span>
                <a href="<?php echo Yii::$app->params['frontendUrl'] ?>">
                <?= Html::encode(Yii::$app->name) ?>
                </a>
            </div>

            <nav class="flex justify-center header-nav hidden"></nav>
            <form action="<?php echo Yii::$app->params['frontendUrl'] . 'recipe/search' ?>"
                class="input-group search-header">
                <input type="search" placeholder="Поиск..." name="keyword"
                    value="<?php echo Yii::$app->request->get('keyword') ?>" />
                <button class="bg-orange"><span class="icon icon--search"></span></button>
            </form>
            <div class="flex">
                <?php if (!Yii::$app->user->isGuest): ?>
                    <a href="<?php echo Yii::$app->params['backendUrl'] ?>recipe/index" class="btn bg-yellow"><span
                            class="icon icon--user"></span></a>
                    <a href="<?php echo Yii::$app->params['backendUrl'] ?>recipe/create" class="btn bg-green"><span
                            class="icon icon--plus"></span>Создать</a>
                            <a href="/site/logout" data-method="post" class="btn bg-orange"><span
                            class="icon icon--difficulty"></span>Выйти</a>
                <?php else: ?>
                    <a href="/site/login" class="btn bg-yellow"><span
                            class="icon icon--user"></span>Войти</a>
                <?php endif; ?>
            </div>
            </nav>
            <button class="btn bg-yellow hamburger-menu">
                <span class="icon icon--menu"></span>
            </button>
        </header>

        <main role="main">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </main>
    </div>

    <footer>
        <p>&copy; <?= Html::encode(Yii::$app->name) ?>
            <?= date('Y') ?>
        </p>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();