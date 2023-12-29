package com.example.restmanager.Fragments;

import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.example.restmanager.databinding.FragmentCartBinding;

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link CartFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class CartFragment extends Fragment {
    private FragmentCartBinding binding;
    public CartFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        binding = FragmentCartBinding.inflate(inflater, container, false);
        View view = binding.getRoot();

        /*get de restaurantes pelo carrinho
        * ou seja, buscar as ordered menus e apresentar os restaurantes referidos
        *
        * Aparecer os restaurantes em que o cliente colocou menus no carrinho
        *
        * Ao clicar num restaurante, abre os itens para remover ou finhalizar a compra*/

        return view;
    }
}