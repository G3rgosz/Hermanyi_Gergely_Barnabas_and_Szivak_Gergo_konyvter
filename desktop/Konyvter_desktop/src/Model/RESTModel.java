
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
    
    private String token;
    private URL url;
    
    public RESTModel() {
        token = tryLogin();
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
        
        String token = tokenObject.get("token").toString().substring(1, 44);

        System.out.println(token);
        return token;
    }
    public void tryLogout() {
        try {
            
            Logout();
        } catch (Exception ex) {
            ex.printStackTrace();
        }
    }
    private void Logout() throws Exception{
    
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

    public Vector<Vector<Object>> tryUsers() {
        Vector<Vector<Object>> users = new Vector<>();
        try {
            users = Users();
        } catch (Exception ex) {
            ex.printStackTrace();
        }
        return users;
    }
    private Vector<Vector<Object>> Users() throws Exception{
    
        URL url = new URL("http://localhost:8000/api/admin/users/");
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();
        
        conn.setRequestProperty("Authorization", "Bearer " +token);
        conn.setRequestMethod("GET");
        conn.setDoOutput(true);
        
        //String data = token;
        //byte[] out = data.getBytes(StandardCharsets.UTF_8);
        
        //OutputStream stream = conn.getOutputStream();
        //stream.write(out);
        
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
        
        System.out.println("lista: " +lista);
        
        Vector<Vector<Object>> users = new Vector<>();
        for(UserModel usermodel: lista) {
            
            Vector<Object> user = new Vector<>();
            
            user.add(usermodel.username);
            user.add(usermodel.email);
            user.add(usermodel.phone);
            
            users.add(user);
            
        }
        System.out.println(users);
        
        return users;
    }
}
