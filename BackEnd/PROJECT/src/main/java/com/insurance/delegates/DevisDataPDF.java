package com.insurance.delegates;

import java.io.ByteArrayOutputStream; 
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.math.BigInteger;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Base64;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.StringTokenizer;
import org.apache.poi.xwpf.extractor.XWPFWordExtractor;
import org.apache.poi.xwpf.usermodel.ParagraphAlignment;
import org.apache.poi.xwpf.usermodel.XWPFDocument;
import org.apache.poi.xwpf.usermodel.XWPFParagraph;
import org.apache.poi.xwpf.usermodel.XWPFRun;
import org.apache.poi.xwpf.usermodel.XWPFStyles;
import org.apache.xmlbeans.XmlException;
import org.docx4j.Docx4J;
import org.docx4j.openpackaging.exceptions.Docx4JException;
import org.docx4j.openpackaging.packages.WordprocessingMLPackage;
import org.docx4j.openpackaging.parts.WordprocessingML.MainDocumentPart;
import org.flowable.engine.delegate.DelegateExecution;
import org.flowable.engine.delegate.JavaDelegate;
import org.openxmlformats.schemas.wordprocessingml.x2006.main.CTPageSz;
import org.openxmlformats.schemas.wordprocessingml.x2006.main.CTSectPr;
import org.openxmlformats.schemas.wordprocessingml.x2006.main.STPageOrientation;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.stereotype.Service;

import com.insurance.models.Devis_info;
import com.insurance.models.Pack_info;

import de.phip1611.Docx4JSRUtil;
import fr.opensagres.poi.xwpf.converter.pdf.PdfConverter;
import fr.opensagres.poi.xwpf.converter.pdf.PdfOptions;


// Service Task
@Service("DevisDataPDF")
//La classe DevisDataPDF, marquée comme un service Spring et implémentant l'interface JavaDelegate
public class DevisDataPDF implements JavaDelegate {
	
    // Déclaration de jdbcTemplate pour faciliter l'interaction avec la base de données
	public static JdbcTemplate jdbcTemplate;
	
    // Injection de dépendance : on assigne une instance de JdbcTemplate à notre variable jdbcTemplate
	@Autowired
	public void setjdbcTempl(JdbcTemplate jdbcTemplate) {
		this.jdbcTemplate=jdbcTemplate;
		
	}
	
