package com.insurance.controller;
import java.nio.charset.Charset;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Base64;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.StringTokenizer;
import java.util.stream.Collectors;
import java.util.stream.Stream;
import org.apache.poi.xwpf.extractor.XWPFWordExtractor;
import org.apache.poi.xwpf.usermodel.*;
import org.apache.xmlbeans.XmlException;
import org.docx4j.Docx4J;
import org.docx4j.openpackaging.exceptions.Docx4JException;
import org.docx4j.openpackaging.packages.WordprocessingMLPackage;
import org.docx4j.openpackaging.parts.WordprocessingML.MainDocumentPart;

import java.io.*;
import java.math.BigInteger;
import org.flowable.engine.HistoryService;
import org.flowable.engine.ProcessEngine;
import org.flowable.engine.ProcessEngineConfiguration;
import org.flowable.engine.RepositoryService;
import org.flowable.engine.RuntimeService;
import org.flowable.engine.TaskService;
import org.flowable.engine.delegate.DelegateExecution;
import org.flowable.engine.repository.Deployment;
import org.flowable.engine.repository.ProcessDefinition;
import org.openxmlformats.schemas.wordprocessingml.x2006.main.CTPageSz;
import org.openxmlformats.schemas.wordprocessingml.x2006.main.CTSectPr;
import org.openxmlformats.schemas.wordprocessingml.x2006.main.CTStyle;
import org.openxmlformats.schemas.wordprocessingml.x2006.main.STPageOrientation;
import org.openxmlformats.schemas.wordprocessingml.x2006.main.STStyleType;
import org.springframework.beans.factory.annotation.Autowired; 
import org.springframework.context.annotation.Bean;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;
import com.insurance.models.AgentTask;
import com.insurance.models.ClientTask;
import com.insurance.models.Deadline_info;
import com.insurance.models.Devis_info;
import com.insurance.models.Pack_info;
import com.insurance.models.Sim_info;
import com.insurance.models.Subscription_info;
import com.insurance.models.TasksDef;
import com.insurance.models.users_info;

import de.phip1611.Docx4JSRUtil;
import fr.opensagres.poi.xwpf.converter.pdf.PdfConverter;
import fr.opensagres.poi.xwpf.converter.pdf.PdfOptions;



@RestController
public class REST_Controller {
	
    // Injection de dépendance de RuntimeService, un service fourni par Flowable pour gérer l'exécution des processus métier.
	@Autowired
	private RuntimeService runtimeService ; 

    // Injection de dépendance de TaskService, un service fourni par Flowable pour gérer les tâches utilisateur au sein des processus métier.
	@Autowired
    private TaskService taskService;

    // Injection de dépendance de JdbcTemplate, un outil fourni par Spring pour interagir facilement avec une base de données SQL en utilisant JDBC.	
	@Autowired
    private JdbcTemplate jdbcTemplate ;
	
    // Injection de dépendance de HistoryService, un service fourni par Flowable pour accéder aux informations historiques sur les processus et les tâches.	
	@Autowired
	private ProcessEngine processEngine;
	
    // Injection de dépendance de HistoryService, un service fourni par Flowable pour accéder aux informations historiques sur les processus et les tâches.
	@Autowired
	private HistoryService historyService;
	
    // Définition d'un formateur pour les dates au format "yyyy-MM-dd". Ceci sera utilisé pour convertir les dates en chaînes de caractères dans ce format et vice versa.
	private static final DateTimeFormatter formatter = DateTimeFormatter.ofPattern("uuuu-MM-dd");
	
	
	
	

	
				///////// INITIALISATION DU SERVEUR //////////
	
