$(document).ready(function() {
    var map;
    var latitude = $('#map').data('latitude');
    var longitude = $('#map').data('longitude');

    ymaps.ready(init);

    function init () {
        map = new ymaps.Map('map', {
            center: [latitude, longitude],
            zoom: 15,
            controls: [],
        }, {
            searchControlProvider: 'yandex#search'
        });

        map.geoObjects.add(new ymaps.Placemark([latitude, longitude], {
        }, {
            preset: 'islands#dotIcon',
            iconColor: '#17488B'
        }))
    }
});
