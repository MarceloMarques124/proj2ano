package com.example.restmanager.Model;

public class Order {
    private int id;
    private String userId;
    private String restId;
    private float price;
    private String status;


    public Order(int id, String userId, String restId, float price, String status) {
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

    public String getUserId() {
        return userId;
    }

    public void setUserId(String userId) {
        this.userId = userId;
    }

    public String getRestId() {
        return restId;
    }

    public void setRestId(String restId) {
        this.restId = restId;
    }

    public float getPrice() {
        return price;
    }

    public void setPrice(float price) {
        this.price = price;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

}
