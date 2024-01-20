package com.example.restmanager.Utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import com.example.restmanager.Model.Menu;
import com.example.restmanager.Model.Order;
import com.example.restmanager.Model.OrderedMenu;
import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.Model.Review;
import com.example.restmanager.Model.Signup;
import com.example.restmanager.Model.User;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class JsonParser {

    /*Add jason parsers from API info*/

    public static boolean isConnectionInternet(Context context) {
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = cm.getActiveNetworkInfo();

        return networkInfo != null && networkInfo.isConnectedOrConnecting();
    }

    public static ArrayList<Restaurant> jsonRestaurantsParser(JSONArray response) {
        ArrayList<Restaurant> restaurants = new ArrayList<>();

        try {
            for (int i = 0; i < response.length(); i++) {
                JSONObject restaurant = (JSONObject) response.get(i);

                int idRest = restaurant.getInt("id");
                String nameRest = restaurant.getString("name");
                String addressRest = restaurant.getString("address");
                int nifRest = restaurant.getInt("nif");
                String email = restaurant.getString("email");
                int mobileNumberRest = restaurant.getInt("mobile_number");

                Restaurant rest = new Restaurant(idRest, nameRest, addressRest, nifRest, email, mobileNumberRest + "");

                restaurants.add(rest);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return restaurants;
    }

    public static ArrayList<Menu> jsonMenusParser(JSONArray response) {
        ArrayList<Menu> menus = new ArrayList<>();

        try {
            for (int i = 0; i < response.length(); i++) {
                JSONObject menu = (JSONObject) response.get(i);

                int idMenu = menu.getInt("id");
                String name = menu.getString("name");
                double price = menu.getDouble("price");
                int restId = menu.getInt("restaurant_id");

                Menu m = new Menu(idMenu, name, price, restId);
                menus.add(m);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return menus;
    }

    public static ArrayList<Review> jsonReviewsParser(JSONArray response) {
        ArrayList<Review> reviews = new ArrayList<>();

        try {
            for (int i = 0; i < response.length(); i++) {
                JSONObject review = (JSONObject) response.get(i);

                int idReview = review.getInt("id");
                int userID = review.getInt("user_id");
                int restID = review.getInt("restaurant_id");
                int stars = review.getInt("stars");
                String description = review.getString("description");

                Review r = new Review(idReview, userID, restID, stars, description);
                reviews.add(r);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return reviews;
    }


    public static User jsonLoginParser(String response) {//user
        User user = null;

        try {
            JSONObject login = new JSONObject(response);

            int id = login.getInt("id");
            //  int user_id = login.getInt("user_id");
            String name = login.getString("name");
            String email = login.getString("email");
            String username = login.getString("username");
            String address = login.getString("address");
            String door_number = login.getString("door_number");
            String postal_code = login.getString("postal_code");
            int nif = login.getInt("nif");
            String token = login.getString("token");

            user = new User(id, username, name, email, address, door_number, postal_code, nif, token);
        } catch (JSONException e) {
            throw new RuntimeException(e);
        }

        return user;
    }

    public static Signup jsonSignupParser(String response) {
        Signup user = null;

        try {
            JSONObject login = new JSONObject(response);

            int id = login.getInt("id");
            //  int user_id = login.getInt("user_id");
            String name = login.getString("name");
            String username = login.getString("username");
            String email = login.getString("email");
            String password = login.getString("password");
            String address = login.getString("address");
            String door_number = login.getString("door_number");
            String postal_code = login.getString("postal_code");
            int nif = login.getInt("nif");
            String token = login.getString("token");

            user = new Signup(name, username, email, password, nif, address, door_number, postal_code);
        } catch (JSONException e) {
            throw new RuntimeException(e);
        }

        return user;
    }

    /**
     * Converter pedidos de JSON para a Classe Order
     *
     * @param response Resposta em JSON com os Pedidos
     * @return Lista de Pedidos
     */
    public static ArrayList<Order> jsonOrdersParser(JSONArray response) {
        ArrayList<Order> orders = new ArrayList<>();

        try {
            for (int i = 0; i < response.length(); i++) {
                JSONObject orderObject = (JSONObject) response.get(i);

                int id = orderObject.getInt("id");
                int userId = orderObject.getInt("user_id");
                int restaurantId = orderObject.getInt("restaurant_id");
                float price = (float) orderObject.getDouble("price");
                int state = orderObject.getInt("state");

                Order order = new Order(id, userId, restaurantId, price, state);

                orders.add(order);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return orders;
    }

    /**
     * Converter pedidos de JSON para a Classe OrderedMenu
     *
     * @param response Resposta em JSON com os detalhes dos pedidos
     * @return Lista de dos detalhes dos Pedidos
     */
    public static ArrayList<OrderedMenu> jsonOrderedMenusParser(JSONArray response) {
        ArrayList<OrderedMenu> orderedMenus = new ArrayList<>();

        try {
            for (int i = 0; i < response.length(); i++) {
                JSONObject orderedMenuObject = (JSONObject) response.get(i);

                int id = orderedMenuObject.getInt("id");
                int menuId = orderedMenuObject.getInt("menu_id");
                int quantity = orderedMenuObject.getInt("quantity");
                int orderId = orderedMenuObject.getInt("order_id");

                OrderedMenu orderedMenu = new OrderedMenu(id, menuId, orderId, quantity);

                orderedMenus.add(orderedMenu);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return orderedMenus;
    }
}
