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
        String token = restMdl.Login();
        return token;
    }
    public void Logout() {
        restMdl.Logout(token);
    }
    public Vector<Vector<Object>> getUsers() {
        Vector<Vector<Object>> users = new Vector<>();
        
        users = restMdl.Users(token, search_text);
        
        return users;
    }
    public Vector<Vector<Object>> getAdvertisments() {
        Vector<Vector<Object>> advertisments = new Vector<>();
        
        advertisments = restMdl.Advertisments(token, search_text);
        
        return advertisments;
    }
    public void DeleteUser() {
        restMdl.DeleteUsers(token, id);
    }
    public void DeleteAdvertisment() {
        restMdl.DeleteAdvertisments(token, id);
    }
    public void ValidAdvertisment() {
        restMdl.ValidAdvertisments(token, id);
    }
    public void setSearchData(String search_text) {
        this.search_text = search_text;
    }
    public void setId(String id) {
        this.id = id;
    }
    public String getLoginMessage() {
       String message = restMdl.getLoginMessage();
       return message;
    }
    public String getDeleteAdvertismentMessage() {
        String message = restMdl.getDeleteAdvertismentMessage();
        return message;
    }
    public String getDeleteUserMessage() {
        String message = restMdl.getDeleteUserMessage();
        return message;
    }
    public String getValidAdvertismentMessage() {
        String message = restMdl.getvalidAdvertismentMessage();
        return message;
    }
}
