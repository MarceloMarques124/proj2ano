package com.example.restmanager.DBHelper;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import com.example.restmanager.Model.Menu;

import java.util.ArrayList;

public class MenuDBHelper extends SQLiteOpenHelper {

    private static final String DB_NAME = "dbrestmanager";
    private static final String DB_TABLE = "menus";
    private static final int DB_VERSION = 1;
    private final SQLiteDatabase db;
    private static final String NAME = "name";
    private static final String PRICE = "price";
    private static final String RESTID = "restId";
    private static final String ID = "id";


    public MenuDBHelper(Context context) {
        super(context, DB_NAME, null, DB_VERSION);
        this.db = this.getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String createMenusTable = "CREATE TABLE " + DB_TABLE + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                NAME + " TEXT NOT NULL, " +
                PRICE + " DECIMAL NOT NULL, " +
                RESTID + " INTEGER NOT NULL" +
                ");";
        db.execSQL(createMenusTable);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS "+ DB_TABLE);
        this.onCreate(db);
    }

    public ArrayList<Menu> getAllMenus(){
        ArrayList<Menu> menus =  new ArrayList<>();
        Cursor cursor = this.db.query(DB_TABLE, new String[]{ID, NAME, PRICE, RESTID}, null, null, null, null, null);

        if (cursor.moveToNext()){
            do{
                Menu menu = new Menu(
                        cursor.getInt(0),
                        cursor.getString(1),
                        cursor.getDouble(2),
                        cursor.getInt(3)
                );
                menus.add(menu);
            }while (cursor.moveToNext());
            cursor.close();

        }
        return menus;
    }

    public void addMenu(Menu m) {
        ContentValues values = new ContentValues();

        values.put(NAME, m.getName());
        values.put(PRICE, m.getPrice());
        values.put(RESTID, m.getRestId());

        this.db.insert(DB_TABLE, null, values);
    }

    public void removeAllmenus() {
//        this.db.delete(DB_TABLE, null, null);
    }

}
