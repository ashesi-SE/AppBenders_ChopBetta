package se.com.chopbetta;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.preference.PreferenceManager;
import android.util.Log;
import android.view.View;
import android.widget.RatingBar;
import android.widget.TextView;
import android.widget.Toast;

import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.concurrent.ExecutionException;

/**
 * Created by HP on 10/15/2014.
 */
public class RatingAlertDialog {
    static TextView ratingText;
    static RatingBar ratingBar;
    static View vc;
    static AlertDialog.Builder alertDialog;
    Context context;
    public RatingAlertDialog(Context context){
        this.context = context;
        alertDialog =  new AlertDialog.Builder(context);
        vc = View.inflate(context,R.layout.rating_alert_layout,null);
        ratingText = (TextView)vc.findViewById(R.id.ratingText);
        ratingBar = (RatingBar)vc.findViewById(R.id.ratingSet);
    }

    public  AlertDialog createAlert(String ratingName,final String mealid) {
        ratingText.setText(ratingName);
        alertDialog.setView(vc)
                .setPositiveButton("Submit rating", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        getData("?submit_ratings&customer_rating="+ratingBar.getRating()+"&current_meal_id="+mealid,false);
                    }
                });
        AlertDialog ad  = alertDialog.create();
        ad.setCanceledOnTouchOutside(true);
        return ad;
    }


    public String getData(String url, boolean block){
        httpSender hts = new httpSender();
        String res = null;

        SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(context);
        PreferenceManager.setDefaultValues(context, R.xml.pref_general, false);
        String serverIp = sharedPref.getString("serverIP", null );
        hts.execute(url,"http://"+ serverIp + context.getString(R.string.pref_urlSet));
        if(block){
            try {
                res = hts.get();
            } catch (InterruptedException e) {
                e.printStackTrace();
            } catch (ExecutionException e) {
                e.printStackTrace();
            }
        }

        return res;
    }



    public class httpSender extends AsyncTask<String, Void, String> {

        private String urlStr;
        private String response;
        InputStream is = null;
        HttpURLConnection con = null;
        OutputStream os = null;
        URL url;
        AlertDialog.Builder alert;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            alert = new AlertDialog.Builder(context);
        }

        @Override
        protected String doInBackground(String... params) {

            urlStr = params[1];
            try {
                Log.i("URL", urlStr + params[0]);
                url = new URL(urlStr+params[0]);
                con = (HttpURLConnection)url.openConnection();

                // Always get the Response code first .
                int responseCode = con.getResponseCode();
                if (responseCode == HttpURLConnection.HTTP_OK) {
                    // You have successfully connected.
                    int length = (int)con.getContentLength();
                    is = con.getInputStream();
                    final int MAX_LENGTH = 5120;
                    byte[] buf = new byte[MAX_LENGTH];
                    int total = 0;

                    while (total < MAX_LENGTH) {

                        int count = is.read(buf, total, MAX_LENGTH - total);
                        if (count < 0) {
                            break;
                        }
                        total += count;
                    }
                    is.close();
                    response = new String(buf, 0, total);
                    System.out.println("HTTPClass| "+ response);
                } else {
                    System.out.println("HTTPClass| Conn error");
                    // Problem with your connection
                }
            } catch (IOException e) {
                e.printStackTrace();
                // Do your exception handling here
            } finally {
                try {
                    if (is != null) {
                        is.close();
                    }
                    if (os != null) {
                        os.close();
                    }
                    if (con != null) {
                        con.disconnect();
                    }
                } catch (IOException ex) {
                    ex.printStackTrace();
                }
            }
            return response;

        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            if(s==null){
                Toast.makeText(context,"Could not submit your rating",Toast.LENGTH_LONG).show();
            }else {
                Toast.makeText(context,"Your rating has been submitted",Toast.LENGTH_SHORT).show();
            }
        }
    }
}
