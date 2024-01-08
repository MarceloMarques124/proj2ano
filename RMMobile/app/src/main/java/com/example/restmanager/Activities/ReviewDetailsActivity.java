package com.example.restmanager.Activities;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;

import com.example.restmanager.Listeners.RestaurantListener;
import com.example.restmanager.R;
import com.example.restmanager.databinding.ActivityLoginBinding;
import com.example.restmanager.databinding.ActivityReviewDetailsBinding;

public class ReviewDetailsActivity extends AppCompatActivity implements RestaurantListener {
    private ActivityReviewDetailsBinding binding;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_review_details);

        binding = ActivityReviewDetailsBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());


    }

    public void onClickSaveReview(View view){

        System.out.println("-->" + binding.etDescription.getText());
        System.out.println("-->" + binding.ratingBar.getRating());

    }

    @Override
    public void onRefreshRestaurantDetails(int operation) {

    }
}