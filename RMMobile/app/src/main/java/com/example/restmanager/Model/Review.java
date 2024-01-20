package com.example.restmanager.Model;

public class Review {
    private int id;
    private String userName;
    private String restId;
    private int stars;
    private String description;
    private  static int autoIncrementId = 1;


    public Review() {
    }

    public Review(int id, String userId, String restId, int stars, String description) {
        this.id = id;
        this.userName = userId;
        this.restId = restId;
        this.stars = stars;
        this.description = description;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getId() {
        return id;
    }

    public String getUserId() {
        return userName;
    }

    public void setUserId(String userId) {
        this.userName = userId;
    }

    public String getRestId() {
        return restId;
    }

    public void setRestId(String restId) {
        this.restId = restId;
    }

    public int getStars() {
        return stars;
    }

    public void setStars(int stars) {
        this.stars = stars;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }
}
