package com.example.restmanager;

import androidx.appcompat.app.AppCompatActivity;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.example.restmanager.databinding.ActivityLoginBinding;

public class LoginActivity extends AppCompatActivity {

    private ActivityLoginBinding binding;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        binding = ActivityLoginBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        binding.etEmailUsername.setText("z@z.x");
        binding.etPassword.setText("1234");
    }

    public void onClickLogin(View view){
        Toast.makeText(this, "Login clicked", Toast.LENGTH_SHORT).show();
        String email = binding.etEmailUsername.getText() + "";
        String pass = binding.etPassword.getText() + "";
        if (!isEmailValid(email) || !isUsernameValid(email)){
            binding.etEmailUsername.setError(getString(R.string.etEmailError));
                return;
        }
        if (!isPasswordValid(pass)){
            binding.etPassword.setError(getString(R.string.etPasswordError));
            return;
        }

        Intent intent = new Intent(getApplicationContext(), MainActivity.class);
        startActivity(intent);
        onPause();
    }

    public void onClickRegister(View view){
        Intent intent = new Intent(getApplicationContext(), RegistActivity.class);
        startActivity(intent);
        onPause();

    }
    public boolean isEmailValid(String email){
        System.out.println("--->çjk");
        if (email.isEmpty())
            return false;
        return Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }

    private boolean isUsernameValid(String email) {
        System.out.println("--->Fuclsad");
        if (email.isEmpty())
            return false;
        //return consoante equalidade à api
        return true;
    }

    public boolean isPasswordValid(String password){
        if (password.isEmpty())
            return false;
        //return consoante equalidade à api
        return true;
    }
}