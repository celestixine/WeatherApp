var Weather = {

        getLocation: function(value) {
            if ( value.length<2 ) return false;
            $('#suggestions').removeClass('d-none');
            fetch("https://www.php-programmiererin.de?name=" + value)
                .then(response => response.json())
                .then(function(text) {
                    if ( text.results ) {
                        text = text.results;
                        let html = "";
                        for(let i in text) {
                            html += '<div class="suggestion" onclick="Weather.getWeatherData(\'' + text[i].latitude + '\',\'' + text[i].longitude + '\',\'' + text[i].name + '\');">' + text[i].name;
                            if ( typeof(text[i].admin2)!==typeof undefined ) {
                                html += '/' + text[i].admin1;
                            }
                            if ( typeof(text[i].admin3)!==typeof undefined ) {
                                html += ' (' + text[i].admin3 + ')';
                            }
                            html += ', ' + text[i].country;
                            html += '</div>';
                        }
                        document.getElementById('suggestions').innerHTML = html;
                    }
                }).catch(error => console.error(error));
        },

        getWeatherData: function(lat,lng,name) {
            $('#suggestions').addClass('d-none');
            $('#location').val(name);
            fetch("https://www.php-programmiererin.de?lat=" + lat + '&long=' + lng)
                .then(response => response.json())
                .then(function(text) {
                    if ( text.hot ) {
                        $('#hottest-day .temperature').html(text.hot.temperature + ' Grad');
                        let html = 'In ' + name + ' war es im vergangenen Jahr am '
                            + text.hot.day + ' um ' + text.hot.hour + ' Uhr mit ' + text.hot.temperature
                            + ' Grad Celsius am Wärmsten.';
                        $('#hottest-day .text').html(html);
                        $('#hottest-day .date').html(text.hot.day + ' um ' + text.hot.hour + ' Uhr');
                        html = 'Am Kältesten war es in ' + name + ' mit ' + text.cold.temperature
                            + ' Grad Celsius am ' + text.cold.day + ' um ' + text.cold.hour + ' Uhr.';
                        $('#coldest-day .text').html(html);
                        $('#coldest-day .date').html(text.cold.day + ' um ' + text.cold.hour + ' Uhr');
                        $('#coldest-day .temperature').html(text.cold.temperature + ' Grad');
                    }
                }).catch(error => console.error(error));
        }

 };

