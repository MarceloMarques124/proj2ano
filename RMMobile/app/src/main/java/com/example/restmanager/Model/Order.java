package com.example.restmanager.Model;

public class Order {
    private int id;
    private int userId;
    private int restId;
    private float price;
    private int status;

    private Restaurant restaurant;

    public Order(int id, int userId, int restId, float price, int status) {
        this.id = id;
        this.userId = userId;
        this.restId = restId;
        this.price = price;
        this.status = status;
    }

    public Order() {
    }

    public int getId() {
        return id;
    }

    public int getUserId() {
        return userId;
    }

    public void setUserId(int userId) {
        this.userId = userId;
    }

    public int getRestId() {
        return restId;
    }

    public void setRestId(int restId) {
        this.restId = restId;
    }

    public float getPrice() {
        return price;
    }

    public void setPrice(float price) {
        this.price = price;
    }

    public int getStatus() {
        return status;
    }

    public void setStatus(int status) {
        this.status = status;
    }

    public Restaurant getRestaurant() {
        return restaurant;
    }

    public void setRestaurant(Restaurant restaurant) {
        this.restaurant = restaurant;
    }
}
