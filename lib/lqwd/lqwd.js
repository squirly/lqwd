dojo.ready(function() {
	if (window.location.pathname != '/') {
		window.location.hash = getHashPath(window.location.href);
		window.location.pathname = '/';
	}
	if (firstLoad && window.location.hash != '') {
		loadAjaxPage(window.location.href.replace('#/', ''));
	}
	pageLoad();
	firstload = false;
});

var firstLoad = true;
var pageLoad = function () {
	dojo.query("a").connect("onclick", link.onClick);
}
var loadAjaxPage = function(path) {
		window.location.hash = getHashPath(path);
		dojo.xhrGet({
			url: path,
			load: function(result) {
				dojo.query('html')[0].innerHTML = result;
				pageLoad();
			}
		});
}
var getHashPath = function(path) {
	return path.slice(path.indexOf('/', 7));
}
var link = {
	onClick: function(evt){
		dojo.stopEvent(evt);
		var element = evt.target;
		while (element.href == undefined) element = element.parentNode;
		loadAjaxPage(element.href);
	}
};