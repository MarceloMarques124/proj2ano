package com.example.restmanager.Mosquitto;
import android.os.AsyncTask;
import org.eclipse.paho.client.mqttv3.IMqttDeliveryToken;
import org.eclipse.paho.client.mqttv3.MqttCallback;
import org.eclipse.paho.client.mqttv3.MqttClient;
import org.eclipse.paho.client.mqttv3.MqttConnectOptions;
import org.eclipse.paho.client.mqttv3.MqttMessage;

public class MqttClientTask extends AsyncTask<Void, Void, Void> implements MqttCallback {

    private static final String BROKER = "tcp://172.22.21.221:1883";
    private static final String TOPIC = "INSERT";
    private static final String CLIENT_ID = "AndroidClient";

    private MqttClient mqttClient;

    @Override
    protected Void doInBackground(Void... voids) {
        try {
            mqttClient = new MqttClient(BROKER, CLIENT_ID);
            mqttClient.setCallback(this);

            MqttConnectOptions options = new MqttConnectOptions();
            options.setCleanSession(true);

            mqttClient.connect(options);
            mqttClient.subscribe(TOPIC);

        } catch (Exception e) {
            e.printStackTrace();
        }
        return null;
    }

    @Override
    public void connectionLost(Throwable cause) {
        // Implemente a lógica para lidar com a perda de conexão
    }

    @Override
    public void messageArrived(String topic, MqttMessage message) throws Exception {
        // A mensagem MQTT chegou. Implemente a lógica para lidar com a mensagem.
        String payload = new String(message.getPayload());
        // Agora você pode usar o payload recebido na sua aplicação Android.
    }

    @Override
    public void deliveryComplete(IMqttDeliveryToken token) {
        // Implemente a lógica para lidar com a entrega completa
    }
}