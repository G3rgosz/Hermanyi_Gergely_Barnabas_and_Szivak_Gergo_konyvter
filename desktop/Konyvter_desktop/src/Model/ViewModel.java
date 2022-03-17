package Model;

import java.util.Vector;

public class ViewModel {
    
    public Vector<String> getUserColumnNames() {
        Vector<String> columnNames = new Vector<>();
        
        columnNames.add("Felhasználónév");
        columnNames.add("Email, cím");
        columnNames.add("telefonszám");
        columnNames.add("Azonosító");
        
        return columnNames;
    }
    
    public Vector<String> getAdvertismentColumnNames(){
        Vector<String> columNames = new Vector<>();
        
        columNames.add("Hirdetés neve");
        columNames.add("Közzétevő");
        columNames.add("Jelentés oka");
        columNames.add("Hirdetés azonosítója");
        
        return columNames;
    }
}
