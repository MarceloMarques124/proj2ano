<?php

namespace backend\modules\api\controllers;

use app\mosquitto\phpMQTT as MosquittoPhpMQTT;
use Yii;
use Mosquitto\Client;
use Bluerhinos\phpMQTT;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;
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
        $model = new \common\models\Menu(); 
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
        $mqtt = new phpMQTT('127.0.0.1', 1883, 'AndroidClient'); // Substitua 'localhost', 1883 e 'ClientID' conforme necessário

        if ($mqtt->connect()) {
            // Construa a mensagem MQTT usando dados do objeto criado
            $mensagem = 'Novo menu criado com ID: ' . $id;
            $mqtt->publish('INSERT', $mensagem, 0, false);
            $mqtt->close();
        }
    }
}
