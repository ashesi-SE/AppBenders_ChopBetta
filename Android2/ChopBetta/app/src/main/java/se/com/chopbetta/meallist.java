package se.com.chopbetta;



import android.animation.Animator;
import android.animation.AnimatorListenerAdapter;
import android.annotation.TargetApi;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ListView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import java.util.concurrent.ExecutionException;


/**
 * A simple {@link Fragment} subclass.
 * Use the {@link meallist#newInstance} factory method to
 * create an instance of this fragment.
 *
 */
public class meallist extends Fragment {
    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String CANTEEN_ID = "param2";

    // TODO: Rename and change types of parameters
    private int mParam1;
    private String canteenID;
    private View meallistView;
    private View progressView;


    /**
     * Use this factory method to create a new instance of
     * this fragment using the provided parameters.
     *
     * @param param1 Parameter 1.
     * @param canteenID Parameter 2.
     * @return A new instance of fragment meallist.
     */
    // TODO: Rename and change types and number of parameters
    public static meallist newInstance(int param1, String canteenID) {
        meallist fragment = new meallist();
        Bundle args = new Bundle();
        args.putInt(ARG_PARAM1, param1);
        args.putString(CANTEEN_ID, canteenID);
        fragment.setArguments(args);
        return fragment;
    }
    public meallist() {
        // Required empty public constructor
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            mParam1 = getArguments().getInt(ARG_PARAM1);
            canteenID = getArguments().getString(CANTEEN_ID);
        }
       

    }
    private ListView lvMeal;
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_meal, container, false);
        progressView = rootView.findViewById(R.id.progress1);
        meallistView = rootView.findViewById(R.id.mealList);
        showProgress(true);
        getData("?display_currentMeal&cid="+canteenID);
        lvMeal = (ListView)rootView.findViewById(R.id.mealListView);

        return rootView;
    }
    /**
     * Shows the progress UI and hides the login form.
     */
    @TargetApi(Build.VERSION_CODES.HONEYCOMB_MR2)
    private void showProgress(final boolean show) {
        // On Honeycomb MR2 we have the ViewPropertyAnimator APIs, which allow
        // for very easy animations. If available, use these APIs to fade-in
        // the progress spinner.
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.HONEYCOMB_MR2) {
            int shortAnimTime = getResources().getInteger(android.R.integer.config_shortAnimTime);

            progressView.setVisibility(View.VISIBLE);
            progressView.animate()
                    .setDuration(shortAnimTime)
                    .alpha(show ? 1 : 0)
                    .setListener(new AnimatorListenerAdapter() {
                        @Override
                        public void onAnimationEnd(Animator animation) {
                            progressView.setVisibility(show ? View.VISIBLE : View.GONE);
                        }
                    });

            meallistView.setVisibility(View.VISIBLE);
            meallistView.animate()
                    .setDuration(shortAnimTime)
                    .alpha(show ? 0 : 1)
                    .setListener(new AnimatorListenerAdapter() {
                        @Override
                        public void onAnimationEnd(Animator animation) {
                            meallistView.setVisibility(show ? View.GONE : View.VISIBLE);
                        }
                    });
        } else {
            // The ViewPropertyAnimator APIs are not available, so simply show
            // and hide the relevant UI components.
            progressView.setVisibility(show ? View.VISIBLE : View.GONE);
            meallistView.setVisibility(show ? View.GONE : View.VISIBLE);
        }
    }

    public ArrayList<NotSoSimpleKVPair> parseResponse(String result){

//        [{"current_meal_id":"7","current_meal_name":"French fries and Sausage","customer_rating":"","cid":"2"}
        ArrayList<NotSoSimpleKVPair> menuArray = new ArrayList<NotSoSimpleKVPair>();
        try {
            JSONArray aJsonArray = new JSONArray(result);
            for (int i=0; i<aJsonArray.length();i++){
                NotSoSimpleKVPair mealData = new NotSoSimpleKVPair();
                JSONObject jAr = aJsonArray.getJSONObject(i);
                Log.i("ANNOY",(jAr.getString("current_meal_name")));
                mealData.put(jAr.getString("current_meal_id"),jAr.getString("current_meal_name"),
                        jAr.getString("customer_rating").equals("")?0.f:Float.parseFloat(jAr.getString("customer_rating")));
                menuArray.add(mealData);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return menuArray;
    }

    public String getData(String url){
        httpSender hts = new httpSender();
        String res = null;
        try {

          hts.execute(url,getString(R.string.urlSet));
          //  hts.execute(url,"http://192.168.42.10:63345/ChopBetta/Web/ChopBetta/canteen_json.php");

          res = hts.get();
        } catch (InterruptedException e) {
            e.printStackTrace();
        } catch (ExecutionException e) {
            e.printStackTrace();
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

            MealListAdapter adap = new MealListAdapter(getActivity(), R.layout.meal_list_item, parseResponse(s));
            lvMeal.setAdapter(adap);
            showProgress(false);
        }
    }

}
