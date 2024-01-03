package com.example.restmanager.Listeners;

import com.example.restmanager.Model.Review;

import java.util.ArrayList;

public interface ReviewsListener {

    void onRefreshReviewsList(ArrayList<Review> reviews);
}
