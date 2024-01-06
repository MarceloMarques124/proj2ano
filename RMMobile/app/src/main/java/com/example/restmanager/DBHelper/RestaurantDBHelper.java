package com.example.restmanager.DBHelper;
import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import com.example.restmanager.Model.Restaurant;

import java.util.ArrayList;

public class RestaurantDBHelper extends SQLiteOpenHelper {

    private static final String DB_NAME = "dbrestmanager";
    private static final String DB_TABLE = "restaurants";
    private static final int DB_VERSION = 1;
    private final SQLiteDatabase db;
    private static final String ID = "id";
    private static final String NAME = "name";
    private static final String ADDRESS = "address";
    private static final String NIF = "nif";
    private static final String EMAIL = "email";
    private static final String MOBILE_NUMBER = "mobile_number";
    private static final String IMG_COVER = "img_cover";

    public RestaurantDBHelper(Context context) {
        super(context, DB_NAME, null, DB_VERSION);
        this.db = this.getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String createRestaurantsTable = "CREATE TABLE " + DB_TABLE + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                NAME + " TEXT NOT NULL, " +
                ADDRESS + " TEXT NOT NULL, " +
                NIF + " INTEGER NOT NULL, " +
                EMAIL + " TEXT NOT NULL, " +
                MOBILE_NUMBER + " TEXT NOT NULL, " +
                IMG_COVER + " INTEGER" +
                ");";
        db.execSQL(createRestaurantsTable);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + DB_TABLE);
        this.onCreate(db);
    }

    public ArrayList<Restaurant> getAllRestaurants(){
        ArrayList<Restaurant> restaurants = new ArrayList<>();
        Cursor cursor = this.db.query(DB_TABLE, new String[]{ID, NAME, ADDRESS, NIF, EMAIL, MOBILE_NUMBER, IMG_COVER}, null,
                null,null, null, null);

        if (cursor.moveToFirst()){
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
            }while (cursor.moveToNext());
            cursor.close();
        }
        return restaurants;
    }

    public void addBookDB(Restaurant r) {
        ContentValues values = new ContentValues();

        values.put(NAME, r.getName());
        values.put(ADDRESS, r.getAddress());
        values.put(NIF, r.getNif());
        values.put(EMAIL, r.getEmail());
        values.put(MOBILE_NUMBER, r.getMobileNumber());

        this.db.insert(DB_TABLE, null, values);
    }

    public void removeAllRestaurants() {
        this.db.delete(DB_TABLE, null, null);
    }
}
