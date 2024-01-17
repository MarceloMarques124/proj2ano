package com.example.restmanager.Fragments;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.example.restmanager.Model.User;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.Utils.Public;
import com.example.restmanager.databinding.FragmentProfileBinding;

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link ProfileFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class ProfileFragment extends Fragment {
    private FragmentProfileBinding binding;

    public ProfileFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        binding = FragmentProfileBinding.inflate(inflater, container, false);
        View view = binding.getRoot();


        SharedPreferences sharedPreferences = getContext().getSharedPreferences(Public.DATAUSER, Context.MODE_PRIVATE);



        User u = SingletonRestaurantManager.getInstance(getContext()).getUserBD(sharedPreferences.getString(Public.TOKEN, "0"));

        binding.etUsername.setText(u.getUsername());
        binding.etName.setText(u.getName());
        binding.etAddress.setText(u.getAddress());
        binding.etDoorNumber.setText(u.getDoorNumber());
        binding.etEmail.setText(u.getEmail());
        binding.etNif.setText(u.getNif());
        binding.etPostalCode.setText(u.getPostalCode());



        return view;
    }
}