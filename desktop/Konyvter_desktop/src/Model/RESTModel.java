
package Model;

import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.nio.charset.StandardCharsets;

import com.google.gson.JsonObject;
import com.google.gson.JsonParser;

public class RESTModel {
    
    private String token;
    private URL url;
    
    public String tryLogin() {
        
        try {
            token = Login();
        } catch (Exception ex) {
            ex.printStackTrace();
        }
        return token;
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
        text = new String(
                conn.getInputStream().readAllBytes(), 
                StandardCharsets.UTF_8);
        
        //új JSONelemző.elemző(text)
        JsonObject jsonObject = new JsonParser().parse(text).getAsJsonObject();
        JsonObject tokenObject = jsonObject.getAsJsonObject("data");
        //a substring levágja az idézőjeleket
        token = tokenObject.get("token").toString().substring(1, 45);
        
        return token;
    }


}
