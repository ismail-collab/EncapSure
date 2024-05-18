package com.insurance.models;

public class Deadline_info {
	
	private String product;
	private Integer contract_num;
	private Integer receipt;
	private String dl_usern;
	private int cin;
	private String client_firstname;
	private String client_lastname;
	private String client_email;
	private String start_date;
	private String end_date;
	private String delivery_adress;
	private String state;
	private String reason;
	private double total_amount;
	private double left_amount;
    private String vignette;
    private String tech_visit;
	
	
	
    
  
    
    
    
	public Deadline_info() {
		super();
	}


	

	public Deadline_info(String product, Integer contract_num, Integer receipt, String dl_usern, int cin,
			String client_firstname, String client_lastname, String client_email, String start_date, String end_date,
			String delivery_adress, String state, String reason, double total_amount, double left_amount,
			String vignette, String tech_visit) {
		super();
		this.product = product;
		this.contract_num = contract_num;
		this.receipt = receipt;
		this.dl_usern = dl_usern;
		this.cin = cin;
		this.client_firstname = client_firstname;
		this.client_lastname = client_lastname;
		this.client_email = client_email;
		this.start_date = start_date;
		this.end_date = end_date;
		this.delivery_adress = delivery_adress;
		this.state = state;
		this.reason = reason;
		this.total_amount = total_amount;
		this.left_amount = left_amount;
		this.vignette = vignette;
		this.tech_visit = tech_visit;
	}










	
	


	public int getCin() {
		return cin;
	}




	public void setCin(int cin) {
		this.cin = cin;
	}




	public String getVignette() {
		return vignette;
	}




	public void setVignette(String vignette) {
		this.vignette = vignette;
	}



	public String getTech_visit() {
		return tech_visit;
	}




	public void setTech_visit(String tech_visit) {
		this.tech_visit = tech_visit;
	}






	public String getProduct() {
		return product;
	}



	public void setProduct(String product) {
		this.product = product;
	}



	public Integer getContract_num() {
		return contract_num;
	}



	public String getDelivery_adress() {
		return delivery_adress;
	}



	public String getReason() {
		return reason;
	}



	public void setReason(String reason) {
		this.reason = reason;
	}




	public void setDelivery_adress(String delivery_adress) {
		this.delivery_adress = delivery_adress;
	}




	public void setContract_num(Integer contract_num) {
		this.contract_num = contract_num;
	}



	public Integer getReceipt() {
		return receipt;
	}



	public void setReceipt(Integer receipt) {
		this.receipt = receipt;
	}



	public String getDl_usern() {
		return dl_usern;
	}



	public void setDl_usern(String dl_usern) {
		this.dl_usern = dl_usern;
	}



	public String getClient_firstname() {
		return client_firstname;
	}



	public void setClient_firstname(String client_firstname) {
		this.client_firstname = client_firstname;
	}



	public String getClient_lastname() {
		return client_lastname;
	}



	public void setClient_lastname(String client_lastname) {
		this.client_lastname = client_lastname;
	}



	public String getClient_email() {
		return client_email;
	}



	public void setClient_email(String client_email) {
		this.client_email = client_email;
	}



	public String getStart_date() {
		return start_date;
	}



	public void setStart_date(String start_date) {
		this.start_date = start_date;
	}



	public String getEnd_date() {
		return end_date;
	}



	public void setEnd_date(String end_date) {
		this.end_date = end_date;
	}



	public String getState() {
		return state;
	}



	public void setState(String state) {
		this.state = state;
	}



	public double getTotal_amount() {
		return total_amount;
	}



	public void setTotal_amount(double total_amount) {
		this.total_amount = total_amount;
	}



	public double getLeft_amount() {
		return left_amount;
	}



	public void setLeft_amount(double left_amount) {
		this.left_amount = left_amount;
	}



	

	@Override
	public String toString() {
		return "Deadline_info [product=" + product + ", contract_num=" + contract_num + ", receipt=" + receipt
				+ ", dl_usern=" + dl_usern + ", cin=" + cin + ", client_firstname=" + client_firstname
				+ ", client_lastname=" + client_lastname + ", client_email=" + client_email + ", start_date="
				+ start_date + ", end_date=" + end_date + ", delivery_adress=" + delivery_adress + ", state=" + state
				+ ", reason=" + reason + ", total_amount=" + total_amount + ", left_amount=" + left_amount
				+ ", vignette=" + vignette + ", tech_visit=" + tech_visit + "]";
	}















	



	
	
	
	










	
}
