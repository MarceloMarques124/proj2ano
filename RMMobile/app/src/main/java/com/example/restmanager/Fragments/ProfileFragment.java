package com.example.restmanager.Fragments;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;

import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;

import android.text.Editable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.android.volley.Response;
import com.example.restmanager.Activities.MainActivity;
import com.example.restmanager.Model.User;
import com.example.restmanager.R;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.Utils.Public;
import com.example.restmanager.databinding.FragmentProfileBinding;


public class ProfileFragment extends Fragment {
    private FragmentProfileBinding binding;
    private User u = new User();
    private FragmentManager fragmentManager;
    private Fragment fragment;

    public ProfileFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        binding = FragmentProfileBinding.inflate(inflater, container, false);
        View view = binding.getRoot();

        fragmentManager = getActivity().getSupportFragmentManager();

        SharedPreferences sharedPreferences = getContext().getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);
        u = SingletonRestaurantManager.getInstance(getContext()).getUserBD(sharedPreferences.getString(Public.TOKEN, "0"));
        if (u == null)
            System.out.println("---> User Null");

        binding.etUsername.setText(u.getUsername());
        binding.etName.setText(u.getName());
        binding.etAddress.setText(u.getAddress());
        binding.etDoorNumber.setText(u.getDoorNumber());
        binding.etEmail.setText(u.getEmail());
        binding.etNif.setText(u.getNif() + "");
        binding.etPostalCode.setText(u.getPostalCode()+"");

        binding.btnSaveUser.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (u != null){
                    u.setUsername(binding.etUsername.getText().toString());
                    u.setName(binding.etName.getText().toString());
                    u.setAddress(binding.etAddress.getText().toString());
                    u.setDoorNumber(binding.etDoorNumber.getText().toString());
                    u.setEmail(binding.etEmail.getText().toString());
                    u.setNif(Integer.parseInt(binding.etNif.getText().toString()));
                    u.setPostalCode(binding.etPostalCode.getText().toString());
                }

                SingletonRestaurantManager.getInstance(getContext()).editUserAPI(u, getContext(), new Response.Listener() {
                    @Override
                    public void onResponse(Object response) {
                        if (getActivity() != null && getActivity() instanceof AppCompatActivity) {
                            // Certifique-se de que a atividade é uma instância de AppCompatActivity
                            ((AppCompatActivity) getActivity()).getSupportActionBar().setTitle("Homepage");
                        }
                        fragment = new HomepageFragment();
                        fragmentManager.beginTransaction().replace(R.id.contentFragment, fragment).commit();
                    }
                });
            }
        });


        return view;
    }
}