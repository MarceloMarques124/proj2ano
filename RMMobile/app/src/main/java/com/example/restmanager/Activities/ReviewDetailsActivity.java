package com.example.restmanager.Activities;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.text.Editable;
import android.view.View;

import com.example.restmanager.Listeners.RestaurantListener;
import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.Model.Review;
import com.example.restmanager.Model.Signup;
import com.example.restmanager.R;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.databinding.ActivityLoginBinding;
import com.example.restmanager.databinding.ActivityReviewDetailsBinding;

import java.sql.SQLOutput;

public class ReviewDetailsActivity extends AppCompatActivity implements RestaurantListener {
    private ActivityReviewDetailsBinding binding;
    Restaurant restaurant;
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

        /*float stars = binding.ratingBar.getRating();
        Editable description = binding.etDescription.getText();
        int restId = id;
        Review review = new Review(userId, restId, stars, description);
        SingletonRestaurantManager.getInstance(getApplicationContext()).addReviewDB(review);*/
    }

    @Override
    public void onRefreshRestaurantDetails(int operation) {

    }
}