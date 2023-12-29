package com.example.restmanager.Activities;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;

import com.example.restmanager.R;
import com.example.restmanager.databinding.ActivityCartBinding;

public class CartActivity extends AppCompatActivity {
    private ActivityCartBinding binding;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cart);

        binding = ActivityCartBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());
    }
}