package se.com.chopbetta;

/**
 * Created by HP on 10/31/2014.
 */

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.SQLException;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;


public class DBAdapter{
    public static final String KEY_ROWID= "entryId";
    public static final String KEY_MEALID= "meal_id";
    private static final String TAG= "DBAdapter";
    private static final String DATABASE_NAME= "CBRDB";
    private static final String DATABASE_TABLE= "rating_today";
    private static final int DATABASE_VERSION= 1;
    private static final String DATABASE_CREATE = "CREATE TABLE \"rating_today\" (\"entryId\" INTEGER PRIMARY KEY AUTOINCREMENT, \"meal_id\" INTEGER NOT NULL)";
    private final Context context;
    private DatabaseHelper DBHelper;
    private SQLiteDatabase db;
    public DBAdapter(Context ctx)
    {
        this.context= ctx;
        DBHelper= new DatabaseHelper(context);
    }
    private static class DatabaseHelper extends SQLiteOpenHelper
    {
        DatabaseHelper(Context context)
        {
            super(context, DATABASE_NAME, null, DATABASE_VERSION);
        }

        @Override
        public void onCreate(SQLiteDatabase db)
        {
            Log.d(TAG, "on create");
            try{
                db.execSQL(DATABASE_CREATE);
                Log.d(TAG,"DB created");
            } catch(SQLException e) {
                Log.d(TAG,"No DB created");
                e.printStackTrace();
            }
        }
        @Override
        public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion){
            Log.w(TAG, "Upgrading database from version "+ oldVersion + " to "
                    + newVersion + ", which will destroy all old data");
            db.execSQL("DROP TABLE IF EXISTS "+DATABASE_TABLE);

            onCreate(db);
        }
    }
    //---opens the database---
    public DBAdapter open() throws SQLException
    {
        db= DBHelper.getWritableDatabase();
        return this;
    }
    //---closes the database
    public void close()
    {
        DBHelper.close();
    }
    //---insert a rating id into the database---
    public long insertRatingData(String meal_id)
    {
        ContentValues initialValues = new ContentValues();
        initialValues.put(KEY_MEALID, meal_id);
        Log.d(TAG,meal_id);
        return db.insert(DATABASE_TABLE, null, initialValues);
    }
    public boolean clearAll(){
        return db.delete(DATABASE_TABLE, KEY_ROWID+ " > 0", null) > 0;
    }
    public boolean ratingExists(String meal_id)
    {
        Cursor mCursor =
                db.query(true, DATABASE_TABLE, new String[] {KEY_ROWID,
                                KEY_MEALID}, KEY_MEALID+ "="+ meal_id, null,
                        null, null, null, null);
        if(mCursor != null) {
            mCursor.moveToFirst();
        }

        return mCursor.getCount() > 0;
    }
    //---deletes a particular id---
    public boolean deleteMealID(String mealId)
    {
        return db.delete(DATABASE_TABLE, KEY_MEALID+ "="+ mealId, null) > 0;
    }
    //---retrieves all the meals---
    public Cursor getAllIDs()
    {
        return db.query(DATABASE_TABLE, new String[] {KEY_ROWID, KEY_MEALID}, null, null, null, null, null);
    }
    //---retrieves a particular meal---​
    public Cursor getRatedMealID(long rowId) throws SQLException
    {
        Cursor mCursor =
                db.query(true, DATABASE_TABLE, new String[] {KEY_ROWID,
                                KEY_MEALID}, KEY_ROWID+ "="+ rowId, null,
                        null, null, null, null);
        if(mCursor != null) {
            mCursor.moveToFirst();
        }
        return mCursor;
    }
    //---updates a contact---
    public boolean updateRatedMealID(long rowId,String meal_id)
    //Creating and Using Databases ❘ 221
    {
        ContentValues args = new ContentValues();
        args.put(KEY_MEALID, meal_id);
        return db.update(DATABASE_TABLE, args, KEY_ROWID+ "="+ rowId, null) > 0;
    }
}
