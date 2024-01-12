package com.example.restmanager.Activities;

import androidx.appcompat.app.AppCompatActivity;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Toast;
import android.widget.TextView;

import com.example.restmanager.Adapters.MenusAdapter;
import com.example.restmanager.Listeners.MenusListener;
import com.example.restmanager.Model.Menu;
import com.example.restmanager.Mosquitto.MqttClientTask;
import com.example.restmanager.R;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.databinding.ActivityOrdersBinding;

import java.util.ArrayList;

public class OrdersActivity extends AppCompatActivity implements MenusListener {
    public final static String ID_REST = "ID_RESTAURANT";

    private ActivityOrdersBinding binding;
    private ArrayList<Menu> menus;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_orders);

        MqttClientTask mqttClientTask = new MqttClientTask();

        mqttClientTask.execute();

        binding = ActivityOrdersBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        int id = getIntent().getIntExtra(ID_REST, 0);
        SingletonRestaurantManager.getInstance(getApplicationContext()).setMenusListener(this);
        SingletonRestaurantManager.getInstance(getApplicationContext()).getMenusAPI(this);

        binding.lvMenus.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent intent = new Intent(getApplicationContext(), ServerConnectionActivity.class);
                startActivity(intent);
            }
        });
    }

    @Override
    public void onRefreshMenusList(ArrayList<Menu> menus) {
        if (menus != null){
            binding.lvMenus.setAdapter(new MenusAdapter(getApplicationContext(), menus));
        }
    }

    public void updateUI(String payload) {
        runOnUiThread(new Runnable() {
            @Override
            public void run() {
                TextView seuTextView = findViewById(R.id.textView44);
                seuTextView.setText(payload);
            }
        });
    }
}