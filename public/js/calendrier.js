/* calendrier.js */
//page chargée?
$(document).ready(function(){
	//clic sur le bouton modifier d'une ligne
	/*$('.modif').on('click', function(){
		elem = $(this).prop('id').substr(1);
		value = $('#i'+elem).val();
		//alert('modif' + ' '+ elem + ' ' + value);
		$.ajax({
			url: 'modifPanier',
			type: "post",
			data: {'id': elem, 'value': value},
			dataType: 'json',
			success: function(data)
			{
				$('#message').html(data.msg);
			},
			error: function(a,b,c)
			{
				alert('oups' + a + b + c);
			}
		});

	});*/
	//clic sur le bouton supprimer d'une ligne
	$('.supp').on('click', function(){
		$.ajax({
			url: "suppPanier",
			type: "post",
			data: {'id' : $(this).prop('id').substr(1)},
			dataType: 'json',
			error: function(a, b, c)
			{
				alert(a + b + c);
			},
			success: function(data)
			{
				window.location.reload();
				$('#message').html(data.msg);
			}
		});
	});
    
    //Pour ajouter une reservation
	$('.libre').on('click', function(){
        elem = $(this).prop('id').substr(19);
		date =  $(this).prop('id').substr(0,19);
		//alert('modif' + ' '+ elem + ' ' + value);
		$.ajax({
			url: "/EasyOffice/public/ajoutReservation",
			type: "post",
			data: {'id': elem, 'date': date},
			dataType: 'json',
			error: function(a, b, c)
			{
				alert(a + b + c );
			},
			success: function(data)
			{
				window.location.reload();
				$('#message').html(data.msg);
			}
		});
	});

});