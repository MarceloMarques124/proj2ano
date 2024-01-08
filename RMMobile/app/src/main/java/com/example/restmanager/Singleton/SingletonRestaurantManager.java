package com.example.restmanager.Singleton;

import android.content.Context;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import com.example.restmanager.DBHelper.RestManagerDBHelper;
import com.example.restmanager.Listeners.MenusListener;
import com.example.restmanager.Listeners.RestaurantsListener;
import com.example.restmanager.Listeners.ReviewListener;
import com.example.restmanager.Listeners.ReviewsListener;
import com.example.restmanager.Model.Menu;
import com.example.restmanager.Model.OrderedMenu;
import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.Model.Review;
import com.example.restmanager.Utils.JsonParser;

import org.json.JSONArray;

import java.util.ArrayList;

public class SingletonRestaurantManager {

    //region # Restaurants variables #
    private ArrayList<Restaurant> restaurants;
    private RestManagerDBHelper restManagerDBHelper;
    private RestaurantsListener restaurantsListener;
    //endregion

    //region # Menus variables #
    private ArrayList<Menu> menus;
    private MenusListener menusListener;
    //endregion

    //region # Reviews variables #
    private ArrayList<Review> reviews;
    private ReviewsListener reviewsListener;
    //endregion

    //region # Constants #
    private static SingletonRestaurantManager instance = null;
    private static RequestQueue volleyQueue = null;
    private static final String apiUrl = "http://172.22.21.221:8080/api";
    //endregion

    private ArrayList<OrderedMenu> orderedMenus;
    public static synchronized SingletonRestaurantManager getInstance(Context context){
        if (instance == null){
            instance = new SingletonRestaurantManager(context);
            volleyQueue = Volley.newRequestQueue(context);
        }
        return instance;
    }

    public void setRestaurantsListener(RestaurantsListener restaurantsListener){
        this.restaurantsListener = restaurantsListener;
    }

    public void setMenusListener(MenusListener menusListener){
        this.menusListener = menusListener;
    }

    public void setReviewsListener(ReviewsListener reviewsListener){
        this.reviewsListener = reviewsListener;
    }

    public void setReviewListener(ReviewListener reviewListener){
    }

    private SingletonRestaurantManager(Context context) {
        generateDinamicData();
        restManagerDBHelper = new RestManagerDBHelper(context);
    }


    private void generateDinamicData() {
        restaurants = new ArrayList<>();
        menus = new ArrayList<>();
        orderedMenus = new ArrayList<>();
        reviews = new ArrayList<>();

        /*restaurants.add(new Restaurant(1, "AntiGona", "Rua da cona da tia que é prima", 222635245, "antigona@k.com", "234668994", R.drawable.coloredlogo));
        restaurants.add(new Restaurant(2, "Foda-se", "Rua da cona da tia que é prima", 222089755, "fuck@k.com", "234668998", R.drawable.coloredlogo));
        menus.add(new Menu(1, "Big Mc", "Pão, Carne de Porco, Alface, Picles, Tomate e Maionese", 5.9, 1));
        menus.add(new Menu(2, "MenuTeste", "Pão, Carne de Porco, Alface, Picles, Tomate e Maionese", 4, 2));
        menus.add(new Menu(3, "MenuTeste2", "Pão, Carne de Porco, Alface, Picles, Tomate e Maionese", 4, 2));
        menus.add(new Menu(4, "MenuTeste3", "Pão, Carne de Porco, Alface, Picles, Tomate e Maionese", 4, 2));
        menus.add(new Menu(5, "Big Mc11", "Pão, Carne de Porco, Alface, Picles, Tomate e Maionese", 8.9, 1));*/
    }

