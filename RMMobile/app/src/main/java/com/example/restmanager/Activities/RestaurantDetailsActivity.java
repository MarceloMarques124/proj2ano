package com.example.restmanager.Activities;

import static com.example.restmanager.Activities.OrdersActivity.ID_REST;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Toast;

import com.example.restmanager.Adapters.ReviewsAdapter;
import com.example.restmanager.Listeners.ReviewsListener;
import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.Model.Review;
import com.example.restmanager.R;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.databinding.ActivityRestaurantDetailsBinding;
import com.example.restmanager.databinding.ActivityReviewDetailsBinding;
import com.google.android.material.snackbar.Snackbar;

import java.util.ArrayList;
import java.util.Objects;

public class RestaurantDetailsActivity extends AppCompatActivity implements ReviewsListener {
    public final static String ID_RESTAURANT = "ID_RESTAURANT";
    public static final int ADD = 10;
    private static final int EDIT = 20;
    private static final int DELETE = 30;
    public static final String OP_CODE = "op detail";
    private ActivityRestaurantDetailsBinding binding;
    Restaurant restaurant;
    private ArrayList<Review> reviews;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_restaurant_details);


        binding = ActivityRestaurantDetailsBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());
        System.out.println("---> ID"  + ID_RESTAURANT);
        String name = getIntent().getStringExtra(ID_RESTAURANT);
        System.out.println("---> name " + name);
        restaurant = SingletonRestaurantManager.getInstance(getApplicationContext()).getRestaurantByName(name);
        System.out.println("---> resta  " + restaurant);
      //  binding.imgCover.setImageResource(restaurant.getCover());
        binding.tvEmail.setText(restaurant.getEmail());
        binding.tvRestName.setText(restaurant.getName());
        binding.tvLocal.setText(restaurant.getAddress());
        binding.tvPhone.setText(restaurant.getMobileNumber());


        // Chame diretamente o método getReviewsByRest com o ID do restaurant

        SingletonRestaurantManager.getInstance(getApplicationContext()).setReviewsListener(this);
        SingletonRestaurantManager.getInstance(getApplicationContext()).getReviewsAPI(getApplicationContext());
    }


    public void onClickReserve(View view){
        Toast.makeText(this, "Reservation", Toast.LENGTH_SHORT).show();
        Intent intent = new Intent(getApplicationContext(), ReserveActivity.class);;
        intent.putExtra(ID_RESTAURANT, restaurant.getId());
        startActivity(intent);
    }

    public void onClickTakeAway(View view){
        Toast.makeText(this, "Take-Away", Toast.LENGTH_SHORT).show();
        Intent intent = new Intent(getApplicationContext(), OrdersActivity.class);
        intent.putExtra(ID_REST, restaurant.getId());
        startActivity(intent);
    }

    public void onClickReview(View view){
        Intent intent = new Intent(getApplicationContext(), ReviewDetailsActivity.class);
        intent.putExtra(ID_RESTAURANT, restaurant.getId());
        startActivityForResult(intent, RestaurantDetailsActivity.ADD);

    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (resultCode == Activity.RESULT_OK) {
            if (requestCode == ReviewDetailsActivity.ADD || requestCode == ReviewDetailsActivity.EDIT) {
                SingletonRestaurantManager.getInstance(getApplicationContext()).getReviewsByRest(restaurant.getName());
                switch (requestCode) {
                    case ReviewDetailsActivity.ADD:
                        // Snackbar.make(get(), "livro add com succ", Snackbar.LENGTH_SHORT).show();
                        Toast.makeText(this, "", Toast.LENGTH_SHORT).show();
                        break;
                    case ReviewDetailsActivity.EDIT:
                        if (data.getIntExtra(ReviewDetailsActivity.OP_CODE, 0) == ReviewDetailsActivity.DELETE) {
                            //  Snackbar.make(getView(), "livro delet com succ", Snackbar.LENGTH_SHORT).show();
                        } else {
                            //  Snackbar.make(getView(), "livro edit com succ", Snackbar.LENGTH_SHORT).show();
                        }
                        break;
                }
            }
        }
    }

    @Override
    public void onRefreshReviewsList(ArrayList<Review> reviews) {
        ArrayList<Review> auxReviews = new ArrayList<>();
        if (reviews != null) {

            String name = getIntent().getStringExtra(ID_RESTAURANT);
            reviews.forEach(review ->{
                if (Objects.equals(review.getRestId(), name))
                    auxReviews.add(review);
            });

            binding.lvReviews.setAdapter(new ReviewsAdapter(getApplicationContext(), auxReviews));
        }
    }


}