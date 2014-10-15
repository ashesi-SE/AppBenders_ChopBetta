package se.com.chopbetta;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;

import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.concurrent.ExecutionException;


public class splashScreen extends Activity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash_screen);
        getData("?display_cafeteria");
    }

    @Override
    protected void onPostCreate(Bundle savedInstanceState) {
        super.onPostCreate(savedInstanceState);

    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.splash_screen, menu);

        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }


    public void getData(String url){
        httpSender hts = new httpSender();
        String res = null;


          hts.execute(url,getString(R.string.urlSet));
          //  hts.execute(url, "http://192.168.42.173:63345/ChopBetta/Web/ChopBetta/canteen_json.php");


    }

    public class httpSender extends AsyncTask<String, Void, String> {

        private String urlStr;
        private String response;
        InputStream is = null;
        HttpURLConnection con = null;
        OutputStream os = null;
        URL url;
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
                    final int MAX_LENGTH = 512;
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
            Intent tIntent = new Intent(splashScreen.this,MainActivity.class);
            tIntent.putExtra("cafeInfo", s);
            startActivity(tIntent);

            finish();
        }
    }
}
