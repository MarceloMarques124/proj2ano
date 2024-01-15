package com.example.restmanager.Activities;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

import com.example.restmanager.Model.Signup;
import com.example.restmanager.R;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.databinding.ActivitySignupBinding;

public class RegistActivity extends AppCompatActivity {


    private ActivitySignupBinding binding;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup);
        binding = com.example.restmanager.databinding.ActivitySignupBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());


    }

    public void onClickSignup(View view){
        String name = binding.etName.toString();
        String username = binding.etUsername.toString();
        String email = binding.etEmail.toString();
        String password = binding.etPassword.toString();
        String confirmpass = binding.etRePassword.toString();
        String nif = binding.etNif.toString();
        String address = binding.etAddress.toString();
        String door = binding.etDoorNumber.toString();
        String postalCode = binding.etPostalCode.toString();

        if (password == confirmpass){
            Signup signup = new Signup(name, username, email, password, Integer.parseInt(nif), address, door, postalCode);
            System.out.println("---> Aqui");
            SingletonRestaurantManager.getInstance(getApplicationContext()).signupAPI(signup, getApplicationContext());

        }
    }

}