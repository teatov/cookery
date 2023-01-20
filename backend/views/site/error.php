<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use yii\helpers\Html;

$this->title = 'Ошибочка вышла';
?>
<section>
        <div class="flex justify-center flex-column align-center fullscreen">
            <p>Оказия...</p>
            <div class="card bg-orange flex flex-column">
                <h1><?= Html::encode($name) ?></h1>
                
        </div>
        <h2><?= nl2br(Html::encode($message)) ?></h2>
        </div>
      </section>