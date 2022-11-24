window.onload(()=>{
    if(document.getElementById("calendar")){
        fetch('/flight-test-date/' + day + '/' + month + '/' + year)
        .then(function(response) {
          return response.json();
        })
        .then(function(response) {
          if(response.exist === "true")
            document.getElementById(day + '-' + month + '-' + year).classList.add('display-color');
        });
      }
    }
)

