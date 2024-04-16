package com.pay.controller;

import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

import com.pay.PayInfo;

@RestController
public class REST_CONTROLLER {
	
	
	
	@PostMapping(value="/pay")
	public void PayReq(@RequestBody PayInfo info) {
		
		
		
	}
	
	

}
