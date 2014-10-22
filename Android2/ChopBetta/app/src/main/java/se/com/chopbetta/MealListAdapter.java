package se.com.chopbetta;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.RatingBar;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.ToggleButton;

import java.util.List;

/**
 * Created by HP on 10/6/2014.
 */
public class MealListAdapter extends ArrayAdapter<NotSoSimpleKVPair> {
    Context context;
    int layoutResourceId;
    List<NotSoSimpleKVPair> data = null;

    public MealListAdapter(Context context, int layoutResourceId, List<NotSoSimpleKVPair> data) {
        super(context, layoutResourceId,  data);
        this.layoutResourceId = layoutResourceId;
        this.context = context;
        this.data = data;
    }
    static class ViewHolder {
        public TextView text;
        public TextView ratedBy;
        public RatingBar ratingBar;
    }

    @Override
    public View getView(final int position, View convertView, final ViewGroup parent) {

        Log.i("KEYVALPOS",""+position);
        View view = convertView;
        // reuse views
        if (view == null) {
            //ALT:LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            final LayoutInflater inflater = ((Activity)context).getLayoutInflater();

            //ALT:view = inflater.inflate(R.layout.rowlayout, null);
            view = inflater.inflate(layoutResourceId, null);
            // configure view holder
            final ViewHolder viewHolder = new ViewHolder();
            viewHolder.text = (TextView) view.findViewById(R.id.mealNameView);
            viewHolder.ratingBar = (RatingBar) view.findViewById(R.id.mealRatingBar);
            viewHolder.ratedBy = (TextView) view.findViewById(R.id.ratedByNo);
            final String mealName = viewHolder.text.getText().toString();
            view.setTag(viewHolder);

        }
        view.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                RatingAlertDialog rad = new RatingAlertDialog(context);
                NotSoSimpleKVPair nsskvp = data.get(position);
                Log.i("KEYVAL",nsskvp.getNameAt(0)+"|"+nsskvp.getKeyAt(0)+"|"+position);
                rad.createAlert(nsskvp.getNameAt(0),nsskvp.getKeyAt(0)).show();
            }
        });
        // fill data
        Log.i("ANNOY","position is now "+position);
        ViewHolder holder = (ViewHolder) view.getTag();
        NotSoSimpleKVPair nsskvp = data.get(position);
        Log.i("ANNOY",nsskvp.getNameAt(0));
        String s = nsskvp.getNameAt(0);

        holder.text.setText(s);
        holder.ratingBar.setRating(data.get(position).getRateAt(0));
        int numRated = nsskvp.getNumRatedAt(0);
        holder.ratedBy.setText("Rated by " + numRated + " user" + (numRated==1?"":"s"));
        return view;
    }
}
