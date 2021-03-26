<?php

namespace backend\controllers;

use common\models\DessertsIngredients;
use Yii;
use common\models\Desserts;
use common\models\db\DessertsSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DessertsController implements the CRUD actions for Desserts model.
 */
class DessertsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Desserts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DessertsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Desserts model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Desserts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Desserts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (isset(Yii::$app->request->post()['Desserts']['ingredients'])
                && is_array(Yii::$app->request->post()['Desserts']['ingredients'])
                && !empty(Yii::$app->request->post()['Desserts']['ingredients'])) {
                $ingredientToSave = Yii::$app->request->post()['Desserts']['ingredients'];
                foreach ($ingredientToSave as $ingredientId) {
                    $modelI = new DessertsIngredients();
                    $modelI->ingredient_id =  $ingredientId;
                    $modelI->dessert_id =  $model->id;
                    $modelI->created_at = date('Y-m-d H:i:s');
                    $modelI->updated_at = date('Y-m-d H:i:s');

                    if (!$modelI->save()) {
                        echo 'Error linking ingredient - dessert';
                    }
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    protected function checkIngredientAlreadyPresent($ingredientId, $dessertId)
    {
        return $this->findDessertIngredientModel($ingredientId, $dessertId);
    }

    protected function getAllIngredientsByDessert($id)
    {
        return $this->findAllDessertIngredients($id);
    }

    /**
     * Updates an existing Desserts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (isset(Yii::$app->request->post()['Desserts']['ingredients'])
                && is_array(Yii::$app->request->post()['Desserts']['ingredients'])
                && !empty(Yii::$app->request->post()['Desserts']['ingredients'])) {
                $allSavedIngredients = $this->getAllIngredientsByDessert($id);
                $ingredientToSave = Yii::$app->request->post()['Desserts']['ingredients'];
                foreach ($ingredientToSave as $ingredientId) {
                    $ingredientExist = $this->checkIngredientAlreadyPresent($ingredientId, $id);
                    if (!$ingredientExist) {
                        $modelI = new DessertsIngredients();
                        $modelI->ingredient_id =  $ingredientId;
                        $modelI->dessert_id =  $id;
                        $modelI->created_at = date('Y-m-d H:i:s');
                        $modelI->updated_at = date('Y-m-d H:i:s');

                        if (!$modelI->save()) {
                            echo 'Error linking ingredient - dessert';
                        }
                    }
                }

                $arrayDiff = array_diff($allSavedIngredients,$ingredientToSave);

                if (!empty($arrayDiff)) {
                    foreach ($arrayDiff as $idToDelete) {
                        $modelIDel = $this->findDessertIngredientModel($idToDelete, $id);
                        if ($modelIDel) {
                            $modelIDel->deleted_at = date('Y-m-d H:i:s');

                            if (!$modelIDel->save()) {
                                echo 'Error deleting ingredient - dessert';
                            }
                        }
                    }
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Desserts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->deleted_at = date('Y-m-d H:i:s');
        if (!$model->save())
        {
            echo 'Error deleting ingredient';
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Desserts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Desserts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Desserts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function findDessertIngredientModel($ingredientId, $dessertId)
    {
        if (($model = DessertsIngredients::findOne(['deleted_at' => null, 'dessert_id' => $dessertId, 'ingredient_id' => $ingredientId])) !== null) {
            return $model;
        }

        return null;
    }

    protected function findAllDessertIngredients($id)
    {
        return ArrayHelper::getColumn(DessertsIngredients::find()
            ->select('ingredient_id')
            ->where(['deleted_at' => null])
            ->andWhere(['dessert_id' => $id])
            ->asArray()->all(),
            function($element) {
                return intval($element['ingredient_id']);
            });
    }
}
