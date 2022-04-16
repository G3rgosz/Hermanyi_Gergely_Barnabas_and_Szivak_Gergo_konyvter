import Model.RESTModel;
import static org.junit.jupiter.api.Assertions.assertEquals;
import org.junit.Test;

public class testRESTModel {
    private RESTModel restMdl;

    @Test //Helyes adat
    public void testLogin() {
        restMdl = new RESTModel();
        restMdl.Login();
        
        Integer expected = 200;
        Integer actual = restMdl.loginResponseCode;
        
        assertEquals(expected, actual);
    }
    @Test //Hibás adat 500
    public void testLogout01() {
        restMdl = new RESTModel();
        String token = "";
        restMdl.Logout(token);
        
        Integer expected = 500;
        Integer actual = restMdl.logoutResponseCode;
        
        assertEquals(expected, actual);
    }
    @Test //Hibás adat 500
    public void testLogout02() {
        restMdl = new RESTModel();
        String token = "test";
        restMdl.Logout(token);
        
        Integer expected = 500;
        Integer actual = restMdl.logoutResponseCode;
        
        assertEquals(expected, actual);
    }
    @Test //Helyes adat
    public void testLogout03() {
        restMdl = new RESTModel();
        String token = restMdl.Login();
        restMdl.Logout(token);
        
        Integer expected = 200;
        Integer actual = restMdl.logoutResponseCode;
        
        assertEquals(expected, actual);
    }
    @Test //Hibás adat 500
    public void testUsers01() {
        restMdl = new RESTModel();
        
        String token = "";
        String search_text = "";
        restMdl.Users(token, search_text);
        
        Integer expected = 500;
        Integer actual = restMdl.usersResponseCode;

        assertEquals(expected, actual);
    }
    @Test //Helyes adat
    public void testUsers02() {
        restMdl = new RESTModel();
        
        String token = restMdl.Login();
        String search_text = "";
        restMdl.Users(token, search_text);
        
        Integer expected = 200;
        Integer actual = restMdl.usersResponseCode;

        assertEquals(expected, actual);
    }
    @Test //Hibás adat 500
    public void testAds01() {
        restMdl = new RESTModel();
        
        String token = "";
        String search_text = "";
        restMdl.Advertisments(token, search_text);
        
        Integer expected = 500;
        Integer actual = restMdl.advertismentResponseCode;
        
        assertEquals(expected, actual);
    }
    @Test //Hibás adat 404
    public void testAds02() {
        restMdl = new RESTModel();
        
        String token = restMdl.Login();
        String search_text = "asd";
        restMdl.Advertisments(token, search_text);
        
        Integer expected = 404;
        Integer actual = restMdl.advertismentResponseCode;
        
        assertEquals(expected, actual);
    }
    @Test //Helyes adat
    public void testAds03() {
        restMdl = new RESTModel();
        
        String token = restMdl.Login();
        String search_text = "";
        restMdl.Advertisments(token, search_text);
        
        Integer expected = 200;
        Integer actual = restMdl.advertismentResponseCode;
        
        assertEquals(expected, actual);
    }
    @Test //Hibás adat 404
    public void testDeleteUsers01() {
        restMdl = new RESTModel();
        
        String token = restMdl.Login();
        String id = "0";
        restMdl.DeleteUsers(token, id);
        
        Integer expected = 404;
        Integer actual = restMdl.deleteUserResponseCode;
        
        assertEquals(expected, actual);
    }
    @Test //Hibás adat 500
    public void testDeleteUsers02() {
        restMdl = new RESTModel();
        
        String token ="";
        String id = "2";
        restMdl.DeleteUsers(token, id);
        
        Integer expected = 500;
        Integer actual = restMdl.deleteUserResponseCode;
        
        assertEquals(expected, actual);
    }
    @Test //Hibás adat 404
    public void testDeleteUsers03() {
        restMdl = new RESTModel();
        
        String token = restMdl.Login();
        String id = "";
        restMdl.DeleteUsers(token, id);
        
        Integer expected = 404;
        Integer actual = restMdl.deleteUserResponseCode;
        
        assertEquals(expected, actual);
    }
    @Test //Helyes adat
    public void testDeleteUsers04() {
        restMdl = new RESTModel();
        
        String token = restMdl.Login();
        String id = "2";
        restMdl.DeleteUsers(token, id);
        
        Integer expected = 200;
        Integer actual = restMdl.deleteUserResponseCode;
        
        assertEquals(expected, actual);
    }
    @Test //Hibás adat 405
    public void testDeleteAdvertisments01() {
        restMdl = new RESTModel();
        
        String token = restMdl.Login();
        String id = "";
        
        restMdl.DeleteAdvertisments(token, id);
        
        Integer expected = 405;
        Integer actual = restMdl.deleteAdvertismentResponseCode;
        
        assertEquals(expected, actual);
    }
    @Test //Hibás adat 404
    public void testDeleteAdvertisments02() {
        restMdl = new RESTModel();
        
        String token = restMdl.Login();
        String id = "0";
        
        restMdl.DeleteAdvertisments(token, id);
        
        Integer expected = 404;
        Integer actual = restMdl.deleteAdvertismentResponseCode;
        
        assertEquals(expected, actual);
    }
    @Test //Hibás adat 500
    public void testDeleteAdvertisments03() {
        restMdl = new RESTModel();
        
        String token = "";
        String id = "1";
        
        restMdl.DeleteAdvertisments(token, id);
        
        Integer expected = 500;
        Integer actual = restMdl.deleteAdvertismentResponseCode;
        
        assertEquals(expected, actual);
    }
    @Test //helyes adat
    public void testDeleteAdvertisments04() {
        restMdl = new RESTModel();
        
        String token = restMdl.Login();
        String id = "1";
        
        restMdl.DeleteAdvertisments(token, id);
        
        Integer expected = 200;
        Integer actual = restMdl.deleteAdvertismentResponseCode;
        
        assertEquals(expected, actual);
    }
    @Test //Hibás adat 405
    public void testValidAdvertisments01() {
        restMdl = new RESTModel();
        
        String token = restMdl.Login();
        String id = "";
        
        restMdl.ValidAdvertisments(token, id);
        
        Integer expected = 405;
        Integer actual = restMdl.validAdvertismentResponseCode;
        
        assertEquals(expected, actual);
    }
    @Test //Hibás adat 404
    public void testValidAdvertisments02() {
        restMdl = new RESTModel();
        
        String token = restMdl.Login();
        String id = "0";
        
        restMdl.ValidAdvertisments(token, id);
        
        Integer expected = 404;
        Integer actual = restMdl.validAdvertismentResponseCode;
        
        assertEquals(expected, actual);
    }
    @Test //Hibás adat 500
    public void testValidAdvertisments03() {
        restMdl = new RESTModel();
        
        String token = "";
        String id = "1";
        
        restMdl.ValidAdvertisments(token, id);
        
        Integer expected = 500;
        Integer actual = restMdl.validAdvertismentResponseCode;
        
        assertEquals(expected, actual);
    }
    @Test //Helyes adat
    public void testValidAdvertisments04() {
        restMdl = new RESTModel();
        
        String token = restMdl.Login();
        String id = "3";
        
        restMdl.ValidAdvertisments(token, id);
        
        Integer expected = 200;
        Integer actual = restMdl.validAdvertismentResponseCode;
        
        assertEquals(expected, actual);
    }
}

