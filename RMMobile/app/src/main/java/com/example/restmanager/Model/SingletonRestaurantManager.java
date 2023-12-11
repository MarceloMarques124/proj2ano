package com.example.restmanager.Model;

import android.widget.Toast;

import com.example.restmanager.Adapters.RestaurantsAdapter;
import com.example.restmanager.R;

import java.util.ArrayList;
import java.util.List;

public class SingletonRestaurantManager {
    private ArrayList<Restaurant> restaurants;
    private static SingletonRestaurantManager instance = null;

    public static synchronized SingletonRestaurantManager getInstance(){
        if (instance == null)
            instance = new SingletonRestaurantManager();
        return instance;
    }

    private SingletonRestaurantManager() {
        generateDinamicData();
    }

    private void generateDinamicData() {
        restaurants = new ArrayList<>();

        restaurants.add(new Restaurant(1, "AntiGona", "Rua da cona da tia que é prima", 222635245, "antigona@k.com", "234668994", R.drawable.coloredlogo));
        restaurants.add(new Restaurant(2, "Foda-se", "Rua da cona da tia que é prima", 222089755, "fuck@k.com", "234668998", R.drawable.coloredlogo));
    }

    public ArrayList<Restaurant> getRestaurants(){
        return new ArrayList<>(restaurants);
    }

    public Restaurant getRestaurant(int id){
        for (Restaurant r : restaurants) {
            if (r.getId() == id){
                return r;
            }
        }
        return null;
    }


    /*public ArrayList<Orders> getOrders(int userId){
        //return de orders daquele user.
    }*/
}

