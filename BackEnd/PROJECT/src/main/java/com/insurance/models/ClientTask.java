package com.insurance.models;


public class ClientTask {
	
	private String Id;
	private String Name;
	private String username;
	private String Adress;
	private String receipt;
	private String contract_num;
	private int left_amount;
	private int paid_amount;
    private String vignette;
    private String tech_visit;
    
    
    
    
	public ClientTask(String id, String name, String username, String Adress, String receipt, String contract_num,
			int left_amount, int paid_amount, String vignette, String tech_visit) {
		super();
		Id = id;
		Name = name;
		this.username = username;
		this.Adress = Adress;
		this.receipt = receipt;
		this.contract_num = contract_num;
		this.left_amount = left_amount;
		this.paid_amount = paid_amount;
		this.vignette = vignette;
		this.tech_visit = tech_visit;
	}




	public String getId() {
		return Id;
	}




	public void setId(String id) {
		Id = id;
	}




	public String getName() {
		return Name;
	}




	public void setName(String name) {
		Name = name;
	}




	public String getUsername() {
		return username;
	}




	public void setUsername(String username) {
		this.username = username;
	}




	public String getAdress() {
		return Adress;
	}




	public void setAdress(String Adress) {
		this.Adress = Adress;
	}




	public String getReceipt() {
		return receipt;
	}




	public void setReceipt(String receipt) {
		this.receipt = receipt;
	}




	public String getContract_num() {
		return contract_num;
	}




	public void setContract_num(String contract_num) {
		this.contract_num = contract_num;
	}




	public int getLeft_amount() {
		return left_amount;
	}




	public void setLeft_amount(int left_amount) {
		this.left_amount = left_amount;
	}




	public int getPaid_amount() {
		return paid_amount;
	}




	public void setPaid_amount(int paid_amount) {
		this.paid_amount = paid_amount;
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




	@Override
	public String toString() {
		return "ClientTask [Id=" + Id + ", Name=" + Name + ", username=" + username + ", Adress=" + Adress
				+ ", receipt=" + receipt + ", contract_num=" + contract_num + ", left_amount=" + left_amount
				+ ", paid_amount=" + paid_amount + ", vignette=" + vignette + ", tech_visit=" + tech_visit + "]";
	}
    
    
    

    
    


    
	



	
	
	

    
    
    

}
