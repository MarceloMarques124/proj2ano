<?php

namespace frontend\controllers;

use Yii;
use common\models\Zone;
use yii\web\Controller;
use common\models\Table;
use yii\filters\VerbFilter;
use common\models\LoginForm;
use common\models\Reservation;
use yii\web\NotFoundHttpException;
use frontend\models\ReservationSearch;

/**
 * ReservationController implements the CRUD actions for Reservation model.
 */
class ReservationController extends Controller
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
            ]
        );
    }

    /**
     * Lists all Reservation models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ReservationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reservation model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Reservation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            }
            $model->password = '';

            return $this->render('@frontend/views/site/login', [
                'model' => $model,
            ]);
        }
        //comeco da criacao da reserva
        $model = new Reservation();
        //buscar o id quando o cliente clica no botao de reserve na pagina inicial
        $restaurantId = Yii::$app->request->get('restaurant_id');
        // o  user id de quem esta loggado
        $userId = Yii::$app->user->getId();
        // as zonas sao necessarias para o dropdown se o cliente quiser escolhe uma zona
        $zonas = Zone::find()->where(['restaurant_id' => $restaurantId])->all();

        if ($this->request->isPost) {
            // Verificar a zona escolhida
            $selectedZoneId = $this->request->post('Reservation')['zone_id'];
            // Obter a capacidade da zona do banco de dados
            $zone = Zone::findOne(['id' => $selectedZoneId]);
            $zoneCapacity = $zone ? $zone->capacity : 0;
            $table = Table::find()->one();
            $tablesCapacity = $table->capacity;
            $zoneTablesNumber = $zoneCapacity / $tablesCapacity;

            $reservationDateTime = $this->request->post('Reservation')['date_time'];
            // Verificar se há reservas nas duas horas anteriores/seguintes à hora escolhida
            $twoHoursEarlier = date('Y-m-d H:i:s', strtotime($reservationDateTime) - 2 * 60 * 60);
            $twoHoursLater = date('Y-m-d H:i:s', strtotime($reservationDateTime) + 2 * 60 * 60);

            $existingReservations = Reservation::find()
                ->where(['restaurant_id' => $restaurantId, 'zone_id' => $selectedZoneId])
                ->andWhere(['>', 'date_time', $twoHoursEarlier])
                ->andWhere(['<=', 'date_time', $twoHoursLater])
                ->all();
            $peopleNumber = $this->request->post('Reservation')['people_number'];
            $tablesNumber = ceil($peopleNumber / $tablesCapacity);



            if (!empty($existingReservations)) {
                // Há reservas nas duas horas anteriores/seguintes à hora escolhida
                $reservedTablesInZone = 0;
                foreach ($existingReservations as $existingReservation) {
                    $reservedTablesInZone += $existingReservation->tables_number;
                }
                // Calcular a disponibilidade de mesas
                $availableTablesInZone = $zoneTablesNumber - $reservedTablesInZone;

                if ($tablesNumber <= $availableTablesInZone) {
                    // Mesas suficientes estão disponíveis, continuar com a atualização
                    $model->restaurant_id = $restaurantId;
                    $model->user_id = $userId;
                    $model->tables_number = $tablesNumber;

                    if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } else {
                    // Mesas insuficientes, exiba uma mensagem de erro
                    Yii::$app->session->setFlash('error', 'Desculpe, não há mesas disponíveis na zona escolhida para a data e hora selecionadas.');
                }
            } else {
                if ($zoneTablesNumber >= $tablesNumber) {
                    $model->restaurant_id = $restaurantId;
                    $model->user_id = $userId;
                    $model->tables_number = $tablesNumber;

                    if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } else {
                    // Mesas insuficientes, exiba uma mensagem de erro
                    Yii::$app->session->setFlash('error', 'Desculpe, não há mesas disponíveis na zona escolhida para a data e hora selecionadas.');
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'zonas' => $zonas,
        ]);
    }

    /**
     * Updates an existing Reservation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Verificar se falta pelo menos 1 hora para a hora da reserva
        $currentDateTime = date('Y-m-d H:i:s');
        $reservationDateTime = $model->date_time;

        $oneHourLater = date('Y-m-d H:i:s', strtotime($currentDateTime) + 60 * 60);

        if ($currentDateTime >= $reservationDateTime) {
            Yii::$app->session->setFlash('error', 'Desculpe, a reserva não pode ser atualizada após o início da mesma.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($oneHourLater >= $reservationDateTime) {
            Yii::$app->session->setFlash('error', 'Desculpe, a reserva só pode ser atualizada até 1 hora antes da hora marcada.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        //buscar o id ao modelo(form)
        $restaurantId = $model->restaurant_id;
        // o  user id de quem esta loggado
        $userId = Yii::$app->user->getId();
        // as zonas sao necessarias para o dropdown se o cliente quiser escolhe uma zona
        $zonas = Zone::find()->where(['restaurant_id' => $restaurantId])->all();

        if ($this->request->isPost) {
            // Verificar a zona escolhida
            $selectedZoneId = $this->request->post('Reservation')['zone_id'];
            // Obter a capacidade da zona do banco de dados
            $zone = Zone::findOne(['id' => $selectedZoneId]);
            $zoneCapacity = $zone ? $zone->capacity : 0;

            $table = Table::find()->one();
            $tablesCapacity = $table->capacity;

            $zoneTablesNumber = $zoneCapacity / $tablesCapacity;


            // Verificar se há reservas nas duas horas anteriores à hora escolhida
            $twoHoursEarlier = date('Y-m-d H:i:s', strtotime($reservationDateTime) - 2 * 60 * 60);
            $twoHoursLater = date('Y-m-d H:i:s', strtotime($reservationDateTime) + 2 * 60 * 60);
            $existingReservations = Reservation::find()
                ->where(['restaurant_id' => $restaurantId, 'zone_id' => $selectedZoneId])
                ->andWhere(['>', 'date_time', $twoHoursEarlier])
                ->andWhere(['<=', 'date_time', $twoHoursLater])
                // Excluir a reserva atual da consulta
                ->andWhere(['!=', 'id', $model->id])
                ->all();
            $peopleNumber = $this->request->post('Reservation')['people_number'];
            $tablesNumber = ceil($peopleNumber / 4);

            if (!empty($existingReservations)) {
                // Há reservas nas duas horas anteriores à hora escolhida

                $reservedTablesInZone = 0;

                foreach ($existingReservations as $existingReservation) {
                    $reservedTablesInZone += $existingReservation->tables_number;
                }

                // Calcular a disponibilidade de mesas
                $availableTablesInZone = $zoneTablesNumber - $reservedTablesInZone;
                if ($tablesNumber <= $availableTablesInZone) {
                    // Mesas suficientes estão disponíveis, continuar com a atualização
                    $model->tables_number = $tablesNumber;

                    if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } else {
                    // Mesas insuficientes, exiba uma mensagem de erro
                    Yii::$app->session->setFlash('error', 'Desculpe, não há mesas disponíveis na zona escolhida para a data e hora selecionadas.');
                }
            } else {
                if ($zoneTablesNumber >= $tablesNumber) {
                    $model->tables_number = $tablesNumber;

                    if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } else {
                    // Mesas insuficientes, exiba uma mensagem de erro
                    Yii::$app->session->setFlash('error', 'Desculpe, não há mesas disponíveis na zona escolhida para a data e hora selecionadas.');
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
            'zonas' => $zonas,
        ]);
    }

    /**
     * Deletes an existing Reservation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Reservation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Reservation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reservation::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
