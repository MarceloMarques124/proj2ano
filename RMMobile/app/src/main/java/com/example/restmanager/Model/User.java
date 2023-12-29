package com.example.restmanager.Model;

public class User {

    private int Id;
    private String Usermane;
    private String Address;
    private String DoorNumber;
    private String PostalCode;
    private int NIF;
    private String email;
    private String Password;

    public User() {
    }

    public User(int id, String usermane, String address, String doorNumber, String postalCode, int NIF, String email, String password) {
        this.Id = id;
        this.Usermane = usermane;
        this.Address = address;
        this.DoorNumber = doorNumber;
        this.PostalCode = postalCode;
        this.NIF = NIF;
        this.email = email;
        this.Password = password;
    }

    public int getId() {
        return Id;
    }

    public String getUsermane() {
        return Usermane;
    }

    public void setUsermane(String usermane) {
        Usermane = usermane;
    }

    public String getAddress() {
        return Address;
    }

    public void setAddress(String address) {
        Address = address;
    }

    public String getDoorNumber() {
        return DoorNumber;
    }

    public void setDoorNumber(String doorNumber) {
        DoorNumber = doorNumber;
    }

    public String getPostalCode() {
        return PostalCode;
    }

    public void setPostalCode(String postalCode) {
        PostalCode = postalCode;
    }

    public int getNIF() {
        return NIF;
    }

    public void setNIF(int NIF) {
        this.NIF = NIF;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getPassword() {
        return Password;
    }

    public void setPassword(String password) {
        Password = password;
    }
}
