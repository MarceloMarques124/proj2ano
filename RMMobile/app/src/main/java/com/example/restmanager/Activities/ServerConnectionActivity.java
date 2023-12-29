package com.example.restmanager.Activities;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.View;
import android.widget.EditText;

import com.example.restmanager.R;

public class ServerConnectionActivity extends AppCompatActivity {


    private EditText port;
    private EditText first;
    private EditText second;
    private EditText third;
    private EditText fourth;
    private String IP;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_server_connection);

        first = findViewById(R.id.etFirstThree);
        second = findViewById(R.id.etSecondThree);
        third = findViewById(R.id.etThirdThree);
        fourth = findViewById(R.id.etFourthThree);
        port = findViewById(R.id.etPort);

        addTextWatcher(first, second);
        addTextWatcher(second, third);
        addTextWatcher(third, fourth);

        port.setText("8080");
        first .setText("555");
        second.setText("55");
        third .setText("55");
        fourth.setText("555");

    }

    public void onClickConnect(View view){
        if (isValid(first, 3)){
            if (isValid(second, 2)){
                if (isValid(third, 2)){
                    if (isValid(fourth, 3)){
                        IP = first.getText().toString() + "." + second.getText().toString() + "." + third.getText().toString() + "." + fourth.getText().toString();
                        System.out.println("---->" + IP + ": " + port.getText().toString());
                        Intent intent = new Intent(getApplicationContext(), LoginActivity.class);
                        startActivity(intent);
                        onStop();
                    }else{
                        fourth.setError("Not Valid");
                    }
                }else{
                    third.setError("Not Valid");
                }
            }else{
                second.setError("Not Valid");
            }
        }else{
            first.setError("Not Valid");
        }
    }

    private boolean isValid(EditText number, int max){
        if (number.getText().toString().trim().isEmpty()  || number.length() > max)
            return false;
        return true;
    }

    private void addTextWatcher(final EditText currentEditText, final EditText nextEditText) {
        currentEditText.addTextChangedListener(new TextWatcher() {

            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {

            }

            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {

            }

            @Override
            public void afterTextChanged(Editable editable) {
                if (editable.length() == /* specify your desired length */ 3) {
                    // Move focus to the next EditText
                    nextEditText.requestFocus();
                }
            }
        });
    }

}