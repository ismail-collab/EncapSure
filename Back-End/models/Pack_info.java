package com.insurance.models;

import java.math.BigDecimal;

public class Pack_info {
	private int pack_id;
	private int guaranty_id;
	private int pg_id;
	private String pack_name;
	private String guaranty_name;
	private BigDecimal price;
	private BigDecimal cover_amount;
	
	
	
	public Pack_info() {
		super();
		// TODO Auto-generated constructor stub
	}







	public Pack_info(int pack_id, int guaranty_id, int pg_id, String pack_name, String guaranty_name, BigDecimal price,
			BigDecimal cover_amount) {
		super();
		this.pack_id = pack_id;
		this.guaranty_id = guaranty_id;
		this.pg_id = pg_id;
		this.pack_name = pack_name;
		this.guaranty_name = guaranty_name;
		this.price = price;
		this.cover_amount = cover_amount;
	}







	public int getPack_id() {
		return pack_id;
	}



	public void setPack_id(int pack_id) {
		this.pack_id = pack_id;
	}



	public int getGuaranty_id() {
		return guaranty_id;
	}



	public void setGuaranty_id(int guaranty_id) {
		this.guaranty_id = guaranty_id;
	}



	public int getPg_id() {
		return pg_id;
	}



	public void setPg_id(int pg_id) {
		this.pg_id = pg_id;
	}



	public String getPack_name() {
		return pack_name;
	}



	public void setPack_name(String pack_name) {
		this.pack_name = pack_name;
	}






	public String getGuaranty_name() {
		return guaranty_name;
	}







	public void setGuaranty_name(String guaranty_name) {
		this.guaranty_name = guaranty_name;
	}







	public BigDecimal getPrice() {
		return price;
	}



	public void setPrice(BigDecimal price) {
		this.price = price;
	}



	public BigDecimal getCover_amount() {
		return cover_amount;
	}



	public void setCover_amount(BigDecimal cover_amount) {
		this.cover_amount = cover_amount;
	}







	@Override
	public String toString() {
		return "Pack_info [pack_id=" + pack_id + ", guaranty_id=" + guaranty_id + ", pg_id=" + pg_id + ", pack_name="
				+ pack_name + ", guaranty_name=" + guaranty_name + ", price=" + price + ", cover_amount=" + cover_amount
				+ "]";
	}



	
	

}
