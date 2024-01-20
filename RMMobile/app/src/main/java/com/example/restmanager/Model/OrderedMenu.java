package com.example.restmanager.Model;

public class OrderedMenu {
    private int id;
    private int menuId;
    private int orderId;
    private int quantity;

    private Menu menu;
    private Order order;

    public OrderedMenu() {
    }

    public OrderedMenu(int id, int menuId, int orderId, int quantity) {
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

    public Menu getMenu() {
        return menu;
    }

    public void setMenu(Menu menu) {
        this.menu = menu;
    }

    public Order getOrder() {
        return order;
    }

    public void setOrder(Order order) {
        this.order = order;
    }
}
