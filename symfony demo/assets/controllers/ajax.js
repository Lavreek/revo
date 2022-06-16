window.bootstrap = require('bootstrap/dist/js/bootstrap.bundle.js');
const $ = require('jquery');

const toastTrigger = document.getElementById('liveToastBtn');
const toastLiveExample = document.getElementById('liveToast');
const toast = new bootstrap.Toast(toastLiveExample);

function sendAjaxForm(url, data)
{
    $.ajax({
    	type: "POST", url: url, data: data,
        
		success: function(response) {
			$('.toast-body').append(response.Response);
        	toast.show();
    	}
 	});
}

$('.btn-push-id').on('click', function()
	{
		let data = $("#form_push_id").serialize();

		if ($('#PushInputID').val() > 0)
		{
			sendAjaxForm('api/revo/add', data);
		}	
	}
);

$('.btn-delete-id').on('click', function()
	{
		let data = $("#form_delete_id").serialize();

		if ($('#DeleteInputID').val() > 0)
		{
			sendAjaxForm('api/revo/delete', data);
		}	
	}
);

$('.btn-revo-settings-apply').on('click', function() 
	{
		let data = $('#set_revo_settings').serialize();
		$('.btn-settings-close').click();

		sendAjaxForm('api/revo/change/settings', data);
	}
)

$('.btn-fluid-settings-apply').on('click', function() 
	{
		let data = $('#set_fluid_settings').serialize();
		$('.btn-settings-close').click();

		sendAjaxForm('api/fluid/change/settings', data);
	}
)

toastLiveExample.addEventListener('hidden.bs.toast', () => {
	$('.toast-body').empty();
})