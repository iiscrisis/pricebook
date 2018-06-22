var currentStep =1;
var maxStep = 3;
var minStep =1;



(function($) {

	/*
	*  Copyright 2006-2007 Dynamic Site Solutions.
	*  Free use of this script is permitted for non-commercial applications,
	*  subject to the requirement that this comment block be kept and not be
	*  altered.  The data and executable parts of the script may be changed
	*  as needed.  Dynamic Site Solutions makes no warranty regarding fitness
	*  of use or correct function of the script.  Terms for use of this script
	*  in commercial applications may be negotiated; for this, or for other
	*  questions, contact "license-info@dynamicsitesolutions.com".
	*
	*  Script by: Dynamic Site Solutions -- http://www.dynamicsitesolutions.com/
	*  Last Updated: 2007-06-17
	*/

	//IE5+/Win, Firefox, Netscape 6+, Opera 7+, Safari, Konqueror 3, IE5/Mac, iCab 3

	var addBookmarkObj = {
		linkText:'Προσθήκη στα Αγαπημένα',
		addTextLink:function(parId){
			var a=addBookmarkObj.makeLink(parId);
			if(!a) return;
			a.appendChild(document.createTextNode(addBookmarkObj.linkText));
		},
		addImageLink:function(parId,imgPath){
			if(!imgPath || isEmpty(imgPath)) return;
			var a=addBookmarkObj.makeLink(parId);
			if(!a) return;
			var img = document.createElement('img');
			img.title = img.alt = addBookmarkObj.linkText;
			img.src = imgPath;
			a.appendChild(img);
		},
		makeLink:function(parId) {
			if(!document.getElementById || !document.createTextNode) return null;
			parId=((typeof(parId)=='string')&&!isEmpty(parId))
			?parId:'addBookmarkContainer';
			var cont=document.getElementById(parId);
			if(!cont) return null;
			var a=document.createElement('a');
			a.href=location.href;
			if(window.opera) {
				a.rel='sidebar'; // this makes it work in Opera 7+
			} else {
				// this doesn't work in Opera 7+ if the link has an onclick handler,
				// so we only add it if the browser isn't Opera.
				a.onclick=function() {
					addBookmarkObj.exec(this.href,this.title);
					return false;
				}
			}
			a.title=document.title;
			return cont.appendChild(a);
		},
		exec:function(url, title) {
			// user agent sniffing is bad in general, but this is one of the times
			// when it's really necessary
			var ua=navigator.userAgent.toLowerCase();
			var isKonq=(ua.indexOf('konqueror')!=-1);
			var isSafari=(ua.indexOf('webkit')!=-1);
			var isMac=(ua.indexOf('mac')!=-1);
			var buttonStr=isMac?'Command/Cmd':'CTRL';

			if(window.external && (!document.createTextNode ||
				(typeof(window.external.AddFavorite)=='unknown'))) {
					// IE4/Win generates an error when you
					// execute "typeof(window.external.AddFavorite)"
					// In IE7 the page must be from a web server, not directly from a local
					// file system, otherwise, you will get a permission denied error.
					window.external.AddFavorite(url, title); // IE/Win
				} else if(isKonq) {
					alert('Πίεσε CTRL + B για να αποθηκεύσεις το site.');
				} else if(window.opera) {
					void(0); // do nothing here (Opera 7+)
				} else if(window.home || isSafari) { // Firefox, Netscape, Safari, iCab
					alert('Πίεσε '+buttonStr+' + D για να αποθηκεύσεις το site.');
				} else if(!window.print || isMac) { // IE5/Mac and Safari 1.0
					alert('Πίεσε Command/Cmd + D για να αποθηκεύσεις το site.');
				} else {
					alert('Για να αποθηκεύσεις αυτό το site πρέπει να χρησιμοποιήσεις την αντίστοιχη δυνατότητα του browser που χρησιμοποιείς.');
				}
			}
		}

		function isEmpty(s){return ((s=='')||/^\s*$/.test(s));}

		function dss_addEvent(el,etype,fn) {
			if(el.addEventListener && (!window.opera || opera.version) &&
			(etype!='load')) {
				el.addEventListener(etype,fn,false);
			} else if(el.attachEvent) {
				el.attachEvent('on'+etype,fn);
			} else {
				if(typeof(fn) != "function") return;
				if(typeof(window.earlyNS4)=='undefined') {
					// to prevent this function from crashing Netscape versions before 4.02
					window.earlyNS4=((navigator.appName.toLowerCase()=='netscape')&&
					(parseFloat(navigator.appVersion)<4.02)&&document.layers);
				}
				if((typeof(el['on'+etype])=="function")&&!window.earlyNS4) {
					var tempFunc = el['on'+etype];
					el['on'+etype]=function(e){
						var a=tempFunc(e),b=fn(e);
						a=(typeof(a)=='undefined')?true:a;
						b=(typeof(b)=='undefined')?true:b;
						return (a&&b);
					}
				} else {
					el['on'+etype]=fn;
				}
			}
		}

		dss_addEvent(window,'load',addBookmarkObj.addTextLink);



		/*function checklineslines(val){
		val = val.replace("\r",'');
		var mySplitResult = val.split("\n");
		for(var i=0; i< mySplitResult.length ; i++){
		if (check_afm(mySplitResult[i])){
		var res = new Element('div', {
		styles: {
		'color': '#00AA00'
	},
	text: mySplitResult[i],
	id: 'line'+i
});
} else {
	var res = new Element('div', {
		styles: {
			'color': '#FF0000'
		},
		text: mySplitResult[i],
		id: 'line'+i
	});
}
$('checkresult').adopt(res);

}



}  */

function check_afm(afm){

	//https://www.papaki.com/ajax/json.aspx?f=get_afm_info&afm=".$this->afm);

	if (afm == '' || afm.length != 9){
		return false;
	} else {
		var cd = afm.substr(8,1);
	}
	if (afm == '000000000'){
		return false;
	}
	var sum = 0;
	afm_ok = false;
	for(var i=0; i<8; i++){
		if (afm.charCodeAt(i) < 48 || afm.charCodeAt(i)>57){
			return false;
		} else {
			d = afm.substr(i,1);
			if (i<8){
				sum = sum + d * Math.pow(2,8-i);
			}
		}
	}
	if (sum == 0){
		return false;
	} else {
		var calc = sum % 11;
		if (calc == cd || ((calc == 0 || calc == 10) && cd == 0) ){
			return true;
		} else {
			return false;
		}
	}

}

function checkPostCode()
{

	var pc =$("#reg_pc").val() ;

	var error =false;
	if(!isNaN(pc) )
	{

		var pccheck = ""+pc;

		if(pccheck.length != 5)
		{
			//alert("error "+pccheck.length)
			error = true;
		}
	}else {
		error = true;
	}

	if(error)
	{
		$("#reg_pc").closest(".form-group").addClass("has-error");
		$("#reg_pc").closest(".form-group").addClass("has-danger");
		$("#reg_pc").closest(".form-group").find(".help-block").html("Μη Eγκυρο TK");
	}else {
		$("#reg_pc").closest(".form-group").removeClass("has-error");
		$("#reg_pc").closest(".form-group").removeClass("has-danger");
		$("#reg_pc").closest(".form-group").find(".help-block").html("");
	}

}

function checkGsis()
{

	var afm = $("#reg_afm").val();
	//alert(afm);
	var afm_res = check_afm(afm);
	//alert(afm_res);
	/*
	alert(228);
	var p_url = "https://www.papaki.com/ajax/json.aspx"; //?f=get_afm_info&afm=+afm; https://www.papaki.com/ajax/json.aspx?f=get_afm_info&afm=113726085

	var data = "f=get_afm_info&afm="+afm;

	$.ajax({
		url : p_url,
		type : 'get',
		data : data,
		dataType: "data",
		contentType: "application/json; charset=utf-8",
		success : function( response ) {
			alert(response);
			var data = JSON.parse(response);
			console.log(data);
			if (data.msg == OK) {
				alert("done "+data.data.afm);

			}
			else {
				alert(data.msg);
			}
			//  window.location.reload();

		},
		error:function()
		{
			alert("error");
		}
	});*/


	if(!afm_res)
	{
		//has-error has-danger
		$("#reg_afm").closest(".form-group").addClass("has-error");
		$("#reg_afm").closest(".form-group").addClass("has-danger");
		$("#reg_afm").closest(".form-group").find(".help-block").html("Μη Eγκυρο ΑΦΜ");
	}else {
		$("#reg_afm").closest(".form-group").removeClass("no-error");
		$("#reg_afm").closest(".form-group").removeClass("has-danger");
		$("#reg_afm").closest(".form-group").find(".help-block").html("");

	}
}



var isCompany = true; //whether its a company or a person
var hotel_sub = 2752;
var products_sub = 2751;
var services_sub = 2750;

function checkIfCompany()
{

	var subtype = $("input[name=reg_subscription]:checked").val();
	//alert(subtype);

	if(	($(".seller_details_company:checked").val() == 1)) //is Φυσικο
	{//alert($(".seller_details_company:checked").val() );

	isCompany = false;
	if( subtype==services_sub)
	{//if services allow for simple receipt
		$("#parastatiko").removeClass("hidden");
		$(".personOnly").removeAttr('disabled');
	}else {
		$(".timologio").attr("selected","selected");

		$(".personOnly").attr('disabled','disabled');
		$("#parastatiko").addClass("hidden");
	}

	if($("#legal_entity").val()=="")
	{
		$("#legal_entity").val(" Φυσικο Πρόσωπο ");
		$("#legal_entity").trigger("focus");
		$("#legal_entity").trigger("focusout");


	}

	$(".companyOnly").attr('disable','disabled');
	$(".companyOnly").removeAttr('required');
	$(".companyOnly").addClass("hidden");



}else {

	$(".timologio").attr("selected","selected");
	$(".personOnly").attr('disabled','disabled');

	$(".companyOnly").attr('required','required');
	$(".companyOnly").removeAttr('disabled');
	$(".companyOnly").removeClass("hidden");

	$("#parastatiko").addClass("hidden");
}

//alert(isCompany);
}

/*
var maxStep = 5;
var minStep =1;
*/

function checkNextPrevious()
{
  if(currentStep < maxStep)
  {
    $("#nextButton").removeClass("hidden");
    $("#submitButton").addClass("hidden");
  }else {
      $("#nextButton").addClass("hidden");
        $("#submitButton").removeClass("hidden");
  }

  if(currentStep > minStep)
  {

    $("#prevButton").removeClass("hidden");
  }else {
      $("#prevButton").addClass("hidden");
  }
}

jQuery(document).ready(function() {
	//seller registration categories expanding
	if($('#subscription-form').length <1)
	{
		return 0;
	}


	$(".single_sub-shape").on("click",function(){

		$(this).find("input[type=radio]").attr("checked","checked");


		$(".single_sub-transform").find(".checked").removeClass("checked");
		$(this).addClass("checked");

		checkIfCompany();

	});




	$(".checkbox_action").each(function(){
		//var checkboxes = $(this).closest(".form-group").find("input[type=checkbox]").trigger("click");
		var checkboxes = $(this).closest(".form-group").find("input[type=checkbox]").attr("checked");
		if (typeof checkboxes !== typeof undefined && checkboxes !== false) {
			$(this).addClass("checked");
			$(this).closest(".form-group").find("input[type=checkbox]").trigger("change");
		}
	});

	$(".radio_action").each(function(){
		//alert(1);
		var radios = $(this).closest(".form-group").find("input[type=radio]").attr("checked");
		if (typeof radios !== typeof undefined && radios !== false) {
			$(this).addClass("checked");
		}else {
			$(this).removeClass("checked");
		}
	});



	$(".checkbox_action").on('click',function(){
		if(!$(this).hasClass("checked"))
		{
		//	alert(1);
			$(this).closest(".form-group").find("input[type=checkbox]").trigger("click");
				$(this).closest(".form-group").find("input[type=checkbox]").attr("checked","checked");
			$(this).addClass("checked");

		}else {
alert(2);
			$(this).closest(".form-group").find("input[type=checkbox]").trigger("click");
			$(this).closest(".form-group").find("input[type=checkbox]").removeAttr("checked");
			$(this).removeClass("checked");
		}

		checkIfCompany();
	});


	$(".radio_action").on('click',function(){
		var radio_class = $(this).closest(".form-group").find("input[type=radio]").data("classname");
		//alert(radio_class);
		if(!$(this).hasClass("checked"))
		{


			$("."+radio_class).each(function(){

				$(this).closest(".form-group").find(".radio_action").removeClass("checked");
				$(this).closest(".form-group").find("input[type=radio]").removeAttr("checked");
			});

			$(this).closest(".form-group").find("input[type=radio]").attr("checked","checked");
			$(this).addClass("checked");

		}

		checkIfCompany();
	});


		$('#subscription-form').validator();
	//alert(1);
	//password strength





	//Check if fysiko proswpo and services. Then make simple recipt available
	checkIfCompany();
	$(".seller_details_company,input[name=reg_subscription]").on("click",checkIfCompany);
	//$("#reg_pass2").keyup(checkPasswordMatch);
	$("#name_copy").html($("#reg-companyName").val());
	$("#reg-companyName").keyup(function(){
		$("#name_copy").html($(this).val());
	});



	password_validator();

	/*ΑΦΜ check */
	//checkGsis();
	//$("#reg_afm").keydown(checkGsis);
	$("#reg_afm").focusout(checkGsis);



	$("#reg_pc").keyup(checkPostCode);


  $(".prev-button-shape").on("click",function(){
    if(currentStep > minStep)
    {
      $(".step_button_"+currentStep).removeClass("current");

      $(".step_"+currentStep).fadeOut();
      currentStep -= 1 ;
      var next_step =currentStep;
      $(".step_button_"+next_step).addClass("current");
      console.log(currentStep);      //parent.fadeOut();

      scrollToStep(next_step);

    }

      checkNextPrevious();

  });

  $(".next-button-shape").on("click",function(){
    if(currentStep < maxStep)
    {
      //$(".step_"+currentStep).css("marginBottom","50px");

      $(".step_button_"+currentStep).addClass("complete");
      $(".step_button_"+currentStep).removeClass("current");

      var parent = $(".step_"+currentStep);
      currentStep += 1 ;
      var next_step =currentStep;
      console.log(currentStep);


      $(".step_button_"+next_step).addClass("current");
      $(".step_"+next_step).fadeIn();

      parent.animate({marginBottom:50},500,'swing',function(){
        scrollToStep(next_step);
      });
    }

      checkNextPrevious();

  });

  $(".step_transform.complete, .step_transform.current").live("click",function(){
      var parent = $(".step_"+currentStep);
      var step =$(this).data("step");
    //  alert(step);
      $(".step_button_"+currentStep).removeClass("current");
      if(currentStep > step)
      {

        for(var i=step+1; i < currentStep; i++)
        {
            $(".step_"+i).fadeOut();
        }
          scrollToStep(step);
      }else {

        $(".step_button_"+step).addClass("current");
        $(".step_"+step).fadeIn();

        parent.animate({marginBottom:50},500,'swing',function(){
          scrollToStep(step);
        });
      }
        currentStep = step;

  });




});

function scrollToStep(next_step){
  var currentScroll = $(".step_"+next_step).position().top;
  var body = $("#seller-register");

  var margin_bottom =  $("#seller-register").height() - 165;

  $(".step_"+next_step).css("marginBottom",margin_bottom)

  console.log(" -- "+currentScroll);
  body.stop().animate({scrollTop:currentScroll}, 500, 'swing', function() {
    //   alert("Finished animating");
  });

}

function checkIfmoveToNext(current_step)
{
  $(".step_button_"+current_step).addClass("complete");
  return 1;
}

})(jQuery);
