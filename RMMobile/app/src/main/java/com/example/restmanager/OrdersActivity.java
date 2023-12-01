package com.example.restmanager;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.app.Activity;
import android.os.Bundle;

import com.example.restmanager.Adapters.RestaurantsAdapter;
import com.example.restmanager.Model.Orders;
import com.example.restmanager.Model.SingletonRestaurantManager;
import com.example.restmanager.databinding.ActivityLoginBinding;
import com.example.restmanager.databinding.ActivityOrdersBinding;

import java.util.ArrayList;

public class OrdersActivity extends AppCompatActivity {

    private ActivityOrdersBinding binding;
    private ArrayList<Orders> orders;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_orders);

        binding = ActivityOrdersBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

      //  orders = SingletonRestaurantManager.getInstance().getOrders(4);

  //      binding.lvOrders.setAdapter(new RestaurantsAdapter(getContext(), orders));


        //get dos menus do restaurante
    }
}