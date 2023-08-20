function strftime (fmt, timestamp) {
  var setlocale = window.setlocale
  var $global = (typeof window !== 'undefined' ? window : global)
  $global.$locutus = $global.$locutus || {}
  var $locutus = $global.$locutus
  setlocale('LC_ALL', 0)
  var _xPad = function (x, pad, r) {
    if (typeof r === 'undefined') {
      r = 10
    }
    for (; parseInt(x, 10) < r && r > 1; r /= 10) {
      x = pad.toString() + x
    }
    return x.toString()
  }
  var locale = $locutus.php.localeCategories.LC_TIME
  var lcTime = $locutus.php.locales[locale].LC_TIME
  var _formats = {
    a: function (d) {
      return lcTime.a[d.getDay()]
    },
    A: function (d) {
      return lcTime.A[d.getDay()]
    },
    b: function (d) {
      return lcTime.b[d.getMonth()]
    },
    B: function (d) {
      return lcTime.B[d.getMonth()]
    },
    C: function (d) {
      return _xPad(parseInt(d.getFullYear() / 100, 10), 0)
    },
    d: ['getDate', '0'],
    e: ['getDate', ' '],
    g: function (d) {
      return _xPad(parseInt(this.G(d) / 100, 10), 0)
    },
    G: function (d) {
      var y = d.getFullYear()
      var V = parseInt(_formats.V(d), 10)
      var W = parseInt(_formats.W(d), 10)
      if (W > V) {
        y++
      } else if (W === 0 && V >= 52) {
        y--
      }
      return y
    },
    H: ['getHours', '0'],
    I: function (d) {
      var I = d.getHours() % 12
      return _xPad(I === 0 ? 12 : I, 0)
    },
    j: function (d) {
      var ms = d - new Date('' + d.getFullYear() + '/1/1 GMT')
      ms += d.getTimezoneOffset() * 60000
      var doy = parseInt(ms / 60000 / 60 / 24, 10) + 1
      return _xPad(doy, 0, 100)
    },
    k: ['getHours', '0'],
    l: function (d) {
      var l = d.getHours() % 12
      return _xPad(l === 0 ? 12 : l, ' ')
    },
    m: function (d) {
      return _xPad(d.getMonth() + 1, 0)
    },
    M: ['getMinutes', '0'],
    p: function (d) {
      return lcTime.p[d.getHours() >= 12 ? 1 : 0]
    },
    P: function (d) {
      return lcTime.P[d.getHours() >= 12 ? 1 : 0]
    },
    s: function (d) {
      return Date.parse(d) / 1000
    },
    S: ['getSeconds', '0'],
    u: function (d) {
      var dow = d.getDay()
      return ((dow === 0) ? 7 : dow)
    },
    U: function (d) {
      var doy = parseInt(_formats.j(d), 10)
      var rdow = 6 - d.getDay()
      var woy = parseInt((doy + rdow) / 7, 10)
      return _xPad(woy, 0)
    },
    V: function (d) {
      var woy = parseInt(_formats.W(d), 10)
      var dow11 = (new Date('' + d.getFullYear() + '/1/1')).getDay()
      var idow = woy + (dow11 > 4 || dow11 <= 1 ? 0 : 1)
      if (idow === 53 && (new Date('' + d.getFullYear() + '/12/31')).getDay() < 4) {
        idow = 1
      } else if (idow === 0) {
        idow = _formats.V(new Date('' + (d.getFullYear() - 1) + '/12/31'))
      }
      return _xPad(idow, 0)
    },
    w: 'getDay',
    W: function (d) {
      var doy = parseInt(_formats.j(d), 10)
      var rdow = 7 - _formats.u(d)
      var woy = parseInt((doy + rdow) / 7, 10)
      return _xPad(woy, 0, 10)
    },
    y: function (d) {
      return _xPad(d.getFullYear() % 100, 0)
    },
    Y: 'getFullYear',
    z: function (d) {
      var o = d.getTimezoneOffset()
      var H = _xPad(parseInt(Math.abs(o / 60), 10), 0)
      var M = _xPad(o % 60, 0)
      return (o > 0 ? '-' : '+') + H + M
    },
    Z: function (d) {
      return d.toString().replace(/^.*\(([^)]+)\)$/, '$1')
    },
    '%': function (d) {
      return '%'
    }
  }
  var _date = (typeof timestamp === 'undefined')
    ? new Date()
    : (timestamp instanceof Date)
      ? new Date(timestamp)
      : new Date(timestamp * 1000)
  var _aggregates = {
    c: 'locale',
    D: '%m/%d/%y',
    F: '%y-%m-%d',
    h: '%b',
    n: '\n',
    r: 'locale',
    R: '%H:%M',
    t: '\t',
    T: '%H:%M:%S',
    x: 'locale',
    X: 'locale'
  }
  while (fmt.match(/%[cDFhnrRtTxX]/)) {
    fmt = fmt.replace(/%([cDFhnrRtTxX])/g, function (m0, m1) {
      var f = _aggregates[m1]
      return (f === 'locale' ? lcTime[m1] : f)
    })
  }
  var str = fmt.replace(/%([aAbBCdegGHIjklmMpPsSuUVwWyYzZ%])/g, function (m0, m1) {
    var f = _formats[m1]
    if (typeof f === 'string') {
      return _date[f]()
    } else if (typeof f === 'function') {
      return f(_date)
    } else if (typeof f === 'object' && typeof f[0] === 'string') {
      return _xPad(_date[f[0]](), f[1])
    } else {
      return m1
    }
  })
  return str
}
