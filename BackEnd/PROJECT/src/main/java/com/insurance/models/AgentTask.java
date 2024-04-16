package com.insurance.models;

public class AgentTask {
	
	private String Id;
	private String Name;
	private String decision;
	private String reason_vig;
	private String reason_tech;
	private String receipt;
	
	
	





	public AgentTask(String id, String name, String decision, String reason_vig, String reason_tech, String receipt) {
		super();
		Id = id;
		Name = name;
		this.decision = decision;
		this.reason_vig = reason_vig;
		this.reason_tech = reason_tech;
		this.receipt = receipt;
	}



	public AgentTask() {
		super();
		// TODO Auto-generated constructor stub
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


	

	public String getReceipt() {
		return receipt;
	}



	public void setReceipt(String receipt) {
		this.receipt = receipt;
	}



	public void setName(String name) {
		Name = name;
	}



	public String getDecision() {
		return decision;
	}



	public void setDecision(String decision) {
		this.decision = decision;
	}




	public String getReason_vig() {
		return reason_vig;
	}



	public void setReason_vig(String reason_vig) {
		this.reason_vig = reason_vig;
	}



	public String getReason_tech() {
		return reason_tech;
	}



	public void setReason_tech(String reason_tech) {
		this.reason_tech = reason_tech;
	}



	@Override
	public String toString() {
		return "AgentTask [Id=" + Id + ", Name=" + Name + ", decision=" + decision + ", reason_vig=" + reason_vig
				+ ", reason_tech=" + reason_tech + ", receipt=" + receipt + "]";
	}




	
	
	
	
	

}
