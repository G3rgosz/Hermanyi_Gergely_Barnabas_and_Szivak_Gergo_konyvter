
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
    private URL url;

    public RESTModel() {
        
    }

    public String tryLogin() {
        String result = "";
        try {
            result = Login();
        } catch (Exception ex) {
            ex.printStackTrace();
        }
        return result;
    }
    private String Login() throws Exception{
        
        URL url = new URL("http://localhost:8000/api/login");
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();
        conn.setRequestMethod("POST");
        conn.setDoOutput(true);
        //conn.setRequestProperty("Accept", "application/json");
        conn.setRequestProperty("Content-Type", "application/json");
        
        String data= "{\"username\":\"admin\",\"password\":\"admin\"}";
        byte[] out = data.getBytes(StandardCharsets.UTF_8);
        
        //ez küldi be az adatokat
        OutputStream stream = conn.getOutputStream();
        stream.write(out);
        
        conn.connect();
        String text = "";
        int responseCode = conn.getResponseCode();
        if(responseCode == 200) {
            text = new String(
                conn.getInputStream().readAllBytes(), 
                StandardCharsets.UTF_8);
        }else {
            throw new RuntimeException("Http válasz: " + responseCode);
        }
        //új JSONelemző.elemző(text)
        JsonObject jsonObject = new JsonParser().parse(text).getAsJsonObject();
        JsonObject tokenObject = jsonObject.getAsJsonObject("data");
        //a substring levágja az idézőjeleket
        //token = tokenObject.get("token").toString().substring(1, 45);
        
        String token = tokenObject.get("token").toString();
        String asd = token.substring(1, 44);
        //System.out.println(asd);
        return asd;
    }
    public void tryLogout(String token) {
        try {
            
            Logout(token);
        } catch (Exception ex) {
            ex.printStackTrace();
        }
    }
    private void Logout(String token) throws Exception{
    
        URL url = new URL("http://localhost:8000/api/logout");
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();
        
        conn.setRequestProperty("Authorization", "Bearer " +token);
        conn.setRequestMethod("POST");
        conn.setDoOutput(true);
        
        String data = token;
        //System.out.println(data);
        //System.out.println(token);
        byte[] out = data.getBytes(StandardCharsets.UTF_8);
        
        OutputStream stream = conn.getOutputStream();
        stream.write(out);
        
        String text = "";
        text = new String(
                conn.getInputStream().readAllBytes(), 
                StandardCharsets.UTF_8);
        
        System.out.println(text);
    }

    public Vector<Vector<Object>> tryUsers(String token, String search_text) {
        Vector<Vector<Object>> users = new Vector<>();
        try {
            users = Users(token, search_text);
        } catch (Exception ex) {
            ex.printStackTrace();
        }
        return users;
    }
    private Vector<Vector<Object>> Users(String token, String search_text) throws Exception{
    
        URL url = new URL("http://localhost:8000/api/admin/users/" + search_text);
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();
        
        conn.setRequestProperty("Authorization", "Bearer " +token);
        conn.setRequestMethod("GET");
        conn.setDoOutput(true);

        conn.connect();
        
        String text = "";
        int responseCode = conn.getResponseCode();
        if(responseCode == 200) {
            text = new String(
                conn.getInputStream().readAllBytes(), 
                StandardCharsets.UTF_8);
        }else {
            throw new RuntimeException("Http válasz: " + responseCode);
        }
        //System.out.println(text);
        JsonObject jsonObject = new JsonParser().parse(text).getAsJsonObject();
        GsonBuilder builder = new GsonBuilder();
        builder.setPrettyPrinting();
        Gson gson = builder.create();

        JsonArray arr = jsonObject.getAsJsonArray("data");
        
        UserModel[] userArray = gson.fromJson(arr, UserModel[].class);
        ArrayList<UserModel> lista = new ArrayList<>(Arrays.asList(userArray));
        
        //System.out.println("lista: " +lista);
        
        Vector<Vector<Object>> users = new Vector<>();
        for(UserModel usermodel: lista) {
            
            Vector<Object> user = new Vector<>();
            
            user.add(usermodel.username);
            user.add(usermodel.email);
            user.add(usermodel.phone);
            
            users.add(user);
            
        }
        //System.out.println(users);
        
        return users;
    }
    public Vector<Vector<Object>> tryAdvertisments(String token, String search_text, String ad_method) {
        Vector<Vector<Object>> advertisments = new Vector<>();
        try {
            advertisments = Advertisments(token, search_text, ad_method);
        } catch (Exception ex) {
            ex.printStackTrace();
        }
        return advertisments;
    }
    private Vector<Vector<Object>> Advertisments(String token, String search_text, String ad_method) throws Exception{
        URL url = new URL("http://localhost:8000/api/admin/reportedads/" + search_text);
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();
        
        conn.setRequestProperty("Authorization", "Bearer " +token);
        conn.setRequestMethod(ad_method);
        conn.setDoOutput(true);

        conn.connect();
        
        String text = "";
        int responseCode = conn.getResponseCode();
        if(responseCode == 200) {
            text = new String(
                conn.getInputStream().readAllBytes(), 
                StandardCharsets.UTF_8);
        }else {
            throw new RuntimeException("Http válasz: " + responseCode);
        }
        //System.out.println(text);
        JsonObject jsonObject = new JsonParser().parse(text).getAsJsonObject();
        GsonBuilder builder = new GsonBuilder();
        builder.setPrettyPrinting();
        Gson gson = builder.create();

        JsonArray arr = jsonObject.getAsJsonArray("data");
        
        AdvertismentModel[] adArray = gson.fromJson(arr, AdvertismentModel[].class);
        ArrayList<AdvertismentModel> lista = new ArrayList<>(Arrays.asList(adArray));
        
        //System.out.println("lista: " +lista);
        
        Vector<Vector<Object>> advertisments = new Vector<>();
        for(AdvertismentModel advertismentmodel: lista) {
            
            Vector<Object> advertisment = new Vector<>();
            
            advertisment.add(advertismentmodel.adtitle);
            advertisment.add(advertismentmodel.username);
            advertisment.add(advertismentmodel.badcontent);
            advertisment.add(advertismentmodel.id);
            
            advertisments.add(advertisment);
            
        }
        //System.out.println(advertisments);
        
        return advertisments;
    }

}
