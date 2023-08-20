function each (arr) {
  var $global = (typeof window !== 'undefined' ? window : global)
  $global.$locutus = $global.$locutus || {}
  var $locutus = $global.$locutus
  $locutus.php = $locutus.php || {}
  $locutus.php.pointers = $locutus.php.pointers || []
  var pointers = $locutus.php.pointers
  var indexOf = function (value) {
    for (var i = 0, length = this.length; i < length; i++) {
      if (this[i] === value) {
        return i
      }
    }
    return -1
  }
  if (!pointers.indexOf) {
    pointers.indexOf = indexOf
  }
  if (pointers.indexOf(arr) === -1) {
    pointers.push(arr, 0)
  }
  var arrpos = pointers.indexOf(arr)
  var cursor = pointers[arrpos + 1]
  var pos = 0
  if (Object.prototype.toString.call(arr) !== '[object Array]') {
    var ct = 0
    for (var k in arr) {
      if (ct === cursor) {
        pointers[arrpos + 1] += 1
        if (each.returnArrayOnly) {
          return [k, arr[k]]
        } else {
          return {
            1: arr[k],
            value: arr[k],
            0: k,
            key: k
          }
        }
      }
      ct++
    }
    return false
  }
  if (arr.length === 0 || cursor === arr.length) {
    return false
  }
  pos = cursor
  pointers[arrpos + 1] += 1
  if (each.returnArrayOnly) {
    return [pos, arr[pos]]
  } else {
    return {
      1: arr[pos],
      value: arr[pos],
      0: pos,
      key: pos
    }
  }
}
