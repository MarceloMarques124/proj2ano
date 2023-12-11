package com.example.restmanager;

import static com.example.restmanager.RestaurantDetailsActivity.ID_RESTAURANT;

import android.content.Intent;
import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.Toast;

import com.example.restmanager.Adapters.RestaurantsAdapter;
import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.Model.SingletonRestaurantManager;
import com.example.restmanager.databinding.FragmentHomepageBinding;

import java.util.ArrayList;


public class HomepageFragment extends Fragment {
    private FragmentHomepageBinding binding;
    private ArrayList<Restaurant> restaurants;
    /*private ListView lvRestaurants;*/
    public HomepageFragment() {
        // Required empty public constructor
    }
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        binding = FragmentHomepageBinding.inflate(inflater, container, false);
        View view = binding.getRoot();

        restaurants = SingletonRestaurantManager.getInstance().getRestaurants();
        binding.lvRestaurants.setAdapter(new RestaurantsAdapter(getContext(), restaurants));


        binding.lvRestaurants.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Toast.makeText(getContext(), "ikpojfed", Toast.LENGTH_SHORT).show();
                Intent intent = new Intent(getContext(), RestaurantDetailsActivity.class); //Details de Restaurant
                intent.putExtra(ID_RESTAURANT, (int)id);
                startActivity(intent);

            }
        });
        return view;
    }

}