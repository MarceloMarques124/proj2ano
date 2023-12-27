package com.example.restmanager.Model;

public class Zone {
    private int id;
    private int restId;
    private String description;
    private int capacity;

    public Zone() {
    }

    public Zone(int id, int restId, String description, int capacity) {
        this.id = id;
        this.restId = restId;
        this.description = description;
        this.capacity = capacity;
    }

    public int getId() {
        return id;
    }

    public int getRestId() {
        return restId;
    }

    public void setRestId(int restId) {
        this.restId = restId;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public int getCapacity() {
        return capacity;
    }

    public void setCapacity(int capacity) {
        this.capacity = capacity;
    }
}
