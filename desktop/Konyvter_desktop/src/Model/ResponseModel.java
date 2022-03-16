package Model;

public class ResponseModel {

    private String method;
    private Integer responseCode;
    
    public ResponseModel() {}
    
    public void setData(String method, Integer responseCode) {
        this.method = method;
        this.responseCode = responseCode;
    }
    public String getMethod() {
        return method;
    }
    public Integer getResponseCode() {
        return responseCode;
    }
}
