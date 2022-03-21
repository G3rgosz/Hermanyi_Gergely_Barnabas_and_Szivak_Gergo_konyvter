package Controller;

import Model.RESTModel;
import Model.ViewModel;
import View.confirmFrame;
import View.mainFrame;
import java.awt.Color;
import java.util.Vector;
import javax.swing.table.DefaultTableModel;
import javax.swing.table.TableModel;

public class GuiController {

    private mainFrame mainFrm;
    private confirmFrame confirmFrm;
    private RESTModel restMdl;
    private ViewModel viewMdl;
    private Vector<Vector<Object>> tableData;
    private RESTController restCtr;
    
    public GuiController(RESTController restCtr) {
        
        this.restCtr = restCtr;
        viewMdl = new ViewModel();
        initFrames();
        ActionListeners();
        ThreadStarter();
    }
    private void ActionListeners() {
        mainFrm.getSearchBtn().addActionListener( event -> { search(); } );
        mainFrm.getDeleteBtn().addActionListener( event -> { initConfirmFrame(); } );
        mainFrm.getExitBtn().addActionListener( event -> { exit(); });
        mainFrm.getTableTb().addChangeListener(event -> {initTables(); });
        
        confirmFrm.getConfirmBtn().addActionListener( event -> { delete(); } );
        confirmFrm.getCancelBtn().addActionListener( event -> { disposeConfrimFrame(); } );
    }
    private void initFrames() {
        mainFrm = new mainFrame();
        mainFrm.setVisible(true);
        
        confirmFrm = new confirmFrame();
        
        initTables();
    }
    private void initConfirmFrame() {
        confirmFrm.setVisible(true);
        confirmFrm.setAlwaysOnTop(true);
    }
    private void disposeConfrimFrame() {
        confirmFrm.dispose();
    }
    private void initTables() {
    
        Vector<String> columnNames = new Vector<>();
        tableData = new Vector<>();
        
        if(mainFrm.getTableTb().getSelectedIndex() == 0) {
                columnNames = viewMdl.getUserColumnNames();
                tableData = restCtr.getUsers();
                TableModel tableMdl = new DefaultTableModel(tableData, columnNames);
                mainFrm.getUserTbl().setModel(tableMdl);
        }else {
                columnNames = viewMdl.getAdvertismentColumnNames();
                tableData = restCtr.getAdvertisments();
                TableModel tableMdl = new DefaultTableModel(tableData, columnNames);
                mainFrm.getAdvertismentTbl().setModel(tableMdl);
        }   
    }
    private void ThreadStarter() {
        new Thread(runner).start();
    }
    private void search() {
        int openTab = mainFrm.getTableTb().getSelectedIndex();
        String search_text = mainFrm.getSearchTf().getText();
        if(openTab == 0) {
            restCtr.setSearchData(search_text);
            initTables();
        }else {
            restCtr.setSearchData(search_text);
            initTables();
        }
    }
    private void exit() {
        restCtr.Logout();
        System.exit(0);
    }
    private void delete() {
        int openTab = mainFrm.getTableTb().getSelectedIndex();
        if(openTab == 0) {
            deleteUser();
        }else {
            deleteAdvertisment();
        }
        confirmFrm.dispose();
    }
    private void deleteUser() {
        int row = mainFrm.getUserTbl().getSelectedRow();
        String value = mainFrm.getUserTbl().getModel().getValueAt(row, 3).toString();
        restCtr.setDeleteData(value);
        
        boolean success = restCtr.DeleteUser();
        if(success) {
            mainFrm.setStatusLbl("Sikeres felhasználó és hozzá tartozó hirdetések törlése");
        }else{
            mainFrm.setStatusLbl("Sikertelen felhasználó törlés");
        }
        initTables();
    }
    private void deleteAdvertisment() {
        int row = mainFrm.getAdvertismentTbl().getSelectedRow();
        String value = mainFrm.getAdvertismentTbl().getModel().getValueAt(row, 3).toString();
        restCtr.setDeleteData(value);
        
        boolean success = restCtr.DeleteAdvertisment();
        if( success ) {
            mainFrm.setStatusLbl("Sikeres hirdetés törlés");
        }else {
            mainFrm.setStatusLbl("Sikertelen hirdetés törlés");
        }
        initTables();
    }
    
    Runnable runner = () -> {
        timer();
    };
    private void timer() {
        boolean time = true;
        while(time) {
               initTables();
               try {
                Thread.sleep(30000);
            } catch (Exception ex) {
                ex.printStackTrace();
            }
        }
    }
}
