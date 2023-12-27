package com.example.restmanager.Model;

public class OerderedMenus {
    private int id;
    private int menuId;
    private int orderId;
    private int quantity;

    public OerderedMenus() {
    }

    public OerderedMenus(int id, int menuId, int orderId, int quantity) {
        this.id = id;
        this.menuId = menuId;
        this.orderId = orderId;
        this.quantity = quantity;
    }

    public int getId() {
        return id;
    }

    public int getMenuId() {
        return menuId;
    }

    public void setMenuId(int menuId) {
        this.menuId = menuId;
    }

    public int getOrderId() {
        return orderId;
    }

    public void setOrderId(int orderId) {
        this.orderId = orderId;
    }

    public int getQuantity() {
        return quantity;
    }

    public void setQuantity(int quantity) {
        this.quantity = quantity;
    }
}
