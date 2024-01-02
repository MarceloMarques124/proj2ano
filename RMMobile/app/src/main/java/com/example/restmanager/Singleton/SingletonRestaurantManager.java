package com.example.restmanager.Singleton;

import android.content.Context;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.example.restmanager.DBHelper.RestaurantDBHelper;
import com.example.restmanager.Listeners.RestaurantsListener;
import com.example.restmanager.Model.Menu;
import com.example.restmanager.Model.OrderedMenu;
import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.Model.Review;
import com.example.restmanager.Utils.JsonParser;

import org.json.JSONArray;

import java.util.ArrayList;

public class SingletonRestaurantManager {
    private ArrayList<Restaurant> restaurants;
    private RestaurantDBHelper restaurantDBHelper;
    private RestaurantsListener restaurantsListener;
    private ArrayList<OrderedMenu> orderedMenus;
    private ArrayList<Menu> menus;
    private ArrayList<Review> reviews;
    private static SingletonRestaurantManager instance = null;
    private static RequestQueue volleyQueue = null;
    private static String apiUrl = "172.22.21.221:8080/api";

    public static synchronized SingletonRestaurantManager getInstance(Context context){
        if (instance == null)
            instance = new SingletonRestaurantManager(context);
        return instance;
    }

    public void setRestaurantsListener(RestaurantsListener restaurantsListener){
        this.restaurantsListener = restaurantsListener;
    }

    private SingletonRestaurantManager(Context context) {
        generateDinamicData();
        restaurantDBHelper = new RestaurantDBHelper(context);
    }

    private void generateDinamicData() {
        restaurants = new ArrayList<>();
        menus = new ArrayList<>();
        orderedMenus = new ArrayList<>();

        //restaurants.add(new Restaurant(1, "AntiGona", "Rua da cona da tia que é prima", 222635245, "antigona@k.com", "234668994", R.drawable.coloredlogo));
        //restaurants.add(new Restaurant(2, "Foda-se", "Rua da cona da tia que é prima", 222089755, "fuck@k.com", "234668998", R.drawable.coloredlogo));
        menus.add(new Menu(1, "Big Mc", "Pão, Carne de Porco, Alface, Picles, Tomate e Maionese", 5.9, 1));
        menus.add(new Menu(2, "MenuTeste", "Pão, Carne de Porco, Alface, Picles, Tomate e Maionese", 4, 2));
        menus.add(new Menu(3, "MenuTeste2", "Pão, Carne de Porco, Alface, Picles, Tomate e Maionese", 4, 2));
        menus.add(new Menu(4, "MenuTeste3", "Pão, Carne de Porco, Alface, Picles, Tomate e Maionese", 4, 2));
        menus.add(new Menu(5, "Big Mc11", "Pão, Carne de Porco, Alface, Picles, Tomate e Maionese", 8.9, 1));
    }

    public ArrayList<Restaurant> getRestaurantsDB(){
        return new ArrayList<>(restaurants);
    }

    public void getRestaurantsAPI(final Context context){
        if (!JsonParser.isConnectionInternet(context)){
            Toast.makeText(context, "No internet conection", Toast.LENGTH_SHORT).show();

            if (restaurantsListener != null){
                restaurantsListener.onRefreshRestaurantsList(restaurantDBHelper.getAllRestaurants());
            }
        }else{
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, apiUrl + "/restaurants", null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    restaurants = JsonParser.jsonRestaurantsParser(response);

                    if (restaurantsListener != null) {
                        restaurantsListener.onRefreshRestaurantsList(restaurants);
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    System.out.println("--> Erro de apito");
                }
            });

            volleyQueue.add(request);
        }
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


    public OrderedMenu getOrderedMenusByOrderId(int id){

        for (OrderedMenu ordered: orderedMenus) {
            if (ordered.getOrderId() == id)
                return ordered;
        }
        return null;
    }
    public ArrayList<Review> getReviews(int id){
        ArrayList<Review> restReviews = new ArrayList<>();

        reviews.forEach(review -> {
            if (review.getRestId() == id)
                restReviews.add(review);
        });

        return restReviews;
    }

    /*public ArrayList<Orders> getOrders(int userId){
        //return de orders daquele user.
    }*/
}

