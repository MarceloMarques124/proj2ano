package com.example.restmanager.Activities;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import com.example.restmanager.R;
import com.example.restmanager.Utils.Public;
import com.example.restmanager.databinding.ActivityLoginBinding;
import com.example.restmanager.databinding.ActivityServerConnectionBinding;

public class ServerConnectionActivity extends AppCompatActivity {

    private ActivityServerConnectionBinding binding;
    private String ip;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        
        binding = ActivityServerConnectionBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());


        binding.etPort.setText("8080");
        binding.etFirstThree.setText("172");
        binding.etSecondThree.setText("22");
        binding.etThirdThree.setText("21");
        binding.etFourthThree.setText("221");

    }

    public void onClickConnect(View view){
        System.out.println("---> AQUI: " + binding.etFourthThree.getText());
        System.out.println("---> AQUIº");
        ip = binding.etFirstThree.getText().toString() + "." + binding.etSecondThree.getText() + "." +
                binding.etThirdThree.getText().toString() + "." + binding.etFourthThree.getText().toString() + ":" + binding.etPort.getText();
        System.out.println("--->" + ip + ":" + binding.etPort.getText().toString());
        SharedPreferences sharedPreferences = getApplication().getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();

        editor.putString(Public.IP, "http://" + ip + "/api");
        editor.apply();
        System.out.println("---> Public.IP: " + Public.IP + "\n ---> ip: " + ip);


    }

    private boolean isValid(EditText number, int max){
        if (number.getText().toString().trim().isEmpty()  || number.length() > max)
            return false;
        return true;
    }
}