	// Annotation @Bean indiquant que cette méthode produit un bean qui sera géré par le conteneur Spring.
	    @Bean
	    public void ConfigAndInit() {
	    	
	// Création de l'instance de ProcessEngine à partir de la configuration Flowable dans le fichier "flowable.cfg.xml"
			   processEngine = ProcessEngineConfiguration.createProcessEngineConfigurationFromResource("flowable.cfg.xml")
		    		   .buildProcessEngine();

			// Interrogation de la base de données pour vérifier l'existence de chaque table spécifique et stockage du résultat dans des variables distinctes.
			 String UsersTable = jdbcTemplate.queryForObject("select count(*) as number from information_schema.tables WHERE table_schema = 'encap_assurance' AND TABLE_NAME='user';", String.class);
			 String DLTable = jdbcTemplate.queryForObject("select count(*) as number from information_schema.tables WHERE table_schema = 'encap_assurance' AND TABLE_NAME='DeadlineRequests';", String.class);
			 String DLHTable = jdbcTemplate.queryForObject("select count(*) as number from information_schema.tables WHERE table_schema = 'encap_assurance' AND TABLE_NAME='DeadlineRequestsHistory';", String.class);
			 String DVTable = jdbcTemplate.queryForObject("select count(*) as number from information_schema.tables WHERE table_schema = 'encap_assurance' AND TABLE_NAME='DevisRequests';", String.class);
			 String DVHTable = jdbcTemplate.queryForObject("select count(*) as number from information_schema.tables WHERE table_schema = 'encap_assurance' AND TABLE_NAME='DevisRequests';", String.class);
			 String SUBSTable = jdbcTemplate.queryForObject("select count(*) as number from information_schema.tables WHERE table_schema = 'encap_assurance' AND TABLE_NAME='Subscriptions';", String.class);
			 String CLTable = jdbcTemplate.queryForObject("select count(*) as number from information_schema.tables WHERE table_schema = 'encap_assurance' AND TABLE_NAME='ClientInfo';", String.class);
			 String VEHTable = jdbcTemplate.queryForObject("select count(*) as number from information_schema.tables WHERE table_schema = 'encap_assurance' AND TABLE_NAME='Vehicles';", String.class);
			 String SIMTable = jdbcTemplate.queryForObject("select count(*) as number from information_schema.tables WHERE table_schema = 'encap_assurance' AND TABLE_NAME='Simulation';", String.class);
			 String PACKTable = jdbcTemplate.queryForObject("select count(*) as number from information_schema.tables WHERE table_schema = 'encap_assurance' AND TABLE_NAME='pack';", String.class);
			 String GRTable = jdbcTemplate.queryForObject("select count(*) as number from information_schema.tables WHERE table_schema = 'encap_assurance' AND TABLE_NAME='guaranties';", String.class);
			 String PGTable = jdbcTemplate.queryForObject("select count(*) as number from information_schema.tables WHERE table_schema = 'encap_assurance' AND TABLE_NAME='PackGuaranties';", String.class);
 
			 
			 
			// Si la table 'user' n'existe pas dans la base de données
			if (Integer.parseInt(UsersTable)==0) {
				 jdbcTemplate.execute("CREATE table user(id INT NOT NULL AUTO_INCREMENT ,username varchar(40) NOT NULL, password varchar(40), firstname varchar(40), lastname varchar(40), email varchar(40), role varchar(10), PRIMARY KEY (id,username), UNIQUE KEY (username));"); 

				/////////////////////  Utilisateurs par defaut  ////////////////////
				 
				String qry="INSERT INTO `user`(`username`, `password`, `firstname`, `lastname`,  `email`,`role`) VALUES ('tijani','tijani123','Tijani', 'Bouraoui','tijani.com','admin')";	
				String qry2="INSERT INTO `user`(`username`, `password`, `firstname`, `lastname`, `email`,`role`) VALUES ('asma','asma123','Asma', 'Houimel','asma@gmail.com','agent')";
				String qry3="INSERT INTO `user`(`username`, `password`, `firstname`, `lastname`, `email`,`role`) VALUES ('ismail','ismail123','Ismail' , 'Ba','ismail@gmail.com','client')";
				 
				 
				 String insertQuery1 = "INSERT INTO user(username, password, firstname, lastname, email, role) VALUES ('user1', 'password1', 'John', 'Doe', 'john.doe@email.com', 'client')";
				 String insertQuery2 = "INSERT INTO user(username, password, firstname, lastname, email, role) VALUES ('user2', 'password2', 'Jane', 'Doe', 'jane.doe@email.com', 'client')";
				 String insertQuery3 = "INSERT INTO user(username, password, firstname, lastname, email, role) VALUES ('user3', 'password3', 'Bob', 'Smith', 'bob.smith@email.com', 'client')";
				 String insertQuery4 = "INSERT INTO user(username, password, firstname, lastname, email, role) VALUES ('user4', 'password4', 'Alice', 'Johnson', 'alice.johnson@email.com', 'client')";
				 String insertQuery5 = "INSERT INTO user(username, password, firstname, lastname, email, role) VALUES ('user5', 'password5', 'Jack', 'Lee', 'jack.lee@email.com', 'client')";
				 String insertQuery6 = "INSERT INTO user(username, password, firstname, lastname, email, role) VALUES ('user6', 'password6', 'Lily', 'Chen', 'lily.chen@email.com', 'client')";

				 
				 jdbcTemplate.execute(qry);
				 jdbcTemplate.execute(qry2);
				 jdbcTemplate.execute(qry3);
				 jdbcTemplate.execute(insertQuery1);
				 jdbcTemplate.execute(insertQuery2);
				 jdbcTemplate.execute(insertQuery3);
				 jdbcTemplate.execute(insertQuery4);
				 jdbcTemplate.execute(insertQuery5);
				 jdbcTemplate.execute(insertQuery6);
				 
				 if (Integer.parseInt(CLTable)==0) {
					 jdbcTemplate.execute("CREATE table ClientInfo(Client_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, cin INT NOT NULL UNIQUE, cl_usern varchar(40) NOT NULL, client_firstname varchar(40), client_lastname varchar(40), birth_date varchar(40) , phone varchar(20), email varchar(40), job varchar(40), gender varchar(40), FOREIGN KEY (cl_usern) REFERENCES user(username));"); 

					 String inserQuery1 = "INSERT INTO ClientInfo(cin, cl_usern, client_firstname, client_lastname, birth_date, phone, email, job, gender) VALUES (12345678, 'user1', 'John', 'Doe', '1990-01-01', '555-1234', 'john.doe@email.com', 'Engineer', 'Male')";
					 String inserQuery2 = "INSERT INTO ClientInfo(cin, cl_usern, client_firstname, client_lastname, birth_date, phone, email, job, gender) VALUES (98765432, 'user2', 'Jane', 'Doe', '1970-05-05', '555-5678', 'jane.doe@email.com', 'Designer', 'Female')";
					 String inserQuery3 = "INSERT INTO ClientInfo(cin, cl_usern, client_firstname, client_lastname, birth_date, phone, email, job, gender) VALUES (45678912, 'user3', 'Bob', 'Smith', '1940-12-25', '555-2468', 'bob.smith@email.com', 'Manager', 'Male')";
					 String inserQuery4 = "INSERT INTO ClientInfo(cin, cl_usern, client_firstname, client_lastname, birth_date, phone, email, job, gender) VALUES (78912345, 'user4', 'Alice', 'Johnson', '1992-03-15', '555-1357', 'alice.johnson@email.com', 'Teacher', 'Female')";
					 String inserQuery5 = "INSERT INTO ClientInfo(cin, cl_usern, client_firstname, client_lastname, birth_date, phone, email, job, gender) VALUES (32165498, 'user5', 'Mark', 'Davis', '1955-08-20', '555-3691', 'mark.davis@email.com', 'Salesperson', 'Male')";
					 String inserQuery6 = "INSERT INTO ClientInfo(cin, cl_usern, client_firstname, client_lastname, birth_date, phone, email, job, gender) VALUES (65498732, 'user6', 'Emily', 'Lee', '1997-11-10', '555-8024', 'emily.lee@email.com', 'Doctor', 'Female')";

					 jdbcTemplate.execute(inserQuery1);
					 jdbcTemplate.execute(inserQuery2);
					 jdbcTemplate.execute(inserQuery3);
					 jdbcTemplate.execute(inserQuery4);
					 jdbcTemplate.execute(inserQuery5);
					 jdbcTemplate.execute(inserQuery6);
					 
	
					 if (Integer.parseInt(VEHTable)==0) {
						 jdbcTemplate.execute("CREATE table Vehicles(Vehicle_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, immat INT NOT NULL UNIQUE, vh_usern varchar(40) NOT NULL, immat_type varchar(20), usage_type varchar(30), serie varchar(10), km int, marque varchar(40) , model varchar(40), seat varchar(10), horse varchar(10), price_new varchar(20), price_venal varchar(20), malus int(10), circ_date varchar(20), FOREIGN KEY (vh_usern) REFERENCES user(username) ON DELETE CASCADE ON UPDATE CASCADE);"); 
						 
						 String insetQuery1 = "INSERT INTO Vehicles(immat, vh_usern, immat_type, usage_type, serie,  km, marque, model, seat, horse, price_new, price_venal, malus, circ_date) VALUES (1234, 'user1', 'TU', 'private', '001',  10000, 'Toyota', 'Corolla', '5', '100', '20000', '15000', 50, '2022-01-01')";
						 String insetQuery2 = "INSERT INTO Vehicles(immat, vh_usern, immat_type, usage_type, serie,  km, marque, model, seat, horse, price_new, price_venal, malus, circ_date) VALUES (2345, 'user2', 'TU', 'private', '002',  5000, 'Honda', 'Civic', '5', '90', '18000', '12000', 30, '2022-02-01')";
						 String insetQuery3 = "INSERT INTO Vehicles(immat, vh_usern, immat_type, usage_type, serie,  km, marque, model, seat, horse, price_new, price_venal, malus, circ_date) VALUES (3456, 'user3', 'TU', 'professional', '003',  20000, 'Ford', 'Transit', '3', '120', '30000', '25000', 100, '2022-03-01')";
						 String insetQuery4 = "INSERT INTO Vehicles(immat, vh_usern, immat_type, usage_type, serie,  km, marque, model, seat, horse, price_new, price_venal, malus, circ_date) VALUES (4567, 'user4', 'TU', 'private', '004',  8000, 'Volkswagen', 'Golf', '5', '110', '22000', '18000', 40, '2022-04-01')";
						 String insetQuery5 = "INSERT INTO Vehicles(immat, vh_usern, immat_type, usage_type, serie,  km, marque, model, seat, horse, price_new, price_venal, malus, circ_date) VALUES (5678, 'user5', 'TU', 'private', '005',  15000, 'BMW', 'X1', '5', '170', '40000', '60000', 80, '2022-05-01')";
						 String insetQuery6 = "INSERT INTO Vehicles(immat, vh_usern, immat_type, usage_type, serie,  km, marque, model, seat, horse, price_new, price_venal, malus, circ_date) VALUES (6789, 'user6', 'TU', 'professional', '006', 30000, 'Renault', 'Master', '3', '130', '40000', '27000', 120, '2022-06-01')";

						 jdbcTemplate.execute(insetQuery1);
						 jdbcTemplate.execute(insetQuery2);
						 jdbcTemplate.execute(insetQuery3);
						 jdbcTemplate.execute(insetQuery4);
						 jdbcTemplate.execute(insetQuery5);
						 jdbcTemplate.execute(insetQuery6);
						 
						 
						 
						 
						 if (Integer.parseInt(PACKTable)==0) {
							 jdbcTemplate.execute("CREATE TABLE pack (pack_id int NOT NULL AUTO_INCREMENT, pack_name VARCHAR(255), price DECIMAL(10,2), PRIMARY KEY (pack_id));");
							 jdbcTemplate.execute("INSERT INTO pack(pack_name,price) values ('securite',200)");
							 jdbcTemplate.execute("INSERT INTO pack(pack_name,price) values ('securite-plus',300)");
							 jdbcTemplate.execute("INSERT INTO pack(pack_name,price) values ('serenite',500)");
						 }
						 
						 if (Integer.parseInt(GRTable)==0) {
							 jdbcTemplate.execute("CREATE TABLE guaranties (guaranty_id INT PRIMARY KEY, guaranty_name VARCHAR(255), cover_amount DECIMAL(10,2));");
							 jdbcTemplate.execute("INSERT INTO guaranties(guaranty_id,guaranty_name,cover_amount) values (1,'Responsabilité civile',100)");
							 jdbcTemplate.execute("INSERT INTO guaranties(guaranty_id,guaranty_name,cover_amount) values (2,'Assistance 24/7',100)");
							 jdbcTemplate.execute("INSERT INTO guaranties(guaranty_id,guaranty_name,cover_amount) values (3,'Protection juridique',100)");
							 jdbcTemplate.execute("INSERT INTO guaranties(guaranty_id,guaranty_name,cover_amount) values (4,'Garantie dommages',100)");
							 jdbcTemplate.execute("INSERT INTO guaranties(guaranty_id,guaranty_name,cover_amount) values (5,'Vol et incendie',100)");
							 jdbcTemplate.execute("INSERT INTO guaranties(guaranty_id,guaranty_name,cover_amount) values (6,'Assurance tous risques',100)");
							 jdbcTemplate.execute("INSERT INTO guaranties(guaranty_id,guaranty_name,cover_amount) values (7,'Franchise modulable',100)");

						 }
						 
						 if (Integer.parseInt(PGTable)==0) {
							 jdbcTemplate.execute("CREATE TABLE PackGuaranties (pg_id INT AUTO_INCREMENT PRIMARY KEY, pack_id INT, guaranty_id INT, FOREIGN KEY (pack_id) REFERENCES pack(pack_id), FOREIGN KEY(guaranty_id) REFERENCES guaranties(guaranty_id));");
							 jdbcTemplate.execute("INSERT INTO PackGuaranties(pack_id,guaranty_id) values (1,1)");
							 jdbcTemplate.execute("INSERT INTO PackGuaranties(pack_id,guaranty_id) values (1,2)");
							 jdbcTemplate.execute("INSERT INTO PackGuaranties(pack_id,guaranty_id) values (1,3)");
							 jdbcTemplate.execute("INSERT INTO PackGuaranties(pack_id,guaranty_id) values (2,1)");
							 jdbcTemplate.execute("INSERT INTO PackGuaranties(pack_id,guaranty_id) values (2,2)");
							 jdbcTemplate.execute("INSERT INTO PackGuaranties(pack_id,guaranty_id) values (2,3)");
							 jdbcTemplate.execute("INSERT INTO PackGuaranties(pack_id,guaranty_id) values (2,4)");
							 jdbcTemplate.execute("INSERT INTO PackGuaranties(pack_id,guaranty_id) values (3,1)");
							 jdbcTemplate.execute("INSERT INTO PackGuaranties(pack_id,guaranty_id) values (3,2)");
							 jdbcTemplate.execute("INSERT INTO PackGuaranties(pack_id,guaranty_id) values (3,3)");
							 jdbcTemplate.execute("INSERT INTO PackGuaranties(pack_id,guaranty_id) values (3,4)");
							 jdbcTemplate.execute("INSERT INTO PackGuaranties(pack_id,guaranty_id) values (3,5)");
							 jdbcTemplate.execute("INSERT INTO PackGuaranties(pack_id,guaranty_id) values (3,6)");
							 
						 }


						 	// Spécifiez le chemin d'accès au fichier que nous voulons lire. Ici, nous lisons un fichier dummy.pdf situé dans un répertoire spécifique.					 
							File f = new File("C:\\Users\\benab\\Documents\\workspace-spring-tool-suite-4-4.17.2.RELEASE\\InsuranceBackEnd\\InsuranceBackEnd\\PROJET\\src\\main\\resources\\DevisFiles\\dummy.pdf");
						
							// Créez un tampon de byte pour stocker les données du fichier que nous lisons.
							byte[] buffer = new byte[10240];
							
							// Créez un ByteArrayOutputStream pour recueillir les données en byte lues du fichier.
							ByteArrayOutputStream OS = new ByteArrayOutputStream();
							
							// Créez une instance FileInputStream pour lire les données du fichier.
							FileInputStream Fin;
							
							try {
								
								// Initialisez la FileInputStream avec le fichier que nous voulons lire.	
								Fin = new FileInputStream(f);
								int read;
								
								// Lisez les données du fichier dans le tampon byte. 
								// Ensuite, écrivez ces données dans le ByteArrayOutputStream. 
								// Continuez ce processus jusqu'à ce qu'il n'y ait plus de données à lire du fichier.
								while ((read = Fin.read(buffer)) != -1) {
									OS.write(buffer, 0, read);
								}
								
								// Fermez les flux pour libérer les ressources du système.
								Fin.close();
								OS.close();
								
								
							} catch (FileNotFoundException e) {
								
								// Gérez l'exception si le fichier que nous voulons lire n'est pas trouvé.
								e.printStackTrace();
							} catch (IOException e) {
								
								// Gérez l'exception si une erreur d'entrée/sortie se produit lors de la lecture ou de l'écriture des données.	
								e.printStackTrace();
							}
							
							// Convertissez les données lues du fichier (qui sont maintenant stockées dans le ByteArrayOutputStream) en une chaîne encodée en Base64.
							String docPDF = Base64.getEncoder().encodeToString(OS.toByteArray());
						 
							
							
						 if (Integer.parseInt(DVTable)==0) {
							 jdbcTemplate.execute("CREATE table DevisRequests(devis_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, dv_usern varchar(40) NOT NULL, cin int NOT NULL, immat int NOT NULL, pack int NOT NULL, money varchar(20), date varchar(20), devis_doc TEXT(99999999), FOREIGN KEY (dv_usern) REFERENCES user(username), FOREIGN KEY (cin) REFERENCES ClientInfo(cin) ON DELETE CASCADE ON UPDATE CASCADE,  FOREIGN KEY (immat) REFERENCES Vehicles(immat) ON DELETE CASCADE ON UPDATE CASCADE, FOREIGN KEY (pack) REFERENCES pack(pack_id) ON DELETE CASCADE ON UPDATE CASCADE  );"); 

							 String insertQery1 = "INSERT INTO DevisRequests(dv_usern, cin, immat, pack, money, date, devis_doc) VALUES ('user1', 12345678, '1234', 1, '1500', '2022-01-15', '"+docPDF+"')";
							 String insertQery2 = "INSERT INTO DevisRequests(dv_usern, cin, immat, pack, money, date, devis_doc) VALUES ('user2', 98765432, '2345', 2, '2000', '2022-02-15', '"+docPDF+"')";
							 String insertQery3 = "INSERT INTO DevisRequests(dv_usern, cin, immat, pack, money, date, devis_doc) VALUES ('user3', 45678912, '3456', 1, '2500', '2022-03-15', '"+docPDF+"')";
							 String insertQery4 = "INSERT INTO DevisRequests(dv_usern, cin, immat, pack, money, date, devis_doc) VALUES ('user4', 78912345, '4567', 2, '1500', '2022-04-15', '"+docPDF+"')";
							 String insertQery5 = "INSERT INTO DevisRequests(dv_usern, cin, immat, pack, money, date, devis_doc) VALUES ('user5', 32165498, '5678', 1, '2000', '2022-05-15', '"+docPDF+"')";
							 String insertQery6 = "INSERT INTO DevisRequests(dv_usern, cin, immat, pack, money, date, devis_doc) VALUES ('user6', 65498732, '6789', 3, '2500', '2022-06-15', '"+docPDF+"')";
							 
							 jdbcTemplate.execute(insertQery1);
							 jdbcTemplate.execute(insertQery2);
							 jdbcTemplate.execute(insertQery3);
							 jdbcTemplate.execute(insertQery4);
							 jdbcTemplate.execute(insertQery5);
							 jdbcTemplate.execute(insertQery6);
							 
							 if (Integer.parseInt(DVHTable)==0) {
								 jdbcTemplate.execute("CREATE table DevisHistory(devis_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, dv_usern varchar(40) NOT NULL, cin int NOT NULL, immat int NOT NULL, pack int NOT NULL, money varchar(20), date varchar(20), devis_doc TEXT(99999999), FOREIGN KEY (dv_usern) REFERENCES user(username), FOREIGN KEY (pack) REFERENCES pack(pack_id) ON DELETE CASCADE ON UPDATE CASCADE);"); 

								 String insertQuer1 = "INSERT INTO DevisHistory(dv_usern, cin, immat, pack, money, date, devis_doc) VALUES ('user1', 12345678, '1234', 1, '1500', '2022-01-15', '"+docPDF+"')";
								 String insertQuer2 = "INSERT INTO DevisHistory(dv_usern, cin, immat, pack, money, date, devis_doc) VALUES ('user2', 98765432, '2345', 2, '2000', '2022-02-15', '"+docPDF+"')";
								 String insertQuer3 = "INSERT INTO DevisHistory(dv_usern, cin, immat, pack, money, date, devis_doc) VALUES ('user3', 45678912, '3456', 1, '2500', '2022-03-15', '"+docPDF+"')";
								 String insertQuer4 = "INSERT INTO DevisHistory(dv_usern, cin, immat, pack, money, date, devis_doc) VALUES ('user4', 78912345, '4567', 2, '1500', '2022-04-15', '"+docPDF+"')";
								 String insertQuer5 = "INSERT INTO DevisHistory(dv_usern, cin, immat, pack, money, date, devis_doc) VALUES ('user5', 32165498, '5678', 1, '2000', '2022-05-15', '"+docPDF+"')";
								 String insertQuer6 = "INSERT INTO DevisHistory(dv_usern, cin, immat, pack, money, date, devis_doc) VALUES ('user6', 65498732, '6789', 3, '2500', '2022-06-15', '"+docPDF+"')";
								 
								 jdbcTemplate.execute(insertQuer1);
								 jdbcTemplate.execute(insertQuer2);
								 jdbcTemplate.execute(insertQuer3);
								 jdbcTemplate.execute(insertQuer4);
								 jdbcTemplate.execute(insertQuer5);
								 jdbcTemplate.execute(insertQuer6);
								 
								 
								 if (Integer.parseInt(SUBSTable)==0) {
									 jdbcTemplate.execute("CREATE table Subscriptions(sub_id int NOT NULL AUTO_INCREMENT, devis_id INT NOT NULL, sub_usern varchar(40) NOT NULL, fraction varchar(20), renew varchar(20), effect_date varchar(20), deadline varchar(20),  delivery_adress varchar(40), money varchar(20), delivery_type varchar(20), id_doc TEXT(99999999), contract TEXT(99999999), PRIMARY KEY (sub_id), FOREIGN KEY (devis_id) REFERENCES devishistory(devis_id), FOREIGN KEY (sub_usern) REFERENCES user(username) ON DELETE CASCADE ON UPDATE CASCADE);"); 

								 }
							 }
							 
						 }
					 }

				 
				 }

				
			 }
			 
			 

			 

			 

			 

			 

			// Vérifiez si la table 'DeadlineRequests' existe. Si elle n'existe pas, créez cette table.
			 if (Integer.parseInt(DLTable)==0) {
				// Créez la table 'DeadlineRequests' avec ses différentes colonnes. Les clés étrangères 'dl_usern' et 'cin' font référence respectivement aux tables 'user' et 'ClientInfo'.
				 jdbcTemplate.execute("CREATE table DeadlineRequests(contract_num int NOT NULL AUTO_INCREMENT, dl_usern varchar(40) NOT NULL, start_date varchar(40), end_date varchar(40), product varchar(40) , receipt int, total_amount varchar(40), left_amount varchar(40), cin int NOT NULL, delivery_adress varchar(100), state varchar(40), reason varchar(100), vignette TEXT(99999999), tech_visit TEXT(99999999),PRIMARY KEY (contract_num), FOREIGN KEY (dl_usern) REFERENCES user(username) ON DELETE CASCADE ON UPDATE CASCADE,FOREIGN KEY (cin) REFERENCES ClientInfo(cin) ON DELETE CASCADE ON UPDATE CASCADE );"); 
				// Configurez la valeur initiale de l'auto-increment pour le champ 'contract_num' à 50.
				 jdbcTemplate.execute("alter table DeadlineRequests auto_increment=50;");

			 }
			 
			 
			// Créez la table 'DeadlineRequests' avec ses différentes colonnes. Les clés étrangères 'dl_usern' et 'cin' font référence respectivement aux tables 'user' et 'ClientInfo'.
			 if (Integer.parseInt(DLHTable)==0) {
				 jdbcTemplate.execute("CREATE table DeadlineRequestsHistory(contract_num int NOT NULL AUTO_INCREMENT, dl_usern varchar(40) NOT NULL, start_date varchar(40), end_date varchar(40), product varchar(40) , receipt int, total_amount varchar(40), left_amount varchar(40), cin int NOT NULL, client_email varchar(40), delivery_adress varchar(100), state varchar(40), reason varchar(100), vignette TEXT(99999999), tech_visit TEXT(99999999), PRIMARY KEY (contract_num), FOREIGN KEY (dl_usern) REFERENCES user(username) ON DELETE CASCADE ON UPDATE CASCADE, FOREIGN KEY (cin) REFERENCES ClientInfo(cin) ON DELETE CASCADE ON UPDATE CASCADE);"); 
				 jdbcTemplate.execute("alter table DeadlineRequestsHistory auto_increment=50;");
			 
			 }
			 
			 
			 
			// Vérifiez si la table 'Simulation' existe. Si elle n'existe pas, créez cette table et insérez une ligne de données initiales. 
			 if (Integer.parseInt(SIMTable)==0) {
				// Créez la table 'Simulation' avec ses différentes colonnes.
				 jdbcTemplate.execute("CREATE TABLE Simulation(devis_in int, devis_cancel int, sub_in int, sub_cancel int);");
				// Insérez une ligne de données initiales dans la table 'Simulation'.
				 jdbcTemplate.execute("INSERT INTO Simulation (devis_in,devis_cancel,sub_in,sub_cancel) values (6,10,0,3);");
				 
			 }
			 

			 
			  
		 }
	
		  
		  

		////////////////// DEADLINE REQUEST ///////////////////
		
