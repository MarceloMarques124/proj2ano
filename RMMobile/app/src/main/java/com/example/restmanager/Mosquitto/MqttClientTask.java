package com.example.restmanager.Mosquitto;
import android.os.AsyncTask;
import org.eclipse.paho.client.mqttv3.IMqttDeliveryToken;
import org.eclipse.paho.client.mqttv3.MqttCallback;
import org.eclipse.paho.client.mqttv3.MqttClient;
import org.eclipse.paho.client.mqttv3.MqttConnectOptions;
import org.eclipse.paho.client.mqttv3.MqttMessage;
import android.os.Handler;
import android.os.Message;
import android.widget.TextView;

import com.example.restmanager.Activities.OrdersActivity;
import com.example.restmanager.R;

public class MqttClientTask extends AsyncTask<Void, Void, Void> implements MqttCallback {

    private static final String BROKER = "tcp://192.168.1.105:1883";
    private static final String TOPIC = "INSERT";
    private static final String CLIENT_ID = "AndroidClient";

    private OrdersActivity ordersActivity;



    private MqttClient mqttClient;
    private Handler mHandler;
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

        if (ordersActivity != null) {
            ordersActivity.updateUI(payload); // Atualiza a interface do usuário na sua Activity
        }

        // Agora você pode usar o payload recebido na sua aplicação Android.
    }

    @Override
    public void deliveryComplete(IMqttDeliveryToken token) {
        // Implemente a lógica para lidar com a entrega completa
    }

    public void setOrdersActivity(OrdersActivity ordersActivity) {
        this.ordersActivity = ordersActivity;
    }
}