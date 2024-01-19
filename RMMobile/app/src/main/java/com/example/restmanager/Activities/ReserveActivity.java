package com.example.restmanager.Activities;

import androidx.appcompat.app.AppCompatActivity;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Toast;

import com.example.restmanager.Listeners.ZonesListener;
import com.example.restmanager.Model.Zone;
import com.example.restmanager.R;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.databinding.ActivityLoginBinding;
import com.example.restmanager.databinding.ActivityReserveBinding;
import com.google.android.material.datepicker.MaterialDatePicker;
import com.google.android.material.datepicker.MaterialPickerOnPositiveButtonClickListener;
import com.google.android.material.timepicker.MaterialTimePicker;
import com.google.android.material.timepicker.TimeFormat;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;

public class ReserveActivity extends AppCompatActivity implements ZonesListener{
    public final static String ID_REST = "ID_RESTAURANT";
    private ActivityReserveBinding binding;
    ArrayList<Zone> zones;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reserve);

        binding = ActivityReserveBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());


        int id = getIntent().getIntExtra(String.valueOf(ID_REST), 0);
        System.out.println("---> Id; " + id);


        SingletonRestaurantManager.getInstance(getApplicationContext()).setZonesListener(this);
        //SingletonRestaurantManager.getInstance(getApplicationContext()).getZonesAPI(getApplicationContext(), id);

        loadZones(id);

        binding.pickDate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                MaterialDatePicker picker = MaterialDatePicker.Builder
                        .datePicker()
                        .setSelection(MaterialDatePicker.todayInUtcMilliseconds())
                        .build();

                picker.show(getSupportFragmentManager(), "tag");


                picker.addOnPositiveButtonClickListener(new MaterialPickerOnPositiveButtonClickListener() {
                    @Override
                    public void onPositiveButtonClick(Object selection) {
                        binding.pickDate.setText(new SimpleDateFormat("dd/MM/yyyy").format(picker.getSelection()));
                    }});
            }
        });

        binding.pickTime.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                MaterialTimePicker picker = new MaterialTimePicker.Builder()
                        .setTimeFormat(TimeFormat.CLOCK_24H)
                        .build();

                picker.show(getSupportFragmentManager(), "tag");

                picker.addOnPositiveButtonClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        picker.setMinute(0000);
                        binding.pickTime.setText(picker.getHour() + ":" + picker.getMinute() + ":00");
                    }
                });

            }
        });

        binding.btnSelectZone.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //
            }
        });
    }

    private void loadZones(int restaurantId) {
        SingletonRestaurantManager.getInstance(getApplicationContext()).getZonesAPI(getApplicationContext(), restaurantId);
    }

    @Override
    public void onRefreshZonesListener(ArrayList<Zone> zones) {
        this.zones = zones;

        System.out.println("---> Zones: " + zones);
    }
}