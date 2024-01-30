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
import android.widget.Toast;

import com.example.restmanager.Listeners.ZonesListener;
import com.example.restmanager.Model.Reserve;
import com.example.restmanager.Model.Restaurant;
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
                        binding.pickDate.setText(new SimpleDateFormat("yyyy-MM-dd").format(picker.getSelection()));
                        picker.dismiss();
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
                        // Aqui você pode obter os minutos e horas selecionados
                        int selectedHour = picker.getHour();
                        int selectedMinute = picker.getMinute();

                        // Configura os minutos para 0
                        picker.setMinute(0);

                        // Atualiza o texto no seu botão ou onde quer que você queira exibir o tempo
                        binding.pickTime.setText(String.format("%02d:%02d:00", selectedHour, selectedMinute));
                        System.out.println("---> hora: " + binding.pickTime.getText().toString());
                        picker.dismiss();
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
                Restaurant rest = SingletonRestaurantManager.getInstance(getApplicationContext()).getRestaurant(id);
                int people = Integer.parseInt(binding.etnPeopleNumber.getText()+"");
                String time = binding.pickTime.getText().toString();
                String date = binding.pickDate.getText().toString();
                int idzone = binding.radioZones.getCheckedRadioButtonId();
                Toast.makeText(ReserveActivity.this, idzone+"", Toast.LENGTH_SHORT).show();
                String remark = binding.etRemark.getText().toString();
                //id pedido a cima é rest
                System.out.println("---> fgsea" + 0 + " | " + u.getId() + " | " + date + " | " + time + " | " + remark + " | " + idzone + " | " + id + " | " + 0);
                Reserve r = new Reserve(0, u.getId()+"", date, time, remark, idzone, rest.getId()+"", people);

                System.out.println("---> Reserve: " + r.getId() + " | " + r.getDate() + " | " + r.getTime() + " | " + r.getTablesNumber() + " | " +
                        r.getUserId() + " | " + r.getZone() + " | " + r.getRestId() + " | " + r.getRemarks() + " | " + r.getPeopleNumber());
                SingletonRestaurantManager.getInstance(getApplicationContext()).addReserveAPI(r, getApplicationContext());

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