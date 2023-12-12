package com.example.restmanager;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.Model.SingletonRestaurantManager;
import com.example.restmanager.databinding.ActivityLoginBinding;
import com.example.restmanager.databinding.ActivityRestaurantDetailsBinding;

public class RestaurantDetailsActivity extends AppCompatActivity {
    public final static String ID_RESTAURANT = "ID_RESTAURANT";
    private ActivityRestaurantDetailsBinding binding;
    Restaurant restaurant;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_restaurant_details);


        
        binding = ActivityRestaurantDetailsBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        int id = getIntent().getIntExtra(String.valueOf(ID_RESTAURANT), 0);
        restaurant = SingletonRestaurantManager.getInstance(getApplicationContext()).getRestaurant(id);
        binding.imgCover.setImageResource(restaurant.getCover());
        binding.tvEmail.setText(restaurant.getEmail());
        binding.tvRestName.setText(restaurant.getName());
        binding.tvLocal.setText(restaurant.getAddress());
        binding.tvPhone.setText(restaurant.getMobileNumber());

        binding.lvReviews.clearFocus();
    }

    public void onClickReserve(View view){
        Toast.makeText(this, "Reservation", Toast.LENGTH_SHORT).show();
        Intent intent = new Intent(getApplicationContext(), ReserveActivity.class);
        startActivity(intent);
    }

    public void onClickTakeAway(View view){
        Toast.makeText(this, "Take-Away", Toast.LENGTH_SHORT).show();
        Intent intent = new Intent(getApplicationContext(), OrdersActivity.class);
        startActivity(intent);
    }
}