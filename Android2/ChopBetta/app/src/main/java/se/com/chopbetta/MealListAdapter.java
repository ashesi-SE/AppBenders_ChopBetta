package se.com.chopbetta;

import android.app.Activity;
import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.RatingBar;
import android.widget.TextView;
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
        public RatingBar ratingBar;
        public ToggleButton mealEatToggle;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {


        View view = convertView;
        // reuse views
        if (view == null) {
            //ALT:LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            LayoutInflater inflater = ((Activity)context).getLayoutInflater();

            //ALT:view = inflater.inflate(R.layout.rowlayout, null);
            view = inflater.inflate(layoutResourceId, null);

            // configure view holder
            ViewHolder viewHolder = new ViewHolder();
            viewHolder.text = (TextView) view.findViewById(R.id.mealNameView);
            viewHolder.ratingBar = (RatingBar) view.findViewById(R.id.mealRatingBar);
            viewHolder.mealEatToggle = (ToggleButton) view.findViewById(R.id.mealEatToggle);
            view.setTag(viewHolder);
        }

        // fill data
        Log.i("ANNOY","position is now "+position);
        ViewHolder holder = (ViewHolder) view.getTag();
        NotSoSimpleKVPair nsskvp = data.get(position);
        Log.i("ANNOY",nsskvp.getNameAt(0));
        String s = nsskvp.getNameAt(0);

        holder.text.setText(s);
        holder.ratingBar.setRating(data.get(position).getRateAt(0));
        return view;
    }
}
