package com.example.restmanager.Model;

public class User {

    private int Id;
    private String username;
    private String name;
    private String email;
    private String address;
    private String doorNumber;
    private String postalCode;
    private int nif;
    private String token;

    public User() {
    }

    public User(int id, String username, String name, String email, String address, String doorNumber, String postalCode, int nif, String token) {
        Id = id;
        this.username = username;
        this.name = name;
        this.email = email;
        this.address = address;
        this.doorNumber = doorNumber;
        this.postalCode = postalCode;
        this.nif = nif;
        this.token = token;
    }

    public int getId() {
        return Id;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getDoorNumber() {
        return doorNumber;
    }

    public void setDoorNumber(String doorNumber) {
        this.doorNumber = doorNumber;
    }

    public String getPostalCode() {
        return postalCode;
    }

    public void setPostalCode(String postalCode) {
        this.postalCode = postalCode;
    }

    public int getNif() {
        return nif;
    }

    public void setNif(int nif) {
        this.nif = nif;
    }

    public String getToken() {
        return token;
    }

    public void setToken(String token) {
        this.token = token;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }
}
