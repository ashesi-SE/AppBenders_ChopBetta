package com.se.ashesi.chopbetta;

import android.content.Context;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import org.apache.http.HttpResponse;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.ArrayList;
import java.util.Collections;
import java.util.HashMap;
import java.util.List;


public class home extends ActionBarActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        //make call to get list
        DownloadWebPageTask task = new DownloadWebPageTask();
        System.out.println("About to execute task");
        task.execute(new String[]{"http://10.10.29.67/test.php"}); //url must always be changed
        //parse json array to a string array


    }

    /**
     *Fill list view with items from the server
     * @param result
     */
    public void fillList(String result){
        final ListView listView =(ListView) findViewById(R.id.listView);
        String [] values =parseResponse(result);

        final ArrayList<String> list = new ArrayList<String>();
        Collections.addAll(list, values);
        final StableArrayAdapter adapter = new StableArrayAdapter(this,android.R.layout.simple_list_item_1, list);
        listView.setAdapter(adapter);
    }

/*
parses the json response from the server into a string array
 */
    public String[] parseResponse(String result){

//        String resultArray
        ArrayList<String> menuArray = new ArrayList<String>();
        try {
            JSONArray aJsonArray = new JSONArray(result);
            for (int i=0; i<aJsonArray.length();i++){
                JSONObject aJsonObject = aJsonArray.getJSONObject(i);
                menuArray.add(aJsonObject.getString("menu_item"));
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return objectArrayToStringArray(menuArray.toArray());
    }

    public String[] objectArrayToStringArray(Object[] result){
        int size = result.length;
        String[] toReturn;
        if(size>0) {
            toReturn = new String[size];
            for (int i = 0; i < size; i++) {
                toReturn[i] = (String) result[i];
            }
        }
        else{
            toReturn = new String []{"No items"};
        }
        return toReturn;
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.home, menu);
        return true;
    }


    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();
        return id == R.id.action_settings || super.onOptionsItemSelected(item);
    }

    /**
     * List Array Adapter
     * currently handles only strings
     *
     */

    private class StableArrayAdapter extends ArrayAdapter<String> {

        HashMap<String, Integer> mIdMap = new HashMap<String, Integer>();

        public StableArrayAdapter(Context context, int textViewResourceId,
                                  List<String> objects) {
            super(context, textViewResourceId, objects);
            for (int i = 0; i < objects.size(); ++i) {
                mIdMap.put(objects.get(i), i);
            }
        }
        @Override
        public long getItemId(int position) {
            String item = getItem(position);
            return mIdMap.get(item);
        }

        @Override
        public boolean hasStableIds() {
            return true;
        }

    }

    /** AsyncTask class works perfectly ... don't touch
     create an object and call the object.execute(string array with the url)
     handle the response in onPostExecute() returns a string
     **/
    private class DownloadWebPageTask extends AsyncTask<String, Void, String> {
        @Override
        protected String doInBackground(String... urls) {
            String response = "";
            for (String url : urls) {
                DefaultHttpClient client = new DefaultHttpClient();
                HttpGet httpGet = new HttpGet(url);
                try {
                    HttpResponse execute = client.execute(httpGet);
                    InputStream content = execute.getEntity().getContent();

                    BufferedReader buffer = new BufferedReader(new InputStreamReader(content));
                    String s = "";
                    while ((s = buffer.readLine()) != null) {
                        response += s;
                    }

                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
            return response;
        }

        @Override
        protected void onPostExecute(String result) {
            //    textView.setText(result);
            fillList(result);
        }
    }

}



