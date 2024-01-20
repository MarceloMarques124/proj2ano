package com.example.restmanager.Listeners;

import com.example.restmanager.Model.Order;
import com.example.restmanager.Model.OrderedMenu;

import java.util.ArrayList;

public interface OrdersListener {
    void onRefreshTakeAwayOrdersList(ArrayList<Order> orders);

    void onRefreshOrderedMenusList(ArrayList<OrderedMenu> orderedMenus);
}
