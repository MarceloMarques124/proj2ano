package com.example.restmanager.Model;

public class MenuItem {
    private int id;
    private String name;
    private int menuId;
    private double price;

    public MenuItem() {
        super();
    }

    public MenuItem(int id, String name, int menuId, double price) {
        this.id = id;
        this.name = name;
        this.menuId = menuId;
        this.price = price;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public int getMenuId() {
        return menuId;
    }

    public void setMenuId(int menuId) {
        this.menuId = menuId;
    }

    public double getPrice() {
        return price;
    }

    public void setPrice(double price) {
        this.price = price;
    }
}