    //region # Restaurants Methods #
    public ArrayList<Restaurant> getRestaurantsDB(){
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

    public void getRestaurantsAPI(final Context context){
        if (!JsonParser.isConnectionInternet(context)){
            Toast.makeText(context, "--> No internet conection", Toast.LENGTH_SHORT).show();

            if (restaurantsListener != null){
                restaurantsListener.onRefreshRestaurantsList(restManagerDBHelper.getAllRestaurants());

            }
        }else{
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, apiUrl + "/restaurants", null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    System.out.println("-->" + response);
                    restaurants = JsonParser.jsonRestaurantsParser(response);
                    addRestaurantsDB(restaurants);


                    if (restaurantsListener != null) {
                        restaurantsListener.onRefreshRestaurantsList(restaurants);
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    System.out.println("--> Restaurants error: " + error);
                }
            });

            volleyQueue.add(request);
        }
    }

    public void addRestaurantsDB(ArrayList<Restaurant> restaurants){
        restManagerDBHelper.removeAllRestaurants();

        for(Restaurant r : restaurants){
            addRestaurantDB(r);
        }
    }

    public void addRestaurantDB(Restaurant restaurant){
        restManagerDBHelper.addBookDB(restaurant);
    }
    //endregion

    //region # Menus Methods #
    public ArrayList<Menu> getMenusDB(){
        return new ArrayList<>(menus);
    }

    public Menu getMenu(int id){
        for (Menu m : menus){
            if (m.getId() == id){
                return m;
            }
        }
        return null;
    }

    public ArrayList<Menu> getMenusById(int id){
        ArrayList<Menu> restMenus = new ArrayList<>();
        menus = this.getMenusDB();
        menus.forEach(menu -> {
            if (menu.getRestId() == id)
                restMenus.add(menu);
        });
        return restMenus;
    }

    public void getMenusAPI(final Context context){
        if (!JsonParser.isConnectionInternet(context)){

            if (menusListener != null){
                menusListener.onRefreshMenusList(restManagerDBHelper.getAllMenus());
            }
        }else {
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, apiUrl + "/menus", null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    System.out.println("aqui " + apiUrl);
                    menus = JsonParser.jsonMenusParser(response);
                    addMenusDB(menus);

                    if (menusListener != null) {
                        menusListener.onRefreshMenusList(menus);
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    System.out.println("--> Menus error: " + error);
                }
            });
            volleyQueue.add(request);
        }
    }

    public void addMenusDB(ArrayList<Menu> menus){
        restManagerDBHelper.removeAllmenus();

        for (Menu m : menus){
            addMenuDB(m);
        }
    }

    public void addMenuDB(Menu m){
        restManagerDBHelper.addMenu(m);
    }
    //endregion

    //region # Reviews Methods #
    public ArrayList<Review> getReviewsDB(int id){
        ArrayList<Review> restReviews = new ArrayList<>();

        reviews.forEach(review -> {
            if (review.getRestId() == id)
                restReviews.add(review);
        });

        return restReviews;
    }

    public Review getReview(int id){
        for (Review r : reviews){
            if (r.getId() == id){
                return r;
            }
        }
        return null;
    }

    public ArrayList<Review> getReviewByUser(int id){
        ArrayList<Review> userReviews = new ArrayList<>();
        for (Review r : reviews){
            if (r.getId() == id){
                userReviews.add(r);
            }
        }
        return userReviews;
    }

    public void getReviewsAPI(final Context context){
        if (!JsonParser.isConnectionInternet(context)){

            if (menusListener != null){
                menusListener.onRefreshMenusList(restManagerDBHelper.getAllMenus());
            }
        }else{
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, apiUrl + "/reviews", null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    reviews = JsonParser.jsonReviewsParser(response);
                    //addReviewsDB(reviews);

                    if (reviewsListener != null){
                        reviewsListener.onRefreshReviewsList(reviews);
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    System.out.println("--> Review error: " + error);
                }
            });

            volleyQueue.add(request);
        }
    }

    public void addReview(ArrayList<Review> reviews){
        restManagerDBHelper.removeAllReviews();

        for (Review r : reviews){
            addReviewDB(r);
        }
    }

    public void addReviewDB(Review r){
        restManagerDBHelper.addReview(r);
    }
    //endregion

    //region #  #
    //endregion

    //region #  #
    //endregion

    //region #  #
    //endregion

    public OrderedMenu getOrderedMenusByOrderId(int id){

        for (OrderedMenu ordered: orderedMenus) {
            if (ordered.getOrderId() == id)
                return ordered;
        }
        return null;
    }

    /*public ArrayList<Orders> getOrders(int userId){
        //return de orders daquele user.
    }*/
}

