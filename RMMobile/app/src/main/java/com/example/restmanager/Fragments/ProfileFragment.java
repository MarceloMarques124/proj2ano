package com.example.restmanager.Fragments;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.text.Editable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.example.restmanager.Model.User;
import com.example.restmanager.Singleton.SingletonRestaurantManager;
import com.example.restmanager.Utils.Public;
import com.example.restmanager.databinding.FragmentProfileBinding;


public class ProfileFragment extends Fragment {
    private FragmentProfileBinding binding;
    private User u = new User();

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



                    SingletonRestaurantManager.getInstance(getContext()).editUserAPI(u, getContext());
                }
            }
        });

        return view;
    }

    public void onClickSaveUser() {


        User u = new User();

    }
}