package com.example.restmanager.DBHelper;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import com.example.restmanager.Model.Menu;
import com.example.restmanager.Model.Order;
import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.Model.Review;
import com.example.restmanager.Model.User;

import java.util.ArrayList;

public class RestManagerDBHelper extends SQLiteOpenHelper {

    //region # VARIABLES #
    private static final String DB_NAME = "dbrestmanager";
    private static final int DB_VERSION = 1;
    private final SQLiteDatabase db;
    private static final String TABLE_MENU = "menus";
    private static final String TABLE_MENU_ITEMS = "menuitems";
    private static final String TABLE_ORDER = "orders";
    private static final String TABLE_ORDERED_MENU = "orderedmenus";
    private static final String TABLE_RESERVATION = "reservations";
    private static final String TABLE_RESTAURANT = "restaurants";
    private static final String TABLE_REVIEW = "reviews";
    private static final String TABLE_TABLE = "tables";
    private static final String TABLE_USER = "users";
    private static final String TABLE_ZONE = "zones";
    private static final String TABLE_SIGNUP = "signup";
    private static final String ID = "id";
    private static final String TOKEN = "token";
    private static final String NAME = "name";
    private static final String ADDRESS = "address";
    private static final String NIF = "nif";
    private static final String EMAIL = "email";
    private static final String MOBILE_NUMBER = "mobile_number";
    private static final String PRICE = "price";
    private static final String REST_ID = "rest_id";
    private static final String MENU_ID = "menu_id";
    private static final String USER_ID = "user_id";
    private static final String STATUS = "status";
    private static final String IMG_COVER = "img_cover";
    private static final String STARS = "stars";
    private static final String DESCRIPTION = "description";
    private static final String ORDER_ID = "order_id";
    private static final String CAPACITY = "capacity";
    private static final String QUANTITY = "quantity";
    private static final String USERNAME = "username";
    private static final String DOOR_NUMBER = "door_number";
    private static final String POSTAL_CODE = "postal_code";
    private static final String PASSWORD = "password";
    private static final String DATE = "date";
    private static final String TIME = "time";
    private static final String REMARKS = "remarks";
    private static final String PEOPLE_NUMBER = "people_number";
    private static final String TABLES_NUMBER = "tables_number";
    //endregion

    //region # SQLiteOpenHelper METHODS #
    public RestManagerDBHelper(Context context) {
        super(context, DB_NAME, null, DB_VERSION);
        this.db = this.getWritableDatabase();
    }


    @Override
    public void onCreate(SQLiteDatabase db) {
        db.execSQL(createMenusTable());
        db.execSQL(createMenuItemsTable());
        db.execSQL(createOrdersTable());
        db.execSQL(createOrderedMenusTable());
        db.execSQL(createRestaurantsTable());
        db.execSQL(createReviewsTable());
        db.execSQL(createTablesTable());
        db.execSQL(createUsersTable());
        db.execSQL(createReservationsTable());
        db.execSQL(createZonesTable());
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL(deleteMenusTable());
        db.execSQL(deleteMenuItemsTable());
        db.execSQL(deleteOrdersTable());
        db.execSQL(deleteOrderedMenusTable());
        db.execSQL(deleteRestaurantsTable());
        db.execSQL(deleteReviewsTable());
        db.execSQL(deleteTablesTable());
        db.execSQL(deleteUsersTable());
        db.execSQL(deleteReservationsTable());
        db.execSQL(deleteZonesTable());
        this.onCreate(db);

    }
    //endregion

    //region # MENU DB METHODS #

    public String createMenusTable() {
        return "CREATE TABLE " + TABLE_MENU + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                NAME + " TEXT NOT NULL, " +
                PRICE + " DECIMAL NOT NULL, " +
                REST_ID + " INTEGER NOT NULL" +
                ");";
    }

    public String deleteMenusTable() {
        return "DROP TABLE IF EXISTS" + TABLE_MENU;
    }

