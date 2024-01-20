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
import com.example.restmanager.Activities.RestaurantDetailsActivity;
import com.example.restmanager.DBHelper.RestManagerDBHelper;
import com.example.restmanager.Listeners.MenusListener;
import com.example.restmanager.Listeners.OrdersListener;
import com.example.restmanager.Listeners.ReservesListener;
import com.example.restmanager.Listeners.RestReviewsListener;
import com.example.restmanager.Listeners.RestaurantsListener;
import com.example.restmanager.Listeners.ReviewListener;
import com.example.restmanager.Listeners.ReviewsListener;
import com.example.restmanager.Listeners.ZonesListener;
import com.example.restmanager.Model.Login;
import com.example.restmanager.Model.Menu;
import com.example.restmanager.Model.Order;
import com.example.restmanager.Model.OrderedMenu;
import com.example.restmanager.Model.Reserve;
import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.Model.Review;
import com.example.restmanager.Model.Signup;
import com.example.restmanager.Model.User;
import com.example.restmanager.Model.Zone;
import com.example.restmanager.R;
import com.example.restmanager.Utils.JsonParser;
import com.example.restmanager.Utils.Public;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.IllegalFormatCodePointException;
import java.util.Map;
import java.util.Objects;

public class SingletonRestaurantManager {

    //region # Constants #
    private static SingletonRestaurantManager instance = null;
    private static RequestQueue volleyQueue = null;
    private static final String apiUrl = "http://172.22.21.221:8080/api";
    //endregion

    //region # Restaurants variables #
    private ArrayList<Restaurant> restaurants;
    private final RestManagerDBHelper restManagerDBHelper;
    private RestaurantsListener restaurantsListener;
    //endregion

    //region # Menus variables #
    private ArrayList<Menu> menus;
    private MenusListener menusListener;
    //endregion

    //region # Reviews variables #
    private ArrayList<Review> reviews;
    private ReviewsListener reviewsListener;
    private ReviewListener reviewListener;
    private RestReviewsListener restReviewsListener;
    //endregion

    //region # Zones variables#
    private ArrayList<Zone> zones;
    private ZonesListener zonesListener;

    //endregion

    //region # Zones variables#
    private ArrayList<Reserve> reserves;
    private ReservesListener reservesListener;

    //endregion

    //#region # Orders Variables #
    private ArrayList<Order> orders;
    private OrdersListener ordersListener;
    //#endregion # Orders Variables #

    private ArrayList<OrderedMenu> orderedMenus;

    public static synchronized SingletonRestaurantManager getInstance(Context context) {
        if (instance == null) {
            instance = new SingletonRestaurantManager(context);
            volleyQueue = Volley.newRequestQueue(context);
        }
        return instance;
    }

    //region # Listeners Setters #
    public void setZonesListener(ZonesListener zonesListener) {
        this.zonesListener = zonesListener;
    }

    public void setRestaurantsListener(RestaurantsListener restaurantsListener) {
        this.restaurantsListener = restaurantsListener;
    }

    public void setRestReviewsListener(RestReviewsListener restReviewsListener) {
        this.restReviewsListener = restReviewsListener;
    }

    public void setMenusListener(MenusListener menusListener) {
        this.menusListener = menusListener;
    }

    public void setReviewsListener(ReviewsListener reviewsListener) {
        this.reviewsListener = reviewsListener;
    }

    public void setReviewListener(ReviewListener reviewListener) {
        this.reviewListener = reviewListener;
    }

    public void setReservesListener(ReservesListener reservesListener) {
        this.reservesListener = reservesListener;
    }

    public void setOrdersListener(OrdersListener ordersListener) {
        this.ordersListener = ordersListener;
    }

    //endregion

    private SingletonRestaurantManager(Context context) {
        generateDinamicData(context);
        restManagerDBHelper = new RestManagerDBHelper(context);
    }

    private void generateDinamicData(Context context) {


        restaurants = new ArrayList<>();
        menus = new ArrayList<>();
        orderedMenus = new ArrayList<>();
        reviews = new ArrayList<>();
        zones = new ArrayList<>();
        reserves = new ArrayList<>();

    }

