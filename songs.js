$(function(){

    $('body').pagecontainer({ defaults: true });
    //$('div:data(role=page)').on('pagecontainershow', function () { alert('so show'); } );

    $('#lists').data('onshow', lists_show);

    $('body').on('pagecontainershow', function(ev,ui){
	switch( ui.toPage ) {
	default:
	    if ( typeof( ui.toPage.data('onshow') ) == 'function' )
		ui.toPage.data('onshow')(ev,ui);
	}
    });

});

function rpc_call(method,params,callback) {

    var sequential = 1;

    var post_data = {
	method: method,
	params: params,
	id: sequential,
    };

    sequential++;

    $.ajax({
	url: 'rpc.php',
	contentType: 'text/json',
	dataType: 'json',
	data: JSON.stringify(post_data),
	type: 'POST',
	success: callback,
	error: function(xhr,status,error){
	    console.log(status,error,xhr.responseText);
	}
    });

}

function lists_show(event,ui) {

    rpc_call('list_songs',{limit:20},lists_load_lists);

}

function lists_load_lists(data,status,xhr) {

    console.log(data);

}
