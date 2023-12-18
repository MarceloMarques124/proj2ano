package com.example.restmanager;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

import com.example.restmanager.Adapters.MenusAdapter;
import com.example.restmanager.Model.Menu;
import com.example.restmanager.Model.Order;
import com.example.restmanager.Model.Order;
import com.example.restmanager.Model.SingletonRestaurantManager;
import com.example.restmanager.databinding.ActivityOrdersBinding;

import java.util.ArrayList;
import java.util.List;

public class OrdersActivity extends AppCompatActivity {

    private ActivityOrdersBinding binding;
    private ArrayList<Menu> menus;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_orders);

        Toast.makeText(this, "ujuojdkasn", Toast.LENGTH_SHORT).show();
        
        binding = ActivityOrdersBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        menus = SingletonRestaurantManager.getInstance(getApplicationContext()).getMenus();
        binding.lvMenus.setAdapter(new MenusAdapter(getApplicationContext(), menus));
    }

}