	 // Ce bloc de code définit l'endpoint pour une requête de délai (deadline request) via une méthode POST. Cette fonction sera accessible aux adresses définies dans le CrossOrigin.
	 // Les informations de la requête de délai sont encapsulées dans l'objet 'DLinfo' de type 'Deadline_info' passé en paramètre de la méthode.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/DeadlineReq")
	    public void DeadlineRequest(@RequestBody Deadline_info DLinfo) throws ParseException {
	    	
	    	
	    	// Initialise une variable de reçu à zéro. 
	    	int receipt = 0;
	    	
	    	// Imprime un message pour indiquer que la requête de délai a commencé.
	    	System.out.println("Deadline Request Started");
	    	
	    	// Crée des instances de différents services nécessaires pour le processus de gestion de la requête de délai.	
	    	RepositoryService repositoryService = processEngine.getRepositoryService();
	    	historyService = processEngine.getHistoryService();
	    	runtimeService = processEngine.getRuntimeService();
	    	
	    	// Déploie le fichier de processus 'DeadlineProcess.bpmn20.xml' et crée une définition de processus à partir de ce déploiement.	
	    	Deployment deployment = repositoryService.createDeployment()
	    	    	  .addClasspathResource("processes/DeadlineProcess.bpmn20.xml")
	    	    	  .deploy();
	    	    	ProcessDefinition processDefinition = repositoryService.createProcessDefinitionQuery()
	    	    			  .deploymentId(deployment.getId())
	    	    			  .singleResult();
	    	    	
	    	    	
	    	// Crée un Map pour stocker les variables de processus.
	    	Map<String, Object> variables = new HashMap<String, Object>();
	    	
	    	// Parse les dates de début et de fin de l'objet 'DLinfo' en LocalDate, et ajoute un an à ces dates.	
	    	LocalDate Sdate = LocalDate.parse(DLinfo.getStart_date());
	    	LocalDate Edate = LocalDate.parse(DLinfo.getEnd_date());
	    	
	    	Sdate= Sdate.plusYears(1);
	    	Edate= Edate.plusYears(1);
	    	

	    // Cette section de code stocke les informations relatives à la requête de délai (Deadline request) provenant de l'objet DLinfo dans le Map de variables.	    	
	    //	variables.put("dl_usern", DLinfo.getDl_usern());
	    	variables.put("left_amount", DLinfo.getLeft_amount());
	    	variables.put("client_firstname", DLinfo.getClient_firstname());
	    	variables.put("client_lastname", DLinfo.getClient_lastname());
	    	variables.put("client_email", DLinfo.getClient_email());
	    	variables.put("cin", DLinfo.getCin());
	    	variables.put("total_amount", DLinfo.getTotal_amount());
	    	variables.put("start_date", Sdate.format(formatter));
	    	variables.put("LeftAmount", 0);
	    	variables.put("end_date", Edate.format(formatter));
	    	
	    	// Crée les requêtes SQL pour insérer des informations de la requête de délai dans les tables 'DeadlineRequests' et 'DeadlineRequestsHistory'.	
	    	 String qry="INSERT INTO DeadlineRequests( dl_usern, cin, start_date, end_date , product , total_amount , left_amount, delivery_adress, state, reason) values (?,?,?,?,?,?,?,?,?,?)";
 
	    	 String qry2="INSERT INTO DeadlineRequestsHistory( dl_usern, cin, start_date, end_date , product , total_amount , left_amount, delivery_adress, state, reason) values (?,?,?,?,?,?,?,?,?,?)";

	    	// Exécute la première requête SQL pour insérer la requête de délai dans la table 'DeadlineRequests'.
	    	// int DLInsert = jdbcTemplate.update(qry,DLinfo.getDl_usern(),DLinfo.getCin(),Sdate,Edate, DLinfo.getProduct(), DLinfo.getTotal_amount(), DLinfo.getLeft_amount(),DLinfo.getDelivery_adress(), "Not Paid", "Waiting for payment");
	    	 int DLInsert = jdbcTemplate.update(qry,DLinfo.getDl_usern(),DLinfo.getCin(),Sdate,Edate, DLinfo.getProduct(), DLinfo.getTotal_amount(), DLinfo.getLeft_amount(),DLinfo.getDelivery_adress(), "Non payée", "En Attente");

	    	// Si l'insertion a réussi, alors récupère les informations de la requête de délai insérée, crée un numéro de reçu et met à jour la ligne correspondante dans la table avec ce numéro.
	    	 if(DLInsert>0) {
	    			
	    		 String query = "SELECT * FROM DeadlineRequests WHERE start_date ='"+Sdate+"' AND end_date ='"+Edate+"' AND dl_usern = '"+DLinfo.getDl_usern()+"';";
	    			
	    		 
	    		 List <Deadline_info> DLInformations = jdbcTemplate.query(query,new BeanPropertyRowMapper(Deadline_info.class));
	    			variables.put("contract_num", DLInformations.get(0).getContract_num());
	    			variables.put("receipt", DLInformations.get(0).getContract_num()+9);
	    			receipt = DLInformations.get(0).getContract_num()+9;
	    			
	    	         String  Upqry="UPDATE `DeadlineRequests` SET `receipt`=? WHERE dl_usern=? AND start_date=? AND end_date=? ";
	    	         
	    	           // Exécute la seconde requête SQL pour insérer la requête de délai dans la table 'DeadlineRequestsHistory'.	
	    	           int UpdateReceipt = jdbcTemplate.update(Upqry,  DLInformations.get(0).getContract_num()+9 , DLinfo.getDl_usern(), Sdate, Edate );
	    	           
	    	           // Si l'insertion a réussi, alors met à jour la ligne correspondante dans la table 'DeadlineRequestsHistory' avec le numéro de reçu généré précédemment.
	    	    	   if (UpdateReceipt > 0) {System.out.println("Receipt GENERATED.");}
	    			
	    			System.out.println("Deadline Added Successfully");
	    			runtimeService.startProcessInstanceByKey("DeadlineReq", variables);
	    		}
	    	 
	    	
	    	 // Exécute la seconde requête SQL pour insérer la requête de délai dans la table 'DeadlineRequestsHistory'.
//	    	 int DLHInsert = jdbcTemplate.update(qry2,DLinfo.getDl_usern(),DLinfo.getCin(),Sdate,Edate, DLinfo.getProduct(), DLinfo.getTotal_amount(), DLinfo.getLeft_amount(), DLinfo.getDelivery_adress(),"Not Paid", "Waiting for payment");
	    	 int DLHInsert = jdbcTemplate.update(qry2,DLinfo.getDl_usern(),DLinfo.getCin(),Sdate,Edate, DLinfo.getProduct(), DLinfo.getTotal_amount(), DLinfo.getLeft_amount(), DLinfo.getDelivery_adress(),"Non payée", "En Attente");

	    	 
	    	// Si l'insertion a réussi, alors met à jour la ligne correspondante dans la table 'DeadlineRequestsHistory' avec le numéro de reçu généré précédemment.
	    		if(DLHInsert>0) {
	    	
	    	         String  Upqry="UPDATE `DeadlineRequestsHistory` SET `receipt`=? WHERE dl_usern=? AND start_date=? AND end_date=? ";
	    	        	
	    	           int UpdateReceiptHis = jdbcTemplate.update(Upqry, receipt , DLinfo.getDl_usern(), Sdate, Edate );
	    	    	   if (UpdateReceiptHis > 0) {System.out.println("Receipt GENERATED in History.");}
	    			System.out.println("Deadline History Added Successfully");
	    			
	    		}
	    	
	    }
	    
	    

	    	    
	    
		////////////////// DEVIS REQUEST ///////////////////
		
		 // Ce code définit un point d'accès de type POST pour les requêtes de devis (Devis Request).
		 // Il récupère des informations de devis à partir du corps de la requête et les utilise pour mettre à jour les enregistrements   
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/DevisReq")
	    public void DevisRequest(@RequestBody Devis_info DVinfo) throws ParseException {
	    	
	    	System.out.println("Devis Request Started");
	    	
	    	// Cette partie initie les services nécessaires pour déployer et exécuter le processus BPMN de devis.    	
	    	RepositoryService repositoryService = processEngine.getRepositoryService();
	    	historyService = processEngine.getHistoryService();
	    	runtimeService = processEngine.getRuntimeService();
	    	
	    	// Le processus BPMN est déployé à partir d'un fichier .bpmn20.xml situé dans les ressources du classpath.
	    	Deployment deployment = repositoryService.createDeployment()
	    	    	  .addClasspathResource("processes/DevisProcess.bpmn20.xml")
	    	    	  .deploy();
	    	    	ProcessDefinition processDefinition = repositoryService.createProcessDefinitionQuery()
	    	    			  .deploymentId(deployment.getId())
	    	    			  .singleResult();
	  
	    	// Les variables qui seront passées au processus BPMN sont stockées dans un Map.
	    	Map<String, Object> variables = new HashMap<String, Object>();
	    	
	    	// Récupère les informations de pack depuis la base de données en fonction du pack sélectionné dans la requête de devis.
	    	String pqry= "SELECT * FROM pack WHERE pack_id ='"+DVinfo.getPack()+"'";
	    	List <Pack_info> packs = jdbcTemplate.query(pqry, new BeanPropertyRowMapper(Pack_info.class));
	   
	    	// Toutes les informations relatives à la requête de devis sont stockées dans le Map de variables.
	    	variables.put("immat", DVinfo.getImmat());
	    	variables.put("immat_type", DVinfo.getImmat_type());
	    	variables.put("usage_type", DVinfo.getUsage_type());
	    	variables.put("serie", DVinfo.getSerie());
	    	variables.put("km", DVinfo.getKm());
	    	variables.put("circ_date", DVinfo.getCirc_date());
	    	variables.put("seat", DVinfo.getSeat());
	    	variables.put("horse", DVinfo.getHorse());
	    	variables.put("price_new", DVinfo.getPrice_new());
	    	variables.put("price_venal", DVinfo.getPrice_venal());
	    	variables.put("malus", 8);
	    	variables.put("marque", DVinfo.getMarque());
	    	variables.put("model", DVinfo.getModel());
	    	variables.put("money", DVinfo.getMoney());
	    	variables.put("dv_usern", DVinfo.getDv_usern());
	    	variables.put("cin", DVinfo.getCin());
	    	variables.put("client_firstname", DVinfo.getClient_firstname());
	    	variables.put("client_lastname", DVinfo.getClient_lastname());
	    	variables.put("phone", DVinfo.getPhone());
	    	variables.put("email", DVinfo.getEmail());
	    	variables.put("gender", DVinfo.getGender());
	    	variables.put("birth_date", DVinfo.getBirth_date());
	    	variables.put("job", DVinfo.getJob());
	    	variables.put("pack", packs.get(0).getPack_name());
	    	variables.put("apiOK", "YES");
	    	
	        SimpleDateFormat formatter = new SimpleDateFormat("dd/MM/yyyy");  
	        Date date = new Date();  
	        
	        variables.put("date", date);
	    	
	    	// Vérifie si le client existe déjà dans la base de données.
	    	String qryCheck= "SELECT cin FROM ClientInfo WHERE cl_usern='"+DVinfo.getDv_usern()+"' AND cin='"+DVinfo.getCin()+"'";
	    	List <Devis_info> DevisGet = jdbcTemplate.query(qryCheck, new BeanPropertyRowMapper(Devis_info.class));
	    	
	    	// Si le client existe déjà, alors les informations du client sont mises à jour.
	    	// Si le client n'existe pas, alors un nouveau client est ajouté à la base de données.
	    	
	    	if (DevisGet.size()>0) {
	    		
	    		String UpdateClient = "UPDATE ClientInfo SET  client_firstname=?, client_lastname=?, phone=?, email=?, gender=?, birth_date=?, job=? WHERE cin=?";
	    	
	    	
		    	 int UpClient = jdbcTemplate.update(UpdateClient, DVinfo.getClient_firstname(), DVinfo.getClient_lastname(), DVinfo.getPhone(), DVinfo.getEmail(), DVinfo.getGender(), DVinfo.getBirth_date(), DVinfo.getJob(), DVinfo.getCin());
		    	 if(UpClient>0) {
		    		 
		    			System.out.println("Client Updated Successfully");
		    			
		    		} 	
	    	}
	    	
	    	else {
	    		
		    	 String qry1 = "INSERT INTO ClientInfo(cl_usern,cin, client_firstname, client_lastname, phone, email, gender, birth_date, job) value (?,?,?,?,?,?,?,?,?)";
		    	 
		    	 int CLInsert = jdbcTemplate.update(qry1, DVinfo.getDv_usern(),DVinfo.getCin(), DVinfo.getClient_firstname(), DVinfo.getClient_lastname(), DVinfo.getPhone(), DVinfo.getEmail(), DVinfo.getGender(), DVinfo.getBirth_date(), DVinfo.getJob());
		    	 if(CLInsert>0) {
		    		 
		    			System.out.println("Client Added Successfully");
		    			
		    		} 	
	    	}
	   
	    	// Vérifie si le véhicule existe déjà dans la base de données.
	    	String carCheck= "SELECT immat FROM Vehicles WHERE vh_usern='"+DVinfo.getDv_usern()+"' AND immat='"+DVinfo.getImmat()+"'";
	    	List <Devis_info> VehGet = jdbcTemplate.query(carCheck, new BeanPropertyRowMapper(Devis_info.class));
	    	
	    	// Si le véhicule existe déjà, alors les informations du véhicule sont mises à jour.
	    	// Si le véhicule n'existe pas, alors un nouveau véhicule est ajouté à la base de données.


	    	// La requête de devis est ajoutée à la table 'DevisRequests' dans la base de données.
	    	// La même requête de devis est également ajoutée à la table 'DevisHistory'.
	    	// Si les requêtes d'insertion sont réussies, alors le processus BPMN
	    	
	    	
	    	if (VehGet.size()>0) {
	    		
	    		String UpdateCar = "UPDATE Vehicles SET immat_type=?, usage_type=?, serie=?,  seat=?, horse=?, price_new=?, price_venal=?, malus=?, vh_usern=?, km=? , marque=? , model=? , circ_date=? WHERE immat=?";
		    	 int VEHup = jdbcTemplate.update(UpdateCar,DVinfo.getImmat_type(),DVinfo.getUsage_type(),DVinfo.getSerie(),DVinfo.getSeat(),DVinfo.getHorse(),DVinfo.getPrice_new(),DVinfo.getPrice_venal(),DVinfo.getMalus(),DVinfo.getDv_usern(),DVinfo.getKm(), DVinfo.getMarque(), DVinfo.getModel(), DVinfo.getCirc_date(), DVinfo.getImmat());
		    	 if(VEHup>0) {
		    		 
		    			System.out.println("Vehicle Updated Successfully");
		    			
	    	   }
		    	 
	    	}
	    	
	    	else {

		    	 String qry2="INSERT INTO Vehicles(immat, immat_type, usage_type, serie,  seat, horse, price_new, price_venal, malus, vh_usern, km , marque , model , circ_date) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		    	 
		    	 int VEHInsert = jdbcTemplate.update(qry2,DVinfo.getImmat(),DVinfo.getImmat_type(),DVinfo.getUsage_type(),DVinfo.getSerie(),DVinfo.getSeat(),DVinfo.getHorse(),DVinfo.getPrice_new(),DVinfo.getPrice_venal(),DVinfo.getMalus(),DVinfo.getDv_usern(),DVinfo.getKm(), DVinfo.getMarque(), DVinfo.getModel(), DVinfo.getCirc_date());
		    	 if(VEHInsert>0) {
		    		 
		    			System.out.println("Vehicle Added Successfully");
		    			
		    	}
		    	 
}
	    	 
	    	 
	    	 
	    	 String qry="INSERT INTO DevisRequests(dv_usern, cin, immat, pack, money, date) values (?,?,?,?,?,?)";
	    	 String qryH="INSERT INTO DevisHistory(dv_usern, cin, immat, pack, money, date) values (?,?,?,?,?,?)";
		    	
	    	 int DVInsert = jdbcTemplate.update(qry,DVinfo.getDv_usern(), DVinfo.getCin(), DVinfo.getImmat(), DVinfo.getPack(), DVinfo.getMoney(), date);
	    	 if(DVInsert>0) {
	    		 
	    		 jdbcTemplate.execute("UPDATE Simulation SET devis_in = devis_in + 1");
	    		 
	    			runtimeService.startProcessInstanceByKey("DevisReq", variables);
	    			System.out.println("Devis Added Successfully");
	    			
	    		} 	
	    	 int DVHInsert = jdbcTemplate.update(qryH,DVinfo.getDv_usern(), DVinfo.getCin(), DVinfo.getImmat(), DVinfo.getPack(), DVinfo.getMoney(), date);
	    	 if(DVHInsert>0) {
	    		 
	    			System.out.println("Devis History Added Successfully");
	    			
	    		} 	
	    	 
	    	 
	    	 
	    }
	    
	    
	    
	    

