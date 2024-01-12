<?php

namespace backend\modules\api\controllers;

use Yii;
use Mosquitto\Client;
use Bluerhinos\phpMQTT;
use yii\web\Controller;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class MenuController extends ActiveController
{
    public $modelClass = 'common\models\Menu';

    /**
     * Renders the index view for the module
     * @return string
     */

    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
     * Cria algo no backend e envia mensagens MQTT.
     * @return array
     */
    public function actionCreateSomething()
    {
        $model = new \common\models\Menu(); // Substitua pelo modelo apropriado

        // Lógica para criar algo no backend
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Envie mensagens MQTT
            $this->enviarMensagensMQTT($model->id);

            return ['status' => 'success', 'message' => 'Objeto criado com sucesso.'];
        } else {
            return ['status' => 'error', 'message' => 'Erro ao criar objeto.'];
        }
    }

    /**
     * Envia mensagens MQTT.
     * @param int $id ID do objeto criado
     */
    private function enviarMensagensMQTT($id)
    {
        $mqtt = new phpMQTT('localhost', 1883, 'ClientID'); // Substitua 'localhost', 1883 e 'ClientID' conforme necessário

        if ($mqtt->connect()) {
            // Construa a mensagem MQTT usando dados do objeto criado
            $mensagem = 'Novo menu criado com ID: ' . $id;

            Yii::info("Publicando mensagem no tópico 'INSERT': " . $mensagem);
            $mqtt->publish('INSERT', $mensagem, 1, false);
            

            $mqtt->close();
        }
    }
}
