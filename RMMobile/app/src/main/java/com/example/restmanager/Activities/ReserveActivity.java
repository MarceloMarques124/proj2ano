package com.example.restmanager.Activities;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.RadioButton;
import android.widget.RadioGroup;

import com.example.restmanager.Listeners.ZonesListener;
import com.example.restmanager.Model.Reserve;
import com.example.restmanager.Model.User;
import com.example.restmanager.Model.Zone;
import com.example.restmanager.R;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.Utils.Public;
import com.example.restmanager.databinding.ActivityReserveBinding;
import com.google.android.material.datepicker.MaterialDatePicker;
import com.google.android.material.datepicker.MaterialPickerOnPositiveButtonClickListener;
import com.google.android.material.timepicker.MaterialTimePicker;
import com.google.android.material.timepicker.TimeFormat;

import java.text.SimpleDateFormat;
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
        binding.radioZones.setOnCheckedChangeListener(new RadioGroup.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(RadioGroup group, int checkedId) {
                // Handle RadioButton selection here
                RadioButton selectedRadioButton = findViewById(checkedId);
                if (selectedRadioButton != null) {
                    String selectedOption = selectedRadioButton.getText().toString();
                    // Do something with the selected option

                    System.out.println("---> CheckedId: "+ checkedId + " | " +selectedRadioButton.getText().toString());
                }
            }
        });

        binding.fabFinish.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                SharedPreferences sharedPreferences = getApplicationContext().getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
                User u = SingletonRestaurantManager.getInstance(getApplicationContext()).getUserBD(sharedPreferences.getString(Public.TOKEN, "55"));
                int people = Integer.parseInt(binding.etnPeopleNumber.getText()+"");
                String time = binding.pickTime.toString();
                String date = binding.pickDate.toString();
                int idzone = binding.radioZones.getCheckedRadioButtonId();
                String remark = "Comidaa";
                //id pedido a cima é rest

                Reserve r = new Reserve(0, u.getName(), date, time, remark, idzone, id, 0);

                startActivity(new Intent(getApplicationContext(),MainActivity.class));
            }
        });
    }

    @Override
    public void onRefreshZonesListener(ArrayList<Zone> zones) {

        this.zones = zones;
        /*String[] x = {"Esplanada", "Dentro", "Fora", "Café", "Restaurante"};
        for(int i = 0; i<x.length; i++){
            RadioButton radioButton = new RadioButton(this);
            radioButton.setText(x[i].toString());
            binding.radioZones.addView(radioButton);
        }*/
        for (Zone z : zones) {
            RadioButton radioButton = new RadioButton(this);
            radioButton.setText(z.getName());
            radioButton.setId(z.getId());
            binding.radioZones.addView(radioButton);
        }

    }
}