/*Main class interface*/
function interface(){
	//...
}
interface.siteRoot = ('https:' == document.location.protocol ? 'https://' : 'http://')+window.location.toString().split("/")[2];
interface.systemUrl = interface.siteRoot + $('input[name=base_path]').val() + $('input[name=application]').val();
interface.objectExist = function(selector){
	if($(selector).length>0) return true;
	else return false;
}
interface.src = function(src){
	var arrSrc = src.split('/');
	var javascript = $('input[name=javascript]').val();
	if(javascript.indexOf(arrSrc[arrSrc.length-1])==-1){
		$('input[name=javascript]').val(javascript+','+arrSrc[arrSrc.length-1]);
		var script = document.createElement('script');
		script.type = 'text/javascript';
		script.async = true;
    	script.src = interface.siteRoot + $('input[name=base_full_path]').val() + 'interface/javascript/'+src+'.js';
		$('head').append(script);
	}
	return true;
}
/*End main class interface*/
/*Class login*/
var login = interface.login = function(){
	
}
interface.login.validate = function(selector){
	if(interface.src('jquery/jquery.validate')){
		$(selector + ' input:first').focus();
		$(selector).validate({
			rules:{
				'username':{
					required: true,
					minlength: 2
				},
				'password':{
					required: true,
					minlength: 2
				}
			},
			messages:{
				'username':{
					required: "Este campo é obrigatório.",
					minlength: "Por favor insira um valor maior ou igual a {0}."
				},
				'password':{
					required: "Este campo é obrigatório.",
					minlength: "Por favor insira um valor maior ou igual a {0}."
				}
			}
		});
	}
}
/*End class login*/
/*Class myprofile*/
var myprofile = interface.myprofile = function(){
	
}
interface.myprofile.validate = function(selector){
	if(interface.src('jquery/jquery.validate')){
		$(selector + ' input:first').focus();
		$(selector).validate({
			rules:{
				'name':{
					required: true,
					minlength: 2					
				},
				'username':{
					required: true,
					minlength: 2
				},
				'password':{
					required: true,
					minlength: 2
				}
			},
			messages:{
				'name':{
					required: "Este campo é obrigatório.",
					minlength: "Por favor insira um valor maior ou igual a {0}."
				},
				'username':{
					required: "Este campo é obrigatório.",
					minlength: "Por favor insira um valor maior ou igual a {0}."
				},
				'password':{
					required: "Este campo é obrigatório.",
					minlength: "Por favor insira um valor maior ou igual a {0}."
				}
			}
		});
	}
}
/*End class myprofile*/
/*Class mailing*/
var mailing = interface.mailing = function(){
	
}
interface.mailing.validate = function(selector){
	if(interface.src('jquery/jquery.validate')){
		$(selector + ' input:first').focus();
		$(selector).validate({
			rules:{
				'name':{
					required: true,
					minlength: 2					
				},
				'userfile':{
					required: true,
					accept: "xls"
				}
			},
			messages:{
				'name':{
					required: "Este campo é obrigatório.",
					minlength: "Por favor insira um valor maior ou igual a {0}."
				},
				'userfile':{
					required: "Este campo é obrigatório.",
					accept: "Por favor insira um valor com uma extensão válida (xls)."
				}
			},
			submitHandler: function(form){
				$(form).find('button').remove();
				$(form).submit();
			}
		});
	}
}
/*End class mailing*/
/*Class template*/
var template = interface.template = function(){
	
}
interface.template.validate = function(selector){
	if(interface.src('jquery/jquery.validate')){
		$(selector + ' input:first').focus();
		$(selector).validate({
			rules:{
				'name':{
					required: true,
					minlength: 2					
				},
				'userfile':{
					required: true,
					accept: "html"
				}
			},
			messages:{
				'name':{
					required: "Este campo é obrigatório.",
					minlength: "Por favor insira um valor maior ou igual a {0}."
				},
				'userfile':{
					required: "Este campo é obrigatório.",
					accept: "Por favor insira um valor com uma extensão válida (html)."
				}
			},
			submitHandler: function(form){
				$(form).find('button').remove();
				$(form).submit();
			}
		});
	}
}
/*End class template*/
/*Class newsletter*/
var newsletter = interface.newsletter = function(){
	
}
interface.newsletter.validate = function(selector){
	if(interface.src('jquery/jquery.validate')){
		$(selector + ' input:first').focus();
		$(selector).validate({
			rules:{
				'name':{
					required: true,
					minlength: 2					
				},
				'sender':{
					required: true,
					minlength: 2					
				},
				'email':{
					required: true,
					email: true					
				},
				'mailing':{
					required: true
				},
				'template':{
					required: true
				}
			},
			messages:{
				'name':{
					required: "Este campo é obrigatório.",
					minlength: "Por favor insira um valor maior ou igual a {0}."
				},
				'sender':{
					required: "Este campo é obrigatório.",
					minlength: "Por favor insira um valor maior ou igual a {0}."					
				},
				'email':{
					required: "Este campo é obrigatório.",
					email: "Por favor insira um email válido."
				},
				'mailing':{
					required: "Este campo é obrigatório."
				},
				'template':{
					required: "Este campo é obrigatório."
				}
			}
		});
	}
}
interface.newsletter.clickSend = function(){
	$('.send').click(function(){
		var url = $(this).attr('href');
		interface.newsletter.send(url,0);
		return false;
	});
}
interface.newsletter.send = function(url,start){
	$.ajax({
		url: url+'/'+start,
		beforeSend: function(){
			if($('.bgModal').length == 0){
				$('body').prepend('<div class=\"boxModal\"><p>Disparando newsletter, não feche seu navegador, isso pode demorar alguns minutos.</p><div class=\"progress\"><span>Inicializando envio.</span></div></div>');
				$('body').prepend('<div class=\"bgModal\">&nbsp;</div>');
			}
		},
		success: function(data){
			$('body .boxModal div').html(data);
			if(data.indexOf('span')!=-1){
				start = start + 5;
				interface.newsletter.send(url, start);
			}else{
				$('body .boxModal div a.closeModal').live('click',function(){
					$('body .boxModal, body .bgModal').remove();
					return false;
				});
			}
		}
	});	
}
/*End class newsletter*/
/*Class user*/
var user = interface.user = function(){
	
}
interface.user.validate = function(selector){
	if(interface.src('jquery/jquery.validate')){
		$(selector + ' input:first').focus();
		$(selector).validate({
			rules:{
				'name':{
					required: true,
					minlength: 2				
				},
				'username':{
					required: true,
					minlength: 2
				},
				'level':{
					required: true
				}
			},
			messages:{
				'name':{
					required: "Este campo é obrigatório.",
					minlength: "Por favor insira um valor maior ou igual a {0}."
				},
				'username':{
					required: "Este campo é obrigatório.",
					minlength: "Por favor insira um valor maior ou igual a {0}."
				},
				'level':{
					required: "Este campo é obrigatório."
				}
			},
			submitHandler: function(form){
				$(form).find('button').remove();
				$(form).submit();
			}
		});
	}
}
/*End class user*/