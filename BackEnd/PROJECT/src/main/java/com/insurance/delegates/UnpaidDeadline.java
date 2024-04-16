package com.insurance.delegates;

import org.flowable.engine.delegate.DelegateExecution;
import org.flowable.engine.delegate.JavaDelegate;
import org.springframework.stereotype.Service;

@Service("unpaidDL")
public class UnpaidDeadline implements JavaDelegate {

	@Override
	public void execute(DelegateExecution execution) {
		
		System.out.println("Your deadline is past and you didn't pay the full amount!");
		
	}

	
}
