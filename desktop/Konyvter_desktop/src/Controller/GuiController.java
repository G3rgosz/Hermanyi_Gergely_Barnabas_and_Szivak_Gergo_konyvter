package Controller;

import Model.RESTModel;
import View.mainFrame;

public class GuiController {

    private mainFrame mainFrm;
    private RESTModel restMdl;
    
    public GuiController() {
        
        restMdl = new RESTModel();
        initWindow();
        ActionListeners();
        getToken();
    }
    private void ActionListeners() {
        mainFrm.getSearchBtn().addActionListener( event -> { search(); } );
        mainFrm.getDeleteBtn().addActionListener( event -> {  } );
        mainFrm.getAdminBtn().addActionListener(event -> { addAdmin(); });
        mainFrm.getExitBtn().addActionListener( event -> { exit(); });
    }
    private void initWindow() {
        mainFrm = new mainFrame();
        mainFrm.setVisible(true);
    }
    

    private void search() {
        restMdl.tryLogout();
    }
    private void exit() {
        System.exit(0);
    }
    private void addAdmin() {
    

    }
    private void getToken() {
        

        
    }

}
