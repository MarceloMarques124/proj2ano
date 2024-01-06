package com.example.restmanager.Fragments;

import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;

import com.example.restmanager.Adapters.RestaurantsAdapter;
import com.example.restmanager.Adapters.ReviewsAdapter;
import com.example.restmanager.Listeners.ReviewListener;
import com.example.restmanager.Listeners.ReviewsListener;
import com.example.restmanager.Model.Review;
import com.example.restmanager.R;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.databinding.FragmentReviewsBinding;

import java.util.ArrayList;

public class ReviewsFragment extends Fragment implements ReviewsListener {

    private FragmentReviewsBinding binding;

    public ReviewsFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        binding = FragmentReviewsBinding.inflate(inflater, container, false);
        View view = binding.getRoot();

        binding.lvUserReviews.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

            }
        });


        SingletonRestaurantManager.getInstance(getContext()).setReviewsListener(this);
        SingletonRestaurantManager.getInstance(getContext()).getReviewsAPI(getContext());
        return view;
    }

    @Override
    public void onRefreshReviewsList(ArrayList<Review> reviews) {
        if (reviews !=null){
            binding.lvUserReviews.setAdapter(new ReviewsAdapter(getContext(), reviews));
        }
    }
}