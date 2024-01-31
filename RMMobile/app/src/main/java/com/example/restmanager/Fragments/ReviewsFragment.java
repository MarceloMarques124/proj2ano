package com.example.restmanager.Fragments;

import static android.app.Activity.RESULT_OK;

import static com.example.restmanager.Activities.ReviewDetailsActivity.ID_REVIEW;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;

import com.example.restmanager.Activities.ReviewDetailsActivity;
import com.example.restmanager.Adapters.ReviewsAdapter;
import com.example.restmanager.Listeners.ReviewsListener;
import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.Model.Review;
import com.example.restmanager.Model.User;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.Utils.Public;
import com.example.restmanager.databinding.FragmentReviewsBinding;

import java.util.ArrayList;
import java.util.Objects;

public class ReviewsFragment extends Fragment implements ReviewsListener {

    public static final int EDIT = 20;
    public static final int OP_CODE = 0;
    private FragmentReviewsBinding binding;
    private ArrayList<Review> reviews;
    private ArrayList<Review> userReviews;
    private Restaurant restaurant;

    public ReviewsFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        binding = FragmentReviewsBinding.inflate(inflater, container, false);
        View view = binding.getRoot();


        SingletonRestaurantManager.getInstance(getContext()).setReviewsListener(this);
        SingletonRestaurantManager.getInstance(getContext()).getReviewsAPI(getContext());

        binding.lvUserReviews.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Review r = SingletonRestaurantManager.getInstance(getContext()).getReviewById((int) id);
                Intent intent = new Intent(getContext(), ReviewDetailsActivity.class);
                intent.putExtra(ID_REVIEW, (int) id);
                startActivityForResult(intent, ReviewDetailsActivity.EDIT);
            }
        });

        binding.swipeLayout.setOnRefreshListener(this::onRefresh);



        return view;
    }

    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if (requestCode == ReviewDetailsActivity.EDIT && resultCode == RESULT_OK) {
            // Atualize a lista de revisões aqui
            onRefresh();
        }
    }

    @Override
    public void onRefresh() {
        SingletonRestaurantManager.getInstance(getContext()).getReviewsAPI(getContext());
        binding.swipeLayout.setRefreshing(false);
    }

    @Override
    public void onRefreshReviewsList(ArrayList<Review> reviews) {
        ArrayList<Review> auxReviews = new ArrayList<>();
        SharedPreferences sharedPreferences = getContext().getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
        User u = SingletonRestaurantManager.getInstance(getContext()).getUserBD(sharedPreferences.getString(Public.TOKEN, "0"));
        if (reviews != null) {

            reviews.forEach(review ->{
                if (Objects.equals(review.getUserId(), u.getName()))
                    auxReviews.add(review);
            });

            binding.lvUserReviews.setAdapter(new ReviewsAdapter(getContext(), auxReviews));
        }
    }
}