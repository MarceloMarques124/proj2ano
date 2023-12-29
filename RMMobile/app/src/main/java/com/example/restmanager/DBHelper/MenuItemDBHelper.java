package com.example.restmanager.DBHelper;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

public class MenuItemDBHelper extends SQLiteOpenHelper {

    private static final String DB_NAME = "dbrestmanager";
    private static final String DB_TABLE = "menuitems";
    private static final int DB_VERSION = 1;
    private final SQLiteDatabase db;
    private static final String NAME = "name";
    private static final String MENUID = "menuid";
    private static final String PRICE = "price";
    private static final String ID = "id";

    public MenuItemDBHelper(Context context){
        super(context, DB_NAME, null, DB_VERSION);
        this.db = this.getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {

    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {

    }
}
