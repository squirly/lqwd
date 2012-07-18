dojo.ready(function() {
  dojo.byId('content').innerHTML = 'loading page...';
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

var s = {
  link: {
    onClick: function(evt){
      dojo.stopEvent(evt);
      var element = evt.target;
      while (element.href == undefined) element = element.parentNode;
      loadAjaxPage(element.href);
    }
  },
  form: {
    onSubmit: function(evt){
      dojo.stopEvent(evt);
      var element = evt.target;
      path = element.action
      if (path == "") path = window.location.origin + window.location.hash.replace('#', '');
      loadAjaxForm(path, element);
    },
    buttonClick: function(evt){
      var element = evt.target;
      var newButton = dojo.clone(element);
      dojo.place(newButton, element, 'before')
      element.type='hidden';
      newButton.click()
    }
  }
};

var parsers = {
  HTML: function(text) {
    dojo.query('body')[0].innerHTML=text.replace(/<body>(.*)<\/body>/, "$1");
  },
  parseqHTML: function(text) {
    var location=0;
    var parent = ''
    while (true) {
      mode = text.charAt(location)
      switch (mode) {
        case '':
      }
      break;
    }
  }
};
var parser = parsers.HTML;

var getHashPath = function(path) {
  return path.slice(path.indexOf('/', 7));
};

var firstLoad = true;
var reloadHandles = [];

var pageLoad = function () {
  reloadHandles.forEach(dojo.disconnect);
  reloadHandles=[];
  dojo.query('a').forEach(function(anchor) {
    reloadHandles.push(dojo.connect(anchor, 'onclick', s.link.onClick));
  });
  forms = dojo.query('form');
  forms.forEach(function(form) {
    reloadHandles.push(dojo.connect(form, 'onsubmit', s.form.onSubmit));
  });
  forms.query('input[type=submit]').forEach( function(submit) {
    reloadHandles.push(dojo.connect(submit, 'onclick', s.form.buttonClick));
  });
};

var loadAjaxPage = function(path, data) {
    data = typeof data !== 'undefined' ? data : [];
    window.location.hash = getHashPath(path);
    dojo.xhrGet({
      url: path+'.html',
      load: function(result) {
        parser(result);
        pageLoad();
      }
    });
};

var loadAjaxForm = function(path, f) {
    window.location.hash = getHashPath(path);
    dojo.xhrPost({
      url: path+'.html',
      form : f,
      load: function(result) {
        parser(result);
        pageLoad();
      }
    });
};