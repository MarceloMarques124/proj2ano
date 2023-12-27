package com.example.restmanager.Model;

import android.content.Context;

import com.example.restmanager.R;

import java.util.ArrayList;

public class SingletonRestaurantManager {
    private ArrayList<Restaurant> restaurants;
    private ArrayList<Menu> menus;
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
        menus = new ArrayList<>();

        restaurants.add(new Restaurant(1, "AntiGona", "Rua da cona da tia que é prima", 222635245, "antigona@k.com", "234668994", R.drawable.coloredlogo));
        restaurants.add(new Restaurant(2, "Foda-se", "Rua da cona da tia que é prima", 222089755, "fuck@k.com", "234668998", R.drawable.coloredlogo));
        menus.add(new Menu(1, "Big Mc", "Pão, Carne de Porco, Alface, Picles, Tomate e Maionese", 5.9, 1));
        menus.add(new Menu(2, "MenuTeste", "Pão, Carne de Porco, Alface, Picles, Tomate e Maionese", 4, 2));
        menus.add(new Menu(3, "MenuTeste2", "Pão, Carne de Porco, Alface, Picles, Tomate e Maionese", 4, 2));
        menus.add(new Menu(4, "MenuTeste3", "Pão, Carne de Porco, Alface, Picles, Tomate e Maionese", 4, 2));
        menus.add(new Menu(5, "Big Mc11", "Pão, Carne de Porco, Alface, Picles, Tomate e Maionese", 8.9, 1));
    }

    public ArrayList<Restaurant> getRestaurants(){
        return new ArrayList<>(restaurants);
    }
    public ArrayList<Menu> getMenus(){
        return new ArrayList<>(menus);
    }

    public ArrayList<Menu> getMenusById(int id){
        ArrayList<Menu> restMenus = new ArrayList<>();

        menus.forEach(menu -> {
            if (menu.getRestId() == id)
                restMenus.add(menu);
        });
        return restMenus;
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

