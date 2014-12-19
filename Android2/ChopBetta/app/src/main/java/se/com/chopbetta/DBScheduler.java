package se.com.chopbetta;


import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.util.Log;
import android.widget.Toast;

/**
 * Created by HP on 11/1/2014.
 */

public class DBScheduler extends BroadcastReceiver {
    DBAdapter dba;
    public DBScheduler() {
        super();
    }

    @Override
    public void onReceive(Context context, Intent intent) {
        dba = new DBAdapter(context);
        dba.open();
        dba.clearAll();
        dba.close();
        Toast.makeText(context, "I'm running", Toast.LENGTH_SHORT).show();
        Log.i("SCHEDULER","DB erased");


    }
}
