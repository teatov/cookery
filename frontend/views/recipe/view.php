<?php
/**
 * @var $model \common\models\recipe
 * @var $similarRecipes \common\models\recipe[]
 * @var yii\web\View $this
 */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Рецепты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>

<section>
        <div class="flex justify-flex-start flex-responsive">
        <?php if ($model->getImageLink()): ?>
          <img class="main-image modal-image" crossorigin="anonymous" src="<?php echo $model->getImageLink() ?>" alt="" />
          <?php endif; ?>
          <div class="flex flex-column">
            <h1><?= Html::encode($model->name) ?></h1>
            <p>
            <?= nl2br(Html::encode($model->description)) ?>
            </p>
          </div>
        </div>
      </section>

<p> Автор -
    <?= Html::encode($model->createdBy->username) ?> |
    <?php echo date('d.m.Y H:i', $model->created_at) ?>
</p>

<section>
        <div class="flex justify-space-between align-flex-start flex-responsive">
          <ul class="card ingredients">
            <h2>ИНГРЕДИЕНТЫ:</h2>
            <?php foreach ($model->ingredients as $ingredient): ?>
              <li>
                <p><?= Html::encode($ingredient->name) ?></p>
                <span class="divider"></span>
                <p><?= Html::encode($ingredient->amount) ?></p>
              </li>
            <?php endforeach; ?>
          </ul>
          <div class="flex flex-column align-flex-start recipe-properties">
            <div class="card bg-green flex flex-column align-flex-end">
              <div class="flex align-center">
                  <span class="icon icon--time"></span>
                  <h3>Время готовки:</h3>
              </div>
              <h2><?= Html::encode($model->cooking_time) ?></h2>
            </div>
            <div class="card bg-yellow flex flex-column align-flex-end">
              <div class="flex align-center">
                  <span class="icon icon--servings"></span>
                  <h3>Количество порций:</h3>
              </div>
              <h2><?= Html::encode($model->servings) ?></h2>
            </div>
            <div class="card bg-orange flex flex-column align-flex-end">
              <div class="flex align-center">
                  <span class="icon icon--difficulty"></span>
                  <h3>Сложность:</h3>
              </div>
              <h2><?= Html::encode($model->difficulty) ?></h2>
            </div>
          </div>
        </div>
      </section>

<section>
        <ul class="list-narrow">
          <h2>ПОШАГОВЫЙ РЕЦЕПТ:</h2>
          <?php 
          $index = 1;
          foreach ($model->steps as $step): ?>
          <li class="flex flex-responsive">
          <?php if ($step->getImageLink()): ?>
            <img
              class="recipe-step-image modal-image"
              crossorigin="anonymous"
              src="<?php echo $step->getImageLink() ?>"
              alt=""
            />
            <?php endif; ?>
            <div class="flex flex-column flex-grow">
              <h2>ШАГ <?php echo $index ?>:</h2>
              <div class="card flex-grow">
                <p>
                <?= nl2br(Html::encode($step->text)) ?>
                </p>
              </div>
            </div>
          </li>
          <?php $index++; endforeach; ?>
          <h2 class="appetit">Приятного аппетита!</h2>
        </ul>
      </section>

      <section>
        <h3>КЛЮЧЕВЫЕ СЛОВА:</h3>
        <ul class="tags">
        <?php foreach (explode(',',$model->tags) as $tag): ?>
          <li><a href=""><?= Html::encode($tag) ?></a></li>
          <?php endforeach; ?>
        </ul>
        <div class="flex justify-space-between flex-responsive">
          <div class="flex u-justify-center buttons-responsive">
            <a class="btn bg-yellow share-btn"
              ><span class="icon icon--share "></span>Поделиться</a
            >
          </div>
          <div class="flex u-justify-center buttons-responsive">
            <?php Pjax::begin() ?>
              <?php echo $this->render('_bookmark_button', [
                  'model' => $model
              ]) ?>
            <?php Pjax::end() ?>
            <a class="btn bg-yellow print-btn"
              ><span class="icon icon--print"></span>Распечатать</a
            >
          </div>
        </div>
        <div class="divider"></div>
      </section>

      <section>
        <ul class="list-narrow">
          <h2><?php echo count($model->comments) > 0 ? 'КОММЕНТАРИИ' : 'КОММЕНТАРИЕВ НЕТ...' ?></h2>
          <?php foreach ($model->comments as $comment): ?>
          <li class="flex justify-space-between">
            <div class="card flex-grow">
              <div class="flex align-center justify-flex-start">
                <img src="<%= comment.user?.photo %>" crossorigin="anonymous" alt="" class="avatar" />
                <h2><?= Html::encode($comment->createdBy->username) ?></h2>
                <h3><?php echo date('d.m.Y H:i', $comment->created_at) ?></h3>
              </div>
              <p>
              <?= nl2br(Html::encode($comment->text)) ?>
              </p>
            </div>
          </li>
          <?php endforeach; ?>
          <?php if (Yii::$app->user->isGuest) : ?>
            <div class="divider"></div>
            <h2>НАПИСАТЬ КОММЕНТАРИЙ:</h2>
            <form data-recipe="<%= recipe.slug %>" class="send-comment flex flex-column">
              <textarea
                class="comment-text"
                rows="5"
              ></textarea>
            <div class="flex justify-flex-end">
              <button type="submit" class="bg-green"><span class="icon icon--comment"></span>Отправить комментарий</button>
            </div>
            </form>
            <?php endif; ?>
        </ul>
        <div class="divider"></div>
      </section>

      <section>
        <ul class="list-narrow">
        <?php if (count($similarRecipes) > 0) : ?>
            <h2>ПОХОЖИЕ РЕЦЕПТЫ:</h2>
            <?php foreach ($similarRecipes as $similarRecipe): ?>
              <li class="flex justify-space-between flex-responsive">
              <?php echo $this->render('_recipe_item', [
                  'model' => $similarRecipe
              ]) ?>
              </li>
              <?php endforeach; ?>
              <div class="divider"></div>
              <?php endif; ?>
        </ul>
      </section>