package com.insurance.delegates;

import org.flowable.engine.delegate.DelegateExecution;
import org.flowable.engine.delegate.JavaDelegate;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.stereotype.Service;

@Service("UploadFiles")
public class UploadFiles implements JavaDelegate {
	
	public static JdbcTemplate jdbcTemplate;
	
	@Autowired
	public void setjdbcTempl(JdbcTemplate jdbcTemplate) {
		this.jdbcTemplate=jdbcTemplate;
		
	}

	@Override
	public void execute(DelegateExecution execution) {
		System.out.println("Uploading Deadline Files...");
		
		
		String qry="UPDATE `deadlinerequests` SET `vignette`=? , `tech_visit`=?, `left_amount`=? WHERE dl_usern=? AND contract_num=? ";
		int UpdateUserAccount = jdbcTemplate.update(qry, (String) execution.getVariable("vignette"), (String) execution.getVariable("tech_visit"), 0, (String) execution.getVariable("username"), (String) execution.getVariable("contract_num")  );
		   if (UpdateUserAccount > 0) {System.out.println("Deadline Files have been uploaded.");
		   
			String qry2="UPDATE `deadlinerequests` SET `state`=? , `reason`=? WHERE dl_usern=? AND contract_num=? ";
			int UpdateUserAccount2 = jdbcTemplate.update(qry2, "Waiting Document Confirmation", "Waiting Document Confirmation", (String) execution.getVariable("username"), (String) execution.getVariable("contract_num")  );
			   if (UpdateUserAccount2 > 0) {System.out.println("Deadlines State have been updated.");
			   }
		   
		   }
		   
		   
			String qry3="UPDATE `deadlinerequestshistory` SET `vignette`=? , `tech_visit`=?, `left_amount`=? WHERE dl_usern=? AND contract_num=? ";
			int UpdateUserAccount3 = jdbcTemplate.update(qry3, (String) execution.getVariable("vignette"), (String) execution.getVariable("tech_visit"), 0, (String) execution.getVariable("username"), (String) execution.getVariable("contract_num")  );
			   if (UpdateUserAccount3 > 0) {System.out.println("Deadline Files have been uploaded.");
			   
				String qry4="UPDATE `deadlinerequestshistory` SET `state`=? , `reason`=? WHERE dl_usern=? AND contract_num=? ";
				int UpdateUserAccount4 = jdbcTemplate.update(qry4, "Waiting Document Confirmation", "Waiting Document Confirmation", (String) execution.getVariable("username"), (String) execution.getVariable("contract_num")  );
				   if (UpdateUserAccount4 > 0) {System.out.println("Deadlines State have been updated.");
				   }
			   
			   }
			   
			   execution.setVariable("LeftAmount", 0);
		   

		
	}

}