    public ArrayList<Menu> getAllMenus() {
        ArrayList<Menu> menus = new ArrayList<>();
        Cursor cursor = this.db.query(TABLE_MENU, new String[]{ID, NAME, PRICE, REST_ID}, null, null, null, null, null);

        if (cursor.moveToNext()) {
            do {
                Menu menu = new Menu(
                        cursor.getInt(0),
                        cursor.getString(1),
                        cursor.getDouble(2),
                        cursor.getInt(3)
                );
                menus.add(menu);
            } while (cursor.moveToNext());
            cursor.close();

        }
        return menus;
    }

    public void addMenu(Menu m) {
        ContentValues values = new ContentValues();

        values.put(NAME, m.getName());
        values.put(PRICE, m.getPrice());
        values.put(REST_ID, m.getRestId());

        this.db.insert(TABLE_MENU, null, values);
    }

    public void removeAllmenus() {
//        this.db.delete(TABLE_MENU, null, null);
    }

    //endregion

    //region # MENU_ITEM DB METHODS #

    public String createMenuItemsTable() {
        return "CREATE TABLE " + TABLE_MENU_ITEMS + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                NAME + " TEXT NOT NULL, " +
                MENU_ID + " INTEGER NOT NULL, " +
                PRICE + " REAL NOT NULL" +
                ");";
    }

    public String deleteMenuItemsTable() {
        return "DROP TABLE IF EXISTS " + TABLE_MENU_ITEMS;
    }

    //endregion

    //region # ORDER DB METHODS #

    public String createOrdersTable() {
        return "CREATE TABLE " + TABLE_ORDER + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                USER_ID + " INTEGER NOT NULL, " +
                REST_ID + " INTEGER NOT NULL, " +
                PRICE + " INTEGER NOT NULL, " +
                STATUS + " TEXT NOT NULL" +
                ");";
    }

    public String deleteOrdersTable() {
        return "DROP TABLE IF EXISTS " + TABLE_ORDER;
    }

    //endregion

    //region # ORDERED_MENU DB METHODS #

    public String createOrderedMenusTable() {
        return "CREATE TABLE " + TABLE_ORDERED_MENU + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                MENU_ID + " INTEGER NOT NULL, " +
                QUANTITY + " INTEGER NOT NULL, " +
                ORDER_ID + " INTEGER NOT NULL" +
                ");";
    }

    public String deleteOrderedMenusTable() {
        return "DROP TABLE IF EXISTS " + TABLE_ORDERED_MENU;
    }

    //endregion

    //region # RESERVATION DB METHODS #

    public String createReservationsTable() {
        return "CREATE TABLE " + TABLE_RESERVATION + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                USER_ID + " INTEGER NOT NULL, " +
                DATE + " TEXT NOT NULL, " +
                TIME + " TEXT NOT NULL, " +
                REMARKS + " TEXT, " +
                REST_ID + " INTEGER NOT NULL, " +
                PEOPLE_NUMBER + " INTEGER NOT NULL, " +
                TABLES_NUMBER + " INTEGER NOT NULL" +
                ");";
    }

    public String deleteReservationsTable() {
        return "DROP TABLE IF EXISTS " + TABLE_RESERVATION;
    }


    //endregion

    //region # RESTAURANT DB METHODS #

    public String createRestaurantsTable() {
        return "CREATE TABLE " + TABLE_RESTAURANT + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                NAME + " TEXT NOT NULL, " +
                ADDRESS + " TEXT NOT NULL, " +
                NIF + " INTEGER NOT NULL, " +
                EMAIL + " TEXT NOT NULL, " +
                MOBILE_NUMBER + " TEXT NOT NULL, " +
                IMG_COVER + " INTEGER" +
                ");";

    }

    public String deleteRestaurantsTable() {
        return "DROP TABLE IF EXISTS " + TABLE_RESTAURANT;
    }

