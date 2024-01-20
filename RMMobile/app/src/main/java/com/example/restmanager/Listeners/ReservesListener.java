package com.example.restmanager.Listeners;

import com.example.restmanager.Model.Reserve;

import java.util.ArrayList;

public interface ReservesListener {
    void onRefreshReservesList(ArrayList<Reserve> reserves);
}
