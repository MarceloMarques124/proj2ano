package com.example.restmanager.Fragments;

import static com.example.restmanager.Activities.RestaurantDetailsActivity.ID_RESTAURANT;

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
import android.widget.SearchView;

import com.example.restmanager.Activities.RestaurantDetailsActivity;
import com.example.restmanager.Adapters.RestaurantsAdapter;
import com.example.restmanager.Listeners.RestaurantsListener;
import com.example.restmanager.Model.Restaurant;
import com.example.restmanager.R;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.databinding.FragmentHomepageBinding;

import java.util.ArrayList;


public class HomepageFragment extends Fragment implements RestaurantsListener{
    private FragmentHomepageBinding binding;
    private ArrayList<Restaurant> restaurants;
    /*private ListView lvRestaurants;*/
    private SearchView serachView;
    public HomepageFragment() {
        // Required empty public constructor
    }
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        setHasOptionsMenu(true);
        binding = FragmentHomepageBinding.inflate(inflater, container, false);
        View view = binding.getRoot();

       // restaurants = SingletonRestaurantManager.getInstance(getContext()).getRestaurants();

       // restaurants = SingletonRestaurantManager.getInstance(getContext()).getRestaurantsAPI();r
//        binding.lvRestaurants.setAdapter(new RestaurantsAdapter(getContext(), restaurants));

        binding.lvRestaurants.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent intent = new Intent(getContext(), RestaurantDetailsActivity.class); //Details de Restaurant
                intent.putExtra(ID_RESTAURANT, (int)id);
                startActivity(intent);

            }
        });

        binding.swipeLayout.setOnRefreshListener(this::onRefresh);


        SingletonRestaurantManager.getInstance(getContext()).setRestaurantsListener(this);
        SingletonRestaurantManager.getInstance(getContext()).getRestaurantsAPI(getContext());
        return view;
    }

    @Override
    public void onCreateOptionsMenu(@NonNull Menu menu, @NonNull MenuInflater inflater) {
        inflater.inflate(R.menu.search_menu, menu);

        MenuItem searchItem = menu.findItem(R.id.searchItem);

        serachView = (SearchView) searchItem.getActionView();

        serachView.setOnQueryTextListener(new SearchView.OnQueryTextListener() {
            @Override
            public boolean onQueryTextSubmit(String query) {
                return false;
            }

            @Override
            public boolean onQueryTextChange(String newText) {
                ArrayList<Restaurant> tempBook = new ArrayList<>();
//Search after API and DB
                /*for (Restaurant r:SingletonRestaurantManager.getInstance(getContext()).getRestaurants()){//Ask help
                    if (r.getName().toLowerCase().contains(newText.toLowerCase())){
                        tempBook.add(r);
                    }
                }*/

                binding.lvRestaurants.setAdapter(new RestaurantsAdapter(getContext(), tempBook));
                return true;
            }
        });
    }

    public void onRefresh(){
        SingletonRestaurantManager.getInstance(getContext()).getRestaurantsAPI(getContext());
        binding.swipeLayout.setRefreshing(false);
    }

    @Override
    public void onRefreshRestaurantsList(ArrayList<Restaurant> restaurants) {
        if (restaurants !=null){
            binding.lvRestaurants.setAdapter(new RestaurantsAdapter(getContext(), restaurants));
        }

        System.out.println("couna");
    }
}