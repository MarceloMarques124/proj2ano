package com.example.restmanager.Model;

public class Restaurant {

    private int id;
    private String name;
    private String address;
    private int nif;
    private String email;
    private String mobileNumber;
    private int imgCover;

    public Restaurant(int id, String name, String address, int nif, String email, String mobileNumber, int imgCover) {
        this.id = id;
        this.name = name;
        this.address = address;
        this.nif = nif;
        this.email = email;
        this.mobileNumber = mobileNumber;
        this.imgCover = imgCover;
    }

    public int getId() {
        return id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public int getNif() {
        return nif;
    }

    public void setNif(int nif) {
        this.nif = nif;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getMobileNumber() {
        return mobileNumber;
    }

    public void setMobileNumber(String mobileNumber) {
        this.mobileNumber = mobileNumber;
    }

    public int getCover() {
        return imgCover;
    }

    public void setCover(int imgCover) {
        this.imgCover = imgCover;
    }
}
