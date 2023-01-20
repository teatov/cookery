<?php

namespace frontend\controllers;

use common\models\Bookmark;
use common\models\Recipe;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class RecipeController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['bookmark'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verb' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'bookmark' => ['post']
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Recipe::find()->with('createdBy')->published()->latest()
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($slug)
    {
        $recipe = Recipe::findOne($slug);
        if (!$recipe) {
            throw new NotFoundHttpException("Такого рецепта нет");
        }

        $similarRecipes = Recipe::find()->published()->andWhere(['NOT', ['slug' => $slug]])->andWhere(['dish_category' => $recipe->dish_category])->limit(3)->all();

        return $this->render('view', [
            'model' => $recipe,
            'similarRecipes' => $similarRecipes
        ]);
    }

    public function actionBookmark($slug)
    {
        $bookmark = Bookmark::find()->userIdRecipeSlug(Yii::$app->user->id, $slug);

        if (!$bookmark) {
            $bookmark = new Bookmark();
            $bookmark->recipe_slug = $slug;
            $bookmark->user_id = Yii::$app->user->id;
            $bookmark->save();
        } else {
            $bookmark->delete();
        }

        $recipe = Recipe::findOne($slug);

        return $this->renderAjax('_bookmark_button', [
            'model' => $recipe
        ]);
    }

    public function actionSearch($keyword)
    {
        $this->layout = 'main';
        $query = Recipe::find()
            ->with('createdBy')
            ->published()
            ->latest();
        if ($keyword) {
            $sql = Yii::$app->db->createCommand("MATCH(name, description, tags)
            AGAINST (:keyword) DESC", ['keyword' => $keyword]);
            $query->byKeyword($keyword)->orderBy($sql->getSql());
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('search', [
            'dataProvider' => $dataProvider
        ]);
    }
}