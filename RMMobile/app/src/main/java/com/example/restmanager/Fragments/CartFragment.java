package com.example.restmanager.Fragments;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.Toast;

import androidx.fragment.app.Fragment;

import com.android.volley.Response;
import com.example.restmanager.Adapters.OrdersAdapter;
import com.example.restmanager.Listeners.OrdersListener;
import com.example.restmanager.Model.Order;
import com.example.restmanager.Model.OrderedMenu;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.databinding.FragmentCartBinding;

import java.util.ArrayList;

public class CartFragment extends Fragment implements OrdersListener {
    private FragmentCartBinding binding;

    public CartFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        setHasOptionsMenu(true);
        binding = FragmentCartBinding.inflate(inflater, container, false);
        View view = binding.getRoot();

        /*get de restaurantes pelo carrinho
         * ou seja, buscar as ordered menus e apresentar os restaurantes referidos
         *
         * Aparecer os restaurantes em que o cliente colocou menus no carrinho
         *
         * Ao clicar num restaurante, abre os itens para remover ou finhalizar a compra*/


        binding.lvCartRests.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Toast.makeText(getContext(), "teste " + id, Toast.LENGTH_SHORT).show();
            }
        });

        SingletonRestaurantManager.getInstance(getContext()).setOrdersListener(this);
        SingletonRestaurantManager.getInstance(getContext()).getOrdersAPI(getContext(), new Response.Listener() {
            @Override
            public void onResponse(Object response) {
                //Order order = SingletonRestaurantManager.getInstance(getApplicationContext()).getOrder(idRest, userid, status);
            }
        });

        return view;
    }

    @Override
    public void onRefreshTakeAwayOrdersList(ArrayList<Order> orders) {
        if (orders != null) {
            ArrayList<Order> auxOrders = new ArrayList<>();

            orders.forEach(order -> {
                if (order.getStatus() == 1)
                    auxOrders.add(order);
            });
            binding.lvCartRests.setAdapter(new OrdersAdapter(getContext(), orders));
        }

         /*   return;

        // receber todos os restaurantes para enviar o nome de cada restaurante juntamente com o orderedMenu
        ArrayList<Restaurant> restaurants = SingletonRestaurantManager.getInstance(getContext()).getRestaurantsDB();
        ArrayList<OrderedMenu> orderedMenus = SingletonRestaurantManager.getInstance(getContext()).getOrderedMenusDB();

        orders.forEach(order -> {

            // buscar o restaurante do pedido
            Restaurant orderRestaurant = restaurants.stream().filter(or -> or.getId() == order.getId()).findFirst().orElse(null);

            if (orderRestaurant == null) return;

            // definir o restaurante do pedido
            order.setRestaurant(orderRestaurant);

            // filtrar os menus do pedido
            ArrayList<OrderedMenu> orderOrderedMenus = orderedMenus.stream().filter(orderedMenu -> orderedMenu.getOrderId() == order.getId()).collect(Collectors.toCollection(ArrayList::new));

            // por cada um preencher o pedido para poder depois usar os dados a contruir cada item da lista
            orderOrderedMenus.forEach(orderedMenu -> orderedMenu.setOrder(order));
        });*/


    }

    @Override
    public void onRefreshOrderedMenusList(ArrayList<OrderedMenu> orderedMenus) {

    }
}