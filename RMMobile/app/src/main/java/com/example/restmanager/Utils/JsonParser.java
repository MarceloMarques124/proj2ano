package com.example.restmanager.Utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class JsonParser {

    /*Add jason parsers from API info*/

    public static boolean isConnectionInternet(Context context){
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = cm.getActiveNetworkInfo();

        return networkInfo != null && networkInfo.isConnectedOrConnecting();

    }

    public static ArrayList<Restaurant> jsonRestaurantsParser(JSONArray response){
        ArrayList<Restaurant> restaurants = new ArrayList<>();

        try{
            for(int i = 0; i<response.length(); i++){
                JSONObject restaurant = (JSONObject) response.get(i);

                int idRest = restaurant.getInt("id");
                String nameRest = restaurant.getString("name");
                String addressRest = restaurant.getString("address");
                int nifRest = restaurant.getInt("nif");
                String email = restaurant.getString("email");
                int mobileNumberRest = restaurant.getInt("mobile_number");

                Restaurant rest = new Restaurant(idRest, nameRest, addressRest, nifRest, email, mobileNumberRest+"");
            }
        }catch (JSONException e){
            e.printStackTrace();
        }
        return restaurants;
    }

}
