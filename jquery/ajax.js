<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script type="text/javascript">
		var ajax = {
			form : null,
			method : "get",
			url : null,
			params : {},



			setForm:function(formId){
				this.form = ("#"+formId);
				this.prepareRequestParams();
				return this;
			},

			prepareRequestParams: function(){
				this.setUrl(this.grtForm().attr("action"));
				this.setUrl(this.grtForm().attr("method"));
				this.setUrl(this.grtForm().serializeArray());
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

				// let self = this;

				// this.prepareRequestSettings();

				$.ajax({url:this.getUrl(),
					type:this.getMethod(),
					dataType:"json",
					data:this.getParams()
				}).done(function(responce){
					$('#a'+responce.element).html(responce.html);
					// self.resetRequestSettings();
				});
			}

		};

		
		// var ajax = {
		// 	name : "hello"
		// };
		// console.log(ajax);
	</script>
</head>
<body>
	<button type="button" onclick="ajax.setUrl('http://localhost/newmvc-akshayfultariya/index.php?c=product&a=grid').call();">Product Grid</button>
	<button type="button" onclick="ajax.setUrl('http://localhost/newmvc-akshayfultariya/index.php?c=product&a=add').call();">Product ADD</button>
	<div id="ajax"></div>
</body>
</html>