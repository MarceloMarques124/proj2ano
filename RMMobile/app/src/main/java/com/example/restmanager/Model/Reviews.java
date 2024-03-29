package com.example.restmanager.Model;

public class Reviews {
    private int id;
    private int userId;
    private int restId;
    private int stars;
    private String description;

    public Reviews() {
    }

    public Reviews(int id, int userId, int restId, int stars, String description) {
        this.id = id;
        this.userId = userId;
        this.restId = restId;
        this.stars = stars;
        this.description = description;
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
