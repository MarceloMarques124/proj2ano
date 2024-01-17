package com.example.restmanager.Fragments;

import android.content.Context;
import android.content.SharedPreferences;
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
import com.example.restmanager.Model.User;
import com.example.restmanager.R;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.Utils.Public;
import com.example.restmanager.databinding.FragmentReviewsBinding;

import java.util.ArrayList;

public class ReviewsFragment extends Fragment {

    private FragmentReviewsBinding binding;
    private ArrayList<Review> reviews;

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
                //dados da review
            }
        });

        SharedPreferences sharedPreferences = getContext().getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);

        User u = SingletonRestaurantManager.getInstance(getContext()).getUserBD(Public.TOKEN);

        reviews = SingletonRestaurantManager.getInstance(getContext()).getReviewsById(u.getId());

        binding.lvUserReviews.setAdapter(new ReviewsAdapter(getContext(), reviews));

        return view;
    }
}