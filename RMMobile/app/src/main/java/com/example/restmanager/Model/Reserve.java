package com.example.restmanager.Model;

import java.sql.Time;
import java.util.Date;

public class Reserve {
    private int id;
    private int userId;
    private String date;
    private String time;
    private String remarks;
    private int restId;
    private int peopleNumber;
    private int tablesNumber;

    public Reserve() {
    }

    public Reserve(int id, int userId, String date, String time, String remarks, int restId, int peopleNumber) {
        this.id = id;
        this.userId = userId;
        this.date = date;
        this.time = time;
        this.remarks = remarks;
        this.restId = restId;
        this.peopleNumber = peopleNumber;
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

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public String getTime() {
        return time;
    }

    public void setTime(String time) {
        this.time = time;
    }

    public String getRemarks() {
        return remarks;
    }

    public void setRemarks(String remarks) {
        this.remarks = remarks;
    }

    public int getRestId() {
        return restId;
    }

    public void setRestId(int restId) {
        this.restId = restId;
    }

    public int getPeopleNumber() {
        return peopleNumber;
    }

    public void setPeopleNumber(int peopleNumber) {
        this.peopleNumber = peopleNumber;
    }

    public int getTablesNumber() {
        return tablesNumber;
    }

    public void setTablesNumber(int tablesNumber) {
        this.tablesNumber = tablesNumber;
    }
}
