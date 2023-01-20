<?php

namespace common\models;
use yii\helpers\FileHelper;

use Yii;

/**
 * This is the model class for table "{{%step}}".
 *
 * @property int $id
 * @property string $text
 * @property string $image
 * @property string|null $recipe_slug
 *
 * @property Recipe $recipeSlug
 */
class Step extends \yii\db\ActiveRecord
{
    /**
     * @var \yii\web\UploadedFile
     */
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%step}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text', 'image', 'recipe_slug'], 'string', 'max' => 512],
            [['recipe_slug'], 'exist', 'skipOnError' => true, 'targetClass' => Recipe::class, 'targetAttribute' => ['recipe_slug' => 'slug']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Текст',
            'image' => 'Изображение',
            'recipe_slug' => 'Recipe Slug',
        ];
    }

    /**
     * Gets query for [[RecipeSlug]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\RecipeQuery
     */
    public function getRecipeSlug()
    {
        return $this->hasOne(Recipe::class, ['slug' => 'recipe_slug']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\StepQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\StepQuery(get_called_class());
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->imageFile) {
            $imageName = $this->recipe_slug . '-step'. $this->id.'.' . $this->imageFile->extension;
        $this->image = $imageName;
        }
        

        if (!parent::save($runValidation, $attributeNames)) {
            return false;
        }

        if ($this->imageFile) {
            $imagePath = Yii::getAlias('@frontend/web/storage/images/' . $imageName);
             if (!is_dir(dirname($imagePath))) {
                FileHelper::createDirectory(dirname($imagePath));
             }
            $this->imageFile->saveAs($imagePath);
        }

        return true;
    }

    public function getImageLink() {
        return $this->image ? (Yii::$app->params['frontendUrl'] . 'storage/images/' . $this->image) : '';
    }

    public function afterDelete(){
        parent::afterDelete();

        $imagePath = Yii::getAlias('@frontend/web/storage/images/' . $this->image);
        if ($this->image && file_exists($imagePath)){
            unlink($imagePath);
        }
    }
}
