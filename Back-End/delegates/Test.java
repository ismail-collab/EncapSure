package com.insurance.delegates;
import org.flowable.engine.delegate.DelegateExecution; 
import org.flowable.engine.delegate.JavaDelegate;
import org.springframework.stereotype.Service;


@Service
public class Test implements JavaDelegate {


	@Override
	public void execute(DelegateExecution execution) {
	
		System.out.println("Hello user ");
		
		
	}
	

}


