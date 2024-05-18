package com.insurance.models;

public class TasksDef {
	

	private String ID_;
	private String PROC_DEF_ID_;
	private String NAME_;
	private String CREATE_TIME_;
	
	
	public TasksDef(String iD_, String pROC_DEF_ID_, String nAME_, String cREATE_TIME_) {
		super();
		ID_ = iD_;
		PROC_DEF_ID_ = pROC_DEF_ID_;
		NAME_ = nAME_;
		CREATE_TIME_ = cREATE_TIME_;
	}

	public TasksDef() {
		super();
	}

	public String getID_() {
		return ID_;
	}

	public void setID_(String iD_) {
		ID_ = iD_;
	}

	public String getPROC_DEF_ID_() {
		return PROC_DEF_ID_;
	}

	public void setPROC_DEF_ID_(String pROC_DEF_ID_) {
		PROC_DEF_ID_ = pROC_DEF_ID_;
	}

	public String getNAME_() {
		return NAME_;
	}

	public void setNAME_(String nAME_) {
		NAME_ = nAME_;
	}

	public String getCREATE_TIME_() {
		return CREATE_TIME_;
	}

	public void setCREATE_TIME_(String cREATE_TIME_) {
		CREATE_TIME_ = cREATE_TIME_;
	}

	@Override
	public String toString() {
		return "Tasks [ID_=" + ID_ + ", PROC_DEF_ID_=" + PROC_DEF_ID_ + ", NAME_=" + NAME_ + ", CREATE_TIME_="
				+ CREATE_TIME_ + "]";
	}
	
	
	

}


