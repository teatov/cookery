<?php

namespace backend\controllers;

use common\models\Recipe;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\RecipeForm;
use common\models\Bookmark;

/**
 * RecipeController implements the CRUD actions for Recipe model.
 */
class RecipeController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }

    /**
     * Lists all Recipe models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $recipeDataProvider = new ActiveDataProvider([
            'query' => Recipe::find()->byUser(Yii::$app->user->id),
        ]);

        $bookmarkDataProvider = new ActiveDataProvider([
            'query' => Bookmark::find()->andWhere(['user_id' => Yii::$app->user->id]),
        ]);

        return $this->render('index', [
            'recipeDataProvider' => $recipeDataProvider,
            'bookmarkDataProvider' => $bookmarkDataProvider,
        ]);
    }

    /**
     * Displays a single Recipe model.
     * @param string $slug Slug
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($slug)
    {
        // return $this->render('view', [
        //     'model' => $this->findModel($slug),
        // ]);
        // return $this->redirect([Yii::$app->params['frontendUrl'].'recipe/view', 'slug' => $slug]);
        return $this->redirect(Yii::$app->urlManagerFrontend->createUrl(['recipe/view', 'slug' => $slug]));
    }

    /**
     * Creates a new Recipe model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Recipe();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['update', 'slug' => $model->slug]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Recipe model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $slug Slug
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($slug)
    {
        $model = new RecipeForm();
        $model->recipe = $this->findModel($slug);
        $model->setAttributes(Yii::$app->request->post());

        $model->recipe->imageFile = UploadedFile::getInstanceByName('recipe-image');

        $index = 0;
        foreach ($model->steps as $key => $step) {
            if (isset(UploadedFile::getInstancesByName('Steps')[$index])) {
                $step->imageFile = UploadedFile::getInstancesByName('Steps')[$index];
            }
            $index++;
        }

        if ($this->request->isPost && $model->save()) {
            return $this->redirect(['view', 'slug' => $model->recipe->slug]);
        }
        // return $this->render('update', ['model' => $model->recipe, 'files' => UploadedFile::getInstancesByName('Steps')]);
        return $this->render('update', ['model' => $model->recipe]);
    }

    /**
     * Deletes an existing Recipe model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $slug Slug
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($slug)
    {
        $this->findModel($slug)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Recipe model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $slug Slug
     * @return Recipe the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($slug)
    {
        if (($model = Recipe::findOne(['slug' => $slug])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}