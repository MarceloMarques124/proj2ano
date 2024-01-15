package com.example.restmanager.Model;

public class Signup {

    private String name;
    private String username;
    private String email;
    private String password;
    private int nif;
    private String address;
    private String doorNumber;
    private String postalCode;

    public Signup(String name, String username, String email, String password, int nif, String address, String doorNumber, String postalCode) {
        this.name = name;
        this.username = username;
        this.email = email;
        this.password = password;
        this.nif = nif;
        this.address = address;
        this.doorNumber = doorNumber;
        this.postalCode = postalCode;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public int getNif() {
        return nif;
    }

    public void setNif(int nif) {
        this.nif = nif;
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
}
