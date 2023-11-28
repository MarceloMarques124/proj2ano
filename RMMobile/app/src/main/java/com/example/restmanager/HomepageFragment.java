package com.example.restmanager;

import android.content.Intent;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.SearchView;
import android.widget.Toast;

import com.example.restmanager.Adapters.RestaurantsAdapter;
import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.Model.SingletonRestaurantManager;
import com.example.restmanager.databinding.FragmentHomepageBinding;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;


public class HomepageFragment extends Fragment {
    private FragmentHomepageBinding binding;
    private ArrayList<Restaurant> restaurant;
    private ListView lvRestaurants;
    public HomepageFragment() {
        // Required empty public constructor
    }
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_homepage, container, false);

        restaurant = SingletonRestaurantManager.getInstance().getRestaurants();
        lvRestaurants = view.findViewById(R.id.lvRestaurants);
        lvRestaurants.setAdapter(new RestaurantsAdapter(getContext(), restaurant));

        /*lvRestaurants.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Toast.makeText(getContext(), restaurants.get(position).getName(), Toast.LENGTH_SHORT).show();
                Intent intent = new Intent(getContext(), BookDetailsActivity.class); //Details de Restaurant
                intent.putExtra(ID_BOOK, (int)id);
                startActivity(intent);
            }
        });*/

        // Inflate the layout for this fragment
        return view;
    }
}