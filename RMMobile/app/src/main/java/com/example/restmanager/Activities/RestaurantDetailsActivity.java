package com.example.restmanager.Activities;

import static com.example.restmanager.Activities.OrdersActivity.ID_REST;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

import com.example.restmanager.Adapters.ReviewsAdapter;
import com.example.restmanager.Listeners.ReviewsListener;
import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.Model.Review;
import com.example.restmanager.R;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.databinding.ActivityRestaurantDetailsBinding;

import java.util.ArrayList;

public class RestaurantDetailsActivity extends AppCompatActivity implements ReviewsListener {
    public final static String ID_RESTAURANT = "ID_RESTAURANT";
    private ActivityRestaurantDetailsBinding binding;
    Restaurant restaurant;
    private ArrayList<Review> reviews;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_restaurant_details);

        
        binding = ActivityRestaurantDetailsBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        int id = getIntent().getIntExtra(String.valueOf(ID_RESTAURANT), 0);
        restaurant = SingletonRestaurantManager.getInstance(getApplicationContext()).getRestaurant(id);
      //  binding.imgCover.setImageResource(restaurant.getCover());
        binding.tvEmail.setText(restaurant.getEmail());
        binding.tvRestName.setText(restaurant.getName());
        binding.tvLocal.setText(restaurant.getAddress());
        binding.tvPhone.setText(restaurant.getMobileNumber());
        
        SingletonRestaurantManager.getInstance(getApplicationContext()).setReviewsListener(this);
        SingletonRestaurantManager.getInstance(getApplicationContext()).getReviewsAPI(getApplicationContext());
    }

    public void onClickReserve(View view){
        Toast.makeText(this, "Reservation", Toast.LENGTH_SHORT).show();
        Intent intent = new Intent(getApplicationContext(), ReserveActivity.class);
        startActivity(intent);
    }

    public void onClickTakeAway(View view){
        Toast.makeText(this, "Take-Away", Toast.LENGTH_SHORT).show();
        Intent intent = new Intent(getApplicationContext(), OrdersActivity.class);
        intent.putExtra(ID_REST, restaurant.getId());
        startActivity(intent);
    }

    @Override
    public void onRefreshReviewsList(ArrayList<Review> reviews) {
        if (reviews != null)
            binding.lvReviews.setAdapter(new ReviewsAdapter(getApplicationContext(), reviews));
    }
}