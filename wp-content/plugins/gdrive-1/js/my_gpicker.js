      // The Browser API key obtained from the Google Developers Console.
      //var developerKey = 'xxxxxxxYYYYYYYY-12345678';
      //constant('clientId', '333823756477-eg0lbp0qnbjq31m438lokfc9jhq2m6pu.apps.googleusercontent.com')
      //.constant('applicationId', '333823756477')
      // The Client ID obtained from the Google Developers Console. Replace with your own Client ID.
      var clientId = "333823756477-eg0lbp0qnbjq31m438lokfc9jhq2m6pu.apps.googleusercontent.com"

      // Scope to use to access user's photos.
      var scope = ['https://www.googleapis.com/auth/photos', 'https://www.googleapis.com/auth/drive'];

      var pickerApiLoaded = false;
      var oauthToken;

      // Use the API Loader script to load google.picker and gapi.auth.
      function onGapiLoad() {
        gapi.load('auth', {'callback': onAuthApiLoad});
        gapi.load('picker', {'callback': onPickerApiLoad});
      }

      function onAuthApiLoad() {
        window.gapi.auth.authorize(
            {
              'client_id': clientId,
              'scope': scope,
              'immediate': false
            },
            handleAuthResult);
      }

      function onPickerApiLoad() {
        pickerApiLoaded = true;
        createPicker();
      }

      function handleAuthResult(authResult) {
        if (authResult && !authResult.error) {
          oauthToken = authResult.access_token;
          createPicker();
        }
      }

      // Create and render a Picker object for picking user Photos.
      function createPicker() {
        if (pickerApiLoaded && oauthToken) {
          var picker = new google.picker.PickerBuilder().
          enableFeature(google.picker.Feature.MULTISELECT_ENABLED).
              addView(google.picker.ViewId.DOCS). //PHOTOS).
              setOAuthToken(oauthToken).
              setCallback(pickerCallback).
              build();
          picker.setVisible(true);
          //setDeveloperKey(developerKey).
        }
      }

      // A simple callback implementation.
      function pickerCallback(data) {
        var urls = []; //'nothing';
        if (data[google.picker.Response.ACTION] == google.picker.Action.PICKED) {
          var i;
          var doc;
          var arr=data[google.picker.Response.DOCUMENTS];
          for(i=0; i<arr.length; i++ ){
            doc = arr[i];
            urls.push(doc[google.picker.Document.URL]);
          }
        }
        var message = 'You picked: <br/> what\'s wrong <br/>' + urls.join('<br/>');
      
        var elem= document.getElementById('fileUrls');
         elem.value = JSON.stringify(urls);
         //alert(elem.value);
          
        document.getElementById('result').innerHTML = message; 
      }

