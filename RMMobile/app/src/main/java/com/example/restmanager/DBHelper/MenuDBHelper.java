package com.example.restmanager.DBHelper;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

public class MenuDBHelper extends SQLiteOpenHelper {

    private static final String DB_NAME = "dbrestmanager";
    private static final String DB_TABLE = "menus";
    private static final int DB_VERSION = 1;
    private final SQLiteDatabase db;
    private static final String NAME = "name";
    private static final String DESCRIPTION = "description";
    private static final String PRICE = "price";
    private static final String RESTID = "restId";
    private static final String ID = "id";


    public MenuDBHelper(Context context) {
        super(context, DB_NAME, null, DB_VERSION);
        this.db = this.getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String createBooksTable = "CREATE TABLE " + DB_TABLE + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                NAME + " TEXT NOT NULL, " +
                DESCRIPTION + " TEXT NOT NULL, " +
                PRICE + " TEXT NOT NULL, " +
                RESTID + " TEXT NOT NULL" +
                ");";
        db.execSQL(createBooksTable);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS "+ DB_TABLE);
        this.onCreate(db);
    }

}
