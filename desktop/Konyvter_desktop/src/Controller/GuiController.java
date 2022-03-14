package Controller;

import Model.RESTModel;
import Model.ViewModel;
import View.mainFrame;
import java.util.Vector;
import javax.swing.table.DefaultTableModel;
import javax.swing.table.TableModel;

public class GuiController {

    private mainFrame mainFrm;
    private RESTModel restMdl;
    private ViewModel viewMdl;
    private Vector<Vector<Object>> tableData;
    private Vector<Vector<Object>> asd;
    public GuiController() {
        
        restMdl = new RESTModel();
        viewMdl = new ViewModel();
        initWindow();
        ActionListeners();
        initTables();
        getToken();
    }
    private void ActionListeners() {
        mainFrm.getSearchBtn().addActionListener( event -> { search(); } );
        mainFrm.getDeleteBtn().addActionListener( event -> {  } );
        mainFrm.getAdminBtn().addActionListener(event -> { addAdmin(); });
        mainFrm.getExitBtn().addActionListener( event -> { exit(); });
        mainFrm.getTableTb().addChangeListener(event -> {initTables(); });

    }
    private void initWindow() {
        mainFrm = new mainFrame();
        mainFrm.setVisible(true);
    }
    private void initTables() {
    
        Vector<String> columnNames = new Vector<>();
        tableData = new Vector<>();
        
        if(mainFrm.getTableTb().getSelectedIndex() == 0) {
                columnNames = viewMdl.getUserColumnNames();
                tableData = restMdl.tryUsers();
                TableModel tableMdl = new DefaultTableModel(tableData, columnNames);
                mainFrm.getUserTbl().setModel(tableMdl);
        }else {
                columnNames = viewMdl.getAdvertismentColumnNames();
                tableData = restMdl.tryAdvertisments();
                TableModel tableMdl = new DefaultTableModel(tableData, columnNames);
                mainFrm.getAdvertismentTbl().setModel(tableMdl);
        }
        
    }

    private void search() {
        //restMdl.tryUsers();
        //restMdl.tryAdvertisments();
    }
    private void exit() {
        restMdl.tryLogout();
        System.exit(0);
    }
    private void addAdmin() {
    

    }
    private void getToken() {
        

        
    }

}