    // La méthode Word qui génère un document Word en fonction des informations fournies
    public void Word(String name, String lastn, String email, String cin, String pack, String mobile, String money, String usage, int horse, int seat, String circ_date, String price_venal, String user) {
    
    	// Initialisation de variables et des valeurs par défaut pour les garanties de l'assurance
    	Map<String, String> var = new HashMap<String, String>();
    	
     	String m1= "----",m2= "----",m3= "----",m4= "----",m5= "----",m6 = "----",m7 = "----";
    	
        // Requête SQL pour récupérer des informations sur les garanties d'un pack
    	String qry1 = "SELECT  packguaranties.guaranty_id,packguaranties.pack_id,pack_name FROM `devisrequests`, pack, packguaranties,guaranties WHERE dv_usern = '"+user+"' AND devisrequests.pack = pack.pack_id AND packguaranties.pack_id = pack.pack_id;";
    	
        // Exécution de la requête SQL et stockage des résultats dans une liste de Pack_info
    	List <Pack_info> Packs = jdbcTemplate.query(qry1,new BeanPropertyRowMapper(Pack_info.class));
    	
        // Parcours de la liste des packs et mise à jour des garanties en fonction du pack sélectionné
    	for(Pack_info pk : Packs) {
    		
    		switch(pk.getGuaranty_id()) {
    		
    		case 1: m1="105000";
    		break;
    		
    		case 2: m2="120000";
    		break;
    		
    		case 3: m3="175000";
    		break;
    		
    		case 4: m4="50000";
    		break;
    		
    		case 5: m5="50000";
    		break;
    		
    		case 6: m6="25000";
    		break;
    		
    		case 7: m7="25000";
    		break;
    		
    		}
    		
    	}
    	
        // Obtention de la date actuelle et formatage de la date en "dd/MM/yyyy"
        SimpleDateFormat formatter = new SimpleDateFormat("dd/MM/yyyy");  
        Date date = new Date();  
        
        // Requête SQL pour récupérer l'ID du devis pour l'utilisateur courant
    	String qry = "SELECT  devis_id FROM `devisrequests` WHERE dv_usern = '"+user+"';";
    	
    	List <Devis_info> Devis = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Devis_info.class));
    	
        // Remplissage de la map 'var' avec les informations à remplacer dans le template du document Word
    	var.put("<<date>>", formatter.format(date));
    	var.put("<<iddevis>>", String.valueOf(Devis.get(0).getDevis_id()));
    	var.put("<<name>>", name);
    	var.put("<<lastn>>", lastn);
    	var.put("<<email>>", email);
    	var.put("<<cin>>", cin);
    	var.put("<<mobile>>", mobile);
    	var.put("<<pack>>", Packs.get(0).getPack_name());
    	var.put("<<u>>", usage);
    	var.put("<<p>>", String.valueOf(horse));
    	var.put("<<np>>", String.valueOf(seat));
    	var.put("<<dv>>", circ_date);
    	var.put("<<vv>>", price_venal);
    	var.put("<<m1>>",m1);
    	var.put("<<m2>>",m2);
    	var.put("<<m3>>",m3);
    	var.put("<<m4>>",m4);
    	var.put("<<m5>>",m5);
    	var.put("<<m6>>",m6);
    	var.put("<<m7>>",m7);
    	var.put("<<money>>",money);
    	
		
    	
        // Tentative de génération du document Word à partir du template en remplaçant les placeholders par les valeurs réelles
        // Sauvegarde du document en format Word et PDF
    	try {
			InputStream templateInputStream = new FileInputStream("C:\\Users\\benab\\Documents\\workspace-spring-tool-suite-4-4.17.2.RELEASE\\InsuranceBackEnd\\InsuranceBackEnd\\PROJET\\src\\main\\resources\\DevisFiles\\temp2.docx");
			WordprocessingMLPackage template = WordprocessingMLPackage.load(templateInputStream);
		
			Docx4JSRUtil.searchAndReplace(template, var );
	
			MainDocumentPart documentPart = template.getMainDocumentPart();
			FileOutputStream docxOs = new FileOutputStream("C:\\Users\\benab\\Documents\\workspace-spring-tool-suite-4-4.17.2.RELEASE\\InsuranceBackEnd\\InsuranceBackEnd\\PROJET\\src\\main\\resources\\DevisFiles\\Devis"+user+".docx");
			FileOutputStream OUT = new FileOutputStream("C:\\Users\\benab\\Documents\\workspace-spring-tool-suite-4-4.17.2.RELEASE\\InsuranceBackEnd\\InsuranceBackEnd\\PROJET\\src\\main\\resources\\DevisFiles\\Devis-"+user+".pdf");
			
			Docx4J.save(template, docxOs);

		    XWPFDocument doc = new XWPFDocument(new FileInputStream("C:\\Users\\benab\\Documents\\workspace-spring-tool-suite-4-4.17.2.RELEASE\\InsuranceBackEnd\\InsuranceBackEnd\\PROJET\\src\\main\\resources\\DevisFiles\\Devis"+user+".docx"));
		    
			PdfOptions PDFOpt = PdfOptions.create();
		    PdfConverter.getInstance().convert(doc, OUT, PDFOpt);

			docxOs.flush();
		    docxOs.close();
		    OUT.flush();
		    OUT.close();
		    doc.close();
		} catch (FileNotFoundException e) {
		
			e.printStackTrace();
		} catch (Docx4JException e) {
		
			e.printStackTrace();
		} catch (IOException e) {
		
			e.printStackTrace();
		};

		
	}
	
	
    // Méthode pour récupérer les informations du client et générer le devis correspondant à ces informations
	@Override
	public void execute(DelegateExecution execution)  {
		
		int count = 0;
		
		String name = (String) execution.getVariable("client_firstname");
		String lastn = (String) execution.getVariable("client_lastname");
		String email = (String) execution.getVariable("email");
		String cin = (String) execution.getVariable("cin");
		String pack = (String) execution.getVariable("pack");
		String mobile = (String) execution.getVariable("phone");
		String money = (String) execution.getVariable("money");
		String user = (String) execution.getVariable("dv_usern");
		String usage = (String) execution.getVariable("usage_type");
		int horse = (int) execution.getVariable("horse");
		int seat = (int) execution.getVariable("seat");
		String circ_date = (String) execution.getVariable("circ_date");
		String price_venal = (String) execution.getVariable("price_venal");
		
        // Appel à la méthode Word pour générer le devis en format Word et PDF
		Word(name,lastn,email,cin,pack,mobile,money,usage,horse,seat,circ_date,price_venal,user);
		
        // Conversion du document PDF en Base64
		File f = new File("C:\\Users\\benab\\Documents\\workspace-spring-tool-suite-4-4.17.2.RELEASE\\InsuranceBackEnd\\InsuranceBackEnd\\PROJET\\src\\main\\resources\\DevisFiles\\Devis-"+(String) execution.getVariable("dv_usern")+".pdf");
		
		byte[] buffer = new byte[10240];
		ByteArrayOutputStream OS = new ByteArrayOutputStream();
		
		FileInputStream Fin;
		try {
			Fin = new FileInputStream(f);
			int read;
			while ((read = Fin.read(buffer)) != -1) {
				OS.write(buffer, 0, read);
			}
			Fin.close();
			OS.close();
		} catch (FileNotFoundException e) {
			
			e.printStackTrace();
		} catch (IOException e) {
			
			e.printStackTrace();
		}
		
		String docPDF = Base64.getEncoder().encodeToString(OS.toByteArray());

		String qry="UPDATE `devisrequests` SET `devis_doc`=?  WHERE dv_usern=? ";
		String qryH="UPDATE `devishistory` SET `devis_doc`=?  WHERE dv_usern=? AND immat=? ";
		
		int UpdateUserAccount = jdbcTemplate.update(qry, docPDF,  (String) execution.getVariable("dv_usern"));
		   if (UpdateUserAccount > 0) {System.out.println("Devis Files has been uploaded.");
		   }
		   
		   System.out.println((String) execution.getVariable("immat"));
		   
		int UpdateHistAccount = jdbcTemplate.update(qryH, docPDF,  (String) execution.getVariable("dv_usern"), (String) execution.getVariable("immat") );
		   if (UpdateHistAccount > 0) {System.out.println("Devis History Files has been uploaded.");
		   }
		
		
		   
	}

}
