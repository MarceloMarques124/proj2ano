package com.example.restmanager.Model;

public class Zone {
    private int id;
    private  String name;
    private int restId;
    private String description;
    private int capacity;

    public Zone() {
    }

    public Zone(int id, String name, int restId, String description, int capacity) {
        this.id = id;
        this.name = name;
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

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
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
