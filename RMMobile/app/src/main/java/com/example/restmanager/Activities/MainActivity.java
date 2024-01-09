package com.example.restmanager.Activities;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;


import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;

import androidx.appcompat.widget.Toolbar;

import com.example.restmanager.Fragments.CartFragment;
import com.example.restmanager.Fragments.HomepageFragment;
import com.example.restmanager.Fragments.OrdersFragment;
import com.example.restmanager.Fragments.ProfileFragment;
import com.example.restmanager.Fragments.ReviewsFragment;
import com.example.restmanager.R;
import com.google.android.material.navigation.NavigationView;

public class MainActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener{


    public static final String USERNAME = "username";
    private NavigationView navigationView;
    private DrawerLayout drawer;
    private FragmentManager fragmentManager;
    private Fragment fragment;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        drawer = findViewById(R.id.drawerLayout);
        navigationView = findViewById(R.id.navView);

        navigationView.setNavigationItemSelectedListener(this);

        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(this, drawer, toolbar, R.string.ndOpen, R.string.ndClose);
        toggle.syncState();
        drawer.addDrawerListener(toggle);
        fragmentManager = getSupportFragmentManager();
        fragment = new HomepageFragment();
        fragmentManager.beginTransaction().replace(R.id.contentFragment, fragment).commit();
    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        Fragment fragment = null;
        Intent intent;

        if(item.getItemId()==R.id.navHome) {
            fragment = new HomepageFragment();
            setTitle(item.getTitle());
        }
        else if(item.getItemId()== R.id.navOrder){
            fragment = new OrdersFragment();
            setTitle(item.getTitle());
        }
        else if(item.getItemId()== R.id.navCart){
            fragment = new CartFragment();
            setTitle(item.getTitle());
        }
        else if(item.getItemId()== R.id.navReviews){
            fragment = new ReviewsFragment();
            setTitle(item.getTitle());
        }
        else if(item.getItemId()== R.id.navServerConnection){
            intent = new Intent(getApplicationContext(), ServerConnectionActivity.class);
            startActivity(intent);
        }
        else if(item.getItemId()== R.id.navProfile){
            fragment = new ProfileFragment();
            setTitle(item.getTitle());
        }
        if (fragment != null)
            fragmentManager.beginTransaction().replace(R.id.contentFragment, fragment).commit();

        drawer.closeDrawer(GravityCompat.START);
        return true;
    }

    /*public void onClickReserve(View view){
        Toast.makeText(this, "Reservation", Toast.LENGTH_SHORT).show();
        Intent intent = new Intent(getApplicationContext(), ReserveActivity.class);
        startActivity(intent);
    }

    public void onClickTakeAway(View view){
        Toast.makeText(this, "Take-Away", Toast.LENGTH_SHORT).show();
        Intent intent = new Intent(getApplicationContext(), OrdersActivity.class);
        startActivity(intent);
    }*/
}