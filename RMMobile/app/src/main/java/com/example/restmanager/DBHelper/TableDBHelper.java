package com.example.restmanager.DBHelper;
import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

public class TableDBHelper extends SQLiteOpenHelper {

    private static final String DB_NAME = "dbrestmanager";
    private static final String DB_TABLE = "tables";
    private static final int DB_VERSION = 1;
    private final SQLiteDatabase db;
    private static final String ID = "id";
    private static final String DESCRIPTION = "description";
    private static final String CAPACITY = "capacity";

    public TableDBHelper(Context context) {
        super(context, DB_NAME, null, DB_VERSION);
        this.db = this.getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String createTablesTable = "CREATE TABLE " + DB_TABLE + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                DESCRIPTION + " TEXT NOT NULL, " +
                CAPACITY + " INTEGER NOT NULL" +
                ");";
        db.execSQL(createTablesTable);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + DB_TABLE);
        this.onCreate(db);
    }
}
