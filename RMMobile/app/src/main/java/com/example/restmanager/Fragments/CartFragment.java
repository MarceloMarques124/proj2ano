package com.example.restmanager.Fragments;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;

import androidx.fragment.app.Fragment;

import com.example.restmanager.Adapters.OrdersAdapter;
import com.example.restmanager.Listeners.OrdersListener;
import com.example.restmanager.Model.Order;
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
            }
        });

        SingletonRestaurantManager.getInstance(getContext()).setOrdersListener(this);
        SingletonRestaurantManager.getInstance(getContext()).getTakeAwayOrdersAPI(getContext());

        return view;
    }

    @Override
    public void onRefreshTakeAwayOrdersList(ArrayList<Order> orders) {
        if (orders != null)
            binding.lvCartRests.setAdapter(new OrdersAdapter(getContext(), orders));
    }
}