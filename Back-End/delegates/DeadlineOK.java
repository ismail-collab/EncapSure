package com.insurance.delegates;

import org.flowable.engine.delegate.DelegateExecution; 
import org.flowable.engine.delegate.JavaDelegate;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.stereotype.Service;

//Service Task 
@Service("DLOK")
public class DeadlineOK implements JavaDelegate {
	
	// Outil Spring pour interagir avec une base de données
	public static JdbcTemplate jdbcTemplate;
	
	// La méthode setjdbcTempl utilise l'injection de dépendances pour attribuer une instance de JdbcTemplate à notre variable jdbcTemplate
	@Autowired
	public void setjdbcTempl(JdbcTemplate jdbcTemplate) {
		this.jdbcTemplate=jdbcTemplate;
		
	}

	@Override
	public void execute(DelegateExecution execution) {
		
   		// On définit une requête SQL pour mettre à jour l'état d'une entrée spécifique dans la table `deadlinerequestshistory`
		String qry="UPDATE `deadlinerequestshistory` SET `state`=?  WHERE dl_usern=? AND contract_num=? ";
		
	
		// Les arguments "Completed", "username" et "contract_num" sont insérés dans la requête.	
		int UpdateUserAccount = jdbcTemplate.update(qry, "Completed", (String) execution.getVariable("username"), (String) execution.getVariable("contract_num")  );
		
		// On vérifie si la mise à jour a été effectuée avec succès. Si c'est le cas, un message est affiché dans la console.
		   if (UpdateUserAccount > 0) {System.out.println("Deadline History Updated.");
		   }
		   
			// On définit une nouvelle requête SQL pour supprimer une entrée spécifique de la table `DeadlineRequests`
			 String query="DELETE FROM DeadlineRequests WHERE dl_usern=? AND contract_num=?";
		   
			// Exécution de la requête SQL avec jdbcTemplate. Les arguments "username" et "contract_num" sont insérés dans la requête.
		   	 int DLInsert = jdbcTemplate.update(query,(String) execution.getVariable("username"), (String) execution.getVariable("contract_num") );
				// On vérifie si l'opération de suppression a été effectuée avec succès. Si c'est le cas, un message est affiché dans la console.
		   		if(DLInsert>0) {
		   			System.out.println("Deadline Process Success");
		   			}
	}

}
