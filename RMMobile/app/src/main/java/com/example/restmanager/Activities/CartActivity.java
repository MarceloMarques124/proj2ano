package com.example.restmanager.Activities;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

import com.example.restmanager.R;
import com.example.restmanager.databinding.ActivityCartBinding;

public class CartActivity extends AppCompatActivity {
    public static final int ADD = 10;
    private ActivityCartBinding binding;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cart);

        binding = ActivityCartBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());
        
        
        binding.fabFinish.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Toast.makeText(CartActivity.this, "FAB Clicked", Toast.LENGTH_SHORT).show();
            }
        });
    }
}