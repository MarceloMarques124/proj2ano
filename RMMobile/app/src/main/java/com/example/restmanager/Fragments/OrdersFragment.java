package com.example.restmanager.Fragments;

import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.example.restmanager.Adapters.OrdersAdapter;
import com.example.restmanager.Listeners.OrdersListener;
import com.example.restmanager.Model.Order;
import com.example.restmanager.Model.OrderedMenu;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.databinding.FragmentOrdersBinding;

import java.util.ArrayList;

public class OrdersFragment extends Fragment implements OrdersListener {
    private FragmentOrdersBinding binding;



    public OrdersFragment() {
        // Required empty public constructor


    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        binding = FragmentOrdersBinding.inflate(inflater, container, false);
        View view = binding.getRoot();

        SingletonRestaurantManager.getInstance(getContext()).setOrdersListener(this);
        /*SingletonRestaurantManager.getInstance(getContext()).getOrdersAPI(getContext(), new Response.Listener() {
            @Override
            public void onResponse(Object response) {
                Order order = SingletonRestaurantManager.getInstance(getApplicationContext()).getOrder(idRest, userid, status);
            }
        });*/

        // Inflate the layout for this fragment
        return view;
    }

    @Override
    public void onRefreshTakeAwayOrdersList(ArrayList<Order> orders) {
        if (orders != null){
            binding.lvDoneOrders.setAdapter(new OrdersAdapter(getContext(), orders));
        }
    }

    @Override
    public void onRefreshOrderedMenusList(ArrayList<OrderedMenu> orderedMenus) {

    }
}