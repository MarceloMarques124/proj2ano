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


        binding.etName.setText("davif");
        binding.etUsername.setText("doomiingus");
        binding.etEmail.setText("word@l.com");
        binding.etPassword.setText("password");
        binding.etRePassword.setText("password");
        binding.etNif.setText("563214753");
        binding.etAddress.setText("Rua da prima que afinal era tia da minha sobrinha");
        binding.etDoorNumber.setText("4.G");
        binding.etPostalCode.setText("2236-556");



    }

    public void onClickSignup(View view){
        String name = binding.etName.getText() + "";
        String username = binding.etUsername.getText() + "";
        String email = binding.etEmail.getText() + "";
        String password = binding.etPassword.getText() + "";
        String confirmpass = binding.etRePassword.getText() + "";
        String nif = binding.etNif.getText() + "";
        String address = binding.etAddress.getText() + "";
        String door = binding.etDoorNumber.getText() + "";
        String postalCode = binding.etPostalCode.getText() + "";


        System.out.println("-->" + password + " | " + confirmpass);

        if (password.toString().equals(confirmpass.toString())){
            Signup signup = new Signup(name, username, email, password, Integer.parseInt(nif), address, door, postalCode);
            System.out.println("---> Aqui");
            SingletonRestaurantManager.getInstance(getApplicationContext()).signupAPI(signup, getApplicationContext());

        }
    }

}