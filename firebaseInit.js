var config = {
  apiKey: 'AIzaSyDg5QomP2mBZT5Vg2Jcphs8I8bY1C7k39Q',
  authDomain: 'ifsm-aad66.firebaseapp.com',
  databaseURL: 'https://ifsm-aad66.firebaseio.com',
  projectId: 'ifsm-aad66',
  storageBucket: '',
  messagingSenderId: '965252051843'
  // apiKey: 'AIzaSyB6PKS0Mh8NfJqRg04P81NMEjZzSyw6cV0',
  // authDomain: 'impulse-fitness-74fc0.firebaseapp.com',
  // databaseURL: 'https://impulse-fitness-74fc0.firebaseio.com',
  // projectId: 'impulse-fitness-74fc0',
  // storageBucket: 'impulse-fitness-74fc0.appspot.com',
  // messagingSenderId: '666560753403'
}

firebase.initializeApp(config)

var db = firebase.database()
var auth = firebase.auth()

function getUrlVars() {
  var vars = {}
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(
    m,
    key,
    value
  ) {
    vars[key] = value
  })
  return vars
}
