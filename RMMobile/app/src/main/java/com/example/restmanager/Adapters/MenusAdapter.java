package com.example.restmanager.Adapters;

import android.content.Context;
import android.util.Patterns;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.example.restmanager.Model.Menu;
import com.example.restmanager.OrdersActivity;
import com.example.restmanager.R;
import com.example.restmanager.databinding.ItemMenuOrderBinding;

import java.util.ArrayList;

public class MenusAdapter extends BaseAdapter {
    private ItemMenuOrderBinding binding;
    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Menu> menus;

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
        if(convertView == null)
            convertView = inflater.inflate(R.layout.item_menu_order, null);
/*
        convertView = binding.getRoot();*/
        MenusAdapter.ViewHolderList viewHolderList = (MenusAdapter.ViewHolderList) convertView.getTag();
        if(viewHolderList == null){
            viewHolderList = new MenusAdapter.ViewHolderList(convertView);
            convertView.setTag(viewHolderList);
        }
        viewHolderList.update(menus.get(position));


        convertView.findViewById(R.id.btnMinus).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //Diminuir a quantity
            }
        });

        convertView.findViewById(R.id.btnPlus).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //aumentar a quantity
            }
        });

        return convertView;
    }

    public class ViewHolderList{

        private TextView menuName;
        private ImageView imgCover;
        public ViewHolderList(View view) {
            menuName = view.findViewById(R.id.tvRestName);
            imgCover = view.findViewById(R.id.imgCover);
        }
        public void update(Menu menu){
            menuName.setText(menu.getName());
        }

    }

}
