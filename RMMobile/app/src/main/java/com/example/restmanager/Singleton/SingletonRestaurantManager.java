package com.example.restmanager.Singleton;

import android.content.Context;
import android.content.SharedPreferences;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.restmanager.DBHelper.RestManagerDBHelper;
import com.example.restmanager.Listeners.MenusListener;
import com.example.restmanager.Listeners.RestaurantsListener;
import com.example.restmanager.Listeners.ReviewListener;
import com.example.restmanager.Listeners.ReviewsListener;
import com.example.restmanager.Model.Login;
import com.example.restmanager.Model.Menu;
import com.example.restmanager.Model.OrderedMenu;
import com.example.restmanager.Model.Signup;
import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.Model.Review;
import com.example.restmanager.Model.User;
import com.example.restmanager.Utils.JsonParser;
import com.example.restmanager.Utils.Public;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

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
        restManagerDBHelper.addRestaurantDB(restaurant);
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
    public ArrayList<Review> getReviewsByRest(int id){
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

    public ArrayList<Review> getReviewsById(int $id){
        ArrayList<Review> userReviews = new ArrayList<>();

        reviews.forEach(review -> {
            if (review.getUserId() == $id)
                userReviews.add(review);
        });

        return userReviews;
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

    //region # USER #

    public void loginAPI(final Login login, final Context context, Response.Listener listener) {
        if (!JsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "--> No internet connection", Toast.LENGTH_SHORT).show();
        } else {
            StringRequest request = new StringRequest(Request.Method.POST, apiUrl + "/user/login", new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    System.out.println("---> String: " + response);
                    SharedPreferences sharedPreferences = context.getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
                    SharedPreferences.Editor editor = sharedPreferences.edit();

                    if (response.contains("Denied Access")) {
                        System.out.println("---> DA 1");
                    } else {
                        addUserBD(JsonParser.jsonLoginParser(response));
                        try {
                            System.out.println("---> Verify point - Check");
                            JSONObject jsonObject = new JSONObject(response);

                            System.out.println("---> JSONObject: " + jsonObject);

                            String token = jsonObject.getString("token");
                            System.out.println("---> Token from JSON: " + token);

                            editor.putString(Public.TOKEN, token);
                            editor.apply(); // Use apply() instead of commit()
                            System.out.println("---> Tokens: " + token + " | " + sharedPreferences.getString(Public.TOKEN, "0"));
                        } catch (JSONException e) {
                            throw new RuntimeException(e);
                        }
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    System.out.println("--> Login error: " + error.getMessage());
                }
            }) {
                protected Map<String, String> getParams() {
                    Map<String, String> params = new HashMap<>();
                    params.put("username", login.getUsername());
                    params.put("password", login.getPassword());
                    return params;
                }
            };
            volleyQueue.add(request);
        }
    }


    public void signupAPI(final Signup signup, final Context context){
        if (!JsonParser.isConnectionInternet(context)){
            Toast.makeText(context, "--> No internet conection", Toast.LENGTH_SHORT).show();
        }else{
            StringRequest request = new StringRequest(Request.Method.POST, apiUrl + "/user/signup", new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    System.out.println("--> " + response);

                    if (response.contains("Denied Access")){
                        System.out.println("--> DA 1");
                    }else{
                        try{
                            System.out.println("--> DA 2");
                            JSONObject jsonObject = new JSONObject(response);
                        } catch (JSONException e) {
                            throw new RuntimeException(e);
                        }
                    }

                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    System.out.println("--> Signup error: " + error.getMessage());
                }
            }){
                protected Map<String, String> getParams(){
                    System.out.println("--> DA 3");
                    Map<String, String> params = new HashMap<String, String>();
                    params.put("name", signup.getName());
                    params.put("username", signup.getUsername());
                    params.put("password", signup.getPassword());
                    params.put("email", signup.getEmail());
                    params.put("nif", signup.getNif()+"");
                    params.put("address", signup.getAddress());
                    params.put("door_number", signup.getDoorNumber());
                    params.put("postal_code", signup.getPostalCode());
                    return params;
                }
            };
            volleyQueue.add(request);
        }
    }

    public User getUserBD(final String token){
        ArrayList<User> users = restManagerDBHelper.getAllUsers();
        System.out.println("---> aquilo");
        for (User u : users) {
            if (u.getToken() == token)
                return u;
        }
        return null;
    }

    public void addUserBD(User l){
        restManagerDBHelper.deleteUsersTable();
        restManagerDBHelper.addUserDB(l);
    }

    public void logout(final Context context){
        SharedPreferences sharedPreferences = context.getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();

        editor.putString(Public.TOKEN, "TOKEN");
        editor.apply();
    }

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

