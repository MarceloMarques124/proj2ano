package com.example.restmanager.Model;

public class Order {
    private int id;
    private int userId;
    private int restId;
    private int price;
    private String status;

    public Order(int id, int userId, int restId, int price, String status) {
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

    public int getPrice() {
        return price;
    }

    public void setPrice(int price) {
        this.price = price;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }
}
