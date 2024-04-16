// appel fonction dans laravel pour communiquer avec la base et laravel  
// Elle contient les informations de base sur le client, son véhicule et les détails du devis.
// Les champs de cette classe sont mappés à ceux de la base de données.

package com.insurance.models;

public class Devis_info {
	
	private String dv_usern;
	private String immat;
	private int devis_id;
	private String immat_type;
	private String serie;
	private String usage_type;
	private String marque;
	private String model;
	private String fuel_type;
	private int malus;
	private String km;
	private String circ_date;
	private int seat;
	private int horse;
	private String price_new;
	private String price_venal;
	private String cin;
	private String client_firstname;
	private String client_lastname;
	private String email;
	private String job;
	private String gender;
	private String birth_date;
	private String phone;
	private int pack;
	private String pack_name;
	private String money;
	private String date;
	private String devis_doc;
	
	
	
	
	public Devis_info() {
		super();

	}



	public Devis_info(String dv_usern, String immat, int devis_id, String immat_type, String serie, String usage_type,
			String marque, String model, String fuel_type, int malus, String km, String circ_date, int seat, int horse,
			String price_new, String price_venal, String cin, String client_firstname, String client_lastname,
			String email, String job, String gender, String birth_date, String phone, int pack, String pack_name,
			String money, String date, String devis_doc) {
		super();
		this.dv_usern = dv_usern;
		this.immat = immat;
		this.devis_id = devis_id;
		this.immat_type = immat_type;
		this.serie = serie;
		this.usage_type = usage_type;
		this.marque = marque;
		this.model = model;
		this.fuel_type = fuel_type;
		this.malus = malus;
		this.km = km;
		this.circ_date = circ_date;
		this.seat = seat;
		this.horse = horse;
		this.price_new = price_new;
		this.price_venal = price_venal;
		this.cin = cin;
		this.client_firstname = client_firstname;
		this.client_lastname = client_lastname;
		this.email = email;
		this.job = job;
		this.gender = gender;
		this.birth_date = birth_date;
		this.phone = phone;
		this.pack = pack;
		this.pack_name = pack_name;
		this.money = money;
		this.date = date;
		this.devis_doc = devis_doc;
	}



















	public String getDate() {
		return date;
	}














	public void setDate(String date) {
		this.date = date;
	}














	public int getDevis_id() {
		return devis_id;
	}




	public void setDevis_id(int devis_id) {
		this.devis_id = devis_id;
	}




	public String getDv_usern() {
		return dv_usern;
	}




	public void setDv_usern(String dv_usern) {
		this.dv_usern = dv_usern;
	}




	public String getImmat() {
		return immat;
	}




	public void setImmat(String immat) {
		this.immat = immat;
	}




	public String getImmat_type() {
		return immat_type;
	}




	public void setImmat_type(String immat_type) {
		this.immat_type = immat_type;
	}




	public String getSerie() {
		return serie;
	}




	public void setSerie(String serie) {
		this.serie = serie;
	}




	public String getUsage_type() {
		return usage_type;
	}




	public void setUsage_type(String usage_type) {
		this.usage_type = usage_type;
	}




	public String getMarque() {
		return marque;
	}




	public void setMarque(String marque) {
		this.marque = marque;
	}




	public String getModel() {
		return model;
	}




	public void setModel(String model) {
		this.model = model;
	}




	public String getFuel_type() {
		return fuel_type;
	}




	public void setFuel_type(String fuel_type) {
		this.fuel_type = fuel_type;
	}




	public int getMalus() {
		return malus;
	}




	public void setMalus(int malus) {
		this.malus = malus;
	}




	public String getKm() {
		return km;
	}




	public void setKm(String km) {
		this.km = km;
	}




	public String getCirc_date() {
		return circ_date;
	}




	public void setCirc_date(String circ_date) {
		this.circ_date = circ_date;
	}




	public int getSeat() {
		return seat;
	}




	public void setSeat(int seat) {
		this.seat = seat;
	}




	public int getHorse() {
		return horse;
	}




	public void setHorse(int horse) {
		this.horse = horse;
	}




	public String getPrice_new() {
		return price_new;
	}




	public void setPrice_new(String price_new) {
		this.price_new = price_new;
	}




	public String getPrice_venal() {
		return price_venal;
	}




	public void setPrice_venal(String price_venal) {
		this.price_venal = price_venal;
	}




	public String getCin() {
		return cin;
	}




	public void setCin(String cin) {
		this.cin = cin;
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




	public String getEmail() {
		return email;
	}




	public void setEmail(String email) {
		this.email = email;
	}




	public String getJob() {
		return job;
	}




	public void setJob(String job) {
		this.job = job;
	}




	public String getGender() {
		return gender;
	}




	public void setGender(String gender) {
		this.gender = gender;
	}




	public String getBirth_date() {
		return birth_date;
	}




	public void setBirth_date(String birth_date) {
		this.birth_date = birth_date;
	}




	public String getPhone() {
		return phone;
	}




	public void setPhone(String phone) {
		this.phone = phone;
	}







	public int getPack() {
		return pack;
	}







	public void setPack(int pack) {
		this.pack = pack;
	}







	public String getPack_name() {
		return pack_name;
	}







	public void setPack_name(String pack_name) {
		this.pack_name = pack_name;
	}







	public String getMoney() {
		return money;
	}




	public void setMoney(String money) {
		this.money = money;
	}




	public String getDevis_doc() {
		return devis_doc;
	}




	public void setDevis_doc(String devis_doc) {
		this.devis_doc = devis_doc;
	}







	@Override
	public String toString() {
		return "Devis_info [dv_usern=" + dv_usern + ", immat=" + immat + ", devis_id=" + devis_id + ", immat_type="
				+ immat_type + ", serie=" + serie + ", usage_type=" + usage_type + ", marque=" + marque + ", model="
				+ model + ", fuel_type=" + fuel_type + ", malus=" + malus + ", km=" + km + ", circ_date=" + circ_date
				+ ", seat=" + seat + ", horse=" + horse + ", price_new=" + price_new + ", price_venal=" + price_venal
				+ ", cin=" + cin + ", client_firstname=" + client_firstname + ", client_lastname=" + client_lastname
				+ ", email=" + email + ", job=" + job + ", gender=" + gender + ", birth_date=" + birth_date + ", phone="
				+ phone + ", pack=" + pack + ", pack_name=" + pack_name + ", money=" + money + ", date=" + date
				+ ", devis_doc=" + devis_doc + "]";
	}













	

	

	
	
	





	


	
	
	
	
	

}
