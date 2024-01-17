package com.example.restmanager.Activities;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;

import com.android.volley.Response;
import com.example.restmanager.Model.Login;
import com.example.restmanager.R;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.Utils.Public;
import com.example.restmanager.databinding.ActivityLoginBinding;

public class LoginActivity extends AppCompatActivity {

    private ActivityLoginBinding binding;
    private Login login;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        binding = ActivityLoginBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());
        String email = binding.etEmailUsername.getText() + "";

        if (isTokenValid()){
            Intent intent = new Intent(getApplicationContext(), MainActivity.class);
            intent.putExtra(MainActivity.USERNAME, email);
            startActivity(intent);
            finish();
        }

        binding.etEmailUsername.setText("client");
        binding.etPassword.setText("password");
    }

    public void onClickLogin(View view){
        String username = binding.etEmailUsername.getText()+"";
        String pass = binding.etPassword.getText()+"";
        if (!isUsernameValid(username)){
            binding.etEmailUsername.setError(getString(R.string.etEmailError));
            return;
        }
        if (!isPasswordValid(pass)){
            binding.etPassword.setError(getString(R.string.etPasswordError));
        }else {
            isLoginValid(username, pass);
        }
    }

    private boolean isUsernameValid(String username) {
        if (username.isEmpty())
            return false;
        //return consoante equalidade à api
        return true;
    }

    public boolean isPasswordValid(String password){
        if (password.isEmpty())
            return false;
        return true;
    }

    private void isLoginValid(String username, String pass){
        login = new Login(username, pass);

        SingletonRestaurantManager.getInstance(getApplicationContext()).loginAPI(login, getApplicationContext(), new Response.Listener(){
            @Override
            public void onResponse(Object response){
                SharedPreferences sharedPreferences = getApplication().getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
                System.out.println("---> I'm here");
                if (sharedPreferences.getString(Public.TOKEN, "0").matches("TOKEN")){

                    System.out.println("---> Login not valid;" + sharedPreferences.getString(Public.TOKEN, "0"));
                    //  return true;
                }else{
                    System.out.println("---> Login valido;" + sharedPreferences.getString(Public.TOKEN, "0"));
                    Intent intent = new Intent(getApplicationContext(), MainActivity.class);
                    intent.putExtra(MainActivity.USERNAME, username);
                    startActivity(intent);
                    finish();
                    //  return false;
                }
            }
        });
    }



    public boolean isTokenValid(){
        SharedPreferences sharedPreferences = getApplication().getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);

        if (sharedPreferences.getString(Public.TOKEN, "TOKEN").matches("TOKEN")){
            return false;
        }else{
            return true;
        }
    }
    public void onClickRegister(View view){
        Intent intent = new Intent(getApplicationContext(), RegistActivity.class);
        startActivity(intent);
        onPause();
    }

    public void onClickServer(View view){
        Intent intent = new Intent(getApplicationContext(), ServerConnectionActivity.class);
        startActivity(intent);
        onPause();

    }
}