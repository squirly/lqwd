dojo.ready(function() {
	if (window.location.pathname != '/') {
		window.location.hash = getHashPath(window.location.href);
		window.location.pathname = '/';
	}
	if (window.location.hash == '') {
			window.location.hash='/home';
	}
	loadAjaxPage(window.location.href.replace('#/', ''));
	dojo.subscribe("/dojo/hashchange", this, hash.onChanged);
	pageLoad();
	firstload = false;
});

var pageLoad = function () {
	dojo.query("a").connect("onclick", link.onClick);
	dojo.query("form").connect('onsubmit', form.onSubmit);
}
var loadAjaxPage = function(path) {
		window.location.hash = getHashPath(path);
		dojo.xhrGet({
			url: path+'.qhtml',
			load: function(result) {
				processResult(result);
				pageLoad();
			}
		});
}
var getHashPath = function(path) {
	return path.slice(path.indexOf('/', 7));
}
var hash = {
	onChange: function(hash){
		loadAjaxPage(window.location.href.replace('#/', ''));
	}
}
var link = {
	onClick: function(evt){
		var element = evt.target;
		while (element.href == undefined) element = element.parentNode;
		if (!dojo.hasClass(element,'nojax')) {
			loadAjaxPage(element.href);
			dojo.stopEvent(evt);
		}
	}
};
var form = {
	onSubmit: function(evt){
		element = evt.target;
		if (element.action == "")
			element.action = window.location.href.replace('#/', '');
		element.action += '.qhtml';
		dojo.xhrPost({
			formNode: element,
			handelAs: 'text',
			load: function(result) {
				processResult(result);
				pageLoad();
			}
		});
		dojo.stopEvent(evt);
	}
};
var processResult = function(result) {
	dojo.query('#content')[0].innerHTML = result;
}