package com.example.restmanager.DBHelper;
import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

public class ReservationDBHelper extends SQLiteOpenHelper {

    private static final String DB_NAME = "dbrestmanager";
    private static final String DB_TABLE = "reservations";
    private static final int DB_VERSION = 1;
    private final SQLiteDatabase db;
    private static final String ID = "id";
    private static final String USER_ID = "user_id";
    private static final String DATE = "date";
    private static final String TIME = "time";
    private static final String REMARKS = "remarks";
    private static final String REST_ID = "rest_id";
    private static final String PEOPLE_NUMBER = "people_number";
    private static final String TABLES_NUMBER = "tables_number";

    public ReservationDBHelper(Context context) {
        super(context, DB_NAME, null, DB_VERSION);
        this.db = this.getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String createReservationsTable = "CREATE TABLE " + DB_TABLE + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                USER_ID + " INTEGER NOT NULL, " +
                DATE + " TEXT NOT NULL, " +
                TIME + " TEXT NOT NULL, " +
                REMARKS + " TEXT, " +
                REST_ID + " INTEGER NOT NULL, " +
                PEOPLE_NUMBER + " INTEGER NOT NULL, " +
                TABLES_NUMBER + " INTEGER NOT NULL" +
                ");";
        db.execSQL(createReservationsTable);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + DB_TABLE);
        this.onCreate(db);
    }
}
