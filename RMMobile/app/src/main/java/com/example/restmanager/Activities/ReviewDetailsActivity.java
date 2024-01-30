package com.example.restmanager.Activities;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.text.Editable;
import android.view.View;
import android.widget.Toast;

import com.example.restmanager.Fragments.ReviewsFragment;
import com.example.restmanager.Listeners.RestaurantListener;
import com.example.restmanager.Listeners.ReviewListener;
import com.example.restmanager.Listeners.ReviewsListener;
import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.Model.Review;
import com.example.restmanager.Model.Reviews;
import com.example.restmanager.Model.Signup;
import com.example.restmanager.Model.User;
import com.example.restmanager.R;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.Utils.Public;
import com.example.restmanager.databinding.ActivityLoginBinding;
import com.example.restmanager.databinding.ActivityReviewDetailsBinding;

import java.sql.SQLOutput;

public class ReviewDetailsActivity extends AppCompatActivity implements ReviewListener {
    public static final int ADD = 10;
    public static final int EDIT = 20;
    public static final int DELETE = 30;
    public static final String OP_CODE = "op detail";
    private ActivityReviewDetailsBinding binding;
    Restaurant restaurant;
    User user;
    Review review;

    public final static String ID_REST = "ID_RESTAURANT";
    public final static String ID_REVIEW = "ID_REVIEW";


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_review_details);

        binding = ActivityReviewDetailsBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        int reviewid = getIntent().getIntExtra(String.valueOf(ID_REVIEW), 0);
        review = SingletonRestaurantManager.getInstance(getApplicationContext()).getReviewById(reviewid);

        if (review != null){
            int idRest = SingletonRestaurantManager.getInstance(getApplicationContext()).getRestaurantByName(review.getRestId()).getId();
            restaurant = SingletonRestaurantManager.getInstance(getApplicationContext()).getRestaurant(idRest);
            binding.tvRestName.setText(restaurant.getName());
            binding.tvEmail.setText(restaurant.getEmail());
            binding.tvPhone.setText(restaurant.getMobileNumber());
            binding.tvLocal.setText(restaurant.getAddress());

            System.out.println("rwview det " + review);

            binding.ratingBar.setRating(review.getStars());
            binding.etDescription.setText(review.getDescription());
        }else{
            int id = getIntent().getIntExtra(String.valueOf(ID_REST), 0);
            restaurant = SingletonRestaurantManager.getInstance(getApplicationContext()).getRestaurant(id);
            binding.tvRestName.setText(restaurant.getName());
            binding.tvEmail.setText(restaurant.getEmail());
            binding.tvPhone.setText(restaurant.getMobileNumber());
            binding.tvLocal.setText(restaurant.getAddress());

            //binding.etDescription.setText(review.getDescription());
            //binding.ratingBar.setRating((float) review.getStars());
        }

        binding.btnSave.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (review != null){
                    review.setStars((int)binding.ratingBar.getRating());
                    review.setDescription(String.valueOf(binding.etDescription.getText()));

                    SingletonRestaurantManager.getInstance(getApplicationContext()).editReviewAPI(review, getApplicationContext());

                    Intent intent = new Intent();
                    setResult(RESULT_OK, intent);
                    finish();
                }else{
                    int id = getIntent().getIntExtra(String.valueOf(ID_REST), 0);
                    restaurant = SingletonRestaurantManager.getInstance(getApplicationContext()).getRestaurant(id);

                    SharedPreferences sharedPreferences = getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
                    String token = sharedPreferences.getString(Public.TOKEN, "0");

                    user = SingletonRestaurantManager.getInstance(getApplicationContext()).getUserBD(token);
                    restaurant = SingletonRestaurantManager.getInstance(getApplicationContext()).getRestaurant(id);

                    String userId = user.getName();
                    float stars = binding.ratingBar.getRating();
                    String description = binding.etDescription.getText().toString();
                    String restId = restaurant.getName();

                    Toast.makeText(ReviewDetailsActivity.this, "AddApi", Toast.LENGTH_SHORT).show();

                    Review review = new Review(0,userId, restId, (int)stars, description);

                    SingletonRestaurantManager.getInstance(getApplicationContext()).addReviewApi(review, getApplicationContext(), token);
                    Intent intent = new Intent();
                    setResult(RESULT_OK, intent);
                    finish();
                }
            }
        });
    }

    /*public void onClickSaveReview(View view){

        int id = getIntent().getIntExtra(String.valueOf(ID_REST), 0);
        restaurant = SingletonRestaurantManager.getInstance(getApplicationContext()).getRestaurant(id);

        SharedPreferences sharedPreferences = getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
        String token = sharedPreferences.getString(Public.TOKEN, "0");

        user = SingletonRestaurantManager.getInstance(getApplicationContext()).getUserBD(token);
        restaurant = SingletonRestaurantManager.getInstance(getApplicationContext()).getRestaurant(id);

        String userId = user.getName();
        float stars = binding.ratingBar.getRating();
        String description = binding.etDescription.getText().toString();
        String restId = restaurant.getName();

        Toast.makeText(ReviewDetailsActivity.this, "AddApi", Toast.LENGTH_SHORT).show();

        Review review = new Review(0,userId, restId, (int)stars, description);
        SingletonRestaurantManager.getInstance(getApplicationContext()).addReviewApi(review, getApplicationContext(), token);
        Intent intent = new Intent();
        setResult(RESULT_OK, intent);
        finish();
    }*/

    @Override
    public void onRefreshReviewDetails(int operation) {
        Intent intent = new Intent();
        intent.putExtra(String.valueOf(ReviewsFragment.OP_CODE), operation);
        setResult(RESULT_OK, intent);
        finish();
    }
}