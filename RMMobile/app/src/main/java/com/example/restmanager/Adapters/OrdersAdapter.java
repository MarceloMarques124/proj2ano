package com.example.restmanager.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.restmanager.Model.OrderedMenu;
import com.example.restmanager.R;

import java.util.ArrayList;

public class OrdersAdapter extends BaseAdapter {

    private final Context context;
    private LayoutInflater inflater;
    private final ArrayList<OrderedMenu> orderedMenus;

    public OrdersAdapter(Context context, ArrayList<OrderedMenu> orderedMenus) {
        super();
        this.context = context;
        this.orderedMenus = orderedMenus;
    }

    @Override
    public int getCount() {
        return orderedMenus.size();
    }

    @Override
    public Object getItem(int position) {
        return orderedMenus.get(position);
    }

    @Override
    public long getItemId(int position) {
        return orderedMenus.get(position).getId();
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if (inflater == null)
            inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);

        if (convertView == null)
            convertView = inflater.inflate(R.layout.item_menu_order, null);

        ViewHolderList viewHolderList = (ViewHolderList) convertView.getTag();

        if (viewHolderList == null) {
            viewHolderList = new ViewHolderList(convertView);
            convertView.setTag(viewHolderList);
        }

        viewHolderList.update(orderedMenus.get(position));

        return convertView;
    }

    class ViewHolderList {
        private final TextView tvRestName;
        private final TextView tvPrice;
        private final EditText etQuantity;
        private final ImageView imgCover;

        public ViewHolderList(View view) {
            tvRestName = view.findViewById(R.id.tvRestName);
            imgCover = view.findViewById(R.id.imgCover);
            tvPrice = view.findViewById(R.id.tvPrice);
            etQuantity = view.findViewById(R.id.etQuantity);
        }

        public void update(OrderedMenu orderedMenu) {
            tvRestName.setText(orderedMenu.getOrder().getRestaurant().getName());
            tvPrice.setText("" + orderedMenu.getMenu().getPrice() * orderedMenu.getQuantity());
            etQuantity.setText("" + orderedMenu.getQuantity());
            // imgCover.setImageResource(restaurant.getCover());
        }
    }
}
