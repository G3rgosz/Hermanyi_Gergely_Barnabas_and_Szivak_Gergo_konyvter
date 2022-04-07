package Model;

import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.Arrays;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.google.gson.JsonParser;
import java.util.Vector;


public class RESTModel {

    private String loginMessage;
    private String deleteUserMessage;
    private String deleteAdvertismentMessage;
    private String validAdvertismentMessage;
    
    public Integer loginResponseCode;
    public Integer logoutResponseCode;
    public Integer usersResponseCode;
    public Integer advertismentResponseCode;
    public Integer deleteUserResponseCode;
    public Integer deleteAdvertismentResponseCode;
    public Integer validAdvertismentResponseCode;
    
    public String Login() {
        String result = "";
        try {
            result = tryLogin();
        } catch (Exception ex) {
            ex.printStackTrace();
        }
        return result;
    }
    private String tryLogin() throws Exception{
        
        URL url = new URL("http://localhost:8000/api/login");
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();
        conn.setRequestMethod("POST");
        conn.setDoOutput(true);
        conn.setRequestProperty("Content-Type", "application/json");
        
        String data= "{\"username\":\"admin\",\"password\":\"admin\"}";
        byte[] out = data.getBytes(StandardCharsets.UTF_8);
        
        OutputStream stream = conn.getOutputStream();
        stream.write(out);
        
        conn.connect();
        String text = "";
        loginResponseCode = conn.getResponseCode();
        if(loginResponseCode == 200) {
            text = new String(
                conn.getInputStream().readAllBytes(), 
                StandardCharsets.UTF_8);
        }else {
            throw new RuntimeException("Http válasz: " + loginResponseCode);
        }
        JsonObject jsonObject = new JsonParser().parse(text).getAsJsonObject();
        JsonObject tokenObject = jsonObject.getAsJsonObject("data");
        
        String message_raw = jsonObject.get("message").toString();
        loginMessage = message_raw.substring(1, message_raw.length() - 1);
        
        String token_raw = tokenObject.get("token").toString();
        String token = token_raw.substring(1, token_raw.length() - 1);
        
        return token;
    }
    public void Logout(String token) {
        try {
            tryLogout(token);
        } catch (Exception ex) {
            ex.printStackTrace();
        }
    }
    private void tryLogout(String token) throws Exception{
    
        URL url = new URL("http://localhost:8000/api/logout");
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();
        
        conn.setRequestProperty("Authorization", "Bearer " +token);
        conn.setRequestMethod("POST");
        conn.setDoOutput(true);

        String data = token;
        byte[] out = data.getBytes(StandardCharsets.UTF_8);
        
        OutputStream stream = conn.getOutputStream();
        stream.write(out);
        
        logoutResponseCode = conn.getResponseCode();
    }

    public Vector<Vector<Object>> Users(String token, String search_text) {
        Vector<Vector<Object>> users = new Vector<>();
        try {
            users = tryUsers(token, search_text);
        } catch (Exception ex) {
            ex.printStackTrace();
        }
        return users;
    }
    private Vector<Vector<Object>> tryUsers(String token, String search_text) throws Exception{
    
        URL url = new URL("http://localhost:8000/api/admin/users/" + search_text);
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();
        
        conn.setRequestProperty("Authorization", "Bearer " +token);
        conn.setRequestMethod("GET");
        conn.setDoOutput(true);

        conn.connect();
        
        String text = "";
        usersResponseCode = conn.getResponseCode();
        if(usersResponseCode == 200) {
            text = new String(
                conn.getInputStream().readAllBytes(), 
                StandardCharsets.UTF_8);
        }else {
            throw new RuntimeException("Http válasz: " + usersResponseCode);
        }
        JsonObject jsonObject = new JsonParser().parse(text).getAsJsonObject();
        GsonBuilder builder = new GsonBuilder();
        builder.setPrettyPrinting();
        Gson gson = builder.create();

        JsonArray arr = jsonObject.getAsJsonArray("data");
        
        UserModel[] userArray = gson.fromJson(arr, UserModel[].class);
        ArrayList<UserModel> lista = new ArrayList<>(Arrays.asList(userArray));
        
        Vector<Vector<Object>> users = new Vector<>();
        for(UserModel usermodel: lista) {
            
            Vector<Object> user = new Vector<>();

            user.add(usermodel.username);
            user.add(usermodel.email);
            user.add(usermodel.phone);
            user.add(usermodel.id);
            
            users.add(user);
            
        }
        return users;
    }
    public Vector<Vector<Object>> Advertisments(String token, String search_text) {
        Vector<Vector<Object>> advertisments = new Vector<>();
        try {
            advertisments = tryAdvertisments(token, search_text);
        } catch (Exception ex) {
            ex.printStackTrace();
        }
        return advertisments;
    }
    private Vector<Vector<Object>> tryAdvertisments(String token, String search_text) throws Exception{
        URL url = new URL("http://localhost:8000/api/admin/reportedads/" + search_text);
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();
        
        conn.setRequestProperty("Authorization", "Bearer " +token);
        conn.setRequestMethod("GET");
        conn.setDoOutput(true);

        conn.connect();
        
        String text = "";
        advertismentResponseCode = conn.getResponseCode();
        if(advertismentResponseCode == 200) {
            text = new String(
                conn.getInputStream().readAllBytes(), 
                StandardCharsets.UTF_8);
        }else {
            throw new RuntimeException("Http válasz: " + advertismentResponseCode);
        }
        JsonObject jsonObject = new JsonParser().parse(text).getAsJsonObject();
        GsonBuilder builder = new GsonBuilder();
        builder.setPrettyPrinting();
        Gson gson = builder.create();

        JsonArray arr = jsonObject.getAsJsonArray("data");
        
        AdvertismentModel[] adArray = gson.fromJson(arr, AdvertismentModel[].class);
        ArrayList<AdvertismentModel> lista = new ArrayList<>(Arrays.asList(adArray));

        Vector<Vector<Object>> advertisments = new Vector<>();
        for(AdvertismentModel advertismentmodel: lista) {
            
            Vector<Object> advertisment = new Vector<>();
            
            advertisment.add(advertismentmodel.adtitle);
            advertisment.add(advertismentmodel.username);
            advertisment.add(advertismentmodel.badcontent);
            advertisment.add(advertismentmodel.id);
            
            advertisments.add(advertisment);
            
        }
        return advertisments;
    }
    
