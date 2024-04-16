package com.insurance.delegates;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.net.URI;
import java.text.SimpleDateFormat;
import java.util.Base64;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.apache.poi.xwpf.usermodel.XWPFDocument;
import org.docx4j.Docx4J;
import org.docx4j.openpackaging.exceptions.Docx4JException;
import org.docx4j.openpackaging.packages.WordprocessingMLPackage;
import org.docx4j.openpackaging.parts.WordprocessingML.MainDocumentPart;
import org.flowable.engine.delegate.BpmnError;
import org.flowable.engine.delegate.DelegateExecution;
import org.flowable.engine.delegate.JavaDelegate;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.stereotype.Service;
import org.springframework.web.client.RestTemplate;
import com.insurance.models.Deadline_info;
import com.insurance.models.Devis_info;
import com.insurance.models.Pack_info;
import com.insurance.models.Subscription_info;

import de.phip1611.Docx4JSRUtil;
import fr.opensagres.poi.xwpf.converter.pdf.PdfConverter;
import fr.opensagres.poi.xwpf.converter.pdf.PdfOptions;


@Service
public class SubSuccess implements JavaDelegate {
	
	public static JdbcTemplate jdbcTemplate;
	
	@Autowired
	public void setjdbcTempl(JdbcTemplate jdbcTemplate) {
		this.jdbcTemplate=jdbcTemplate;
		
	}
	
	
    public void Word(String name, String lastn, String email,  String mobile, String job, String money, String user) {
    	
    	Map<String, String> var = new HashMap<String, String>();
   
    	String m1= "----",m2= "----",m3= "----",m4= "----",m5= "----",m6 = "----",m7 = "----";
    	
    	String qry = "SELECT * FROM `devisrequests`, vehicles WHERE dv_usern = '"+user+"' AND vh_usern ='"+user+"' ;";
    	
    	List <Devis_info> Devis = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Devis_info.class));
    	
    	String qryp = "SELECT  packguaranties.guaranty_id,packguaranties.pack_id,pack_name FROM `devisrequests`, pack, packguaranties,guaranties WHERE dv_usern = '"+user+"' AND devisrequests.pack = pack.pack_id AND packguaranties.pack_id = pack.pack_id;";
    	
    	List <Pack_info> Packs = jdbcTemplate.query(qryp,new BeanPropertyRowMapper(Pack_info.class));
    	

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
    	
        SimpleDateFormat formatter = new SimpleDateFormat("dd/MM/yyyy");  
        Date date = new Date();  
        
        
    	String qry1 = "SELECT  * FROM `subscriptions` WHERE sub_usern = '"+user+"';";
    	
    	List <Subscription_info> Subs = jdbcTemplate.query(qry1,new BeanPropertyRowMapper(Subscription_info.class));
    	
    	String qry2 = "SELECT * FROM `vehicles` WHERE vh_usern = '"+user+"';";
    	
    	List <Devis_info> Veh = jdbcTemplate.query(qry2,new BeanPropertyRowMapper(Devis_info.class));
    	
    	var.put("<<Date>>", formatter.format(date));
    	var.put("<<idContrat>>", String.valueOf(Subs.get(0).getSub_id()));
    	var.put("<<name>>", name);
    	var.put("<<lastn>>", lastn);
    	var.put("<<email>>", email);
    	var.put("<<cin>>", String.valueOf(Devis.get(0).getCin()));
    	var.put("<<mobile>>", mobile);
    	var.put("<<pr>>", job);
    	var.put("<<pack>>", Packs.get(0).getPack_name());
    	var.put("<<u>>", Devis.get(0).getUsage_type());
    	var.put("<<p>>", String.valueOf(Devis.get(0).getHorse()));
    	var.put("<<np>>", String.valueOf(Devis.get(0).getSeat()));
    	var.put("<<dv>>", Veh.get(0).getCirc_date());
    	var.put("<<vv>>", Veh.get(0).getPrice_venal());
    	var.put("<<m1>>",m1);
    	var.put("<<m2>>",m2);
    	var.put("<<m3>>",m3);
    	var.put("<<m4>>",m4);
    	var.put("<<m5>>",m5);
    	var.put("<<m6>>",m6);
    	var.put("<<m7>>",m7);
    	var.put("<<v1>>", Subs.get(0).getDeadline());
    	var.put("<<v2>>", Subs.get(0).getRenew());
    	var.put("<<v3>>", Subs.get(0).getFraction());
    	var.put("<<v4>>", Subs.get(0).getEffect_date());
    	var.put("<<money>>",money);
    	
    	
		try {
			InputStream templateInputStream = new FileInputStream("C:\\Users\\benab\\Documents\\workspace-spring-tool-suite-4-4.17.2.RELEASE\\InsuranceBackEnd\\InsuranceBackEnd\\PROJET\\src\\main\\resources\\DevisFiles\\cont.docx");
			WordprocessingMLPackage template = WordprocessingMLPackage.load(templateInputStream);
		
			Docx4JSRUtil.searchAndReplace(template, var );
	
			MainDocumentPart documentPart = template.getMainDocumentPart();
			FileOutputStream docxOs = new FileOutputStream("C:\\Users\\benab\\Documents\\workspace-spring-tool-suite-4-4.17.2.RELEASE\\InsuranceBackEnd\\InsuranceBackEnd\\PROJET\\src\\main\\resources\\DevisFiles\\Contrat"+user+".docx");
			FileOutputStream OUT = new FileOutputStream("C:\\Users\\benab\\Documents\\workspace-spring-tool-suite-4-4.17.2.RELEASE\\InsuranceBackEnd\\InsuranceBackEnd\\PROJET\\src\\main\\resources\\DevisFiles\\Contrat-"+user+".pdf");
			
			Docx4J.save(template, docxOs);

		    XWPFDocument doc = new XWPFDocument(new FileInputStream("C:\\Users\\benab\\Documents\\workspace-spring-tool-suite-4-4.17.2.RELEASE\\InsuranceBackEnd\\InsuranceBackEnd\\PROJET\\src\\main\\resources\\DevisFiles\\Contrat"+user+".docx"));
		    
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
	
	

	
	public void addDeadline(String user, String client_firstname, String client_lastname, String client_email,  String start_date, String end_date, String adress,String money) {
		
		RestTemplate restTemplate = new RestTemplate();
		 final String baseUrl = "http://localhost:9090/DeadlineReq";
		 URI uri;
		try {
			uri = new URI(baseUrl);
		} catch (Exception e) {
			
			e.printStackTrace();
			throw new BpmnError("BAD_REQUEST","Error in post request");
		}
		
    	String qry = "SELECT * FROM `devisrequests`, vehicles WHERE dv_usern = '"+user+"' AND vh_usern ='"+user+"' ;";
    	
    	List <Devis_info> Devis = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Devis_info.class));
    	
    	String cin = Devis.get(0).getCin();
    	int Cin = Integer.parseInt(cin);
		
		 Deadline_info DLinfo = new Deadline_info("Automobile", 0, 0, user, Cin, client_firstname, client_lastname, client_email,  start_date, end_date, adress, "Not Paid"," Waiting payment ", Double.parseDouble(money),Double.parseDouble(money), "","");
		 ResponseEntity<String> result = restTemplate.postForEntity(uri, DLinfo, String.class);
		 
	}

	@Override
	public void execute(DelegateExecution execution) {
		String username = (String) execution.getVariable("sub_usern");
		String cl_firstname = (String) execution.getVariable("client_firstname");
		String cl_lastname = (String) execution.getVariable("client_lastname");
		String cl_email = (String) execution.getVariable("email");
		String start_date = (String) execution.getVariable("effect_date");
		String end_date = (String) execution.getVariable("deadline");
		String adress = (String) execution.getVariable("delivery_adress");
		String money = (String) execution.getVariable("money");
		String mobile = (String) execution.getVariable("phone");
		String job = (String) execution.getVariable("job");
		
		Word(cl_firstname,cl_lastname,cl_email,mobile,job,money,username);
		
		
		File f = new File("C:\\Users\\benab\\Documents\\workspace-spring-tool-suite-4-4.17.2.RELEASE\\InsuranceBackEnd\\InsuranceBackEnd\\PROJET\\src\\main\\resources\\DevisFiles\\Contrat-"+(String) execution.getVariable("sub_usern")+".pdf");
		
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

		String qry="UPDATE `subscriptions` SET `contract`=?  WHERE sub_usern=? ";
		int UpdateUserAccount = jdbcTemplate.update(qry, docPDF,  (String) execution.getVariable("sub_usern"));
		   if (UpdateUserAccount > 0) {System.out.println("Contract has been uploaded.");
		   }
		   
			
			
		addDeadline(username,cl_firstname,cl_lastname,cl_email,start_date,end_date,adress,money);
		   
		String qry1 = "DELETE FROM devisrequests WHERE dv_usern=?";
		
		int UpdateDev = jdbcTemplate.update(qry1, (String) execution.getVariable("sub_usern"));
		   if (UpdateDev > 0) {System.out.println("Devis Deleted from Requests.");
		   }
		
		
		
		
		
		
				
		System.out.println("Subscription Ended Successfully");
		
	
		
	}

}
