package com.example.restmanager.Model;

import java.sql.Time;
import java.util.Date;

public class Reservation {
    private int id;
    private int userId;
    private Date date;
    private Time time;
    private String remarks;
    private int restId;
    private int peopleNumber;
    private int tablesNumber;

    public Reservation() {
    }

    public Reservation(int id, int userId, Date date, Time time, String remarks, int restId, int peopleNumber) {
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

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    public Time getTime() {
        return time;
    }

    public void setTime(Time time) {
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