    public void DeleteUsers(String token, String id) {
        try {
            tryDeleteUsers(token, id);
        } catch (Exception ex) {
            ex.printStackTrace();
        }
    }
    private void tryDeleteUsers(String token, String id) throws Exception{
    
        URL url = new URL("http://localhost:8000/api/account/" + id);
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();
        
        conn.setRequestProperty("Authorization", "Bearer " +token);
        conn.setRequestMethod("DELETE");
        conn.setDoOutput(true);

        conn.connect();
        
        String text = "";
        deleteUserResponseCode = conn.getResponseCode();
        
        if(deleteUserResponseCode == 200) {
            text = new String(
                conn.getInputStream().readAllBytes(), 
                StandardCharsets.UTF_8);
        }else {
            throw new RuntimeException("Http válasz: " + deleteUserResponseCode);
        }
        
        JsonObject jsonObject = new JsonParser().parse(text).getAsJsonObject();
        
        String message_raw = jsonObject.get("message").toString();
        deleteUserMessage = message_raw.substring(1, message_raw.length() - 1);
    }
    public void DeleteAdvertisments(String token, String id) {
        try {
            tryDeleteAdvertisments(token, id);
        } catch (Exception ex) {
            ex.printStackTrace();
        }
    }
    private void tryDeleteAdvertisments(String token, String id) throws Exception{
        URL url = new URL("http://localhost:8000/api/web/advertisements/" + id);
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();
        
        conn.setRequestProperty("Authorization", "Bearer " +token);
        conn.setRequestMethod("DELETE");
        conn.setDoOutput(true);

        conn.connect();
        
        deleteAdvertismentResponseCode = conn.getResponseCode();
        String text = "";
        
        if(deleteAdvertismentResponseCode == 200) {
            text = new String(
                conn.getInputStream().readAllBytes(), 
                StandardCharsets.UTF_8);
        }else {
            throw new RuntimeException("Http válasz: " + deleteAdvertismentResponseCode);
        }
        
        JsonObject jsonObject = new JsonParser().parse(text).getAsJsonObject();
        
        String message_raw = jsonObject.get("message").toString();
        deleteAdvertismentMessage = message_raw.substring(1, message_raw.length() - 1);
        
    }
    
    public void ValidAdvertisments(String token, String id) {
        try {
            tryValidAdvertisments(token, id);
        } catch (Exception ex) {
            ex.printStackTrace();
        }
    }
    private void tryValidAdvertisments(String token, String id) throws Exception{
        URL url = new URL("http://localhost:8000/api/admin/reportedads/remove/" + id);
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();
        
        conn.setRequestProperty("Authorization", "Bearer " +token);
        conn.setRequestMethod("PUT");
        conn.setDoOutput(true);

        conn.connect();
        
        validAdvertismentResponseCode = conn.getResponseCode();
        String text = "";
        
        if(validAdvertismentResponseCode == 200) {
            text = new String(
                conn.getInputStream().readAllBytes(), 
                StandardCharsets.UTF_8);
        }else {
            throw new RuntimeException("Http válasz: " + validAdvertismentResponseCode);
        }
        
        JsonObject jsonObject = new JsonParser().parse(text).getAsJsonObject();
        
        String message_raw = jsonObject.get("message").toString();
        validAdvertismentMessage = message_raw.substring(1, message_raw.length() - 1);
    }
    
    public String getLoginMessage() {
        return loginMessage;
    }
    public String getDeleteUserMessage() {
        return deleteUserMessage;
    }
    public String getDeleteAdvertismentMessage() {
        return deleteAdvertismentMessage;
    }
    public String getvalidAdvertismentMessage() {
        return validAdvertismentMessage;
    }
}
