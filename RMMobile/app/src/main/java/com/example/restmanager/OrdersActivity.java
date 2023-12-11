package com.example.restmanager;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;

import com.example.restmanager.Model.Order;
import com.example.restmanager.Model.Order;
import com.example.restmanager.databinding.ActivityOrdersBinding;

import java.util.ArrayList;
import java.util.List;

public class OrdersActivity extends AppCompatActivity {

    private ActivityOrdersBinding binding;
    private ArrayList<Order> orders;
    private List<String> zones;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_orders);

        binding = ActivityOrdersBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());


        //binding.spinnerZones;
        //get dos menus do restaurante
    }
}