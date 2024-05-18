package com.insurance.models;

public class Sim_info {
	
	private int devis_in;
	private int devis_cancel;
	private int sub_in;
	private int sub_cancel;
	
	
	
	public Sim_info(int devis_in, int devis_cancel, int sub_in, int sub_cancel) {
		super();
		this.devis_in = devis_in;
		this.devis_cancel = devis_cancel;
		this.sub_in = sub_in;
		this.sub_cancel = sub_cancel;
	}



	public Sim_info() {
		super();
	
	}



	public int getDevis_in() {
		return devis_in;
	}



	public void setDevis_in(int devis_in) {
		this.devis_in = devis_in;
	}



	public int getDevis_cancel() {
		return devis_cancel;
	}



	public void setDevis_cancel(int devis_cancel) {
		this.devis_cancel = devis_cancel;
	}



	public int getSub_in() {
		return sub_in;
	}



	public void setSub_in(int sub_in) {
		this.sub_in = sub_in;
	}



	public int getSub_cancel() {
		return sub_cancel;
	}



	public void setSub_cancel(int sub_cancel) {
		this.sub_cancel = sub_cancel;
	}



	@Override
	public String toString() {
		return "Sim_info [devis_in=" + devis_in + ", devis_cancel=" + devis_cancel + ", sub_in=" + sub_in
				+ ", sub_cancel=" + sub_cancel + "]";
	}
	
	
	

}
