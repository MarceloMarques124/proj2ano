package com.example.restmanager.Fragments;

import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

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

        binding.etName.setText("Teste");
        binding.etAddress.setText("Rua da de teste de leiria");
        binding.etDoorNumber.setText("7.ªE");
        binding.etEmail.setText("teste@teste.com");
        binding.etNif.setText("256365966");
        binding.etPostalCode.setText("2425-963");
        binding.etUsername.setText("Teste");



        return view;
    }
}