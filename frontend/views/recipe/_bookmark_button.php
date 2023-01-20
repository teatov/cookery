<?php
/**
 * @var $model \common\models\recipe
 * @var yii\web\View $this
 */

use yii\helpers\Url;

?>

<a class="btn bg-green bookmark-btn" href="<?php echo Url::to(['recipe/bookmark', 'slug' => $model->slug]) ?>"
    data-method="post" data-pjax="1"><span class="icon icon--bookmark"></span>
    <?php echo $model->isBookmarkedBy(Yii::$app->user->id) ? "В закладках" : "В закладки" ?>
</a>