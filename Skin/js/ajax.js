var ajax = {
	form : null,
	method : "post",
	url : '',
	params : {},


	prepareRequestParams: function(){
		this.setUrl(this.getForm().attr("action"));
		this.setMethod(this.getForm().attr("method"));
		this.setParams(this.getForm().serializeArray());
	},

	setForm:function(formId){
		this.form = $("#"+formId);
		this.prepareRequestParams();
		return this;
	},


	getForm:function(){
		return this.form;
	},

	setMethod:function(method){
		this.method = method;
		return this;
	},

	getMethod:function(){
		return this.method;
	},

	setUrl:function(url){
		this.url = url;
		return this;
	},

	getUrl:function(){
		return this.url;
	},

	setParams:function(params){
		this.params = params;
		return this;
	},

	getParams:function(key=null){
		if (key === null) {
			return this.params;
		}

		if (this.params[key] === undefined) {
			return null;
		}
		return this.params[key];
	},

	prepareRequestSettings:function(){
		if (this.getForm()) {
			this.getParams(this.getForm().serializeArray());
			this.getMethod(this.getForm().attr('method'));
		}
	},

	resetRequestSettings:function(){
			this.setParam({});
			this.setMethod('get');

			return this;
		
	},

	call:function(){

		$.ajax({url:this.getUrl(),
			type : this.getMethod(),
			dataType:"json",
			data : this.getParams(),
		}).done(function(response){
			$('#'+response.element).html(response.html);
			if (response.messageBlockHtml !== undefined) {
				$('#message-html').html(response.messageBlockHtml);
			}
		});
	},

};