		////////////////// SUBSCRIPTION REQUEST ///////////////////
		
	 // Ce code définit un point d'accès de type POST pour les demandes d'abonnement (Subscription Request).
	 // Il récupère les informations d'abonnement du corps de la requête et les utilise pour mettre à jour les enregistrements correspondants dans la base de données et démarrer un processus d'abonnement.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/SubsReq")
	    public ResponseEntity<String> SubscriptionRequest(@RequestBody Subscription_info SBinfo) throws ParseException {
	    	
	    	System.out.println("SUBS Request Started");
	    	
	    	// Cette partie initie les services nécessaires pour déployer et exécuter le processus BPMN d'abonnement.	
	    	RepositoryService repositoryService = processEngine.getRepositoryService();
	    	historyService = processEngine.getHistoryService();
	    	runtimeService = processEngine.getRuntimeService();
	    	
	    	// Le processus BPMN est déployé à partir d'un fichier .bpmn20.xml situé dans les ressources du classpath.
	    	Deployment deployment = repositoryService.createDeployment()
	    	    	  .addClasspathResource("processes/SubscriptionProcess.bpmn20.xml")
	    	    	  .deploy();
	    	    	ProcessDefinition processDefinition = repositoryService.createProcessDefinitionQuery()
	    	    			  .deploymentId(deployment.getId())
	    	    			  .singleResult();
	    	    	
	    	// Les variables qui seront passées au processus BPMN sont stockées dans un Map.   	
	    	Map<String, Object> variables = new HashMap<String, Object>();
	    	

	    	
	    	variables.put("client_firstname", SBinfo.getClient_firstname());
	    	variables.put("client_lastname", SBinfo.getClient_lastname());
	    	variables.put("birth_date", SBinfo.getBirth_date());
	    	variables.put("fraction", SBinfo.getFraction());
	    	variables.put("renew", SBinfo.getRenew());
	    	variables.put("effect_date", SBinfo.getEffect_date());
	    	variables.put("deadline", SBinfo.getDeadline());
	    	variables.put("delivery_adress", SBinfo.getDelivery_adress());
	    	variables.put("delivery_type", SBinfo.getDelivery_type());
	    	variables.put("job", SBinfo.getJob());
	    	variables.put("sub_usern", SBinfo.getSub_usern());
	    	variables.put("gender", SBinfo.getGender());
	    	variables.put("money", SBinfo.getMoney());
	    	variables.put("phone", SBinfo.getPhone());
	    	variables.put("email", SBinfo.getEmail());
	    	variables.put("apiOK", "YES");
	    	variables.put("approved", "YES");
	    	
	    	
	    	String qryD= "SELECT devis_id FROM DevisRequests WHERE dv_usern='"+SBinfo.getSub_usern()+"'";
	    	List <Devis_info> DevisGet = jdbcTemplate.query(qryD, new BeanPropertyRowMapper(Devis_info.class));
	    	
	    	
	    	String qry="INSERT INTO Subscriptions( sub_usern , devis_id, fraction, renew, effect_date, deadline,  delivery_adress , delivery_type , money) values (?,?,?,?,?,?,?,?,?)";
	    	
	    	
	    	 int SubInsert = jdbcTemplate.update(qry,SBinfo.getSub_usern(), DevisGet.get(0).getDevis_id(), SBinfo.getFraction(),  SBinfo.getRenew(),  SBinfo.getEffect_date(),  SBinfo.getDeadline(), SBinfo.getDelivery_adress(), SBinfo.getDelivery_type(),  SBinfo.getMoney());
	    		
	    	 if(SubInsert>0) {
	    		 
	    		 jdbcTemplate.execute("UPDATE Simulation SET sub_in = sub_in + 1");
	    			System.out.println("SUB Added Successfully");
	    			runtimeService.startProcessInstanceByKey("Subscription", variables);
	    		} 	
	    	 
	    	 return new ResponseEntity<>("Success",HttpStatus.OK);
	    	
	    } 
	    

	    
	    
	    
	    
	    
	    
	    //////////////////////////// USER TASK EXECUTION ////////////////////////
	   
	    //////////////////////////// AGENT TASK /////////////////////////////
		// Il récupère les informations de la tâche de l'agent à partir du corps de la requête, 
		// et utilise ces informations pour mettre à jour la tâche correspondante dans le moteur de processus.  	    
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/agenttask")
	    public ResponseEntity<String> CompleteAgentTask(@RequestBody AgentTask Agenttask) {
	    	
	        // Cette partie initie le service Runtime pour l'accès aux données du moteur de processus.
	    	runtimeService = processEngine.getRuntimeService();
			Map<String, Object> variable = new HashMap<String, Object>();
			
		    // Une requête SQL est définie pour récupérer l'ID de la tâche en fonction du reçu associé.
			String qry="SELECT act_ru_task.ID_ FROM act_ru_task, act_ru_variable, deadlinerequests WHERE act_ru_task.PROC_INST_ID_ = act_ru_variable.PROC_INST_ID_ AND act_ru_variable.NAME_='receipt' AND act_ru_variable.TEXT_ in ('"+Agenttask.getReceipt()+"');";
			
		    // Raison est une variable qui conserve les raisons pour lesquelles la tâche de l'agent peut être rejetée.
			String reason ="";
			
			if (Agenttask.getReason_tech().equals("valid")==false || Agenttask.getReason_vig().equals("valid")==false) {
				reason="Visite technique est : "+Agenttask.getReason_tech() + "/ Vignette est : "+Agenttask.getReason_vig();
			}
		
		    // Récupère l'ID de la tâche associée au reçu spécifié.
			List <TasksDef> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(TasksDef.class));

		    // Complète la tâche dans le moteur de processus.
			taskService = processEngine.getTaskService();
			variable.put("approved", Agenttask.getDecision());
			variable.put("reason_tech", Agenttask.getReason_tech());
			variable.put("reason_vig", Agenttask.getReason_vig());
			variable.put("reason", reason);
			taskService.complete(TasksInformations.get(0).getID_(), variable);
			
