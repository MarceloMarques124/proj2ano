package com.example.restmanager.Model;

public class Table {
    private int id;
    private String description;
    private int capacity;

    public Table() {
    }

    public Table(int id, String description, int capacity) {
        this.id = id;
        this.description = description;
        this.capacity = capacity;
    }

    public int getId() {
        return id;
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
