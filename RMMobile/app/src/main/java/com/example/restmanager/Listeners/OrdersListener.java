package com.example.restmanager.Listeners;

import com.example.restmanager.Model.Order;

import java.util.ArrayList;

public interface OrdersListener {
    void onRefreshTakeAwayOrdersList(ArrayList<Order> orders);
}
