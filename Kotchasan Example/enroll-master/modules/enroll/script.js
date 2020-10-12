function initEnroll(text, country) {
  birthdayChanged('register_birthday', text);
  initProvince('register', country);
  var doLevelChanged = function() {
    send(WEB_URL + "index.php/enroll/model/plan/toJSON", 'level=' + this.value, function(xhr) {
      var ds = xhr.responseText.toJSON();
      if (ds) {
        forEach($E('setup_frm').getElementsByTagName('select'), function() {
          if (/register_plan\[[0-9]\]/.test(this.name)) {
            $G(this).setOptions(ds, this.value);
          }
        });
      }
    }, this)
  };
  $G('register_level').addEvent('change', doLevelChanged);
  doLevelChanged.call($E('register_level'));
}

function initEnrollWrite() {
  $G('write_language').addEvent('change', function() {
    loader.location('index.php?module=enroll-write&language=' + this.value);
  });
}

function initEnrollPlan() {
  $G('level').addEvent('change', function() {
    loader.location('index.php?module=enroll-plan&level=' + this.value);
  });
}