    //region # Restaurants Methods #
    public ArrayList<Restaurant> getRestaurantsDB() {
        return new ArrayList<>(restaurants);
    }

    public Restaurant getRestaurant(int id) {
        for (Restaurant r : restaurants) {
            if (r.getId() == id) {
                return r;
            }
        }
        return null;
    }

    public Restaurant getRestaurantByName(String name) {
        for (Restaurant r : restaurants) {
            System.out.println("---> r: " + r.getName() + "/" + name);
            if (Objects.equals(r.getName(), name)) {
                return r;
            }
        }
        return null;
    }

    public void getRestaurantsAPI(final Context context) {
        if (!JsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "--> No internet conection", Toast.LENGTH_SHORT).show();
            //carregar mesmo sem net!
            restaurants  = restManagerDBHelper.getAllRestaurants();


            if (restaurantsListener != null){
                restaurantsListener.onRefreshRestaurantsList(restaurants);
            }
        } else {
            SharedPreferences sharedPreferences = context.getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, sharedPreferences.getString(Public.IP, "http://172.22.21.221:8080/api") + "/restaurants", null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
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

    public void addRestaurantsDB(ArrayList<Restaurant> restaurants) {
        restManagerDBHelper.removeAllRestaurants();

        for (Restaurant r : restaurants) {
            addRestaurantDB(r);
        }
    }

    public void addRestaurantDB(Restaurant restaurant) {
        restManagerDBHelper.addRestaurantDB(restaurant);
    }
    //endregion

    //region # Menus Methods #
    public ArrayList<Menu> getMenusDB() {
        return new ArrayList<>(menus);
    }

    public Menu getMenu(int id) {
        for (Menu m : menus) {
            if (m.getId() == id) {
                return m;
            }
        }
        return null;
    }

    public ArrayList<Menu> getMenusById(int id) {
        ArrayList<Menu> restMenus = new ArrayList<>();
        menus = this.getMenusDB();
        menus.forEach(menu -> {
            if (menu.getRestId() == id)
                restMenus.add(menu);
        });
        return restMenus;
    }

    public void getMenusAPI(final Context context) {
        if (!JsonParser.isConnectionInternet(context)) {

            menus = restManagerDBHelper.getAllMenus();

            if (menusListener != null) {
                menusListener.onRefreshMenusList(menus);
            }
        } else {
            SharedPreferences sharedPreferences = context.getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, sharedPreferences.getString(Public.IP, "0") + "/menus", null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
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

    public void addMenusDB(ArrayList<Menu> menus) {
        restManagerDBHelper.removeAllmenus();

        for (Menu m : menus) {
            addMenuDB(m);
        }
    }

    public void addMenuDB(Menu m) {
        restManagerDBHelper.addMenu(m);
    }
    //endregion

    //region # Reviews Methods #
    public void getReviewsByRest(String name) {
        ArrayList<Review> restReviews = new ArrayList<>();

        reviews.forEach(review -> {
            if (review.getRestId() == name)
                restReviews.add(review);
        });
        if (restReviewsListener != null) {
            restReviewsListener.onRefreshReviewsList(restReviews);
        }
    }

    public Review getReviewById(int id) {
        for (Review r : reviews) {
            if (r.getId() == id) {
                return r;
            }
        }
        return null;
    }

    public ArrayList<Review> getReviewByUser(int id) {
        ArrayList<Review> userReviews = new ArrayList<>();
        for (Review r : reviews) {
            if (r.getId() == id) {
                userReviews.add(r);
            }
        }
        return userReviews;
    }

    public ArrayList<Review> getReviewsBD() {
        return reviews;
    }

    public void getReviewsAPI(final Context context) {
        if (!JsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, R.string.no_internet, Toast.LENGTH_SHORT).show();
            SharedPreferences sharedPreferences = context.getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
            User u = restManagerDBHelper.getAllUsers().get(1);
            ArrayList<Review> r = getReviewsByName(u.getName());

            if (reviewsListener != null)
                reviewsListener.onRefreshReviewsList(r);

        } else {
            SharedPreferences sharedPreferences = context.getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, sharedPreferences.getString(Public.IP, "0") + "/reviews", null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    System.out.println("---> ReviewsResponse: " + response);
                    reviews = JsonParser.jsonReviewsParser(response);
                    addReviewsDB(reviews);

                    if (reviewsListener != null) {
                        reviewsListener.onRefreshReviewsList(reviews);
                    }
                    System.out.println("---> Reviews: " + reviews);
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

    public ArrayList<Review> getReviewsByName(String name) {
        ArrayList<Review> userReviews = new ArrayList<>();

        System.out.println("---> name: " + name + "| reviews: " + reviews);

        reviews.forEach(review -> {
            if (Objects.equals(review.getUserId(), name)) {
                System.out.println("---> Review: " + review.getUserId());
                userReviews.add(review);
            }
        });
        if (restReviewsListener != null) {
            restReviewsListener.onRefreshReviewsList(userReviews);
        }

        return userReviews;
    }

    public void addReviewsDB(ArrayList<Review> reviews) {
        restManagerDBHelper.removeAllReviews();

        for (Review r : reviews) {
            addReviewDB(r);
        }
    }

    public void addReviewDB(Review r) {
        restManagerDBHelper.addReview(r);
    }

    public void editReviewDB(Review r) {
        restManagerDBHelper.editReview(r);
    }

    public void addReviewApi(final Review review, final Context context, String token) {
        if (!JsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, R.string.no_internet, Toast.LENGTH_SHORT).show();
        } else {

            SharedPreferences sharedPreferences = context.getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
            StringRequest req = new StringRequest(Request.Method.POST, sharedPreferences.getString(Public.IP, "0") + "/review/create", new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    addReviewDB(JsonParser.parserJsonReview(response));
                    if (reviewListener != null) {
                        reviewListener.onRefreshReviewDetails(RestaurantDetailsActivity.ADD);
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    System.out.println("---> error add api " + error.getMessage());
                }
            }) {
                protected Map<String, String> getParams() {
                    Restaurant rest = SingletonRestaurantManager.getInstance(context).getRestaurantByName(review.getRestId());
                    User u = SingletonRestaurantManager.getInstance(context).getUserBD(sharedPreferences.getString(Public.TOKEN, "0"));
                    Map<String, String> params = new HashMap<String, String>();
                    System.out.println("---> Review: " + u.getId() + "|" + review.getStars() + "|" + review.getDescription() + "|" + rest.getId());
                    params.put("user_id", "" + u.getId());
                    params.put("stars", "" + review.getStars());
                    params.put("description", "" + review.getDescription());
                    params.put("restaurant_id", "" + rest.getId());
                    return params;
                }
            };
            volleyQueue.add(req);
        }
    }

    public void editReviewAPI(final Review review, Context context) {
        if (!JsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, R.string.no_internet, Toast.LENGTH_SHORT).show();
        } else {

            SharedPreferences sharedPreferences = context.getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
            StringRequest req = new StringRequest(Request.Method.PUT, sharedPreferences.getString(Public.IP, "0") + "/review/edit/" + review.getId(), new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    editReviewDB(JsonParser.parserJsonReview(response));
                    if (reviewListener != null) {
                        reviewListener.onRefreshReviewDetails(RestaurantDetailsActivity.ADD);
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    System.out.println("---> error add api " + error.getMessage());
                }
            }) {
                protected Map<String, String> getParams() {
                    Restaurant rest = SingletonRestaurantManager.getInstance(context).getRestaurantByName(review.getRestId());
                    User u = SingletonRestaurantManager.getInstance(context).getUserBD(sharedPreferences.getString(Public.TOKEN, "0"));
                    Map<String, String> params = new HashMap<String, String>();
                    System.out.println("---> Review: " + u.getId() + "|" + review.getStars() + "|" + review.getDescription() + "|" + rest.getId());
                    params.put("user_id", "" + u.getId());
                    params.put("stars", "" + review.getStars());
                    params.put("description", "" + review.getDescription());
                    params.put("restaurant_id", "" + rest.getId());
                    return params;
                }
            };
            volleyQueue.add(req);
        }
    }
    //endregion

