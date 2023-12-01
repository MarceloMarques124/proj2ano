package com.example.restmanager;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;

import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.Model.SingletonRestaurantManager;
import com.example.restmanager.databinding.ActivityLoginBinding;
import com.example.restmanager.databinding.ActivityRestaurantDetailsBinding;

public class RestaurantDetailsActivity extends AppCompatActivity {
    final static int ID_RESTAURANT = 0;
    private ActivityRestaurantDetailsBinding binding;
    Restaurant restaurant;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_restaurant_details);

        binding = ActivityRestaurantDetailsBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        int id = getIntent().getIntExtra(String.valueOf(ID_RESTAURANT), 0);
        restaurant = SingletonRestaurantManager.getInstance().getRestaurant(id);

        binding.imgCover.setImageResource(restaurant.getCover());
        binding.tvEmail.setText(restaurant.getEmail());
        binding.tvRestName.setText(restaurant.getName());
        binding.tvLocal.setText(restaurant.getAddress());
        binding.tvPhone.setText(restaurant.getMobileNumber());
    }
}