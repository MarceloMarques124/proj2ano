package com.example.restmanager.DBHelper;
import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

public class UserDBHelper extends SQLiteOpenHelper {

    private static final String DB_NAME = "dbrestmanager";
    private static final String DB_TABLE = "users";
    private static final int DB_VERSION = 1;
    private final SQLiteDatabase db;
    private static final String ID = "id";
    private static final String USERNAME = "username";
    private static final String ADDRESS = "address";
    private static final String DOOR_NUMBER = "door_number";
    private static final String POSTAL_CODE = "postal_code";
    private static final String NIF = "nif";
    private static final String EMAIL = "email";
    private static final String PASSWORD = "password";

    public UserDBHelper(Context context) {
        super(context, DB_NAME, null, DB_VERSION);
        this.db = this.getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String createUsersTable = "CREATE TABLE " + DB_TABLE + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                USERNAME + " TEXT NOT NULL, " +
                ADDRESS + " TEXT NOT NULL, " +
                DOOR_NUMBER + " TEXT NOT NULL, " +
                POSTAL_CODE + " TEXT NOT NULL, " +
                NIF + " INTEGER NOT NULL, " +
                EMAIL + " TEXT NOT NULL, " +
                PASSWORD + " TEXT NOT NULL" +
                ");";
        db.execSQL(createUsersTable);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + DB_TABLE);
        this.onCreate(db);
    }
}
