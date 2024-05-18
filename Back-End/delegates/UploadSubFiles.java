package com.insurance.delegates;

import org.flowable.engine.delegate.DelegateExecution;
import org.flowable.engine.delegate.JavaDelegate;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.stereotype.Service;

@Service("UploadSubFiles")
public class UploadSubFiles implements JavaDelegate {
	
	public static JdbcTemplate jdbcTemplate;
	
	@Autowired
	public void setjdbcTempl(JdbcTemplate jdbcTemplate) {
		this.jdbcTemplate=jdbcTemplate;
		
	}

	@Override
	public void execute(DelegateExecution execution) {
		System.out.println("Uploading SUB Files...");
		
		
		String qry="UPDATE `subscriptions` SET `id_doc`=? WHERE sub_usern=? ";
		int UpdateUserAccount = jdbcTemplate.update(qry, (String) execution.getVariable("id_doc"),  (String) execution.getVariable("sub_usern")  );
		   if (UpdateUserAccount > 0) {System.out.println("Files has been uploaded.");
		   }
		
	}

}