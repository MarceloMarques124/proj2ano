package com.example.restmanager.Adapters;

import android.content.Context;
import android.util.Patterns;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.example.restmanager.Model.Menu;
import com.example.restmanager.Model.MenuItem;
import com.example.restmanager.Model.Order;
import com.example.restmanager.Model.SingletonRestaurantManager;
import com.example.restmanager.OrdersActivity;
import com.example.restmanager.R;
import com.example.restmanager.databinding.ItemMenuOrderBinding;

import java.math.BigInteger;
import java.util.ArrayList;

public class MenusAdapter extends BaseAdapter {
    private ItemMenuOrderBinding binding;
    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Menu> menus;
    private Order order = new Order();
    private ArrayList<MenuItem> menuItem;
    //private MyViewHolder myViewHolder;

    public MenusAdapter(Context context, ArrayList<Menu> menus) {
        this.context = context;
        this.menus = menus;
    }

    @Override
    public int getCount() {
        return menus.size();
    }

    @Override
    public Object getItem(int position) {
        return menus.get(position);
    }

    @Override
    public long getItemId(int position) {
        return menus.get(position).getId();
    }


    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if(inflater == null)
            inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);

        ViewHolderList holder;
        if(convertView == null){
            binding = ItemMenuOrderBinding.inflate(LayoutInflater.from(context), parent, false);
            convertView = binding.getRoot();
            holder = new ViewHolderList(convertView);
            convertView.setTag(holder);
        }else {
            holder = (ViewHolderList) convertView.getTag();
        }
            holder.update(menus.get(position));

        binding.etQuantity.setEnabled(false);
        binding.etQuantity.setCursorVisible(false);

        binding.btnMinus.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Menu menu = menus.get(position);
                if (menu.getQuantity() == 0) return;

                menu.setQuantity(menu.getQuantity() - 1);
                holder.update(menu);
            }
        });

        binding.btnPlus.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Menu menu = menus.get(position);
                menu.setQuantity(menu.getQuantity() + 1);
                holder.update(menu);
            }
        });

        binding.addToChart.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Toast.makeText(context, "Adding to chart", Toast.LENGTH_SHORT).show();

                if (order == null){
               //     order = SingletonRestaurantManager.
                }

            }
        });

        return convertView;
    }


    public class ViewHolderList{

        private TextView menuName;
        private EditText qty;
        private TextView price;
        public ViewHolderList(View view) {
            menuName = view.findViewById(R.id.tvRestName);
            qty = view.findViewById(R.id.etQuantity);
            price = view.findViewById(R.id.tvPrice);
        }
        public void update(Menu menu){
            menuName.setText(menu.getName());
            qty.setText(""+menu.getQuantity());
            price.setText(menu.getPrice()+" €");
        }

    }

}
