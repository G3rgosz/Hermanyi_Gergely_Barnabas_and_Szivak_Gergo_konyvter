package Controller;

import Model.RESTModel;
import java.util.Vector;

public class RESTController {

    private RESTModel restMdl;
    private String token;
    private String search_text;
    private String id;
    
    public RESTController() {
        restMdl = new RESTModel();
        token = getToken();
        search_text = "";
        id = "";
    }
    private String getToken() {
        String token = restMdl.tryLogin();
        System.out.println(token);
        return token;
    }
    public void Logout() {
        restMdl.tryLogout(token);
    }
    public Vector<Vector<Object>> getUsers() {
        Vector<Vector<Object>> users = new Vector<>();
        
        users = restMdl.tryUsers(token, search_text);
        
        return users;
    }
    public Vector<Vector<Object>> getAdvertisments() {
        Vector<Vector<Object>> advertisments = new Vector<>();
        
        advertisments = restMdl.tryAdvertisments(token, search_text);
        
        return advertisments;
    }
    public Boolean DeleteUser() {
        boolean success = restMdl.tryDeleteUsers(token, id);
        return success;
    }
    public Boolean DeleteAdvertisment() {
        
        boolean success = restMdl.tryDeleteAdvertisments(token, id);
        return success;
    }
    public void setSearchData(String search_text) {
        
        this.search_text = search_text;
    }
    public void setDeleteData(String id) {
        this.id = id;
    }
}
