<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "{{%recipe}}".
 *
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property int|null $created_by
 * @property int $dish_category
 * @property string|null $image
 * @property string $cooking_time
 * @property string $servings
 * @property string $difficulty
 * @property int|null $created_at
 * @property string|null $tags
 * @property int|null $status
 *
 * @property User $createdBy
 * @property DishCategory $dishCategory
 * @property Ingredient[] $ingredients
 * @property Step[] $steps
 */
class Recipe extends \yii\db\ActiveRecord
{
    const STATUS_UNLISTED = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * @var \yii\web\UploadedFile
     */
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%recipe}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['created_by', 'dish_category', 'created_at', 'status'], 'integer'],
            [['name', 'slug', 'image', 'tags'], 'string', 'max' => 512],
            [['cooking_time', 'servings', 'difficulty'], 'string', 'max' => 32],
            [['name'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['dish_category'], 'exist', 'skipOnError' => true, 'targetClass' => DishCategory::class, 'targetAttribute' => ['dish_category' => 'id']],
            ['status', 'default', 'value' => self::STATUS_UNLISTED]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'slug' => 'Slug',
            'description' => 'Описание',
            'created_by' => 'Автор',
            'dish_category' => 'Категория',
            'image' => 'Изображение',
            'cooking_time' => 'Время готовки',
            'servings' => 'Количество порций',
            'difficulty' => 'Сложность',
            'created_at' => 'Дата создания',
            'tags' => 'Ключевые слова',
            'status' => 'Статус',
        ];
    }

    public function getStatusLabels()
    {
        return [
            self::STATUS_UNLISTED => 'Скрыт',
            self::STATUS_PUBLISHED => 'Опубликован'
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[DishCategory]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\DishCategoryQuery
     */
    public function getDishCategory()
    {
        return $this->hasOne(DishCategory::class, ['id' => 'dish_category']);
    }

    /**
     * Gets query for [[Ingredients]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\IngredientQuery
     */
    public function getIngredients()
    {
        return $this->hasMany(Ingredient::class, ['recipe_slug' => 'slug']);
    }

    /**
     * Gets query for [[Steps]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\StepQuery
     */
    public function getSteps()
    {
        return $this->hasMany(Step::class, ['recipe_slug' => 'slug']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CommentQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['recipe_slug' => 'slug']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\RecipeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RecipeQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false
            ],
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false
            ],
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',
                'ensureUnique' => true,
                'immutable' => true
                // 'slugAttribute' => 'slug',
            ],
        ];
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->imageFile) {
            $imageName = $this->slug . '-image.' . $this->imageFile->extension;
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

    public function getImageLink()
    {
        return $this->image ? (Yii::$app->params['frontendUrl'] . 'storage/images/' . $this->image) : '';
    }

    public function afterDelete()
    {
        parent::afterDelete();

        $imagePath = Yii::getAlias('@frontend/web/storage/images/' . $this->image);
        if ($this->image && file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    public function isBookmarkedBy($userId)
    {
        return Bookmark::find()->userIdRecipeSlug($userId, $this->slug);
    }
}