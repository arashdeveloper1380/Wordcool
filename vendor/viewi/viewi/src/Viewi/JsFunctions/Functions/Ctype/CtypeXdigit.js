function ctype_xdigit (text) { 
  var setlocale = window.setlocale
  if (typeof text !== 'string') {
    return false
  }
  setlocale('LC_ALL', 0)
  var $global = (typeof window !== 'undefined' ? window : global)
  $global.$locutus = $global.$locutus || {}
  var $locutus = $global.$locutus
  var p = $locutus.php
  return text.search(p.locales[p.localeCategories.LC_CTYPE].LC_CTYPE.xd) !== -1
}
