<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
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

    <div class="content">
        <header>
            <div class="logo-container">
                <span class="icon icon--logo"></span>
                <a href="<?php echo Yii::$app->params['frontendUrl'] ?>">
                    <?= Html::encode(Yii::$app->name) ?>
                </a>
            </div>

            <nav class="flex justify-center header-nav hidden"></nav>
            <form action="<?php echo Url::to([Yii::$app->params['frontendUrl'] . 'recipe/search']) ?>"
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