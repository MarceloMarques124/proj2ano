package com.example.restmanager.Activities;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;

import com.example.restmanager.Listeners.ZonesListener;
import com.example.restmanager.Model.Zone;
import com.example.restmanager.R;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.databinding.ActivityReserveBinding;

import java.util.ArrayList;

public class ReserveActivity extends AppCompatActivity implements ZonesListener{
    //ZonesSpinnerAdapter zonesSpinnerAdapter;
    public final static String ID_REST = "ID_RESTAURANT";
    private ActivityReserveBinding binding;
    ArrayList<Zone> zones;
    ArrayAdapter<String> arrayAdapter;

    String items[];

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reserve);

        binding = ActivityReserveBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        int id = getIntent().getIntExtra(String.valueOf(ID_REST), 0);
        System.out.println("---> Id; " + id);

        SingletonRestaurantManager.getInstance(getApplicationContext()).setZonesListener(this);
        SingletonRestaurantManager.getInstance(getApplicationContext()).getZonesAPI(getApplicationContext(), id);

        binding.autoComplete.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                System.out.println("---> Position: "+ position);
                System.out.println("---> ID: "+ id);


            }
        });

    }

    @Override
    public void onRefreshZonesListener(ArrayList<Zone> zones) {

        this.zones = zones;

        for (Zone z : zones) {
            items = new String[]{z.getName()};
        }
        arrayAdapter = new ArrayAdapter<String>(this, R.layout.spiner_item);

        binding.autoComplete.setAdapter(arrayAdapter);
    }
}