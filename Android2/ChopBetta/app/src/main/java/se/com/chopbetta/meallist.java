package se.com.chopbetta;



import android.animation.Animator;
import android.animation.AnimatorListenerAdapter;
import android.annotation.TargetApi;
import android.app.AlarmManager;
import android.app.AlertDialog;
import android.app.PendingIntent;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.app.Fragment;
import android.os.Handler;
import android.preference.PreferenceManager;
import android.support.v4.widget.SwipeRefreshLayout;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.concurrent.ExecutionException;


/**
 * A simple {@link Fragment} subclass.
 * Use the {@link meallist#newInstance} factory method to
 * create an instance of this fragment.
 *
 */
public class meallist extends Fragment implements SwipeRefreshLayout.OnRefreshListener {
    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String CANTEEN_ID = "param2";

    // TODO: Rename and change types of parameters
    private int mParam1;
    private String canteenID;
    private SwipeRefreshLayout meallistView;
    private View progressView;
    private PendingIntent pendingIntent;
    private AlarmManager manager;


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
        //Scheduled task for deleting ratings
        Calendar calendar = Calendar.getInstance();
        calendar.set(Calendar.HOUR_OF_DAY, 0);
        calendar.set(Calendar.MINUTE, 0);
        calendar.set(Calendar.SECOND, 0);
        if (calendar.getTimeInMillis() <= System.currentTimeMillis()) {
            calendar.add(Calendar.DATE,1);
        }

        Intent alarmIntent = new Intent(getActivity(), DBScheduler.class);
        pendingIntent = PendingIntent.getBroadcast(getActivity(), 0, alarmIntent, PendingIntent.FLAG_UPDATE_CURRENT);
        manager = (AlarmManager) getActivity().getSystemService(Context.ALARM_SERVICE);
        manager.setRepeating(AlarmManager.RTC_WAKEUP, calendar.getTimeInMillis(),
                AlarmManager.INTERVAL_DAY, pendingIntent);

        //End of scheduled task
        if (getArguments() != null) {
            mParam1 = getArguments().getInt(ARG_PARAM1);
            canteenID = getArguments().getString(CANTEEN_ID);
        }
        setRetainInstance(true);

    }
    private ListView lvMeal;
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_meal, container, false);

        progressView = rootView.findViewById(R.id.progress1);
        meallistView = (SwipeRefreshLayout)rootView.findViewById(R.id.mealList);
        meallistView.setOnRefreshListener(this);
        meallistView.setColorScheme( android.R.color.holo_orange_light,
                android.R.color.holo_green_light,
                android.R.color.holo_blue_bright,
                android.R.color.holo_red_light);

        showProgress(true);
        getData("?display_currentMeal&cid="+canteenID,false);
        lvMeal = (ListView)rootView.findViewById(R.id.mealListView);

        return rootView;
    }

    @Override
    public void onRefresh() {
        if(meallistView.isRefreshing()){
            meallistView.setRefreshing(true);
        }
        getData("?display_currentMeal&cid="+canteenID,false);

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
                        jAr.getString("customer_rating").equals("")?0.f:Float.parseFloat(jAr.getString("customer_rating")),
                        jAr.getInt("number_of_ratings"));
                menuArray.add(mealData);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return menuArray;
    }

    public String getData(String url, boolean block){
        httpSender hts = new httpSender();
        String res = null;



        SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(getActivity());
        PreferenceManager.setDefaultValues(getActivity(), R.xml.pref_general, false);
        String serverIp = sharedPref.getString("serverIP", null );
        hts.execute(url,"http://"+ serverIp + getString(R.string.pref_urlSet));
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
            alert = new AlertDialog.Builder(getActivity());
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
                alert.setTitle("Could not connect to service.")
                        .setMessage("The internet may be down\n" +
                                "You may also want to check IP/hostname configuration settings?")
                        .setPositiveButton("App Settings", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {

                                Intent i = new Intent(getActivity(), SettingsActivity.class);
                                startActivity(i);
                            }
                        }).setNegativeButton("Try later", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        dialog.cancel();
                        getActivity().finish();
                    }
                }).show();
            }else {
                //TODO: Check crash that occurs on multiple screen rotates
                if(getActivity()!=null) {
                    MealListAdapter adap = new MealListAdapter(getActivity(), R.layout.meal_list_item, parseResponse(s));
                    lvMeal.setAdapter(adap);
                    showProgress(false);
                    meallistView.setRefreshing(false);
                }
            }
        }
    }

}
