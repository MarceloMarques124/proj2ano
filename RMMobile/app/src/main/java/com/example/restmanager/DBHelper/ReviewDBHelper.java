package com.example.restmanager.DBHelper;
import android.content.ContentValues;
import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import com.example.restmanager.Model.Review;

public class ReviewDBHelper extends SQLiteOpenHelper {

    private static final String DB_NAME = "dbrestmanager";
    private static final String DB_TABLE = "reviews";
    private static final int DB_VERSION = 1;
    private final SQLiteDatabase db;
    private static final String ID = "id";
    private static final String USER_ID = "user_id";
    private static final String REST_ID = "rest_id";
    private static final String STARS = "stars";
    private static final String DESCRIPTION = "description";

    public ReviewDBHelper(Context context) {
        super(context, DB_NAME, null, DB_VERSION);
        this.db = this.getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String createReviewsTable = "CREATE TABLE " + DB_TABLE + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                USER_ID + " INTEGER NOT NULL, " +
                REST_ID + " INTEGER NOT NULL, " +
                STARS + " INTEGER NOT NULL, " +
                DESCRIPTION + " TEXT NOT NULL" +
                ");";
        db.execSQL(createReviewsTable);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + DB_TABLE);
        this.onCreate(db);
    }

    public void addReview(Review r) {
        ContentValues values = new ContentValues();

        values.put(USER_ID, r.getUserId());
        values.put(REST_ID, r.getRestId());
        values.put(STARS, r.getStars());
        values.put(DESCRIPTION, r.getDescription());

        this.db.insert(DB_TABLE, null, values);
    }

    public boolean editReview(Review r){
        ContentValues values = new ContentValues();

        values.put(USER_ID, r.getUserId());
        values.put(REST_ID, r.getRestId());
        values.put(STARS, r.getStars());
        values.put(DESCRIPTION, r.getDescription());

        return this.db.update(DB_TABLE, values, ID + "= ?",  new String[]{"" + r.getId()}) > 0;
    }

    public void removeAll() {
        this.db.delete(DB_TABLE, null, null);
    }

    public boolean removeReview(int id){
        return (this.db.delete(DB_TABLE, ID + "= ?", new String[]{"" + id}) == 1);
    }
}
