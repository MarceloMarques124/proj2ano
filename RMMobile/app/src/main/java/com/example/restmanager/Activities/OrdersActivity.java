package com.example.restmanager.Activities;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;

import com.example.restmanager.Adapters.MenusAdapter;
import com.example.restmanager.Listeners.MenusListener;
import com.example.restmanager.Model.Menu;
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


        binding = ActivityOrdersBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        int id = getIntent().getIntExtra(ID_REST, 0);
        SingletonRestaurantManager.getInstance(getApplicationContext()).setMenusListener(this);
        SingletonRestaurantManager.getInstance(getApplicationContext()).getMenusAPI(this);


    }

    @Override
    public void onRefreshMenusList(ArrayList<Menu> menus) {
        if (menus != null){
            binding.lvMenus.setAdapter(new MenusAdapter(getApplicationContext(), menus));
        }
    }
}