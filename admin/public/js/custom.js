$(document).ready(function () {
$('#VisitorDt').DataTable();
$('.dataTables_length').addClass('bs-select');
});

function getServiceData(){


	axios.get('/getservicedata')
	.then(function(response){

		$('#main-ser').removeClass('d-none');
		$('#loader-div').addClass('d-none');

		if(response.status == 200){
		var jsonData=response.data;
		$.each(jsonData, function(i,item){
			$('<tr>').html(
				"<td> <img class='table-img' src="+jsonData[i].service_img+"> </td>"+
				"<td>"+ jsonData[i].service_name +"</td>"+
				"<td> "+ jsonData[i].service_des +" </td>"+
				"<td> <a href=''><i class='fas fa-edit'></i></a> </td>"+
				"<td> <a href=''><i class='fas fa-trash-alt'></i></a> </td>"
				).appendTo('#service_table');
		});	
	}else{

	$('#loader-div').addClass('d-none');
		$('#wrong-div').removeClass('d-none');

	}

		
	}).catch(function (error) {
	$('#loader-div').addClass('d-none');
		$('#wrong-div').removeClass('d-none');
});
}