    //region # Zones Methods #

    public ArrayList<Zone> getZonesDB() {
        return new ArrayList<>(zones);
    }

    public void getZonesAPI(final Context context, int id) {
        if (!JsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, R.string.no_internet, Toast.LENGTH_SHORT).show();

            zones = restManagerDBHelper.getAllZones();

            zonesListener.onRefreshZonesListener(zones);

        } else {
            SharedPreferences sharedPreferences = context.getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, sharedPreferences.getString(Public.IP, "0") + "/zones/zonesbyrest/" + id, null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {

                    zones = JsonParser.jsonZonesParser(response);
                    addZonesDB(JsonParser.jsonZonesParser(response));
                    if (zonesListener != null) {
                        zonesListener.onRefreshZonesListener(zones);
                    }
                    System.out.println("---> Zones: " + zones);

                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    System.out.println("---> Zones error" + error.getMessage());
                }
            });
            volleyQueue.add(request);
        }
    }

    public void addZonesDB(ArrayList<Zone> zones) {
        restManagerDBHelper.removeAllZones();

        for (Zone z : zones) {
            addZoneDB(z);
        }
    }

    public void addZoneDB(Zone z) {
        restManagerDBHelper.addZone(z);
    }

    public ArrayList<Zone> getZonesBD() {
        return zones;
    }
    //endregion

    //region # Orders #

    /**
     * Receber todos os Pedidos TakeAway da API e colocar na base de dados local
     *
     * @param context
     */
    public void getTakeAwayOrdersAPI(final Context context) {

        if (!JsonParser.isConnectionInternet(context) && ordersListener != null) {
            ordersListener.onRefreshTakeAwayOrdersList(restManagerDBHelper.getAllOrders());
            orders = restManagerDBHelper.getAllOrders();

            ordersListener.onRefreshOrderedMenusList(orderedMenus);
        }

        JsonArrayRequest requestOrders = new JsonArrayRequest(Request.Method.GET, apiUrl + "/orders", null,
                response -> {
                    orders = JsonParser.jsonOrdersParser(response);

                    addOrdersDB(orders);
                    onRequestsCompleted();
                },
                error -> System.out.println("--> Restaurants error: " + error));


        JsonArrayRequest requestOrderedMenus = new JsonArrayRequest(Request.Method.GET, apiUrl + "/orderedmenus", null,
                response -> {
                    orderedMenus = JsonParser.jsonOrderedMenusParser(response);

                    addOrderedMenusDB(orderedMenus);
                    onRequestsCompleted();
                },
                error -> System.out.println("--> OrderedMenus error: " + error));

        volleyQueue.add(requestOrders);
        volleyQueue.add(requestOrderedMenus);
    }

    int completedRequestsCount = 0;

    private void onRequestsCompleted() {
        completedRequestsCount++;

        if (completedRequestsCount == 2) {

            if (ordersListener != null) {
                ordersListener.onRefreshTakeAwayOrdersList(orders);
            }
            completedRequestsCount = 0;
        }
    }

    /**
     * Limpar todos os Pedidos e Adicionar pedidos a base de dados
     *
     * @param orders
     */
    public void addOrdersDB(ArrayList<Order> orders) {
        restManagerDBHelper.removeAllOrders();

        orders.forEach(order -> addOrderDB(order));
    }

    /**
     * Adicionar pedido a base de dados
     *
     * @param order Pedido a Adicionar
     */
    public void addOrderDB(Order order) {
        restManagerDBHelper.addOrderDB(order);
    }

    public ArrayList<Order> getOrdersDB() {
        return new ArrayList<>(orders);
    }

    //endregion # Orders #

    //#region # OrderedMenus #


    public void getOrderedMenusAPI(final Context context) {

        if (!JsonParser.isConnectionInternet(context) && ordersListener != null) {
            ordersListener.onRefreshOrderedMenusList(restManagerDBHelper.getAllOrderedMenus());
            return;
        }

        JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, apiUrl + "/orderedmenus", null,
                response -> {
                    orderedMenus = JsonParser.jsonOrderedMenusParser(response);

                    addOrderedMenusDB(orderedMenus);

                    if (ordersListener != null) {
                        ordersListener.onRefreshOrderedMenusList(orderedMenus);
                    }
                },
                error -> System.out.println("--> OrderedMenus error: " + error));

        volleyQueue.add(request);
    }

    public void addOrderedMenusDB(ArrayList<OrderedMenu> orderedMenus) {
        restManagerDBHelper.removeAllOrders();

        orderedMenus.forEach(orderedMenu -> addOrderedMenuDB(orderedMenu));
    }

    public void addOrderedMenuDB(OrderedMenu orderedMenu) {
        restManagerDBHelper.addOrderedMenuDB(orderedMenu);
    }

    public ArrayList<OrderedMenu> getOrderedMenusDB() {
        return orderedMenus != null && orderedMenus.size() > 0 ? new ArrayList<>(orderedMenus) : null;
    }

    //endregion # OrderedMenus #

    //region # User Methods #

    public void loginAPI(final Login login, final Context context, Response.Listener listener, Response.ErrorListener errorListener) {
        if (!JsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "--> No internet connection", Toast.LENGTH_SHORT).show();
        } else {
            SharedPreferences sharedPreferences = context.getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
            StringRequest request = new StringRequest(Request.Method.POST, sharedPreferences.getString(Public.IP, "0") + "/users/login", new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    SharedPreferences sharedPreferences = context.getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
                    SharedPreferences.Editor editor = sharedPreferences.edit();

                    if (response.contains("Denied Access")) {
                        System.out.println("---> DA 1");
                        editor.putString(Public.TOKEN, "TOKEN");

                        editor.apply(); // Use apply() instead of commit()
                    } else {
                        addUserBD(JsonParser.jsonLoginParser(response));
                        try {
                            JSONObject jsonObject = new JSONObject(response);

                            String token = jsonObject.getString("token");

                            editor.putString(Public.TOKEN, token);
                            editor.apply(); // Use apply() instead of commit()
                        } catch (JSONException e) {
                            throw new RuntimeException(e);
                        }
                        listener.onResponse(response);
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    System.out.println("--> Login error: " + error.getMessage());
                    errorListener.onErrorResponse(error);
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


    public void signupAPI(final Signup signup, final Context context) {
        if (!JsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "--> No internet conection", Toast.LENGTH_SHORT).show();
        } else {
            SharedPreferences sharedPreferences = context.getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
            StringRequest request = new StringRequest(Request.Method.POST, sharedPreferences.getString(Public.IP, "0") + "/user/signup", new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    System.out.println("--> " + response);

                    if (response.contains("Denied Access")) {
                        System.out.println("--> DA 1");
                    } else {
                        try {
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
            }) {
                protected Map<String, String> getParams() {
                    System.out.println("--> DA 3");
                    Map<String, String> params = new HashMap<String, String>();
                    params.put("name", signup.getName());
                    params.put("username", signup.getUsername());
                    params.put("password", signup.getPassword());
                    params.put("email", signup.getEmail());
                    params.put("nif", signup.getNif() + "");
                    params.put("address", signup.getAddress());
                    params.put("door_number", signup.getDoorNumber());
                    params.put("postal_code", signup.getPostalCode());
                    return params;
                }
            };
            volleyQueue.add(request);
        }
    }

    public void editUserAPI(final User user, Context context, Response.Listener listener) {
        if (!JsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "No Internet Connection", Toast.LENGTH_SHORT).show();
        } else {
            SharedPreferences sharedPreferences = context.getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
            StringRequest request = new StringRequest(Request.Method.PUT, sharedPreferences.getString(Public.IP, "0") + "/users/edit/" + user.getId(), new Response.Listener<String>() {

                @Override
                public void onResponse(String response) {
                    System.out.println("---> Deu fixe");
                    Toast.makeText(context, "dpo+dsjf", Toast.LENGTH_SHORT).show();
                    editUserBD(user);
                    listener.onResponse(response);
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    System.out.println("---> Error editing book (API Singleton method): " + error.getMessage());
                }
            }) {
                protected Map<String, String> getParams() {
                    System.out.println("--> DA 3");
                    Map<String, String> params = new HashMap<String, String>();
                    params.put("id", user.getId() + "");
                    params.put("name", user.getName());
                    params.put("username", user.getUsername());
                    params.put("email", user.getEmail());
                    params.put("nif", user.getNif() + "");
                    params.put("address", user.getAddress());
                    params.put("door_number", user.getDoorNumber());
                    params.put("postal_code", user.getPostalCode());
                    return params;
                }
            };
            volleyQueue.add(request);
        }
    }

    public User getUserBD(final String token) {


        ArrayList<User> users = restManagerDBHelper.getAllUsers();
        for (User u : users) {
            if (u != null)
                System.out.println("---> TOKEN (From u): " + u.getId());

            if (Objects.equals(u.getToken(), token))
                return u;
        }
        return null;
    }

    public void addUserBD(User l) {
        restManagerDBHelper.deleteUsersTable();
        restManagerDBHelper.addUserDB(l);
    }

    public void editUserBD(User u) {
        restManagerDBHelper.editUserDB(u);
    }


    public void logout(final Context context) {
        SharedPreferences sharedPreferences = context.getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();

        editor.putString(Public.TOKEN, "TOKEN");
        editor.apply();
    }

    //endregion

    //region # Reserves Methods #
    public void getReservesAPI(final Context context) {
        if (!JsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, R.string.no_internet, Toast.LENGTH_SHORT).show();


        } else {
            SharedPreferences sharedPreferences = context.getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
            String token = sharedPreferences.getString(Public.TOKEN, "token");
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, sharedPreferences.getString(Public.IP, "0") + "/reserves", null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    reserves = JsonParser.jsonReservesParser(response);
                    addReservesDB(reserves);

                    if (reservesListener != null) {
                        reservesListener.onRefreshReservesList(reserves);
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    System.out.println("--> Review error: " + error);
                }
            }) {
                protected Map<String, String> getParams() {
                    Map<String, String> params = new HashMap<>();
                    params.put("token", token);
                    return params;
                }
            };
        }
    }

    public void addReserveAPI(Reserve reserve, Context context){
        if (!JsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, R.string.no_internet, Toast.LENGTH_SHORT).show();


        } else {
            SharedPreferences sharedPreferences = context.getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
            String token = sharedPreferences.getString(Public.TOKEN, "token");
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.POST, sharedPreferences.getString(Public.IP, "0") + "/reserves/create", null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    reserves = JsonParser.jsonReservesParser(response);
                    addReservesDB(reserves);

                    if (reservesListener != null) {
                        reservesListener.onRefreshReservesList(reserves);
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    System.out.println("--> Review error: " + error);
                }
            }) {
                protected Map<String, String> getParams() {
                    Map<String, String> params = new HashMap<>();

                    User u = SingletonRestaurantManager.instance.getUserBD(token);
                    Restaurant r = SingletonRestaurantManager.instance.getRestaurantByName(reserve.getRestId());
                    Zone z = SingletonRestaurantManager.instance.getZone(reserve.getZone());
                    reserve.setTablesNumber(reserve.getPeopleNumber()/4);
                    params.put("tables_number", reserve.getTablesNumber());
                    params.put("date_time", reserve.getDate() + reserve.getTime()+"");
                    params.put("people_number", reserve.getPeopleNumber()+"");
                    params.put("remarks", reserve.getRemarks());
                    params.put("user_id", u.getId()+"");
                    params.put("restaurant_id", r.getId()+"");
                    params.put("zone_id", z.getId()+"");
                    return params;
                }
            };
        }
    }

    private Zone getZone(int zone) {
        for(Zone z : zones){
            if (z.getId() == zone){
                return z;
            }
        }
        return null;
    }

    public void addReservesDB(ArrayList<Reserve> reserves) {
        restManagerDBHelper.removeAllReserves();

        for (Reserve r : reserves) {
            addReserveDB(r);
        }
    }

    public void addReserveDB(Reserve r) {
        System.out.println("---> R.ID: " + r.getUserId());
        restManagerDBHelper.addReserve(r);
    }

    //endregion

    public OrderedMenu getOrderedMenusByOrderId(int id) {

        for (OrderedMenu ordered : orderedMenus) {
            if (ordered.getOrderId() == id)
                return ordered;
        }
        return null;
    }

    /*public ArrayList<Orders> getOrders(int userId){
        //return de orders daquele user.
    }*/
}

