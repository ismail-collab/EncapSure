package com.insurance.models;

public class Subscription_info {
	
	private int cin;
	private int sub_id;
	private String sub_usern;
	private String client_firstname;
	private String client_lastname;
	private String birth_date;
	private String job;
	private String fraction;
	private String renew;
	private String effect_date;
	private String deadline;
	private String delivery_adress;
	private String delivery_type;
	private String phone;
	private String email;
	private String money;
	private String gender;
	private String id_doc;
	private String contract;
	
	
	
	public Subscription_info() {
		super();

	}













	public Subscription_info(int cin, int sub_id, String sub_usern, String client_firstname, String client_lastname,
			String birth_date, String job, String fraction, String renew, String effect_date, String deadline,
			String delivery_adress, String delivery_type, String phone, String email, String money, String gender,
			String id_doc, String contract) {
		super();
		this.cin = cin;
		this.sub_id = sub_id;
		this.sub_usern = sub_usern;
		this.client_firstname = client_firstname;
		this.client_lastname = client_lastname;
		this.birth_date = birth_date;
		this.job = job;
		this.fraction = fraction;
		this.renew = renew;
		this.effect_date = effect_date;
		this.deadline = deadline;
		this.delivery_adress = delivery_adress;
		this.delivery_type = delivery_type;
		this.phone = phone;
		this.email = email;
		this.money = money;
		this.gender = gender;
		this.id_doc = id_doc;
		this.contract = contract;
	}



















	public int getSub_id() {
		return sub_id;
	}









	public String getContract() {
		return contract;
	}





	public void setContract(String contract) {
		this.contract = contract;
	}













	public void setSub_id(int sub_id) {
		this.sub_id = sub_id;
	}









	public String getMoney() {
		return money;
	}




	public void setMoney(String money) {
		this.money = money;
	}




	public int getCin() {
		return cin;
	}



	public void setCin(int cin) {
		this.cin = cin;
	}



	public String getSub_usern() {
		return sub_usern;
	}



	public void setSub_usern(String sub_usern) {
		this.sub_usern = sub_usern;
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



	public String getBirth_date() {
		return birth_date;
	}



	public void setBirth_date(String birth_date) {
		this.birth_date = birth_date;
	}



	public String getJob() {
		return job;
	}



	public void setJob(String job) {
		this.job = job;
	}



	public String getFraction() {
		return fraction;
	}



	public void setFraction(String fraction) {
		this.fraction = fraction;
	}



	public String getRenew() {
		return renew;
	}



	public void setRenew(String renew) {
		this.renew = renew;
	}



	public String getEffect_date() {
		return effect_date;
	}



	public void setEffect_date(String effect_date) {
		this.effect_date = effect_date;
	}



	public String getDeadline() {
		return deadline;
	}



	public void setDeadline(String deadline) {
		this.deadline = deadline;
	}



	public String getDelivery_adress() {
		return delivery_adress;
	}



	public void setDelivery_adress(String delivery_adress) {
		this.delivery_adress = delivery_adress;
	}



	public String getDelivery_type() {
		return delivery_type;
	}



	public void setDelivery_type(String delivery_type) {
		this.delivery_type = delivery_type;
	}



	public String getPhone() {
		return phone;
	}



	public void setPhone(String phone) {
		this.phone = phone;
	}



	public String getEmail() {
		return email;
	}



	public void setEmail(String email) {
		this.email = email;
	}



	public String getGender() {
		return gender;
	}



	public void setGender(String gender) {
		this.gender = gender;
	}



	public String getId_doc() {
		return id_doc;
	}



	public void setId_doc(String id_doc) {
		this.id_doc = id_doc;
	}













	@Override
	public String toString() {
		return "Subscription_info [cin=" + cin + ", sub_id=" + sub_id + ", sub_usern=" + sub_usern
				+ ", client_firstname=" + client_firstname + ", client_lastname=" + client_lastname + ", birth_date="
				+ birth_date + ", job=" + job + ", fraction=" + fraction + ", renew=" + renew + ", effect_date="
				+ effect_date + ", deadline=" + deadline + ", delivery_adress=" + delivery_adress + ", delivery_type="
				+ delivery_type + ", phone=" + phone + ", email=" + email + ", money=" + money + ", gender=" + gender
				+ ", id_doc=" + id_doc + ", contract=" + contract + "]";
	}










	
	





	
	
	

}
