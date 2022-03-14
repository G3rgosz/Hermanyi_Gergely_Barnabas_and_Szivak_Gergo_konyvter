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
    private RESTController restCtr;
    
    public GuiController(RESTController restCtr) {
        
        this.restCtr = restCtr;
        //restMdl = new RESTModel();
        viewMdl = new ViewModel();
        initWindow();
        ActionListeners();
        new Thread(runner).start();
        
    }
    private void ActionListeners() {
        mainFrm.getSearchBtn().addActionListener( event -> { search(); } );
        mainFrm.getDeleteBtn().addActionListener( event -> { delete(); } );
        mainFrm.getAdminBtn().addActionListener(event -> { addAdmin(); });
        mainFrm.getExitBtn().addActionListener( event -> { exit(); });
        mainFrm.getTableTb().addChangeListener(event -> {initTables(); });

    }
    private void initWindow() {
        mainFrm = new mainFrame();
        mainFrm.setVisible(true);
        initTables();
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

    private void search() {
        int openTab = mainFrm.getTableTb().getSelectedIndex();
        String search_text = mainFrm.getSearchTf().getText();
        String method = "GET";
        if(openTab == 0) {
            restCtr.setData(search_text, method);
            initTables();
        }else {
            restCtr.setData(search_text, method);
            initTables();
        }
    }
    private void exit() {
        restCtr.Logout();
        System.exit(0);
    }
    //TODO
    private void addAdmin() {
    
        
    }
    //TODO: befejezni a törlést
    private void delete() {
        int openTab = mainFrm.getTableTb().getSelectedIndex();
        int row = mainFrm.getAdvertismentTbl().getSelectedRow();
        String value = mainFrm.getAdvertismentTbl().getModel().getValueAt(row, 3).toString();
        System.out.println(value);
        String method = "DELETE";
        if(openTab == 0) {
            deleteUser(method);
        }else {
            deleteAdvertisment(method);
        }
    }
    //TODO: id szükséges a törléshez, de nem kapunk a REST API-tól. Szükséges egyeztetni a Backend fejlesztővel
    private void deleteUser(String method) {
        int row = mainFrm.getUserTbl().getSelectedRow();
        String value = mainFrm.getUserTbl().getModel().getValueAt(row, 0).toString();
        
        restCtr.setData(value, method);
        initTables();
    }
    private void deleteAdvertisment(String method) {
        int row = mainFrm.getAdvertismentTbl().getSelectedRow();
        String value = mainFrm.getAdvertismentTbl().getModel().getValueAt(row, 3).toString();
        
        restCtr.setData(value, method);
        initTables();
    }

    Runnable runner = new Runnable() {
        @Override
        public void run() {
            timer();
        }
    };
    public void timer() {
        boolean time = true;
        //for(;;) {        }
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
