function startNewHttpRequest(type, url) {
	var request = new XMLHttpRequest();
	request.open(type, url);

	return request;
}

function handleHttpRequest(request, requestData, onSuccess) {
	request.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			onSuccess(request.responseText);
		}
	}

	request.send(requestData);
}