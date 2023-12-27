package com.example.restmanager.Model;

public class Menu {
    private int id;
    private String name;
    private String description;
    private double price;
    private int restId;
    private int quantity;
    public Menu(int id, String name, String description, double price, int restId) {
        this.id = id;
        this.name = name;
        this.description = description;
        this.price = price;
        this.restId = restId;
        this.quantity = 0;
    }

    public int getId() {
        return id;
    }

    public String getName() {
        return name;
    }

    public String getDescription() {
        return description;
    }

    public int getQuantity() {
        return quantity;
    }

    public void setQuantity(int quantity) {
        this.quantity = quantity;
    }

    public double getPrice() {
        return price;
    }

    public void setPrice(double price) {
        this.price = price;
    }

    public int getRestId() {
        return restId;
    }

    public void setRestId(int restId) {
        this.restId = restId;
    }
}
