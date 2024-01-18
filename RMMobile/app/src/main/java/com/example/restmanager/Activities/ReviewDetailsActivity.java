package com.example.restmanager.Activities;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.text.Editable;
import android.view.View;
import android.widget.Toast;

import com.example.restmanager.Listeners.RestaurantListener;
import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.Model.Review;
import com.example.restmanager.Model.Signup;
import com.example.restmanager.Model.User;
import com.example.restmanager.R;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.Utils.Public;
import com.example.restmanager.databinding.ActivityLoginBinding;
import com.example.restmanager.databinding.ActivityReviewDetailsBinding;

import java.sql.SQLOutput;

public class ReviewDetailsActivity extends AppCompatActivity implements RestaurantListener {
    public static final int ADD = 10;
    public static final int EDIT = 20;
    public static final int DELETE = 30;
    public static final String OP_CODE = "op detail";
    private ActivityReviewDetailsBinding binding;
    Restaurant restaurant;
    User user;

    public final static String ID_REST = "ID_RESTAURANT";


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_review_details);

        binding = ActivityReviewDetailsBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        int id = getIntent().getIntExtra(String.valueOf(ID_REST), 0);
        System.out.println("--->" + id);
        restaurant = SingletonRestaurantManager.getInstance(getApplicationContext()).getRestaurant(id);
        binding.tvEmail.setText(restaurant.getEmail());
        binding.tvPhone.setText(restaurant.getMobileNumber());
        binding.tvLocal.setText(restaurant.getAddress());

    }

    public void onClickSaveReview(View view){

        System.out.println("-->" + binding.etDescription.getText());
        System.out.println("-->" + binding.ratingBar.getRating());

        int id = getIntent().getIntExtra(String.valueOf(ID_REST), 0);
        System.out.println("--->" + id);
        restaurant = SingletonRestaurantManager.getInstance(getApplicationContext()).getRestaurant(id);

        SharedPreferences sharedPreferences = getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
        String token = sharedPreferences.getString(Public.TOKEN, "0");
        user = SingletonRestaurantManager.getInstance(getApplicationContext()).getUserBD(token);
        int userId = user.getId();
        float stars = binding.ratingBar.getRating();
        String description = binding.etDescription.getText().toString();
        int restId = id;
        System.out.println("-->user id"+ userId + stars + description + restId);

        Toast.makeText(ReviewDetailsActivity.this, "AddApi", Toast.LENGTH_SHORT).show();
        Review review = new Review(0,userId, restId, (int)stars, description);
        SingletonRestaurantManager.getInstance(getApplicationContext()).addReviewApi(review, getApplicationContext(), token);
        Intent intent = new Intent();
        setResult(RESULT_OK, intent);
        finish();
    }

    @Override
    public void onRefreshRestaurantDetails(int operation) {

    }
}