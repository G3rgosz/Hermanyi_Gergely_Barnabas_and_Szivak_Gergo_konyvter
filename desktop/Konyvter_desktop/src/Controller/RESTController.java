package Controller;

import Model.RESTModel;
import java.util.Vector;

public class RESTController {

    private RESTModel restMdl;
    private String token;
    private String search_text;
    private String method;
    
    public RESTController() {
        restMdl = new RESTModel();
        token = getToken();
        search_text = "";
        method = "GET";
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
        
        users = restMdl.tryUsers(token, search_text, method);
        
        return users;
    }
    public Vector<Vector<Object>> getAdvertisments() {
        Vector<Vector<Object>> advertisments = new Vector<>();
        
        advertisments = restMdl.tryAdvertisments(token, search_text, method);
        
        return advertisments;
    }
    public void setData(String search_text, String method) {
        
        this.search_text = search_text;
        this.method = method;
    }
}
