package Controller;


public class MainController {
    
    public MainController() {
        RESTController restCtr = new RESTController();
        new GuiController(restCtr);
    }
        

}
