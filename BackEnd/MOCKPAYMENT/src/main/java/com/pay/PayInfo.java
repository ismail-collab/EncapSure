package com.pay;

public class PayInfo {
	private double PaidAmount;
	private double LeftAmount;
	private String username;
	private int Cardnum;
	
	
	
	public PayInfo(double paidAmount, double leftAmount, String username, int cardnum) {
		super();
		PaidAmount = paidAmount;
		LeftAmount = leftAmount;
		this.username = username;
		Cardnum = cardnum;
	}



	public PayInfo() {
		super();
		// TODO Auto-generated constructor stub
	}



	public double getPaidAmount() {
		return PaidAmount;
	}



	public void setPaidAmount(double paidAmount) {
		PaidAmount = paidAmount;
	}



	public double getLeftAmount() {
		return LeftAmount;
	}



	public void setLeftAmount(double leftAmount) {
		LeftAmount = leftAmount;
	}



	public String getUsername() {
		return username;
	}



	public void setUsername(String username) {
		this.username = username;
	}



	public int getCardnum() {
		return Cardnum;
	}



	public void setCardnum(int cardnum) {
		Cardnum = cardnum;
	}



	@Override
	public String toString() {
		return "PayInfo [PaidAmount=" + PaidAmount + ", LeftAmount=" + LeftAmount + ", username=" + username
				+ ", Cardnum=" + Cardnum + "]";
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

}
