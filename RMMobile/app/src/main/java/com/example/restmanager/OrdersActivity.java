package com.example.restmanager;

import static com.example.restmanager.RestaurantDetailsActivity.ID_RESTAURANT;
import static com.google.android.material.snackbar.Snackbar.*;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.content.DialogInterface;
import android.app.Dialog;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Toast;

import com.example.restmanager.Adapters.MenusAdapter;
import com.example.restmanager.Model.Menu;
import com.example.restmanager.Model.Order;
import com.example.restmanager.Model.Order;
import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.Model.SingletonRestaurantManager;
import com.example.restmanager.databinding.ActivityOrdersBinding;
import com.google.android.material.snackbar.Snackbar;

import java.util.ArrayList;
import java.util.List;

public class OrdersActivity extends AppCompatActivity {
    public final static String ID_REST = "ID_RESTAURANT";

    private ActivityOrdersBinding binding;
    private ArrayList<Menu> menus;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_orders);

        
        binding = ActivityOrdersBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        int id = getIntent().getIntExtra(ID_REST, 0);
        menus = SingletonRestaurantManager.getInstance(getApplicationContext()).getMenusById(id);
        binding.lvMenus.setAdapter(new MenusAdapter(getApplicationContext(), menus));
            binding.lvMenus.setOnItemClickListener(new AdapterView.OnItemClickListener() {

            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Toast.makeText(getApplicationContext(), "pikn", Toast.LENGTH_SHORT).show();
                //alertDialog((int) id);
            }
        });
    }

    private void alertDialog(int id){
        AlertDialog.Builder builder = new AlertDialog.Builder(this);

        builder
                .setTitle(menus.get((int) id).getName() + "Informação")
                .setMessage("Info do prato aqui")
                .setPositiveButton(R.string.Ok, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        return;
                    }
                })
                .setIcon(android.R.drawable.ic_dialog_info);

        AlertDialog dialog = builder.create();
        dialog.show();
    }
}