package com.example.restmanager.Model;

public class Reserve {
    private int id;
    private String userId;
    private String restId;
    private String date;
    private int zone;
    private String time;
    private String remarks;
    private int peopleNumber;
    private int tablesNumber;

    public Reserve(int id, String name, String date, String time, String remark, int idzone, int i, int peopleNumber) {
    }

    public Reserve(int id, String userId, String date, String time, String remarks, int zone, String restId, int peopleNumber) {
        this.id = id;
        this.userId = userId;
        this.date = date;
        this.time = time;
        this.remarks = remarks;
        this.zone = zone;
        this.restId = restId;
        this.peopleNumber = peopleNumber;
    }

    public int getId() {
        return id;
    }

    public String getUserId() {
        return userId;
    }

    public void setUserId(String userId) {
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

    public String getRestId() {
        return restId;
    }

    public void setRestId(String restId) {
        this.restId = restId;
    }

    public int getPeopleNumber() {
        return peopleNumber;
    }

    public void setPeopleNumber(int peopleNumber) {
        this.peopleNumber = peopleNumber;
    }

    public String getTablesNumber() {
        return String.valueOf(tablesNumber);
    }

    public void setTablesNumber(int tablesNumber) {
        this.tablesNumber = tablesNumber;
    }

    public int getZone() {
        return zone;
    }

    public void setZone(int zone) {
        this.zone = zone;
    }
}