    public ArrayList<Restaurant> getAllRestaurants() {
        ArrayList<Restaurant> restaurants = new ArrayList<>();
        Cursor cursor = this.db.query(TABLE_RESTAURANT, new String[]{ID, NAME, ADDRESS, NIF, EMAIL, MOBILE_NUMBER, IMG_COVER}, null,
                null, null, null, null);

        if (cursor.moveToFirst()) {
            do {
                Restaurant restaurant = new Restaurant(
                        cursor.getInt(0),
                        cursor.getString(1),
                        cursor.getString(2),
                        cursor.getInt(3),
                        cursor.getString(4),
                        cursor.getString(5)/*,
                              cursor.getString(6)*/);
                restaurants.add(restaurant);
            } while (cursor.moveToNext());
            cursor.close();
        }
        return restaurants;
    }

    public void addRestaurantDB(Restaurant r) {
        ContentValues values = new ContentValues();

        values.put(NAME, r.getName());
        values.put(ADDRESS, r.getAddress());
        values.put(NIF, r.getNif());
        values.put(EMAIL, r.getEmail());
        values.put(MOBILE_NUMBER, r.getMobileNumber());

        this.db.insert(TABLE_RESTAURANT, null, values);
        System.out.println("---> VALUES: " + values);
    }

    public void removeAllRestaurants() {
        this.db.delete(TABLE_RESTAURANT, null, null);
    }

    //endregion

    //region # REVIEW DB METHODS #

    public String createReviewsTable() {
        return "CREATE TABLE " + TABLE_REVIEW + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                USER_ID + " INTEGER NOT NULL, " +
                REST_ID + " INTEGER NOT NULL, " +
                STARS + " INTEGER NOT NULL, " +
                DESCRIPTION + " TEXT NOT NULL" +
                ");";
    }

    public String deleteReviewsTable() {
        return "DROP TABLE IF EXISTS " + TABLE_REVIEW;
    }

    public void addReview(Review r) {
        ContentValues values = new ContentValues();

        values.put(USER_ID, r.getUserId());
        values.put(REST_ID, r.getRestId());
        values.put(STARS, r.getStars());
        values.put(DESCRIPTION, r.getDescription());

        this.db.insert(TABLE_REVIEW, null, values);
    }

    public boolean editReview(Review r) {
        ContentValues values = new ContentValues();

        values.put(USER_ID, r.getUserId());
        values.put(REST_ID, r.getRestId());
        values.put(STARS, r.getStars());
        values.put(DESCRIPTION, r.getDescription());

        return this.db.update(TABLE_REVIEW, values, ID + "= ?", new String[]{"" + r.getId()}) > 0;
    }

    public void removeAllReviews() {
        this.db.delete(TABLE_REVIEW, null, null);
    }

    public boolean removeReview(int id) {
        return (this.db.delete(TABLE_REVIEW, ID + "= ?", new String[]{"" + id}) == 1);
    }

    //endregion

    //region # TABLE DB METHODS #

    public String createTablesTable() {
        return "CREATE TABLE " + TABLE_TABLE + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                DESCRIPTION + " TEXT NOT NULL, " +
                CAPACITY + " INTEGER NOT NULL" +
                ");";
    }

    public String deleteTablesTable() {
        return "DROP TABLE IF EXISTS " + TABLE_TABLE;
    }

    //endregion

    //region # USER DB METHODS #

    public String createUsersTable() {
        return "CREATE TABLE " + TABLE_USER + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                USERNAME + " TEXT NOT NULL, " +
                NAME + " TEXT NOT NULL, " +
                ADDRESS + " TEXT NOT NULL, " +
                DOOR_NUMBER + " TEXT NOT NULL, " +
                POSTAL_CODE + " TEXT NOT NULL, " +
                NIF + " INTEGER NOT NULL, " +
                EMAIL + " TEXT NOT NULL, " +
                TOKEN + " TEXT NOT NULL" +
                ");";
    }

