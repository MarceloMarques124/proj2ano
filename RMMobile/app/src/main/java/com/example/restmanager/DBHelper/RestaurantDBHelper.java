package com.example.restmanager.DBHelper;
import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

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
}
