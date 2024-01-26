package com.example.restmanager.Activities;

import androidx.appcompat.app.AppCompatActivity;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Toast;
import android.widget.TextView;

import com.android.volley.Response;
import com.example.restmanager.Adapters.MenusAdapter;
import com.example.restmanager.Listeners.MenusListener;
import com.example.restmanager.Model.Login;
import com.example.restmanager.Model.Menu;
import com.example.restmanager.Model.Order;
import com.example.restmanager.Model.OrderedMenu;
import com.example.restmanager.Model.User;
import com.example.restmanager.Mosquitto.MqttClientTask;
import com.example.restmanager.R;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.Utils.Public;
import com.example.restmanager.databinding.ActivityOrdersBinding;

import java.util.ArrayList;

public class OrdersActivity extends AppCompatActivity implements MenusListener {
    public final static String ID_REST = "ID_RESTAURANT";

    private ActivityOrdersBinding binding;
    private ArrayList<Menu> menus;
    private int idRest;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_orders);

        MqttClientTask mqttClientTask = new MqttClientTask();

        mqttClientTask.execute();

        binding = ActivityOrdersBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        idRest = getIntent().getIntExtra(ID_REST, 0);
        SingletonRestaurantManager.getInstance(getApplicationContext()).setMenusListener(this);
        SingletonRestaurantManager.getInstance(getApplicationContext()).getMenusAPI(this);

        binding.lvMenus.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                System.out.println("---> Clicked Menu: " + id);
                Menu menu = SingletonRestaurantManager.getInstance(getApplicationContext()).getMenu((int) id);
                Toast.makeText(OrdersActivity.this, "BigMac\nSem alfaces", Toast.LENGTH_SHORT).show();
            }
        });
        
        binding.fabAddCart.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                ArrayList<Integer> selectedMenuIds = new ArrayList<>();
                ArrayList<Integer> selectedQuantities = new ArrayList<>();
                Toast.makeText(OrdersActivity.this, "Cart FAB clicked" , Toast.LENGTH_SHORT).show();
                for (int i = 0; i < binding.lvMenus.getAdapter().getCount(); i++) {
                    View itemView = binding.lvMenus.getChildAt(i);
                    if (itemView != null) {
                        MenusAdapter.ViewHolderList viewHolder = (MenusAdapter.ViewHolderList) itemView.getTag();
                        if (viewHolder != null) {
                            Menu menu = (Menu) binding.lvMenus.getAdapter().getItem(i);
                            if (menu != null && menu.getQuantity() > 0) {
                                selectedMenuIds.add(menu.getId());
                                selectedQuantities.add(menu.getQuantity());
                                System.out.println("---> Item added to cart: " + menu.getName() + " - Quantity: " + menu.getQuantity());
                            }else {
                                Toast.makeText(OrdersActivity.this, "nada clicado", Toast.LENGTH_SHORT).show();
                            }
                        }
                    }
                }
                for (int y=0; y<selectedMenuIds.size(); y++){
                    System.out.println("---> teste: " + selectedMenuIds.get(y) + " | " + selectedQuantities.get(y));
                }

                processCart(selectedMenuIds, selectedQuantities);

                Toast.makeText(OrdersActivity.this, "---> Items added to cart", Toast.LENGTH_SHORT).show();

                Intent intent = new Intent(getApplicationContext(), LoginActivity.class);
                startActivity(intent);
                finish();

            }
        });
    }

    public void processCart(ArrayList<Integer> selectedMenuIds, ArrayList<Integer> selectedQuantities){
        SharedPreferences sharedPreferences = getApplicationContext().getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
        String token = sharedPreferences.getString(Public.TOKEN, "0");
        int userid = SingletonRestaurantManager.getInstance(getApplicationContext()).getUserBD(token).getId();
        int status = 1;

        SingletonRestaurantManager.getInstance(getApplicationContext()).getOrdersAPI(getApplicationContext(), response -> {
            System.out.println("---> response: " + response);
            Order order = SingletonRestaurantManager.getInstance(getApplicationContext()).getOrder(idRest, userid, status);
            System.out.println("---> Order: " + order);
            float price;
            if (order != null){
                for (int i = 0; i < selectedMenuIds.size(); i++) {
                    Integer menuId = selectedMenuIds.get(i);
                    Integer quantity = selectedQuantities.get(i);

                    // Check if the OrderedMenu already exists for this menu in the order
                    OrderedMenu orderedMenu = SingletonRestaurantManager.getInstance(getApplicationContext()).getOrderedMenu(order.getId(), menuId);

                    if (orderedMenu == null) {
                        orderedMenu = new OrderedMenu(0, menuId, order.getId(), quantity);
                        SingletonRestaurantManager.getInstance(getApplicationContext()).addOrderedMenuAPI(getApplicationContext(), orderedMenu);
                    }else{
                        orderedMenu.setQuantity(orderedMenu.getQuantity()+quantity);
                    }
                    price = (float) (orderedMenu.getMenu().getPrice()*orderedMenu.getQuantity());
                    SingletonRestaurantManager.getInstance(getApplicationContext()).updateOrderPrice(getApplicationContext(), price, order.getId());
                }
            }else{
                System.out.println("---> Entri aqui");
                order = new Order(0, userid, idRest, 0, status);
                SingletonRestaurantManager.getInstance(getApplicationContext()).addOrderAPI(getApplicationContext(), order, response1 -> {
                    Order o = SingletonRestaurantManager.getInstance(getApplicationContext()).getOrder(idRest, userid, status);

                    for (int i = 0; i < selectedMenuIds.size(); i++) {
                        OrderedMenu orderedMenu =new OrderedMenu();
                        Integer menuId = selectedMenuIds.get(i);
                        Integer quantity = selectedQuantities.get(i);
                        orderedMenu = new OrderedMenu(0, menuId, o.getId(), quantity);
                        SingletonRestaurantManager.getInstance(getApplicationContext()).addOrderedMenuAPI(getApplicationContext(), orderedMenu);

                    }
                });
            }
        });


    }

    @Override
    public void onRefreshMenusList(ArrayList<Menu> menus) {
        ArrayList<Menu> m = new ArrayList<>();
        int id = getIntent().getIntExtra(ID_REST, 0);
        if (menus != null){
            menus.forEach(menu -> {
                if (menu.getRestId() == id){
                    m.add(menu);
                }
            });
            binding.lvMenus.setAdapter(new MenusAdapter(getApplicationContext(), m));
        }
    }

    public void updateUI(String payload) {
        runOnUiThread(new Runnable() {
            @Override
            public void run() {
                TextView seuTextView = findViewById(R.id.textView44);
                seuTextView.setText(payload);
            }
        });
    }
}