    public void addUserDB(User u) {


        ContentValues values = new ContentValues();
        values.put(USERNAME, u.getUsername());
        values.put(NAME, u.getName());
        values.put(EMAIL, u.getEmail());
        values.put(USERNAME, u.getUsername());
        values.put(ADDRESS, u.getAddress());
        values.put(DOOR_NUMBER, u.getDoorNumber());
        values.put(POSTAL_CODE, u.getPostalCode());
        values.put(NIF, u.getNif());
        values.put(TOKEN, u.getToken());

        System.out.println("---> VALUES: " + values);

        this.db.insert(TABLE_USER, null, values);
    }

    public String deleteUsersTable() {
        return "DROP TABLE IF EXISTS " + TABLE_USER;
    }

    public ArrayList<User> getAllUsers() {
        ArrayList<User> users = new ArrayList<>();
        Cursor cursor = this.db.query(TABLE_USER, new String[]{ID, USERNAME, NAME, EMAIL, ADDRESS, DOOR_NUMBER, POSTAL_CODE, NIF, TOKEN}, null,
                null, null, null, null);

        if (cursor.moveToFirst()) {
            do {
                User auxu = new User(
                        cursor.getInt(0),
                        cursor.getString(1),
                        cursor.getString(2), // Adicione esta linha se a coluna NAME existir
                        cursor.getString(3),
                        cursor.getString(4),
                        cursor.getString(5),
                        cursor.getString(6),
                        cursor.getInt(7),
                        cursor.getString(8)
                );
                System.out.println("---> ID: " + auxu.getId() + ", Username: " + auxu.getUsername() + ", Address: " + auxu.getAddress());
                users.add(auxu);
            } while (cursor.moveToNext());
            cursor.close();
        }
        return users;
    }


    //endregion

    //region # ZONE DB METHODS #

    public String createZonesTable() {
        return "CREATE TABLE " + TABLE_ZONE + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                REST_ID + " INTEGER NOT NULL, " +
                DESCRIPTION + " TEXT NOT NULL, " +
                CAPACITY + " INTEGER NOT NULL" +
                ");";
    }

    public String deleteZonesTable() {
        return "DROP TABLE IF EXISTS " + TABLE_ZONE;
    }

    //endregion

    //#region # ORDER DB METHODS #

    /**
     * Receber todas os pedidos da base de dados
     *
     * @return Todos os pedidos
     */
    public ArrayList<Order> getAllOrders() {
        ArrayList<Order> orders = new ArrayList<>();
        String[] columns = new String[]{ID, USER_ID, REST_ID, PRICE, STATUS};

        Cursor cursor = this.db.query(TABLE_ORDER, columns, null,
                null, null, null, null);

        if (cursor.moveToFirst()) {
            do {

                Order order = new Order(
                        cursor.getInt(0),
                        cursor.getInt(1),
                        cursor.getInt(2),
                        cursor.getFloat(3),
                        cursor.getInt(4)
                );

                orders.add(order);
            } while (cursor.moveToNext());

            cursor.close();
        }
        return orders;
    }

    /**
     * Adicionar pedido à base de dados
     *
     * @param order Pedido a Adicionar
     */
    public void addOrderDB(Order order) {
        ContentValues values = new ContentValues();

        values.put(USER_ID, order.getUserId());
        values.put(REST_ID, order.getRestId());
        values.put(PRICE, order.getPrice());
        values.put(STATUS, order.getStatus());

        this.db.insert(TABLE_ORDER, null, values);
    }

    /**
     * Apagar todos os pedidos da base de dados
     */
    public void removeAllOrders() {
        this.db.delete(TABLE_ORDER, null, null);
    }

    //#endregion # ORDER DB METHODS #

    //region # SIGNUP DB METHODS #


    //endregion

}
