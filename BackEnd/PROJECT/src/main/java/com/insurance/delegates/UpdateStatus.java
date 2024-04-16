package com.insurance.delegates;

import org.flowable.engine.delegate.DelegateExecution;
import org.flowable.engine.delegate.JavaDelegate;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.stereotype.Service;

@Service
public class UpdateStatus implements JavaDelegate {
	
	
	public static JdbcTemplate jdbcTemplate;
	
	@Autowired
	public void setjdbcTempl(JdbcTemplate jdbcTemplate) {
		this.jdbcTemplate=jdbcTemplate;
		
	}
	


	@Override
	public void execute(DelegateExecution execution) {
		System.out.println("Reason/State updating...");
		
		
		
		
		String qry="UPDATE `deadlinerequests` SET `reason`=? , `state`=? WHERE dl_usern=? AND contract_num=? ";
		int UpdateUserAccount = jdbcTemplate.update(qry, (String) execution.getVariable("reason"), "Waiting documents submission", (String) execution.getVariable("username"), (String) execution.getVariable("contract_num")  );
		   if (UpdateUserAccount > 0) {System.out.println("Deadline Reason/State have been uploaded.");

		}
	
			   
		String qry4="UPDATE `deadlinerequestshistory` SET `reason`=?, `state`=?  WHERE dl_usern=? AND contract_num=? ";
		int UpdateUserAccount4 = jdbcTemplate.update(qry4, (String) execution.getVariable("reason"), "Waiting documents submission", (String) execution.getVariable("username"), (String) execution.getVariable("contract_num")  );
			if (UpdateUserAccount4 > 0) {System.out.println("Deadlines Reason/State have been updated.");
			   
		}
		
		
		
		
		
		
	}
	
	

}
