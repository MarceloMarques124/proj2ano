package com.example.restmanager.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;
import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.R;
import java.util.ArrayList;

public class RestaurantsAdapter extends BaseAdapter {

    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Restaurant> restaurants;

    public RestaurantsAdapter(Context context, ArrayList<Restaurant> restaurants) {
        this.context = context;
        this.restaurants = restaurants;
    }

    @Override
    public int getCount() {
        return restaurants.size();
    }

    @Override
    public Object getItem(int position) {
        return restaurants.get(position);
    }

    @Override
    public long getItemId(int position) {
        return restaurants.get(position).getId();
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if(inflater == null)
            inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        if(convertView == null)
            convertView = inflater.inflate(R.layout.item_restaurant_list, null);

        ViewHolderList viewHolderList = (ViewHolderList) convertView.getTag();
        if(viewHolderList == null){
            viewHolderList = new ViewHolderList(convertView);
            convertView.setTag(viewHolderList);
        }
        viewHolderList.update(restaurants.get(position));

        return convertView;
    }

    private class ViewHolderList{
        private TextView tvRestName;
        private ImageView imgCover;

        public ViewHolderList(View view){
            tvRestName = view.findViewById(R.id.tvRestName);
            imgCover = view.findViewById(R.id.imgCover);
        }
        public void update(Restaurant restaurant){
            tvRestName.setText(restaurant.getName());
          //  imgCover.setImageResource(restaurant.getCover());
        }
    }
}
