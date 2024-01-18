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
        Toast.makeText(this, "CONAN OSIRIS DA WISH", Toast.LENGTH_SHORT).show();
        /*if (isValid((EditText) binding.etFirstThree, 3)){
            System.out.println("---> AQUI: " + binding.etFirstThree.getText());
            if (isValid((EditText) binding.etSecondThree, 2)){
                System.out.println("---> AQUI: " + binding.etSecondThree.getText());
                if (isValid((EditText) binding.etThirdThree, 2)){
                    System.out.println("---> AQUI: " + binding.etThirdThree.getText());
                    if (isValid((EditText) binding.etFourthThree, 3)){*/
                        System.out.println("---> AQUI: " + binding.etFourthThree.getText());
                        System.out.println("---> AQUIº");
                        ip = binding.etFirstThree.getText().toString() + "." + binding.etSecondThree.getText() + "." +
                                binding.etThirdThree.getText().toString() + "." + binding.etFourthThree.getText().toString() + ":" + binding.etPort.getText();
                        System.out.println("--->" + ip + ":" + binding.etPort.getText().toString());
                        SharedPreferences sharedPreferences = getApplication().getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
                        SharedPreferences.Editor editor = sharedPreferences.edit();

                        editor.putString(Public.IP, ip);
                        editor.apply();
                        System.out.println("---> Public.IP: " + Public.IP + "\n ---> ip: " + ip);

                        //verifica se user logged. Se sim, vai para main page
                        /*Intent intent = new Intent(getApplicationContext(), LoginActivity.class);
                        startActivity(intent);
                        onStop();*/
                    /*}else{
                        binding.etFourthThree.setError("Not Valid");
                    }
                }else{
                    binding.etThirdThree.setError("Not Valid");
                }
            }else{
                binding.etSecondThree.setError("Not Valid");
            }
        }else{
            binding.etFirstThree.setError("Not Valid");
        }*/
    }

    private boolean isValid(EditText number, int max){
        if (number.getText().toString().trim().isEmpty()  || number.length() > max)
            return false;
        return true;
    }
}