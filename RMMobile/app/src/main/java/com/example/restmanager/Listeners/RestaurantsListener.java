package com.example.restmanager.Listeners;

import com.example.restmanager.Model.Restaurant;

import java.util.ArrayList;

public interface RestaurantsListener {

    void onRefreshRestaurantsList(ArrayList<Restaurant> restaurants);
}
