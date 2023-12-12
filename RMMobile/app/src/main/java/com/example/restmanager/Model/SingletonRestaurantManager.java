package com.example.restmanager.Model;

import android.content.Context;

import com.example.restmanager.R;

import java.util.ArrayList;

public class SingletonRestaurantManager {
    private ArrayList<Restaurant> restaurants;
    private static SingletonRestaurantManager instance = null;

    public static synchronized SingletonRestaurantManager getInstance(Context context){
        if (instance == null)
            instance = new SingletonRestaurantManager(context);
        return instance;
    }

    private SingletonRestaurantManager(Context context) {
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

