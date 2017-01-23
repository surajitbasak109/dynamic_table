window.addEventListener('load', function () {
	
	var myForm = document.getElementById('myForm');

	if (myForm) {
		myForm.addEventListener('submit', function (e) {
			e.preventDefault();
			ajax({
				type: 'post',
				url: myForm.action,
				params: 'name=' + e.target.elements[0].value,
				done: function (data) {
					document.querySelector('.help-block').innerHTML = data;
					render();
				}
			});
			e.target.elements[0].value = "";
			e.target.elements[0].focus();
		});
	}

	render(1);
	
});

function ajax(opts) {
	var invocation = new XMLHttpRequest();
	invocation.onreadystatechange = function () {
		if (invocation.readyState === invocation.DONE) {
			if (invocation.status === 200) {
				opts.done(invocation.responseText);
			} else {
				opts.fail(invocation.status, invocation.statusText);
			}
		}
	}	

	invocation.open(opts.type, opts.url, true);
	if (opts.type.toLowerCase() === "post") {
		invocation.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		invocation.send(opts.params);
	} else {
		invocation.send(null);
	}
}

function display_edit_form(id) {
	ajax({
		type: 'get',
		url: 'editForm.php?editid=' + id,
		done: function(data) {
			document.querySelector('.form-wrap').innerHTML = data;
		},
		fail: function(error, status) {
			document.querySelector('.help-block').innerHTML = error + ": " + status;
		}
	});
	render(1);
}

function delComp(id, name) 
{
	var sure = window.confirm('Are you sure you want to delete "'+ name +'"?');

	if (sure) 
	{
		ajax({
			type: 'get',
			url: 'delete.php?delid=' + id,
			done: function (data) {
				document.querySelector('.help-block').innerHTML = data;
			},			
			fail: function (error, status) {
				document.querySelector('.help-block').innerHTML = error + ": " + status;
			}
		});
		render(1);
	}	
}

function render(id) {
	
	ajax({
		type: 'get',
		url: 'render.php?pages='+id,
		done: function(data) {
			document.querySelector('.render').innerHTML = data;
		},
		fail: function (error, status) {
			document.querySelector('.render').innerHTML = error + ": " + status;
		}
	});
}