		    // Renvoie un ResponseEntity avec un message de succès et un statut HTTP de OK.
			return new ResponseEntity<>("Success",HttpStatus.OK);
		
		}
	    
	    
	    
	    
	    /////////////////////////// AGENT DEADLINE PRINTS ///////////////////////////
	
		// Ce code définit un point d'accès POST qui renvoie toutes les informations sur les échéances. 
		// Cela pourrait être utile pour un agent qui a besoin d'accéder à toutes les échéances en cours.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/dlinfo")
	    public ResponseEntity<List<Deadline_info>> AllDLInfo() {
	    	
	    //String qry="SELECT act_ru_task.ID_ FROM act_ru_task, act_ru_variable, deadlinerequests WHERE act_ru_task.PROC_INST_ID_ = act_ru_variable.PROC_INST_ID_ AND act_ru_variable.NAME_='receipt' AND act_ru_variable.TEXT_ in ('');";
	    	
	    // Une requête SQL est définie pour récupérer toutes les informations des demandes d'échéances.
	    String qry = "SELECT * FROM `deadlinerequests`;";
	    	
	    // Ici, la requête SQL est exécutée avec jdbcTemplate.query() et les résultats sont mappés à des objets de type Deadline_info.
	    List <Deadline_info> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Deadline_info.class));
	    	
	    // Renvoie un ResponseEntity contenant la liste des informations sur les échéances et un statut HTTP de OK.
	    return new ResponseEntity<>(TasksInformations,HttpStatus.OK);
	    	
	    }
	    
	    
	    
	    
	    
	
	    
	    ///////////////////////////// Client Deadline Pay Task /////////////////////////////
	    
	    // Cette méthode permet au client de terminer une tâche de paiement.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/clientpaytask")
	    public ResponseEntity<String> CompleteClientPayingTask(@RequestBody ClientTask [] CLtask) {
	    	
	        // Instancie le RuntimeService à partir du processEngine
	    	runtimeService = processEngine.getRuntimeService();
	    	String Contracts = "";
	    	int TotalPA = 0;
			Map<String, Object> variable = new HashMap<String, Object>();
			
		    // Itère sur les tâches du client
			for (int i=0;i<CLtask.length;i++) {
				
		        // Concatène les numéros de contrat
				Contracts =  CLtask[i].getContract_num()  +  "," + Contracts ; // 
		        // Calcule le montant total restant à payer
				TotalPA += CLtask[i].getLeft_amount();
			}
			Contracts = Contracts.substring(0,Contracts.length()-1);
	
		    // Construit la requête SQL pour trouver les tâches qui correspondent aux numéros de contrat
			String qry = "SELECT act_ru_task.ID_ FROM act_ru_task, act_ru_variable WHERE act_ru_task.PROC_INST_ID_ = act_ru_variable.PROC_INST_ID_ AND act_ru_variable.NAME_ = 'contract_num' AND act_ru_variable.TEXT_ in ("+Contracts+");";
			List <TasksDef> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(TasksDef.class));
	
		
			taskService = processEngine.getTaskService();
			
			System.out.println("TI length : "+TasksInformations.size());
			System.out.println("CL length : "+CLtask.length);
			
		    // Itère sur les tâches pour les compléter
			for (int i=0;i<TasksInformations.size();i++) {		
			
			variable.put("Left_amount", TotalPA);
			variable.put("Paid_amount", TotalPA);
			variable.put("approved", "YES");
			variable.put("paid","YES");
			variable.put("username", CLtask[i].getUsername());
			taskService.complete(TasksInformations.get(i).getID_(), variable);
				
			}
			
		    // Renvoie un ResponseEntity avec un statut HTTP de OK et un message de "Success".
			return new ResponseEntity<>("Success",HttpStatus.OK);
		
		}
	    
	    
	    
	    
	    
	    
	    //////////////////////// ADD PACK ////////////////////////////////
	    
	    // Cette méthode permet d'ajouter un nouveau pack de garanties.   
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/addpack")
	    public void AddPack(@RequestBody Pack_info [] Pack) { 
	    
	 // qry1 est une requête SQL pour insérer le nom et le prix du pack dans la table 'pack'.
   	 String qry1 = "INSERT INTO pack(pack_name, price) values (?,?)";
     // qry3 est une requête SQL pour insérer le pack_id et le guaranty_id dans la table 'PackGuaranties'.
   	 String qry3 = "INSERT INTO PackGuaranties(pack_id, guaranty_id) values (?,?)";
	 
     // PInsert est une mise à jour de la base de données en utilisant qry1 et les informations du premier élément du tableau Pack.
   	 int PInsert = jdbcTemplate.update(qry1, Pack[0].getPack_name(), Pack[0].getPrice());
   	 if(PInsert>0) {
   		 
         // qry est une requête SQL pour sélectionner le pack_id du pack ajouté précédemment.
	     String qry = "SELECT pack_id FROM pack WHERE pack_name ='"+Pack[0].getPack_name()+"' ;";
	    	
	        // PackInf est une liste d'objets Pack_info retournés par l'exécution de la requête qry.
	    	List <Pack_info> PackInf = jdbcTemplate.query(qry, new BeanPropertyRowMapper(Pack_info.class));
   		 
	     // Itère sur chaque élément de Pack et insère le pack_id et le guaranty_id dans la table 'PackGuaranties'. 
   		 for (int i=0;i<Pack.length;i++) {
   			 
    			int PGInsert = jdbcTemplate.update(qry3, PackInf.get(0).getPack_id(), Pack[i].getGuaranty_id());
                // Si PGInsert est supérieur à 0, cela signifie que l'insertion a été effectuée avec succès, et un message est affiché.
       			if(PGInsert>0) {
       				
       				System.out.println("Pack Added Successfully");

       			}
   		 }
   		 	
	
   	 }
   		
   		
}
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    //////////////////////////// UPDATE PACKS /////////////////////////
	    
	    
	    // Cette méthode permet de mettre à jour un pack existant dans la base de données.    
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/updatepack")
	    public ResponseEntity<String> UpdatePack(@RequestBody Pack_info [] Pack) {
	    	
	        // Affiche l'identifiant du pack qui doit être mis à jour.
	    	System.out.println("pack id for update :"+ Pack[0].getPack_id());
	    	
	    	
	        // Initialisation de la variable 'done' qui comptera le nombre de mises à jour réussies.
	    	int done = 0;
	        // Requête SQL pour mettre à jour les informations du pack dans la table 'pack'.
	    	String qryUp="UPDATE pack SET pack_name=?, price=? WHERE pack_id=?";
		    
	        // Exécution de la requête de mise à jour. Si la mise à jour est réussie, la variable 'done' est incrémentée.
		    	int PDel1 = jdbcTemplate.update(qryUp, Pack[0].getPack_name(), Pack[0].getPrice(), Pack[0].getPack_id());
		    	if (PDel1>0) {
		    		done++;
		    		System.out.println("Updated Pack Table");
		    		
		    	}
		    	
		        // Requête SQL pour supprimer les anciennes garanties du pack de la table 'packguaranties'.    
		    	String qry = "DELETE packguaranties FROM packguaranties WHERE packguaranties.pack_id = ?;";
		    	
		        // Exécution de la requête de suppression. Si la suppression est réussie, la variable 'done' est incrémentée.
		    	int PDel = jdbcTemplate.update(qry, Pack[0].getPack_id());
		    	
		    	if (PDel>0) {
		    		
			    	done++;
			    	System.out.println("DELETED OLD after update");
			    	
	
		    		
		    	}
		    	
		        // Requête SQL pour insérer les nouvelles garanties du pack dans la table 'packguaranties'.
		    	String qry3 = "INSERT INTO PackGuaranties(pack_id, guaranty_id) values (?,?)";	
	    		
		   		 for (int i=0;i<Pack.length;i++) {
		   			 
		    			int PGInsert = jdbcTemplate.update(qry3, Pack[0].getPack_id(), Pack[i].getGuaranty_id());
		       			if(PGInsert>0) {
		       				
		       				System.out.println("Pack Added Successfully");

		       			}
		   		 }
	    	
		   	// Si toutes les mises à jour et suppressions ont réussi (c'est-à-dire si 'done' est égal à 2), la réponse renvoie "Pack Updated".
		   	// Sinon, la réponse indique qu'il y a eu une erreur.	 
	    	if (done == 2) {
	    		return new ResponseEntity<>("Pack Updated", HttpStatus.OK);
	    	}
	    	
	    	else {
	    		return new ResponseEntity<>("Error : Pack not updated", HttpStatus.OK);
	    	}
   		 
	    	
	    }
	    
	    
	    
	    
	    
	    
	    
	    ////////////////////////// DISPLAY PACKS /////////////////////////
	    
	    // Cette méthode permet d'afficher tous les packs disponibles dans la base de données.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/showpack")
	    public ResponseEntity<List<Pack_info>> ShowPack() {
	    	
	    	
	        // Requête SQL pour obtenir toutes les informations nécessaires sur les packs.
	        // Elle joint les tables 'pack', 'guaranties' et 'packguaranties' pour obtenir les détails complets des packs, y compris les garanties qu'ils contiennent.
	    	String qry = "SELECT pack.pack_id, pack.pack_name, pack.price, guaranties.guaranty_id, guaranty_name FROM pack,guaranties,packguaranties WHERE packguaranties.pack_id = pack.pack_id AND packguaranties.guaranty_id = guaranties.guaranty_id ;";
	    	
	        // Exécution de la requête et stockage des résultats dans une liste d'objets 'Pack_info'.
	    	List <Pack_info> PackInf = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Pack_info.class));
   		 
	        // Renvoie la liste des packs avec un statut HTTP OK
	    	return new ResponseEntity<>(PackInf, HttpStatus.OK);
	    	
	    }
	    
	    
	    
	    
	    
	        
	    //////////////////////////// DELETE PACKS /////////////////////////
	    
	    // Cette méthode permet de supprimer un pack spécifique dans la base de données.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/delpack")
	    public ResponseEntity<String> DeletePack(@RequestBody Pack_info Pack) {
	    	
	        // Initialisation d'un compteur pour vérifier si toutes les opérations de suppression ont réussi.
	    	int done = 0;
	    	
	        // Première requête SQL pour supprimer les entrées correspondantes dans la table 'packguaranties'.
	    	String qry = "DELETE packguaranties FROM pack, packguaranties WHERE  pack.pack_id =? AND packguaranties.pack_id=? ;";
	    	
	        // Exécution de la première requête de suppression.
	    	int PDel = jdbcTemplate.update(qry, Pack.getPack_id(), Pack.getPack_id());
	    	
	        // Si la suppression dans 'packguaranties' a réussi...
	    	if (PDel>0) {
	    		
	            // Deuxième requête SQL pour supprimer le pack lui-même dans la table 'pack'.
		    	String qry1 = "DELETE FROM pack WHERE pack_id =? ;";
		    	done++;
		    	System.out.println("DELETED");
		    	
		        // Exécution de la deuxième requête de suppression.
		    	int PDel1 = jdbcTemplate.update(qry1, Pack.getPack_id());
		    	
		        // Si la suppression dans 'pack' a réussi...
		    	if (PDel1>0) {
		            // Incrémentation du compteur.
		    		done++;
		    		System.out.println("DELETED TOO");
		    	}
	    		
	    	}
	    	
	        // Si toutes les suppressions ont réussi, retourne un message de succès avec un statut HTTP OK.
	    	if (done == 2) {
	    		return new ResponseEntity<>("Pack Deleted", HttpStatus.OK);
	    	}
	    	
	    	
	        // Sinon, retourne un message d'erreur avec un statut HTTP OK.
	    	else {
	    		return new ResponseEntity<>("Error : Pack not deleted", HttpStatus.OK);
	    	}
   		 
	    	
	    }
	    
	    
	    
	    
	    

	    
	    
	    
	    
 ///////////////////////////// Client DEVISE Input Task /////////////////////////////
	    
	    // This method is used to complete a specific task related to the client's quote (devis in French) input in the process.  
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/devisintask")
	    public ResponseEntity<String> CompleteDevisInputTask(@RequestBody ClientTask DvTask) {
	    	
	        // Get the runtime service from the process engine
	    	runtimeService = processEngine.getRuntimeService();
	    
	    	// Define a SQL query that will find the task ID for the task where the process instance ID matches
	        // the process instance ID associated with the username provided in the task object (DvTask).
			String qry = "SELECT act_ru_task.ID_ FROM act_ru_task, act_ru_variable WHERE act_ru_task.PROC_INST_ID_ = act_ru_variable.PROC_INST_ID_ AND act_ru_variable.NAME_ = 'dv_usern' AND act_ru_variable.TEXT_ = '"+DvTask.getUsername()+"';";
			
		    // Create a map to hold variables that might be used in the process. In this case, the map is empty.
			Map<String, Object> variable = new HashMap<String, Object>();
			
		    // Run the SQL query and store the results in a list of TasksDef objects.
			List <TasksDef> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(TasksDef.class));
		
		    // Get the task service from the process engine.
			taskService = processEngine.getTaskService();
			
		    // Complete the task with the task ID retrieved from the SQL query.
			taskService.complete(TasksInformations.get(0).getID_(), variable);
			
		    // Run the SQL query again and store the results in the same list of TasksDef objects.
			TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(TasksDef.class));
			
		    // Complete the task with the new task ID retrieved from the SQL query.
			taskService.complete(TasksInformations.get(0).getID_(), variable);
			
		    // Return a response entity with a success message and a HTTP status of OK.
			return new ResponseEntity<>("Success",HttpStatus.OK);
		
		}
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    ////////////////////// SUBSCRIPTION PAY TASK ///////////////////////
	    
	    // Endpoint to handle completion of subscription payment tasks
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/subpaytask")
	    public ResponseEntity<String> CompleteSUBPayTask(@RequestBody ClientTask SBTask) {
	    	
	    	
	        // Print to console to indicate that the subscription payment task process has been activated for a given user
	    	System.out.println("SUB PAY TASK ACTIVATED!!"+SBTask.getUsername());
	    	
	        // Get the runtime service from the process engine
	    	runtimeService = processEngine.getRuntimeService();
	    
	    	
	        // Define a SQL query that will find the task ID for the task where the process instance ID matches
	        // the process instance ID associated with the username provided in the task object (SBTask).
			String qry = "SELECT act_ru_task.ID_ FROM act_ru_task, act_ru_variable WHERE act_ru_task.PROC_INST_ID_ = act_ru_variable.PROC_INST_ID_ AND act_ru_variable.NAME_ = 'sub_usern' AND act_ru_variable.TEXT_ = '"+SBTask.getUsername()+"';";
			
		    // Create a map to hold variables that might be used in the process. In this case, the map is empty.
			Map<String, Object> variable = new HashMap<String, Object>();
			
		    // Run the SQL query and store the results in a list of TasksDef objects.
			List <TasksDef> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(TasksDef.class));
		
		    // Get the task service from the process engine.
			taskService = processEngine.getTaskService();
			
		    // Complete the task with the task ID retrieved from the SQL query.
			taskService.complete(TasksInformations.get(0).getID_(), variable);
			
		    // Run the SQL query again and store the results in the same list of TasksDef objects.
			TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(TasksDef.class));
			
		    // Get the task service from the process engine.
			taskService = processEngine.getTaskService();
			
		    // Complete the task with the new task ID retrieved from the SQL query.
			taskService.complete(TasksInformations.get(0).getID_(), variable);
			
		    // Return a response entity with a success message and a HTTP status of OK.
			return new ResponseEntity<>("Success",HttpStatus.OK);
		
		}
	    
	    
	    
	    
	    
	    
 ////////////////////// SUBSCRIPTION UPLOAD TASK ///////////////////////
	    
	    // Endpoint for completing a Subscription Upload Task
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/subuptask")
	    public ResponseEntity<String> SUBUploadTask(@RequestBody ClientTask SBTask) {
	    	
	        // Get the runtime service from the process engine
	    	runtimeService = processEngine.getRuntimeService();
	    
	    	// Define a SQL query that will find the task ID for the task where the process instance ID matches
	        // the process instance ID associated with the username provided in the task object (SBTask).
			String qry = "SELECT act_ru_task.ID_ FROM act_ru_task, act_ru_variable WHERE act_ru_task.PROC_INST_ID_ = act_ru_variable.PROC_INST_ID_ AND act_ru_variable.NAME_ = 'sub_usern' AND act_ru_variable.TEXT_ = '"+SBTask.getUsername()+"';";
			
		    // Create a map to hold variables that might be used in the process. 
			Map<String, Object> variable = new HashMap<String, Object>();
			
		    // Run the SQL query and store the results in a list of TasksDef objects.
			List <TasksDef> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(TasksDef.class));
		
		    // Get the task service from the process engine.
			taskService = processEngine.getTaskService();
			
		    // Put the 'vignette' attribute from the ClientTask object into the variables map as 'id_doc'.
			variable.put("id_doc", SBTask.getVignette());
			
			taskService.complete(TasksInformations.get(0).getID_(), variable);
			
		    // Return a response entity with a success message and a HTTP status of OK.
			return new ResponseEntity<>("Success",HttpStatus.OK);
		
		}
	    
	    
	    
	    ////////////////////// SUBSCRIPTION SIGNATURE TASK ///////////////////////
	    
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/subsigntask")
	    public ResponseEntity<String> SUBSignTask(@RequestBody ClientTask SBTask) {
	    	
	        // Get the runtime service from the process engine
	    	runtimeService = processEngine.getRuntimeService();
	    
	    	// Define a SQL query to find the task ID for the task where the process instance ID matches
	        // the process instance ID associated with the username provided in the task object (SBTask).
			String qry = "SELECT act_ru_task.ID_ FROM act_ru_task, act_ru_variable WHERE act_ru_task.PROC_INST_ID_ = act_ru_variable.PROC_INST_ID_ AND act_ru_variable.NAME_ = 'sub_usern' AND act_ru_variable.TEXT_ = '"+SBTask.getUsername()+"';";
			
		    // Create a map to hold variables that might be used in the process.
			Map<String, Object> variable = new HashMap<String, Object>();
			
		    // Execute the SQL query and store the results in a list of TasksDef objects.
			List <TasksDef> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(TasksDef.class));
			
		    // Get the task service from the process engine.
			taskService = processEngine.getTaskService();
			
		    // Complete the task with the task ID retrieved from the SQL query and the variables map.
			taskService.complete(TasksInformations.get(0).getID_(), variable);
			
		    // Return a response entity with a success message and a HTTP status of OK.
			return new ResponseEntity<>("Success",HttpStatus.OK);
		
		}
	    
	    
	    
	    
	    
	    
	   
	    /////////////////////////////// Client Upload Task /////////////////////////////
	    
	    // Cross-origin resource sharing (CORS) allows AJAX requests to skip the Same-origin policy and access resources from remote hosts.   
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    // Annotation for mapping HTTP POST requests onto this method.
	    @PostMapping(value="/clientuptask")
	    public ResponseEntity<String> CompleteClientUploadTask(@RequestBody ClientTask [] CLtask) {
	    	
	        // Gets the RuntimeService from the process engine.
	    	runtimeService = processEngine.getRuntimeService();
	    	
	        // A map to hold variables that will be used in the process.
			Map<String, Object> variable = new HashMap<String, Object>();
			
		    // String to hold the contract numbers.
			String Contracts = "";
	    	
			
		    // Loop through the array of ClientTask objects.
            for (int i=0;i<CLtask.length;i++) {
                // Append the contract number to the Contracts string.
				Contracts = Contracts +    ","  + CLtask[i].getContract_num() ; // 
		
			}
            // Remove the leading comma from the Contracts string.
			Contracts = Contracts.substring(1,Contracts.length());
	    	
		    // Query to select the task ID from the activity tables where the contract number matches one of the contract numbers in the Contracts string.
			String qry = "SELECT act_ru_task.ID_ FROM act_ru_task, act_ru_variable WHERE act_ru_task.PROC_INST_ID_ = act_ru_variable.PROC_INST_ID_ AND act_ru_variable.NAME_ = 'contract_num' AND act_ru_variable.TEXT_ in ("+Contracts+");";
			
		    // Execute the query and store the results in a list of TasksDef objects.
			List <TasksDef> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(TasksDef.class));
	
		    // Get the TaskService from the process engine.
			taskService = processEngine.getTaskService();
			
		    // Loop through the list of TasksDef objects.
			for (int i=0;i<TasksInformations.size();i++) {
				
		        // Add variables to the variables map.
				variable.put("vignette", CLtask[i].getVignette());
				variable.put("tech_visit", CLtask[i].getTech_visit());
				variable.put("username", CLtask[i].getUsername());
				variable.put("contract_num", CLtask[i].getContract_num());
				
		        // Complete the task with the task ID retrieved from the SQL query and the variables map.
				taskService.complete(TasksInformations.get(i).getID_(), variable);
				
				
			}
			
		    // Return a response entity with a success message and a HTTP status of OK.
			return new ResponseEntity<>("Success",HttpStatus.OK);
		
		}
	    
	    
	    
	    
	    /////////////////////////////// Client Re-Upload Task /////////////////////////////
	    
	    // Cross-origin resource sharing (CORS) allows AJAX requests to skip the Same-origin policy and access resources from remote hosts.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/clientreuptask")
	    // Annotation for mapping HTTP POST requests onto this method.
	    public ResponseEntity<String> CompleteClientREUploadTask(@RequestBody ClientTask  CLtask) {
	    	
	        // Gets the RuntimeService from the process engine.
	    	runtimeService = processEngine.getRuntimeService();
	    	
	        // A map to hold variables that will be used in the process.
			Map<String, Object> variable = new HashMap<String, Object>();
	
		    // Query to select the task ID from the activity tables where the contract number matches the contract number in the ClientTask object.
			String qry = "SELECT act_ru_task.ID_ FROM act_ru_task, act_ru_variable WHERE act_ru_task.PROC_INST_ID_ = act_ru_variable.PROC_INST_ID_ AND act_ru_variable.NAME_ = 'contract_num' AND act_ru_variable.TEXT_ in ('"+CLtask.getContract_num()+"');";
			
		    // Execute the query and store the results in a list of TasksDef objects.
			List <TasksDef> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(TasksDef.class));
	
		    // Get the TaskService from the process engine.
			taskService = processEngine.getTaskService();
			
		    // Add variables to the variables map.
				variable.put("vignette", CLtask.getVignette());
				variable.put("tech_visit", CLtask.getTech_visit());
				variable.put("username", CLtask.getUsername());
				variable.put("contract_num", CLtask.getContract_num());
				
			    // Complete the task with the task ID retrieved from the SQL query and the variables map.
				taskService.complete(TasksInformations.get(0).getID_(), variable);
			
			// Return a response entity with a success message and a HTTP status of OK.
			return new ResponseEntity<>("Success",HttpStatus.OK);
		
		
	    }
	    
	    
 
	    
	    /////////////////////////////////////// DEADLINE CLIENT PRINTING /////////////////////////////////////////////////////
	    
	    // Cross-origin resource sharing (CORS) allows AJAX requests to skip the Same-origin policy and access resources from remote hosts.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    // Annotation for mapping HTTP POST requests onto this method.
	    @PostMapping(value="/productlist")
	    public ResponseEntity<List<Deadline_info>> Info(@RequestBody Deadline_info User) {
	    	
	        // Query to select the product, contract number, receipt, start date, end date, left amount, total amount, and state from the deadlinerequests table for a specific username.
	    	String qry = "SELECT  product, contract_num, receipt, start_date, end_date, left_amount, total_amount, state FROM `deadlinerequests` WHERE dl_usern = '"+User.getDl_usern()+"';";
	    	
	        // Execute the query and store the results in a list of Deadline_info objects.
	    	List <Deadline_info> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Deadline_info.class));
	    	
	        // Return a response entity with the list of Deadline_info objects and a HTTP status of OK.
	    	return new ResponseEntity<>(TasksInformations,HttpStatus.OK);
	    	
	    }
	    
	    

	    /////////////////////////////////////// DEADLINE CLIENT PRINTING /////////////////////////////////////////////////////
	    
		  
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/productlisthis")

	    // Cet objet contient une liste d'objets Deadline_info en tant que corps de la réponse, et un HttpStatus en tant que code de statut HTTP de la réponse.
	    public ResponseEntity<List<Deadline_info>> InfoHis(@RequestBody Deadline_info User) {

	    	
	        // Définition de la requête SQL pour récupérer certaines informations sur les produits pour un utilisateur spécifique.
	    	String qry = "SELECT  product, contract_num, receipt, start_date, end_date, left_amount, total_amount, state FROM `deadlinerequests` WHERE dl_usern = '"+User.getDl_usern()+"';";

	        // Les résultats sont mappés vers des objets de type Deadline_info, et ajoutés à une liste.
	    	List <Deadline_info> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Deadline_info.class));

	    	
	        // Création d'un nouvel objet ResponseEntity contenant la liste des informations sur les tâches et le statut HTTP OK (200), puis renvoie de cet objet.
	    	return new ResponseEntity<>(TasksInformations,HttpStatus.OK);

	    }
	    
	  
   
	    
	    /////////////////////// DOWNLOAD DEVIS PDF FILE ////////////////////////
	    
	    // Cross-origin resource sharing (CORS) allows AJAX requests to skip the Same-origin policy and access resources from remote hosts.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    
	    // Annotation for mapping HTTP POST requests onto this method.
	    @PostMapping(value="/devisfiledownload")
	    public ResponseEntity<Devis_info> DevisFileDownload(@RequestBody Devis_info User) {
	    	
	        // Query to select the product, contract number, receipt, start date, end date, left amount, total amount, and state from the deadlinerequests table for a specific username.
	    	String qry = "SELECT  devis_doc, money FROM `devishistory`,clientinfo WHERE devishistory.cin = clientinfo.cin AND cl_usern =  '"+User.getDv_usern()+"';";
	    	
	        // Execute the query and store the results in a list of Deadline_info objects.
	    	List <Devis_info> Devis = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Devis_info.class));
	    	
	        // Return a response entity with the list of Deadline_info objects and a HTTP status of OK.
	    	return new ResponseEntity<>(Devis.get(0),HttpStatus.OK);
	    	
	    }
	    
	    
	    
	    /////////////////////// DOWNLOAD DEVIS PDF FILE ////////////////////////
	    
	    // Cross-origin resource sharing (CORS) allows AJAX requests to skip the Same-origin policy and access resources from remote hosts.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    // Annotation for mapping HTTP POST requests onto this method.
	    @PostMapping(value="/deviscurrshow")
	    public ResponseEntity<Devis_info> DevisSubSHOWDownload(@RequestBody Devis_info User) {
	    	
	        // Query to select the devis document and money from the devisrequests and clientinfo tables for a specific username.
	    	String qry = "SELECT  devis_id, devis_doc, money FROM `devisrequests`,clientinfo WHERE devisrequests.cin = clientinfo.cin AND cl_usern = '"+User.getDv_usern()+"';";
	    	
	        // Execute the query and store the results in a list of Devis_info objects.
	    	List <Devis_info> Devis = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Devis_info.class));
	    	
	        // If the list of Devis_info objects is not empty, return the first object in the list with a HTTP status of OK.
	    	if (Devis.size()>0) {
		    	return new ResponseEntity<>(Devis.get(0),HttpStatus.OK);
	    	}
	    	
	        // If the list of Devis_info objects is empty, return null.
	    	else {
	    		return null;
	    	}
	    	

	    	
	    }
	    
	    
	    
	    /////////////////////// DOWNLOAD CONTRACT PDF FILE ////////////////////////
	    
	    // Le partage de ressources cross-origin (CORS) permet aux requêtes AJAX de contourner la politique de même origine et d'accéder aux ressources à partir d'hôtes distants.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    // Annotation pour mapper les requêtes HTTP POST sur cette méthode.
	    @PostMapping(value="/contdownload")
	    public ResponseEntity<Subscription_info> CONTRACTFileDownload(@RequestBody Devis_info User) {
	    	
	        // Requête pour sélectionner le contrat depuis la table 'subscriptions' pour un nom d'utilisateur spécifique.
	    	String qry = "SELECT  contract FROM `subscriptions` WHERE sub_usern = '"+User.getDv_usern()+"';";
	    	
	    // Exécute la requête et stocke les résultats dans une liste d'objets Subscription_info.
	    List <Subscription_info> Devis = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Subscription_info.class));
	    
	    	// Retourne le premier objet dans la liste avec un statut HTTP de OK.
	    	return new ResponseEntity<>(Devis.get(0),HttpStatus.OK);
	    	
	    }
	    
	    
	    
	    
	    
	    /////////////////////////////////////// DEVIS FILL API /////////////////////////////////////////////////////
	    
	    // Annotation pour permettre les requêtes cross-origin à partir des hôtes spécifiés.  
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/cinapi")
	    public ResponseEntity<List<Devis_info>> DevisPrint(@RequestBody Devis_info User) {
	    	
	        // Requête SQL pour sélectionner toutes les informations des tables 'devisrequests', 'clientinfo' et 'vehicles' pour un nom d'utilisateur spécifique où 'devisrequests.cin' est égal à 'clientinfo.cin' et 'vehicles.immat' est égal à 'devisrequests.immat'.
	    	String qry = "SELECT * FROM `devisrequests`,clientinfo,vehicles WHERE cl_usern = '"+User.getDv_usern()+"' AND devisrequests.cin = clientinfo.cin AND vehicles.immat = devisrequests.immat; ";
	    	
	        // Exécute la requête et stocke les résultats dans une liste d'objets Devis_info.
	    	List <Devis_info> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Devis_info.class));
	    	
	        // Retourne la liste d'objets Devis_info avec un statut HTTP de OK.
	    	return new ResponseEntity<>(TasksInformations,HttpStatus.OK);
	    	
	    }
	    
	    
	    
	    
	    /////////////////////////////////////// DEVIS API /////////////////////////////////////////////////////
	    
	    // Annotation pour permettre les requêtes cross-origin à partir des hôtes spécifiés.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    // Annotation pour mapper les requêtes HTTP POST à cette méthode.
	    @PostMapping(value="/showdevis")
	    public ResponseEntity<List<Devis_info>> DevisPrinter() {
	    	
	        // Requête SQL pour sélectionner toutes les informations des tables 'devisrequests' et 'clientinfo' où 'clientinfo.cin' est égal à 'devisrequests.cin'.
	    	String qry = "SELECT * FROM `devisrequests`,`clientinfo` WHERE clientinfo.cin = devisrequests.cin;";
	    	
	        // Exécute la requête et stocke les résultats dans une liste d'objets Devis_info.
	    	List <Devis_info> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Devis_info.class));
	    	
	        // Retourne la liste d'objets Devis_info avec un statut HTTP de OK.
	    	return new ResponseEntity<>(TasksInformations,HttpStatus.OK);
	    	
	    }  
	    
	
	    
	    
	    
	    
	    
	    
	    
	    /////////////////////////////////////// DEVIS API /////////////////////////////////////////////////////
	    
	    // Annotation pour permettre les requêtes cross-origin à partir des hôtes spécifiés.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    // Annotation pour mapper les requêtes HTTP POST à cette méthode.
	    @PostMapping(value="/devisinfo")
	    public ResponseEntity<List<Devis_info>> DevisInfoPrinter() {
	    	
	    	// Requête SQL pour sélectionner toutes les informations des tables 'devishistory', 'clientinfo', et 'vehicles' où 'clientinfo.cin' est égal à 'devishistory.cin', 
	        // 'devishistory.immat' est égal à 'vehicles.immat', 'cl_usern' est égal à 'dv_usern', et 'dv_usern' est égal à 'vh_usern'.
	    	String qry = "SELECT * FROM `devishistory`,`clientinfo`,`vehicles` WHERE clientinfo.cin = devishistory.cin AND devishistory.immat = vehicles.immat AND cl_usern = dv_usern AND dv_usern = vh_usern ;";
	    	
	        // Exécute la requête et stocke les résultats dans une liste d'objets Devis_info.
	    	List <Devis_info> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Devis_info.class));
	    	
	        // Retourne la liste d'objets Devis_info avec un statut HTTP de OK.
	    	return new ResponseEntity<>(TasksInformations,HttpStatus.OK);
	    	
	    }  
	    
	    
	    
	    /////////////////////////////////////// DEVIS DELETE API /////////////////////////////////////////////////////
	    /*Cette méthode est utilisée pour supprimer des informations de devis spécifiques des tables 'devisrequests' et 'devishistory' en fonction d'un ID de devis spécifié. */
	    
	    
	    
	    // Annotation pour permettre les requêtes cross-origin à partir des hôtes spécifiés.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    // Annotation pour mapper les requêtes HTTP POST à cette méthode.
	    @PostMapping(value="/devisdel")
	    public String DevisDELETE(@RequestBody Devis_info Dev) {
	    	
	    	// Requête SQL pour supprimer des informations de devis des tables 'devisrequests' et 'devishistory' où 'devisrequests.devis_id' est égal à 'devishistory.devis_id', 
	        // et 'devishistory.devis_id' est égal à l'ID de devis fourni.
	    	String qry = "DELETE devisrequests, devishistory FROM devisrequests, devishistory WHERE devisrequests.devis_id = devishistory.devis_id AND devishistory.devis_id = ?";
	    	
	        // Exécute la requête et stocke le nombre de lignes affectées dans une variable.
	    	int DevisDel = jdbcTemplate.update(qry, Dev.getDevis_id());
	    	
	        // Vérifie si la suppression a été réussie.
	    	if (DevisDel>0) {
	    		return "Devis Deleted";
	    	}
	    	else {
	    		return "No devis to delete";
	    	}
			

	    }  
	    
	    
	    
	    
	    
	    
	    /////////////////////////////////////// CLIENT DEVIS DELETE API /////////////////////////////////////////////////////
	    /*Cette méthode est utilisée pour supprimer des informations de devis spécifiques des tables 'devisrequests' et 'devishistory' en fonction d'un ID de devis spécifié. */
	    
	    
	    
	    // Annotation pour permettre les requêtes cross-origin à partir des hôtes spécifiés.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    // Annotation pour mapper les requêtes HTTP POST à cette méthode.
	    @PostMapping(value="/cldevisdel")
	    public String ClientDevisDELETE(@RequestBody Devis_info Dev) {
	    	System.out.println("Client Del initiated"+ Dev.getDevis_id());
	    	
	    	// Requête SQL pour supprimer des informations de devis des tables 'devisrequests' et 'devishistory' où 'devisrequests.devis_id' est égal à 'devishistory.devis_id', 
	        // et 'devishistory.devis_id' est égal à l'ID de devis fourni.
	    	String qry = "DELETE devisrequests FROM devisrequests WHERE devisrequests.devis_id = ?";
	    	
	        // Exécute la requête et stocke le nombre de lignes affectées dans une variable.
	    	int DevisDel = jdbcTemplate.update(qry, Dev.getDevis_id());
	    	
	        // Vérifie si la suppression a été réussie.
	    	if (DevisDel>0) {
	    		return "Devis Deleted";
	    	}
	    	else {
	    		return "No devis to delete";
	    	}
			

	    }  
	    
	
	    
	    /////////////////////////////////////// SIMULATION API /////////////////////////////////////////////////////
	    /*Cette méthode est utilisée pour obtenir des informations sur la simulation de la table Simulation dans la base de données.*/
	    
	    // Annotation pour permettre les requêtes cross-origin à partir des hôtes spécifiés.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/siminfo")
	    
	    // Déclaration de la méthode
	    public ResponseEntity<List<Sim_info>> SimulationInfo() {
	    	
	        // Requête SQL pour sélectionner toutes les informations de la table 'Simulation'.
	    	String qry = "SELECT * FROM Simulation ;";
	    	
	        // Exécute la requête et stocke les résultats dans une liste d'objets 'Sim_info'.
	    	List <Sim_info> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Sim_info.class));
	    	
	        // Renvoie la liste des informations de simulation avec un statut HTTP OK.
	    	return new ResponseEntity<>(TasksInformations,HttpStatus.OK);
	    	
	    }  
	    
	    
	    /////////////////////////////////////// DEVIS STATS API /////////////////////////////////////////////////////
	    /*Cette méthode est utilisée pour obtenir des informations statistiques à partir de la table devisrequests dans la base de données.*/
		
	    // Annotation pour permettre les requêtes cross-origin à partir des hôtes spécifiés.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    
	    // Annotation pour mapper les requêtes HTTP POST à cette méthode.
	    @PostMapping(value="/devisstats")
	    public ResponseEntity<List<Devis_info>> DevisStats() {
	    	
	        // Requête SQL pour sélectionner toutes les informations de la table 'devisrequests'.
	    	String qry = "SELECT * FROM `devisrequests` ;";
	    	
	        // Exécute la requête et stocke les résultats dans une liste d'objets 'Devis_info'.
	    	List <Devis_info> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Devis_info.class));
	    	
	        // Renvoie la liste des informations statistiques avec un statut HTTP OK.
	    	return new ResponseEntity<>(TasksInformations,HttpStatus.OK);
	    	
	    }  
	    
	    
	    
	    
	    
	    /////////////////////////////////////// DEVIS HISTORY API /////////////////////////////////////////////////////
	    /*Cette méthode est utilisée pour obtenir des informations historiques à partir des tables devishistory, clientinfo et vehicles dans la base de données. */
	    
	    // Annotation pour permettre les requêtes cross-origin à partir des hôtes spécifiés.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    
	    // Annotation pour mapper les requêtes HTTP POST à cette méthode.
	    @PostMapping(value="/devishist")
	    public ResponseEntity<List<Devis_info>> DevisHistory() {
	    	
	    	// Requête SQL pour sélectionner toutes les informations de la table 'devishistory', 'clientinfo' et 'vehicles'
	        // où 'vehicles.immat' est égal à 'devishistory.immat' et 'clientinfo.cin' est égal à 'devishistory.cin'.
	    	String qry = "SELECT * FROM `devishistory`, clientinfo,vehicles WHERE vehicles.immat = devishistory.immat AND clientinfo.cin = devishistory.cin;";
	    	
	        // Exécute la requête et stocke les résultats dans une liste d'objets 'Devis_info'.
	    	List <Devis_info> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Devis_info.class));
	    	
	        // Renvoie la liste des informations historiques avec un statut HTTP OK.
	    	return new ResponseEntity<>(TasksInformations,HttpStatus.OK);
	    	
	    }  
	    
	    
	    
	    
	    /////////////////////////////////////// DEVIS HISTORY API /////////////////////////////////////////////////////
	    /*Cette méthode est utilisée pour obtenir des informations historiques à partir des tables devishistory, clientinfo et vehicles dans la base de données. */
		  
	    // Annotation pour permettre les requêtes cross-origin à partir des hôtes spécifiés.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    
	    // Annotation pour mapper les requêtes HTTP POST à cette méthode.
	    @PostMapping(value="/cldevishist")
	    public ResponseEntity<List<Devis_info>> DevisClHistory(@RequestBody Devis_info user) {
	    	
	    	
	        // Requête SQL pour sélectionner toutes les informations de la table 'devishistory', 'clientinfo' et 'vehicles'
	        // où 'vehicles.immat' est égal à 'devishistory.immat' et 'clientinfo.cin' est égal à 'devishistory.cin'.
	    	String qry = "SELECT * FROM `devishistory`, clientinfo,vehicles WHERE vehicles.immat = devishistory.immat AND clientinfo.cin = devishistory.cin AND dv_usern ='"+user.getDv_usern()+"';";
	    	
	        // Exécute la requête et stocke les résultats dans une liste d'objets 'Devis_info'.
	    	List <Devis_info> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Devis_info.class));
	    	
	        // Renvoie la liste des informations historiques avec un statut HTTP OK.
	    	return new ResponseEntity<>(TasksInformations,HttpStatus.OK);
	    	
	    }  
	    
	
	    /////////////////////////////////////// DEADLINE HISTORY API /////////////////////////////////////////////////////
	    /*Cette méthode est utilisée pour récupérer des informations historiques à partir de la table deadlinerequestshistory dans la base de données.*/
		  
	    // Annotation pour permettre les requêtes cross-origin à partir des hôtes spécifiés.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    // Annotation pour mapper les requêtes HTTP POST à cette méthode.
	    @PostMapping(value="/dlhist")
	    public ResponseEntity<List<Deadline_info>> DLHistory() {
	    	
	        // Requête SQL pour sélectionner toutes les informations de la table 'deadlinerequestshistory'
	    	String qry = "SELECT * FROM `deadlinerequestshistory` ;";
	    	
	        // Exécute la requête et stocke les résultats dans une liste d'objets 'Deadline_info'.
	    	List <Deadline_info> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Deadline_info.class));
	    	
	        // Renvoie la liste des informations historiques avec un statut HTTP OK.
	    	return new ResponseEntity<>(TasksInformations,HttpStatus.OK);
	    	
	    }  
	    
	
	    
	    
	    
	  /////////////////////////////////////// SUBS PRINT API /////////////////////////////////////////////////////
	 // Cette méthode est une API qui renvoie une liste de toutes les informations d'abonnement associées aux clients.
	 // Elle utilise une annotation CrossOrigin pour permettre les requêtes à partir de certaines origines (dans ce cas, localhost sur le port 8000 et 127.0.0.1 sur le port 8000).
	 // La méthode utilise une requête SQL pour récupérer les informations d'abonnement des clients à partir de trois tables différentes : subscriptions, clientinfo et devishistory. 
	 // Ces informations sont ensuite renvoyées dans une liste de Subscription_info et retournées comme une réponse HTTP avec un statut de 200 (OK).
		  
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/subshow")
	    public ResponseEntity<List<Subscription_info>> SubPrinter() {
	    	
	        // La requête SQL pour récupérer les informations d'abonnement
	    	String qry = "SELECT * FROM `subscriptions`,`clientinfo`,devishistory WHERE clientinfo.cin = devishistory.cin AND cl_usern= sub_usern ORDER BY effect_date;";
	    	
	        // Exécuter la requête SQL et récupérer les informations dans une liste de Subscription_info
	    	List <Subscription_info> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Subscription_info.class));
	    	
	        // Retourner les informations récupérées comme une réponse HTTP avec un statut de 200 (OK)
	    	return new ResponseEntity<>(TasksInformations,HttpStatus.OK);
	    	
	    }
	    
	    
	    /////////////////////////////////////// SUBS STATS API /////////////////////////////////////////////////////
	    /*Cette méthode est utilisée pour récupérer les informations de souscription à partir de plusieurs tables (subscriptions, clientinfo et devishistory) dans la base de données.*/
		  
	    // Annotation pour permettre les requêtes cross-origin à partir des hôtes spécifiés.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    
	    // Annotation pour mapper les requêtes HTTP POST à cette méthode.
	    @PostMapping(value="/substats")
	    public ResponseEntity<List<Subscription_info>> SubStats() {
	    	
	        // Requête SQL pour sélectionner toutes les informations de souscription à partir des tables 'subscriptions', 'clientinfo' et 'devishistory',
	        // en les triant par la date d'effet.
	    	String qry = "SELECT * FROM `subscriptions` ORDER BY effect_date ;";
	    	
	        // Exécute la requête et stocke les résultats dans une liste d'objets 'Subscription_info'.
	    	List <Subscription_info> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Subscription_info.class));
	    	
	        // Renvoie la liste des informations de souscription avec un statut HTTP OK.
	    	return new ResponseEntity<>(TasksInformations,HttpStatus.OK);
	    	
	    }
	    
	    
	    
	    /////////////////////////////////////// SUBS STATS API /////////////////////////////////////////////////////
	    /*Cette méthode est utilisée pour récupérer les informations de souscription pour un utilisateur spécifique à partir de la table subscriptions dans la base de données.*/
	
	    // Annotation pour permettre les requêtes cross-origin à partir des hôtes spécifiés.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    
	    // Annotation pour mapper les requêtes HTTP POST à cette méthode.
	    @PostMapping(value="/clsubstats")
	    public ResponseEntity<List<Subscription_info>> ClSubStats(@RequestBody Subscription_info Sub) {
	    	
	    	
	    	// Requête SQL pour sélectionner toutes les informations de souscription à partir de la table 'subscriptions'
	        // pour un utilisateur spécifique, et les trier par la date d'effet
	    	String qry = "SELECT * FROM `subscriptions` WHERE sub_usern='"+Sub.getSub_usern()+"' ORDER BY effect_date ;";
	    	
	        // Exécute la requête et stocke les résultats dans une liste d'objets 'Subscription_info'.
	    	List <Subscription_info> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Subscription_info.class));
	    	
	        // Renvoie la liste des informations de souscription avec un statut HTTP OK.
	    	return new ResponseEntity<>(TasksInformations,HttpStatus.OK);
	    	
	    }
	    
	    
	    
	    
	    
	    /////////////////////////////////////// SUBS STATS API /////////////////////////////////////////////////////
	    /*Cette méthode est utilisée pour récupérer les informations historiques sur les demandes de délais à partir de la table deadlinerequestshistory dans la base de données, triées par la date de début.*/
		
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/dlstats")
	    public ResponseEntity<List<Deadline_info>> dlStats() {
	    	
	        // Requête SQL pour sélectionner toutes les informations de la table 'deadlinerequestshistory',
	        // triées par la date de début.
	    	String qry = "SELECT * FROM `deadlinerequestshistory` ORDER BY start_date ;";
	    	
	        // Exécute la requête et stocke les résultats dans une liste d'objets 'Deadline_info'.
	    	List <Deadline_info> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Deadline_info.class));
	    	
	        // Renvoie la liste des informations avec un statut HTTP OK.
	    	return new ResponseEntity<>(TasksInformations,HttpStatus.OK);
	    	
	    }
	    
	    

	    
	    
	    /////////////////////////////////////// SUBS STATS API /////////////////////////////////////////////////////
	    /*Cette méthode est utilisée pour récupérer les informations historiques sur les demandes de délais pour un utilisateur spécifique à partir de la table deadlinerequestshistory dans la base de données, triées par la date de début.*/
	    
	    
	    // Annotation pour permettre les requêtes cross-origin à partir des hôtes spécifiés.
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    
	    // Annotation pour mapper les requêtes HTTP POST à cette méthode.
	    @PostMapping(value="/cldlstats")
	    public ResponseEntity<List<Deadline_info>> ClDlStats(@RequestBody Deadline_info User) {
	    	
	    	// Requête SQL pour sélectionner toutes les informations de la table 'deadlinerequestshistory' 
	        // pour un utilisateur spécifique, triées par la date de début.
	    	String qry = "SELECT * FROM `deadlinerequestshistory` WHERE dl_usern='"+User.getDl_usern()+"' ORDER BY start_date ;";
	    	
	        // Exécute la requête et stocke les résultats dans une liste d'objets 'Deadline_info'.
	    	List <Deadline_info> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Deadline_info.class));
	    	
	        // Renvoie la liste des informations avec un statut HTTP OK.
	    	return new ResponseEntity<>(TasksInformations,HttpStatus.OK);
	    	
	    }
	    
	    
	    
	    
	    /////////////////////////////////////// DEVIS SIM CANCEL API /////////////////////////////////////////////////////
	    /*Cette méthode est utilisée pour mettre à jour le nombre de devis annulés dans la table Simulation de la base de données.*/
		  
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/dvcancel")
	    public void DevisCancel() {
	    	
	        // Requête SQL pour incrémenter la valeur de 'devis_cancel' dans la table 'Simulation'.
	    	jdbcTemplate.execute("UPDATE Simulation SET devis_cancel = devis_cancel + 1");
	    
	    }
	    
	     

	    /////////////////////////////////////// SUB SIM CANCEL API /////////////////////////////////////////////////////
	    /*Cette méthode est utilisée pour augmenter le nombre de souscriptions annulées dans la table Simulation de la base de données.*/
		
	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/subcancel")
	    public void SubCancel() {
	    
	        // Requête SQL pour incrémenter la valeur de 'sub_cancel' dans la table 'Simulation'.
	    	jdbcTemplate.execute("UPDATE Simulation SET sub_cancel = sub_cancel + 1");
	    
	    }
	    
	     

	     
      
	    
	   
	    /////////////////////////////////////// AUTHENTICATION / ACCOUNT MANAGEMENT ////////////////////////////////////////////////
	    
	//////////////////////// ADD USER ///////////////////////////
	/*Cette méthode est utilisée pour ajouter un nouvel utilisateur à la base de données. */
	    
	@CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
    @PostMapping(value="/adduser")
	void insertAttribute(@RequestBody users_info insertUser ) {
		
	
	    // Définition de la requête SQL pour insérer un nouvel utilisateur.
		String qry = "insert into user (firstname,lastname,username,password,email,role) values (?,?,?,?,?,?) " ;
		
	    // Exécution de la requête SQL.
		int testInsert = jdbcTemplate.update(qry,insertUser.getFirstname(),insertUser.getLastname(),insertUser.getUsername(),insertUser.getPassword(), insertUser.getEmail(),insertUser.getRole()) ;
		
	    // Vérification si l'utilisateur a été ajouté avec succès.
	if(testInsert>0) {
		System.out.println("User Added Successfully");
	} 	
}
	
	
	
	
	
	
	
	/////////////////// USER DELETE ////////////////////////////	
	@CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
    @PostMapping(value="/deleteuser")
    public ResponseEntity<String>DeleteUser(@RequestBody users_info [] Delete ){
		
	    // Impression dans la console pour le suivi.
		System.out.println("Delete User Activated...");
		
	    // Définition de la requête SQL pour supprimer un utilisateur.
    	String query = "DELETE FROM user WHERE username = ?";
        int numDeleted = 0;
        
        // Pour chaque utilisateur dans le tableau reçu, on exécute la requête de suppression.
        for (int i = 0; i < Delete.length; i++) {
            int result = jdbcTemplate.update(query, Delete[i].getUsername());
            if (result > 0) {
                numDeleted++;
            }
        }
        
        // Si au moins un utilisateur a été supprimé, on imprime un message dans la console.
        if (numDeleted > 0) {
            System.out.println("Users DELETED!");
        }
    	
        // On retourne une réponse HTTP avec un message indiquant que les utilisateurs ont été supprimés.
    	return new ResponseEntity<>("Users Deleted",HttpStatus.OK);
    	
    }
	
	
	
	

	/////////////// DISPLAY USERS LIST ///////////////////////////
	/*Cette méthode est utilisée pour récupérer une liste de tous les utilisateurs de la base de données.*/
	@CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
    @PostMapping(value="/showUsers")	
    public ResponseEntity<List<users_info>> GetUsersList(){
    	
	    // Définition de la requête SQL pour récupérer tous les utilisateurs.
    	String qry="SELECT * FROM `user`";
    	
        // Exécution de la requête et récupération des résultats dans une liste d'objets 'users_info'.
    	List <users_info> Data = jdbcTemplate.query(qry, new BeanPropertyRowMapper(users_info.class));
    	
        // Retour de la liste d'utilisateurs en tant que réponse HTTP.
    	return new ResponseEntity<>(Data ,HttpStatus.OK);
    }	

 
    
	
    ///////////////////////// USER AUTHENTICATION ////////////////////////////
    /*Cette méthode est responsable de l'authentification d'un utilisateur.*/
	
	@CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
    @PostMapping(value="/usersauth")
    public ResponseEntity<List<users_info>> UsersAuth(@RequestBody users_info UserData) {
    	
	    // Vérifie si le nom d'utilisateur et le mot de passe fournis sont alphanumériques.
    	if (UserData.getUsername().matches("[a-zA-Z0-9]+") || UserData.getPassword().matches("[a-zA-Z0-9]+")) {
    		
            // Extrait le nom d'utilisateur et le mot de passe du corps de la requête.
    		String username = UserData.getUsername();
        	String password = UserData.getPassword();
    
        	
        	String qry = "";
        	
            // Assure que le nom d'utilisateur et le mot de passe ne sont pas nuls.
        	if (username!=null && password!=null) {
        		
                // Si ce n'est pas le cas, définit une requête SQL pour récupérer l'utilisateur correspondant au nom d'utilisateur et au mot de passe (ou email et mot de passe).
        		qry= "SELECT user.username,user.password,user.firstname,user.lastname,user.email,user.role FROM user WHERE (username='"+username+"' AND password='"+password+"') OR (email='"+username+"' AND password='"+password+"') ";
        	}
        	else { return null;}
        	
            // Exécute la requête et stocke les résultats dans une liste d'objets 'users_info'.
        	List <users_info> auth = jdbcTemplate.query(qry,new BeanPropertyRowMapper(users_info.class));
        	System.out.println(auth);
        	
            // Retourne la liste des utilisateurs (qui devrait seulement contenir un utilisateur si l'authentification a réussi) en tant que réponse HTTP.
    		return new ResponseEntity<>(auth,HttpStatus.OK); 
    		
    	}
    	else {
    		return null;
    	}
    }
    
    
    
    
    ////////////////////////// USER UPDATE ///////////////////////////////////
    /*mettre à jour les informations d'un utilisateur dans votre base de données.*/
	
	@CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
    @PostMapping(value="/updateuser")
    public ResponseEntity<String> UpdateUser(@RequestBody users_info NewValues) {
    	
    	System.out.println("Update user is running");
    	String qry="UPDATE `user` SET `password`=?,`email`=? WHERE username=? ";
    	
    	
        // Si le mot de passe est vide ou null
    	if ( NewValues.getPassword()==null || NewValues.getPassword()=="" || NewValues.getPassword().isBlank()) {
    		qry="UPDATE `user` SET `email`=? WHERE username=? ";
    		int UpdateUserAccount = jdbcTemplate.update(qry,  NewValues.getEmail(), NewValues.getUsername() );
    		   if (UpdateUserAccount > 0) {System.out.println("User has been updated.");
    		   }
    	}
    	
        // Si le mot de passe n'est pas vide
    	else {
    		
 
           qry="UPDATE `user` SET `password`=?,`email`=? WHERE username=? ";
        
           int UpdateUserAccount = jdbcTemplate.update(qry,   NewValues.getPassword() , NewValues.getEmail(), NewValues.getUsername() );
    	   if (UpdateUserAccount > 0) {System.out.println("User has been updated.");}
    		
    	}
    	
    	return new ResponseEntity<>("User Updated",HttpStatus.OK); 
    }
    
    
    
    
    
    
    
    
    
    
    ////////////////////////// DEVIS Maker ///////////////////////////////////
	/* 
	 Cette méthode crée un devis basé sur les informations de l'utilisateur et du pack d'assurance.
	 Un devis est un document qui donne une estimation des coûts d'un service. Dans ce cas, le service est une assurance.
	 Le devis est créé en remplissant un modèle de document avec des informations spécifiques à l'utilisateur et au pack d'assurance.*/
	
	  public void DevisMaker(String name, String lastn, String email, String cin, String pack, String mobile, String money, String usage, int horse, int seat, String circ_date, String price_venal, String user) {
	    
		    // Création d'une map pour stocker les informations qui seront insérées dans le devis
	    	Map<String, String> var = new HashMap<String, String>();
	    	
	        // Définition des valeurs par défaut pour les garanties
	    	String m1= "----",m2= "----",m3= "----",m4= "----",m5= "----",m6 = "----",m7 = "----";
	    	
	    	String qry1 = "SELECT  packguaranties.guaranty_id,packguaranties.pack_id,pack_name FROM `devisrequests`, pack, packguaranties,guaranties WHERE dv_usern = '"+user+"' AND devisrequests.pack = pack.pack_id AND packguaranties.pack_id = pack.pack_id;";
	    	
	        // Exécution de la requête et stockage des résultats dans une liste
	    	List <Pack_info> Packs = jdbcTemplate.query(qry1,new BeanPropertyRowMapper(Pack_info.class));
	    	
	        // Parcourir la liste des packs et définir les montants des garanties en fonction de l'ID de la garantie
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
	    		
	    	
	        // Obtention de la date actuelle	
	        SimpleDateFormat formatter = new SimpleDateFormat("dd/MM/yyyy");  
	        Date date = new Date();  
	        
	        // Exécution d'une autre requête SQL pour obtenir l'ID du devis
	    	String qry = "SELECT  devis_id FROM `devisrequests` WHERE dv_usern = '"+user+"';";
	    	
	        // Exécution de la requête et stockage du résultat dans une liste
	    	List <Devis_info> Devis = jdbcTemplate.query(qry,new BeanPropertyRowMapper(Devis_info.class));
	    	
	        // Remplissage de la map avec les informations à insérer dans le devis
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
	    	
	    	
	    	// Le code suivant charge un modèle de document, remplit les informations du devis, puis sauvegarde le document au format .docx et .pdf.
			try {
			
			    /* 
			     * Ouverture du fichier modèle (template) de Word. 
			     * Ce modèle contient la structure de base du devis, avec des espaces réservés pour les informations spécifiques au client.
			     */
			
				InputStream templateInputStream = new FileInputStream("C:\\Users\\benab\\Documents\\workspace-spring-tool-suite-4-4.17.2.RELEASE\\InsuranceBackEnd\\InsuranceBackEnd\\PROJET\\src\\main\\resources\\DevisFiles\\temp2.docx");
				
			    // Chargement du modèle de Word dans un objet WordprocessingMLPackage, qui permet de manipuler le document Word.
				WordprocessingMLPackage template = WordprocessingMLPackage.load(templateInputStream);
			
			    // Remplacement des espaces réservés dans le modèle par les informations spécifiques au client.
				Docx4JSRUtil.searchAndReplace(template, var );
		
			    // Préparation à l'enregistrement du document Word.
				MainDocumentPart documentPart = template.getMainDocumentPart();
				
			    // Définition des emplacements où seront enregistrés les fichiers de devis (un en format Word et l'autre en format PDF).
				FileOutputStream docxOs = new FileOutputStream("C:\\Users\\benab\\Documents\\workspace-spring-tool-suite-4-4.17.2.RELEASE\\InsuranceBackEnd\\InsuranceBackEnd\\PROJET\\src\\main\\resources\\DevisFiles\\Devis"+user+".docx");
				FileOutputStream OUT = new FileOutputStream("C:\\Users\\benab\\Documents\\workspace-spring-tool-suite-4-4.17.2.RELEASE\\InsuranceBackEnd\\InsuranceBackEnd\\PROJET\\src\\main\\resources\\DevisFiles\\Devis-"+user+".pdf");
				
			    // Enregistrement du document Word.
				Docx4J.save(template, docxOs);

			    // Ouverture du document Word enregistré pour le convertir en PDF.
			    XWPFDocument doc = new XWPFDocument(new FileInputStream("C:\\Users\\benab\\Documents\\workspace-spring-tool-suite-4-4.17.2.RELEASE\\InsuranceBackEnd\\InsuranceBackEnd\\PROJET\\src\\main\\resources\\DevisFiles\\Devis"+user+".docx"));
			    
			    // Préparation à la conversion du document Word en PDF.
				PdfOptions PDFOpt = PdfOptions.create();
				
			    // Conversion du document Word en PDF.
			    PdfConverter.getInstance().convert(doc, OUT, PDFOpt);

			    // Nettoyage et fermeture des flux de sortie.
				docxOs.flush();
			    docxOs.close();
			    OUT.flush();
			    OUT.close();
			    
			    
			    // Fermeture du document Word.
			    doc.close();
			    
			    
			 // Gestion des exceptions qui peuvent survenir lors de l'ouverture, la manipulation et l'enregistrement des fichiers.
			} catch (FileNotFoundException e) {
			
				e.printStackTrace();
			} catch (Docx4JException e) {
			
				e.printStackTrace();
			} catch (IOException e) {
			
				e.printStackTrace();
			};

			
		}
		
		
    
    
    
	// Autorise les requêtes provenant de "http://127.0.0.1:8000" et "http://localhost:8000"
    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
    
    // Indique que cette méthode est utilisée pour traiter les requêtes POST à l'URL "/word" 
    @PostMapping(value="/word")
    public void Word(@RequestBody Devis_info Devis) {
    	System.out.println("Devis update data : "+Devis);
    	
        // Appelle la méthode pour créer un devis basé sur les informations de Devis_info
    	DevisMaker(Devis.getClient_firstname(), Devis.getClient_lastname(),  Devis.getEmail(), Devis.getCin(), Devis.getPack_name(), Devis.getPhone(), Devis.getMoney(), Devis.getUsage_type(), Devis.getHorse(), Devis.getSeat(), Devis.getCirc_date(), Devis.getPrice_venal(), Devis.getDv_usern());
	
        // Crée un objet File pour représenter le fichier PDF du devis
		File f = new File("C:\\Users\\benab\\Documents\\workspace-spring-tool-suite-4-4.17.2.RELEASE\\InsuranceBackEnd\\InsuranceBackEnd\\PROJET\\src\\main\\resources\\DevisFiles\\Devis-"+Devis.getDv_usern()+".pdf");
		
		byte[] buffer = new byte[10240]; // Crée un tampon pour lire le fichier
		ByteArrayOutputStream OS = new ByteArrayOutputStream(); // Utilisé pour recueillir les données du fichier
		
	    // Lit le fichier dans le ByteArrayOutputStream
		FileInputStream Fin;
		try {
			Fin = new FileInputStream(f);
			int read;
			while ((read = Fin.read(buffer)) != -1) {
				OS.write(buffer, 0, read);
			}
			
			Fin.close(); // Ferme le flux d'entrée du fichier
			OS.close();  // Ferme le flux de sortie du ByteArrayOutputStream
			
		} catch (FileNotFoundException e) {
			
	        // Gère l'exception si le fichier n'est pas trouvé
			e.printStackTrace();
		} catch (IOException e) {
			
	        // Gère l'exception s'il y a une erreur d'entrée/sortie lors de la lecture du fichier
			e.printStackTrace();
		}
		
	    // Convertit le ByteArrayOutputStream en une chaîne Base64
		String docPDF = Base64.getEncoder().encodeToString(OS.toByteArray());
		
	    // Mise à jour des informations du client dans la base de données
		String qry1="UPDATE IGNORE `clientinfo` SET `cin`=?, `client_firstname`=?,`client_lastname`=?,`email`=?,`phone`=?,`job`=?,`birth_date`=?,`gender`=? WHERE cl_usern=? ";
		int UpdateUClientInfo = jdbcTemplate.update(qry1, Devis.getCin(),Devis.getClient_firstname(),Devis.getClient_lastname(),Devis.getEmail(),Devis.getPhone(),Devis.getJob(),Devis.getBirth_date(),Devis.getGender(), Devis.getDv_usern());
			
	    	// Affiche un message si l'information du client a été modifiée
			if (UpdateUClientInfo > 0) {System.out.println("Client info has been changed.");}
		
			
			// Récupère les informations de la plaque d'immatriculation du véhicule à partir de la table DevisRequests pour l'utilisateur spécifié
	    	String carCheck= "SELECT immat FROM DevisRequests WHERE dv_usern='"+Devis.getDv_usern()+"'";
	    	
	    	// Exécute la requête et stocke les résultats dans une liste d'objets Devis_info
	    	List <Devis_info> VehGet = jdbcTemplate.query(carCheck, new BeanPropertyRowMapper(Devis_info.class));
		
	    	// Met à jour les informations du véhicule dans la base de données
			String qry="UPDATE `vehicles` SET `immat`=?,`immat_type`=?,`usage_type`=?,`serie`=?,`km`=?, `marque`=?,`model`=?,`seat`=?,`horse`=?, `price_new`=?,`price_venal`=? WHERE vh_usern=? and immat=? ";
			int UpdateVeh = jdbcTemplate.update(qry, Devis.getImmat(),Devis.getImmat_type(),Devis.getUsage_type(),Devis.getSerie(),Devis.getKm(),Devis.getMarque(),Devis.getModel(),Devis.getSeat(),Devis.getHorse(),Devis.getPrice_new(),Devis.getPrice_venal(), Devis.getDv_usern(), VehGet.get(0).getImmat());
			
			// Affiche un message si les informations du véhicule ont été mises à jour
			   if (UpdateVeh > 0) {System.out.println("Vehicle has been Updated.");}
			   
			// Met à jour les informations de la demande de devis dans la base de données
			String qry2="UPDATE `devisrequests` SET `devis_doc`=?, `pack`=?,`money`=? WHERE dv_usern=? and devis_id=? ";
		int UpdateUserAccount = jdbcTemplate.update(qry2, docPDF,Devis.getPack(),Devis.getMoney(), Devis.getDv_usern(), Devis.getDevis_id() );
		
		   // Affiche un message si la demande de devis a été modifiée
		   if (UpdateUserAccount > 0) {System.out.println("Devis has been changed.");}

		// Met à jour l'historique de la demande de devis dans la base de données
			String qry3="UPDATE `devishistory` SET `devis_doc`=?, `pack`=?,`money`=?, `immat`=?, `cin`=? WHERE dv_usern=? and devis_id=? ";
		int UpdateHistAccount = jdbcTemplate.update(qry3, docPDF,Devis.getPack(),Devis.getMoney(), Devis.getImmat(), Devis.getCin(), Devis.getDv_usern(), Devis.getDevis_id() );
		
		// Affiche un message si l'historique de la demande de devis a été modifié
		   if (UpdateHistAccount > 0) {System.out.println("Devis History has been changed.");}


		}
    
    
    
			

 	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/testreq")
	    public void TestReq() throws ParseException {
	    	
	    //so ? kahawa 
	    	
	    	// Imprime un message pour indiquer que la requête de délai a commencé.
	    	System.out.println("Test Request Started");
	    	
	    	// Crée des instances de différents services nécessaires pour le processus de gestion de la requête de délai.	
	    	RepositoryService repositoryService = processEngine.getRepositoryService();
	    	historyService = processEngine.getHistoryService();
	    	runtimeService = processEngine.getRuntimeService();
	    	
	    	// Déploie le fichier de processus 'DeadlineProcess.bpmn20.xml' et crée une définition de processus à partir de ce déploiement.	
	    	Deployment deployment = repositoryService.createDeployment()
	    	    	  .addClasspathResource("processes/Testprocess.bpmn20.xml")
	    	    	  .deploy();
	    	    	ProcessDefinition processDefinition = repositoryService.createProcessDefinitionQuery()
	    	    			  .deploymentId(deployment.getId())
	    	    			  .singleResult();
	    	    	
	    	    	
	    	// Crée un Map pour stocker les variables de processus.
	    	Map<String, Object> variables = new HashMap<String, Object>();
	    	
	    	variables.put("user", "test");
	    	
	    	
	 
	    	
	    // Cette section de code stocke les informations relatives à la requête de délai (Deadline request) provenant de l'objet DLinfo dans le Map de variables.	    	
	   //  variables.put("user", info.getUsername());
	      
	    			runtimeService.startProcessInstanceByKey("TestReq", variables);
	    			
	    			
	    			runtimeService = processEngine.getRuntimeService();
	    			Map<String, Object> variable = new HashMap<String, Object>();
	    			
	    		    // Une requête SQL est définie pour récupérer l'ID de la tâche en fonction du reçu associé.
	    			String qry="SELECT act_ru_task.ID_ FROM act_ru_task, act_ru_variable, deadlinerequests WHERE act_ru_task.PROC_INST_ID_ = act_ru_variable.PROC_INST_ID_ AND act_ru_variable.NAME_='user' AND act_ru_variable.TEXT_ in ('test');";
	    			
	    		    // Raison est une variable qui conserve les raisons pour lesquelles la tâche de l'agent peut être rejetée.
	    			String reason ="YES";
	    			
	    		
	    		
	    		    // Récupère l'ID de la tâche associée au reçu spécifié.
	    			List <TasksDef> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(TasksDef.class));

	    		    // Complète la tâche dans le moteur de processus.
	    			taskService = processEngine.getTaskService();

	    			variable.put("approved", reason);
	    			taskService.complete(TasksInformations.get(0).getID_(), variable);
	    			


	    	
	    			
	    	
	    }
	     
  
 


 	    

 	    @CrossOrigin(origins = {"http://127.0.0.1:8000","http://localhost:8000"})
	    @PostMapping(value="/test2")
	    public void Test2() throws ParseException {
	    	
	    	
	    	// Imprime un message pour indiquer que la requête de délai a commencé.
	    	System.out.println("Test2 Started");
	    	
	    	// Crée des instances de différents services nécessaires pour le processus de gestion de la requête de délai.	
	    	RepositoryService repositoryService = processEngine.getRepositoryService();
	    	historyService = processEngine.getHistoryService();
	    	runtimeService = processEngine.getRuntimeService();
	    	
	    	// Déploie le fichier de processus 'DeadlineProcess.bpmn20.xml' et crée une définition de processus à partir de ce déploiement.	
	    	Deployment deployment = repositoryService.createDeployment()
	    	    	  .addClasspathResource("processes/Test2process.bpmn20.xml")
	    	    	  .deploy();
	    	    	ProcessDefinition processDefinition = repositoryService.createProcessDefinitionQuery()
	    	    			  .deploymentId(deployment.getId())
	    	    			  .singleResult();
	    	    	
	    	    	
	    	// Crée un Map pour stocker les variables de processus.
	    	Map<String, Object> variables = new HashMap<String, Object>();
	    	
	    	variables.put("user", "test");
	    	
	    	
	 
	    	
	    // Cette section de code stocke les informations relatives à la requête de délai (Deadline request) provenant de l'objet DLinfo dans le Map de variables.	    	
	   //  variables.put("user", info.getUsername());
	      
	    			runtimeService.startProcessInstanceByKey("Test2", variables);
	    			
	    			
	    			runtimeService = processEngine.getRuntimeService();
	    			Map<String, Object> variable = new HashMap<String, Object>();
	    			
	    		    // Une requête SQL est définie pour récupérer l'ID de la tâche en fonction du reçu associé.
	    			String qry="SELECT act_ru_task.ID_ FROM act_ru_task, act_ru_variable, deadlinerequests WHERE act_ru_task.PROC_INST_ID_ = act_ru_variable.PROC_INST_ID_ AND act_ru_variable.NAME_='user' AND act_ru_variable.TEXT_ in ('test');";
	    			
	    		    // Raison est une variable qui conserve les raisons pour lesquelles la tâche de l'agent peut être rejetée.
	    			String reason ="YES";
	    			
	    		
	    		
	    		    // Récupère l'ID de la tâche associée au reçu spécifié.
	    			List <TasksDef> TasksInformations = jdbcTemplate.query(qry,new BeanPropertyRowMapper(TasksDef.class));

	    		    // Complète la tâche dans le moteur de processus.
	    			taskService = processEngine.getTaskService();

	    			variable.put("approved", reason);
	    			taskService.complete(TasksInformations.get(0).getID_(), variable);
	    			


	    	
	    			
	    	
	    }
	     
 	    
 	    
 	    
 	    
 	    
 	    


    
}